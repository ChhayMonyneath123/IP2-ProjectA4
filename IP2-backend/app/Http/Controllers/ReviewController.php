<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    // List all reviews
    public function index()
    {
        // Get all reviews with replies (assuming replies are stored in the same table or related)
        $reviews = Review::with('replies')->get();

        return response()->json($reviews);
    }

    // Create a new review
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'user_id' => 'required|integer|exists:users,id', // or get from auth()->id()
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $review = Review::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Review created', 'review' => $review], 201);
    }

    // Update a review
    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['error' => 'Review not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'sometimes|integer|min:1|max:5',
            'comment' => 'sometimes|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $review->update($request->only(['rating', 'comment']));

        return response()->json(['message' => 'Review updated', 'review' => $review]);
    }

    // Delete a review
    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['error' => 'Review not found'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted']);
    }

    // Admin reply to a review
    public function reply(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['error' => 'Review not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'reply' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Assuming your replies are stored in a related model like ReviewReply
        // or you have a 'reply' field on Review model, adjust accordingly.

        // Option 1: If replies are a separate model with a relationship
        // $review->replies()->create([
        //     'admin_id' => auth()->id(),
        //     'reply' => $request->reply,
        // ]);

        // Option 2: If you just store a single reply in the review table
        $review->reply = $request->reply;
        $review->save();

        return response()->json(['message' => 'Reply added', 'review' => $review]);
    }
}
