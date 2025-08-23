<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
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
    $restaurants = \App\Models\Restaurant::with('products')->get();
    return Inertia::render('Restaurants/Index', [
        'restaurants' => $restaurants
    ]);
})->name('restaurants.index');

Route::get('restaurants/create', function () {
    return Inertia::render('Restaurants/Create');
})->name('restaurants.create');

Route::get('restaurants/{id}/foods', function ($id) {
    return Inertia::render('Restaurants/RestaurantFoods', ['id' => $id]);
})->name('restaurants.foods');

Route::get('foods', function () {
    return Inertia::render('Foods/Index');
})->name('foods.index');

Route::get('foods/create', function () {
    return Inertia::render('Foods/Create');
})->name('foods.create');

Route::get('tracking', function () {
    return Inertia::render('Tracking');
})->name('tracking');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('restaurant/login', function () {
    return Inertia::render('auth/RestaurantLogin');
})->name('restaurant.login');

Route::get('restaurant/register', function () {
    return Inertia::render('auth/RestaurantRegister');
})->name('restaurant.register');

Route::get('restaurant/dashboard', function () {
    $restaurant = \App\Models\Restaurant::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
    return Inertia::render('RestaurantDashboard', [
        'restaurant' => $restaurant
    ]);
})->middleware(['auth', 'verified'])->name('restaurant.dashboard');

// Restaurant management routes
Route::get('api/restaurants', [RestaurantController::class, 'index'])->name('api.restaurants.index');
Route::post('api/restaurants', [RestaurantController::class, 'store'])->name('api.restaurants.store');
Route::get('api/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('api.restaurants.show');
Route::put('api/restaurants/{restaurant}', [RestaurantController::class, 'update'])->name('api.restaurants.update');
Route::delete('api/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->name('api.restaurants.destroy');

// Food management routes
Route::get('api/foods', [ProductController::class, 'index'])->name('api.foods.index');
Route::post('api/foods', [ProductController::class, 'store'])->name('api.foods.store');
Route::get('api/foods/{food}', [ProductController::class, 'show'])->name('api.foods.show');
Route::put('api/foods/{food}', [ProductController::class, 'update'])->name('api.foods.update');
Route::delete('api/foods/{food}', [ProductController::class, 'destroy'])->name('api.foods.destroy');
Route::get('api/restaurants/{restaurant}/foods', [ProductController::class, 'restaurantFoods'])->name('api.restaurants.foods');

// Product management routes
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// API route for menu products
Route::get('api/menu-products', [ProductController::class, 'menuProducts'])->name('api.menu-products');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
