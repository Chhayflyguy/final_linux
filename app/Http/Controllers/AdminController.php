<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function indexUser(Request $request)
    {
        // dd($request->all());

        // Validate the incoming request
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if($request->name == 'admin' && $request->password == 'admin') {
            // Redirect to the admin page
            return view('adminside');
        } else {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Invalid credentials');
        }
        return redirect()->back();
    }
    public function Orderindex()
    {
        $orders = Order::all();
        // dd($orders);
        return view('order', compact('orders'));
    }
    public function index()
    {
        return view('adminside');
    }

    public function indexCategory()
    {
        $categories = Category::all();
        return view('category-modal', compact('categories'));
    }

    // public function addStock(product)
    // {

    // }

    public function showProducts()
    {
        // Retrieve all products (you can add further filtering if needed)
        $products = Product::all();

        // Return the view with the products
        return view('product-index', compact('products'));
    }

    public function destroyproduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.show')->with('success', 'Product deleted successfully.');
    }

    public function createProduct()
    {
        $categories = Category::all();
        // dd($categories);
        return view('product-modal', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        // Debug request data
        \Log::info('Request data:', $request->all());

        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'unit_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $newProduct = new Product();
            $newProduct->name = $request->name;
            $newProduct->qty = $request->qty;
            $newProduct->unit_price = $request->unit_price;
            $newProduct->category_id = $request->category_id;


            if ($request->hasFile('product_image')) {
                // Store image in 'products' folder in S3 bucket
                $path = $request->file('product_image')->store('product', 's3');
                // Generate the full URL for the uploaded image
                $url = Storage::disk('s3')->url($path);
                // dd($url);
                // Save the URL in the database
                $newProduct->product_image = $url;
            }

            // dd($url);

            // Save the product to the database
            $newProduct->save();
            \Log::info('Product saved with image URL: ' . ($newProduct->product_image ?? 'No image'));

            return redirect()->route('product.create')->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            \Log::error('Product creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add product: ' . $e->getMessage());
        }
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    public function addcate(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string'
    ]);

    // Create a new Category record
    Category::create([
        'name' => $request->name
    ]);

    // Redirect to the index route with a success message
    return redirect()->route('index')->with('success', 'Category added successfully');
}
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
