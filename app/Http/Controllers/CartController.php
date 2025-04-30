<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Redis;

class CartController extends Controller
{
    public function checkoutbuy(Request $request)
    {
        // Validate the input fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
        ]);

        // Get the cart from session
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Prepare items array for storage (itemid and qty)
        $items = collect($cart)->map(function ($item, $itemId) {
            return [
                'itemid' => $itemId,
                'qty' => isset($item['quantity']) ? (int)$item['quantity'] : 0,
            ];
        })->values()->toArray();

        // Calculate total
        $total = collect($cart)->sum(function ($item) {
            if (!isset($item['quantity'])) {
                return 0;
            }
            $price = isset($item['unit_price']) ? $item['unit_price'] : (isset($item['price']) ? $item['price'] : 0);
            return (float)$price * (int)$item['quantity'];
        });

        // Save the order
        $order = new Order();
        $order->name = $validated['name'];
        $order->phone = $validated['phone'];
        $order->items = $items; // Automatically encoded as JSON
        $order->total = $total;
        $order->save();

        // Clear the cart
        $request->session()->forget('cart');

        // Redirect with success message
        return redirect()->back()->with('success', 'Order placed successfully!');
    }

    public function add(Request $request)
    {

        // Get the product ID from the request
        $productId = $request->input('productid'); // Use 'productid' as per your form
        $quantity = $request->input('quantity', 1); // Default to 1 if quantity is not provided

        // Find the product by ID
        $product = Product::findOrFail($productId); // Throws 404 if product not foun

        // dd($product);

        // Get or initialize the cart from session
        $cart = session()->get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$productId])) {
            // Increment quantity
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Add new product to cart
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->unit_price,
                'quantity' => $quantity,
                'image' => $product->product_image,
            ];
        }

        // Save the updated cart back to session
        session()->put('cart', $cart);

        // dd(session()->get('cart'));

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function clear(Request $request)
    {
        // Clear the cart by removing the 'cart' key from the session
        $request->session()->forget('cart');

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'unit_price' => $product->unit_price,
                'quantity' => 1,
                'image' => $product->product_image,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Added to cart']);
    }

    public function purchase(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'phone' => 'required|string',
        'cart' => 'required|array'
    ]);

    $order = Order::create([
        'customer_name' => $request->name,
        'customer_phone' => $request->phone,
        'total' => collect($request->cart)->sum(fn($item) => $item['price'] * $item['qty']),
    ]);

    foreach ($request->cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'qty' => $item['qty'],
            'price' => $item['price'],
        ]);
    }

    return response()->json(['success' => true]);
}

    // public function add(Request $request, Product $product)
    // {
    //     // dd("tam ng men");
    //     if (!$product || $product->qty <= 0) {
    //         if ($request->expectsJson()) {
    //             return response()->json(['error' => 'Product is out of stock.'], 422);
    //         }
    //         return redirect()->back()->with('error', 'Product is out of stock.');
    //     }

    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$product->id])) {
    //         $cart[$product->id]['quantity']++;
    //     } else {
    //         $cart[$product->id] = [
    //             'name' => $product->name,
    //             'quantity' => 1,
    //             'price' => $product->unit_price,
    //             'image' => $product->product_image,
    //         ];
    //     }

    //     session()->put('cart', $cart);

    //     if ($request->expectsJson()) {
    //         return response()->json([
    //             'success' => 'Product added to cart!',
    //             'cart' => $cart,
    //             'cartCount' => count($cart),
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Product added to cart!');
    // }

    public function remove(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']--;
            if ($cart[$product->id]['quantity'] <= 0) {
                unset($cart[$product->id]);
            }
            session()->put('cart', $cart);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => 'Product quantity decreased!',
                'cart' => $cart,
                'cartCount' => count($cart),
            ]);
        }

        return redirect()->back()->with('success', 'Product quantity decreased!');
    }

    public function checkout(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'phone' => 'required|string',
        'items' => 'required|string',
        'quantities' => 'required|string',
        'prices' => 'required|string',
        'total_price' => 'required|numeric',
    ]);

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return response()->json(['error' => 'Cart is empty.'], 400);
    }

    $order = Order::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'items' => json_decode($request->items, true),
        'quantities' => json_decode($request->quantities, true),
        'prices' => json_decode($request->prices, true),
        'total_price' => $request->total_price,
    ]);

    session()->forget('cart');

    return response()->json(['success' => 'Checkout successful!', 'cart' => []]);
}

}