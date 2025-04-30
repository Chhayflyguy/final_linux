<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/checkout', [CartController::class, 'checkoutbuy'])->name('cart.checkout');


Route::get('/Order-Index', [AdminController::class, 'Orderindex'])->name('order.index');
Route::get('/Admin-Side', [AdminController::class, 'index'])->name('index');
Route::get('/Admin-category', [AdminController::class, 'indexCategory'])->name('categories.index');
Route::post('add-Categpry', [AdminController::class , 'addcate'])->name('addCategory');
Route::post('/store-category', [AdminController::class, 'storeCategory'])->name('categories.store');
Route::delete('/categories/{id}', [AdminController::class, 'destroy'])->name('categories.destroy');
Route::get('/product/create', [AdminController::class, 'createProduct'])->name('product.create');
Route::post('/product', [AdminController::class, 'storeProduct'])->name('product.store');
Route::get('/show-products', [AdminController::class, 'showProducts'])->name('products.show');
Route::delete('products/{product}', [AdminController::class, 'destroyproduct'])->name('product.destroy');
Route::patch('/products/{product}/add-stock', [AdminController::class, 'addStock'])->name('product.addStock');

// Route::post('/cart/checkout', [CartController::class, 'checkout']);





