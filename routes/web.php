<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Publicly accessible routes

Route::get('/', function () {
    $restaurants = \App\Models\Restaurant::with('products')->get();
    return Inertia::render('Home', [
        'restaurants' => $restaurants
    ]);
})->name('home');

Route::get('menus', function () {
    return Inertia::render('Menus');
})->name('menus');

Route::get('offers', function () {
    return Inertia::render('Offers');
})->name('offers');

Route::get('restaurants', function () {
    $restaurants = \App\Models\Restaurant::with('products')->get();
    return Inertia::render('Restaurants', [
        'restaurants' => $restaurants
    ]);
})->name('restaurants.index');

Route::get('restaurants/create', function () {
    return Inertia::render('Restaurants/Create');
})->name('restaurants.create');

Route::get('restaurants/{restaurant}/edit', function (App\Models\Restaurant $restaurant) {
    return Inertia::render('Restaurants/Edit', [
        'restaurant' => $restaurant
    ]);
})->middleware(['auth'])->name('restaurants.edit');

Route::get('restaurants/{id}/foods', function ($id) {
    return Inertia::render('Restaurants/RestaurantFoods', ['id' => $id]);
})->name('restaurants.foods');

Route::get('tracking', function () {
    return Inertia::render('Tracking');
})->name('tracking');

Route::get('api/tracking', [App\Http\Controllers\TrackingController::class, 'trackOrder'])->name('api.tracking');

Route::get('checkout', function () {
    return Inertia::render('Checkout');
})->name('checkout');


//  Other static pages Routes

Route::get('terms-and-conditions', function () {
    return Inertia::render('otherPages/TermsAndConditions');
})->name('terms-and-conditions');

Route::get('privacy-policy', function () {
    return Inertia::render('otherPages/PrivacyPolicy');
})->name('privacy-policy');

Route::get('site-map', function () {
    return Inertia::render('otherPages/SiteMap');
})->name('site-map');

Route::get('contact-us', function () {
    return Inertia::render('otherPages/ContactUs');
})->name('contact-us');

Route::get('cookies', function () {
    return Inertia::render('otherPages/Cookies');
})->name('cookies');

Route::get('modern-slavery-statement', function () {
    return Inertia::render('otherPages/ModernSlaveryStatement');
})->name('modern-slavery-statement');

Route::get('corporate-documents', function () {
    return Inertia::render('otherPages/CorporateDocuments');
})->name('corporate-documents');

Route::get('do-not-sell-my-personal-information', function () {
    return Inertia::render('otherPages/DoNotSellMyPersonalInformation');
})->name('do-not-sell-my-personal-information');




// Authenticated user routes

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
    return Inertia::render('Restaurants/Index', [
        'restaurant' => $restaurant
    ]);
})->middleware(['auth', 'verified'])->name('restaurant.dashboard');

// Restaurant management routes
Route::middleware(['auth'])->group(function () {
    Route::get('api/restaurants', [RestaurantController::class, 'index'])->name('api.restaurants.index');
    Route::post('api/restaurants', [RestaurantController::class, 'store'])->name('api.restaurants.store');
    Route::get('api/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('api.restaurants.show');
    Route::get('api/restaurants/{id}/foods', [ProductController::class, 'restaurantFoods'])->name('api.restaurants.foods');
Route::put('api/restaurants/{restaurant}', [RestaurantController::class, 'update'])->name('api.restaurants.update');
Route::put('api/restaurants/{id}', [RestaurantController::class, 'updateById'])->name('api.restaurants.update-by-id');
    Route::delete('api/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->name('api.restaurants.destroy');
});


// Product management routes
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// API route for menu products
Route::get('api/menu-products', [ProductController::class, 'menuProducts'])->name('api.menu-products');




// SSLCOMMERZ Start

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);

Route::match(['get', 'post'], '/success', [SslCommerzPaymentController::class, 'success']);
Route::match(['get', 'post'], '/fail', [SslCommerzPaymentController::class, 'fail']);
Route::match(['get', 'post'], '/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

Route::post('/orders/cash', [SslCommerzPaymentController::class, 'createCashOrder']);

//SSLCOMMERZ END

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
