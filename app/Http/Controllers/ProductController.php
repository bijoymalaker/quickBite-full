<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Products/Index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'restaurant_id' => 'required|exists:restaurants,id',
            'image' => 'nullable|image|max:2048',
            'is_available' => 'boolean',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->restaurant_id = $request->restaurant_id;
        $product->is_available = $request->is_available ?? true;

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'is_available' => 'boolean',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->is_available = $request->is_available ?? true;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Get products for the menu page with filtering.
     */
    public function menuProducts(Request $request)
    {
        $query = Product::where('is_available', true);

        if ($request->category && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        // Pagination parameters
        $perPage = $request->input('per_page', 9); // default 9 items per page
        $page = $request->input('page', 1);

        $products = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($products);
    }

    /**
     * Get all food items for a specific restaurant.
     */
    public function restaurantFoods($restaurantId)
    {
        $foods = Product::where('restaurant_id', $restaurantId)->get();
        return response()->json($foods);
    }

    /**
     * Get unique categories with product counts.
     */
    public function getCategories()
    {
        $categories = Product::select('category', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get();
        return response()->json($categories);
    }
}