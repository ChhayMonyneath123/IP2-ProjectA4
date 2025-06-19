<?php

namespace App\Http\Controllers;

use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
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
}
