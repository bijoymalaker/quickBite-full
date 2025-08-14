<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
            'image' => 'nullable|url',
            'is_open' => 'boolean',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'minimum_order' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            // 'user_id' => 'required|exists:users,id'
        ]);

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
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:restaurants,email,' . $restaurant->id,
            'phone' => 'sometimes|required|string|max:20',
            'address' => 'sometimes|required|string|max:500',
            'cuisine_type' => 'sometimes|required|string|max:100',
            'delivery_fee' => 'sometimes|required|numeric|min:0',
            'image' => 'nullable|url',
            'is_open' => 'boolean',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'minimum_order' => 'nullable|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

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
