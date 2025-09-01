# QuickBite Restaurant Management System

## Overview
This is a comprehensive restaurant and food management system built with Laravel and Inertia.js.

## Features
- Restaurant management with full CRUD operations
- Food item management with categories and images
- Restaurant-specific food listings
- Clean and responsive UI

## Pages and Routes

### Restaurant Management
- **Restaurants/Index.vue** - List all restaurants
- **Restaurants/Create.vue** - Add new restaurant
- **Restaurants/RestaurantFoods.vue** - Show foods for specific restaurant

### Food Management
- **Foods/Index.vue** - List all food items
- **Foods/Create.vue** - Add new food item

### Routes
- `/restaurants` - List all restaurants
- `/restaurants/create` - Add new restaurant
- `/restaurants/{id}/foods` - Show foods for specific restaurant
- `/foods` - List all food items
- `/foods/create` - Add new food item

## Usage
1. Navigate to `/restaurants` to view all restaurants
2. Click "Add Restaurant" to add new restaurants
3. Click "View Foods" on any restaurant to see their food items
4. Navigate to `/foods` to manage food items


## SSL config

SSLCZ_STORE_ID=quick68b52ad1379ae
SSLCZ_STORE_PASSWORD=quick68b52ad1379ae@ssl
SSLCZ_TESTMODE=true #true for sandbox and false for live
