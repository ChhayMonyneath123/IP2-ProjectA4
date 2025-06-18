<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    public function index()
    {
        return response()->json(Cuisine::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $cuisine = Cuisine::create($validated);
        return response()->json($cuisine, 201);
    }

    public function show(Cuisine $cuisine)
    {
        return response()->json($cuisine);
    }

    public function update(Request $request, Cuisine $cuisine)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string'
        ]);

        $cuisine->update($validated);
        return response()->json($cuisine);
    }

    public function destroy(Cuisine $cuisine)
    {
        $cuisine->delete();
        return response()->json(null, 204);
    }
    public function products(Cuisine $cuisine)
    {
        return response()->json($cuisine->products);
    }


}
