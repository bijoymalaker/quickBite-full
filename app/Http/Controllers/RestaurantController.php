<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $restaurants = Restaurant::with('products')->get();
        return response()->json($restaurants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:restaurants,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'cuisine_type' => 'required|string|max:100',
            'delivery_fee' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_open' => 'nullable|in:0,1,true,false',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'minimum_order' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
            $validated['image'] = $imagePath;
        }

        // Add authenticated user ID to the restaurant data
        $validated['user_id'] = Auth::user()->id;

        $restaurant = Restaurant::create($validated);
        return response()->json($restaurant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant): JsonResponse
    {
        $restaurant->load('products');
        return response()->json($restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant): JsonResponse
    {
        // Check if the authenticated user owns this restaurant
        if ($restaurant->user_id !== Auth::user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Prepare validation rules with proper data type handling
        $rules = [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:restaurants,email,' . $restaurant->id,
            'phone' => 'sometimes|required|string|max:20',
            'address' => 'sometimes|required|string|max:500',
            'cuisine_type' => 'sometimes|required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_open' => 'nullable|in:0,1,true,false',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'rating' => 'nullable|numeric|min:0|max:5',
        ];

        // Handle numeric fields that might be empty strings
        if ($request->has('delivery_fee') && $request->delivery_fee !== '') {
            $rules['delivery_fee'] = 'required|numeric|min:0';
        } else {
            $rules['delivery_fee'] = 'nullable|numeric|min:0';
        }

        if ($request->has('minimum_order')) {
            $rules['minimum_order'] = 'nullable|numeric|min:0';
        }

        $validated = $request->validate($rules);

        // Handle image upload for updates
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
            $validated['image'] = $imagePath;
        }

        $restaurant->update($validated);
        return response()->json($restaurant);
    }

    /**
     * Update the specified resource in storage by ID.
     */
    public function updateById(Request $request, $id): JsonResponse
    {
        $restaurant = Restaurant::findOrFail($id);

        // Check if the authenticated user owns this restaurant
        if ($restaurant->user_id !== Auth::user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Prepare validation rules with proper data type handling
        $rules = [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:restaurants,email,' . $restaurant->id,
            'phone' => 'sometimes|required|string|max:20',
            'address' => 'sometimes|required|string|max:500',
            'cuisine_type' => 'sometimes|required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_open' => 'nullable|in:0,1,true,false',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'rating' => 'nullable|numeric|min:0|max:5',
        ];

        // Handle numeric fields that might be empty strings
        if ($request->has('delivery_fee') && $request->delivery_fee !== '') {
            $rules['delivery_fee'] = 'required|numeric|min:0';
        } else {
            $rules['delivery_fee'] = 'nullable|numeric|min:0';
        }

        if ($request->has('minimum_order')) {
            $rules['minimum_order'] = 'nullable|numeric|min:0';
        }

        $validated = $request->validate($rules);

        // Handle image upload for updates
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
            $validated['image'] = $imagePath;
        }

        $restaurant->update($validated);
        return response()->json($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant): JsonResponse
    {
        $restaurant->delete();
        return response()->json(null, 204);
    }
}
