<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('menus', function () {
    return Inertia::render('Menus');
})->name('menus');

Route::get('offers', function () {
    return Inertia::render('Offers');
})->name('offers');

Route::get('restaurants', function () {
    return Inertia::render('Restaurants');
})->name('restaurants');

Route::get('tracking', function () {
    return Inertia::render('Tracking');
})->name('tracking');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Product management routes
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('products', [ProductController::class, 'index'])->name('products.index');
//     Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
//     Route::post('products', [ProductController::class, 'store'])->name('products.store');
//     Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
//     Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
//     Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
// });

Route::group([], function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// API route for menu products
Route::get('api/menu-products', [ProductController::class, 'menuProducts'])->name('api.menu-products');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

// Catch-all route to redirect unknown paths to home
// Route::get('/{any}', function () {
//     return redirect()->route('home');
// })->where('any', '.*');
