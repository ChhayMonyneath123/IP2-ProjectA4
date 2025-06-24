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
        'user_id' => 'required|integer|exists:users,id'  // Keep this since there's no auth
    ]);

    $rating = ProductRating::create([
        'product_id' => $productId,
        'user_id' => $validated['user_id'], // Must be passed from frontend
        'rating' => $validated['rating'],
        'comment' => $validated['comment']
    ]);

    $rating->load('user:id,name,avatar');

    return response()->json(['status' => 'success', 'data' => $rating], 201);
}


    // GET /products/{productId}/ratings
   public function index($productId)
{
    $ratings = ProductRating::where('product_id', $productId)
        ->with('user:id,name,avatar') // include avatar
        ->orderByDesc('created_at')
        ->get();

    return response()->json(['status' => 'success', 'data' => $ratings]);
}
public function update(Request $request, $id)
{
    $rating = ProductRating::findOrFail($id);

    // Ensure the logged-in user owns the review
    if ($request->user()->id !== $rating->user_id) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
    ]);

    $rating->update($validated);
    $rating->load('user:id,name,avatar');

    return response()->json(['status' => 'success', 'data' => $rating]);
}
//DELETE /api/ratings/{id}
public function destroy(Request $request, $id)
{
    $rating = ProductRating::findOrFail($id);

    if ($request->user()->id !== $rating->user_id) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $rating->delete();

    return response()->json(['status' => 'success', 'message' => 'Review deleted']);
}


}
