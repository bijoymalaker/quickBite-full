<?php

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

Route::get('login', function () {
    return Inertia::render('Login');
})->name('login');

// Catch-all route to redirect unknown paths to home
Route::get('/{any}', function () {
    return redirect()->route('home');
})->where('any', '.*');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
