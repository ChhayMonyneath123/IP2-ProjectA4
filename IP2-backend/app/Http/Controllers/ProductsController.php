<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return response()->json(Product::with(['category', 'cuisine', 'beverageType', 'subcategory'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|url',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,category_id',
            'cuisine_id' => 'nullable|exists:cuisines,cuisine_id',
            'beverage_type_id' => 'nullable|exists:beverages,beverage_type_id',
            'delivery_time' => 'required|date_format:H:i:s',
            'rating' => 'nullable|numeric|between:0,5'
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product->load(['category', 'cuisine', 'beverageType', 'subcategory']));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'image' => 'sometimes|url',
            'quantity' => 'sometimes|integer|min:0',
            'category_id' => 'sometimes|exists:categories,category_id',
            'cuisine_id' => 'nullable|exists:cuisines,cuisine_id',
            'beverage_type_id' => 'nullable|exists:beverages,beverage_type_id',
            'delivery_time' => 'sometimes|date_format:H:i:s',
            'rating' => 'nullable|numeric|between:0,5'
        ]);

        $product->update($validated);
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }

    public function filterByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)
            ->with(['category', 'cuisine', 'beverageType'])
            ->get();
        return response()->json($products);
    }
}