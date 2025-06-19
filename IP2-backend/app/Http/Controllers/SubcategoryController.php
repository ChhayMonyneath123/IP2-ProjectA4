<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return response()->json(Subcategory::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id'
        ]);

        $subcategory = Subcategory::create($validated);
        return response()->json($subcategory, 201);
    }

    public function show(Subcategory $subcategory)
    {
        return response()->json($subcategory);
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'sometimes|exists:categories,category_id'
        ]);

        $subcategory->update($validated);
        return response()->json($subcategory);
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return response()->json(null, 204);
    }

    public function products(Subcategory $subcategory)
    {
        return response()->json($subcategory->products);
    }
}
