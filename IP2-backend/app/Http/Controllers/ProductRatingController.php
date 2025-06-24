<?php

namespace App\Http\Controllers;

use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    // POST /products/{productId}/ratings
    public function store(Request $request, $productId)
    {
        // Check if the user is authenticated; if not, set the user_id to 1 (default for anonymous)
        $user_id = $request->user() ? $request->user()->id : 1; // Default to 1 if not authenticated

        // Validate the rating and comment input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Create the product review (for authenticated or anonymous user)
        $rating = ProductRating::create([
            'product_id' => $productId,
            'user_id' => $user_id, // Use the user_id from the request or default to 1
            'rating' => $validated['rating'],
            'comment' => $validated['comment']
        ]);

        // Load the user information (if any)
        $rating->load('user:id,name,avatar');

        return response()->json(['status' => 'success', 'data' => $rating], 201);
    }

    // GET /products/{productId}/ratings
    public function index($productId)
{
    $ratings = ProductRating::where('product_id', $productId)
        ->with('user:id,name,avatar') // Ensure you're loading the user details
        ->orderByDesc('created_at')
        ->get(['id', 'product_id', 'user_id', 'rating', 'comment', 'created_at']); // Specify the fields you want to return

    // Return the response with status and data
    return response()->json(['status' => 'success', 'data' => $ratings]);
}



    // Update review (only for the authenticated user who owns the review)
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

    // DELETE /api/ratings/{id} (only for the owner of the review)
    public function destroy(Request $request, $id)
    {
        $rating = ProductRating::findOrFail($id);

        // Ensure the logged-in user owns the review
        if ($request->user()->id !== $rating->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $rating->delete();

        return response()->json(['status' => 'success', 'message' => 'Review deleted']);
    }
}
