<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
{
    $products = Product::with('category')
        ->where('qty', '>', 0)
        ->get()
        ->groupBy('category_id');
    $categories = Category::all()->keyBy('id');

    $cart = session()->get('cart', []);

    // Calculate total, handle missing keys
    // dd($cart); // Check the cart contents
    $total = collect($cart)->sum(function ($item) {
        if (!isset($item['quantity'])) {
            return 0;
        }
        $price = isset($item['unit_price']) ? $item['unit_price'] : (isset($item['price']) ? $item['price'] : 0);
        return (float)$price * (int)$item['quantity'];
    });
    // dd($total);
    $itemCount = collect($cart)->sum(function ($item) {
        return isset($item['quantity']) ? $item['quantity'] : 0;
    });

    return view('dashboard', compact('products', 'categories', 'cart', 'total', 'itemCount'));
}
}
