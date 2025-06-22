<?php

namespace App\Http\Controllers;

use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    // POST /products/{productId}/ratings
    public function store(Request $request, $productId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $rating = ProductRating::create([
            'product_id' => $productId,
            'user_id' => $validated['user_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment']
        ]);

        return response()->json(['status' => 'success', 'data' => $rating], 201);
    }

    // GET /products/{productId}/ratings
    public function index($productId)
    {
        $ratings = ProductRating::where('product_id', $productId)
            ->with('user:id,name') // include user name only
            ->get();

        return response()->json(['status' => 'success', 'data' => $ratings]);
    }
}
