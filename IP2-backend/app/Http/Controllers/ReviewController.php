<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews
     */
    public function index(Request $request)
    {
        $request->validate([
            'sort_by' => 'sometimes|in:created_at,rating,user.name',
            'order' => 'sometimes|in:asc,desc',
            'per_page' => 'sometimes|integer|min:1|max:100',
            'search' => 'sometimes|string|max:255'
        ]);

        $query = Review::with(['user:user_id,name,email', 'product:product_id,title'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('message', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('product', function ($q) use ($request) {
                        $q->where('title', 'like', '%' . $request->search . '%');
                    });
            });

        // Sorting
        switch ($request->sort_by) {
            case 'user.name':
                $query->join('users', 'reviews.user_id', '=', 'users.user_id')
                    ->orderBy('users.name', $request->order ?? 'asc')
                    ->select('reviews.*');
                break;
            default:
                $query->orderBy(
                    $request->sort_by ?? 'created_at',
                    $request->order ?? 'desc'
                );
        }

        return $query->paginate($request->per_page ?? 10);
    }

    /**
     * Store a newly created review
     */
    public function store(Request $request)
{
    try {
        $request->validate([
            'product_id' => 'required|exists:products,product_id', // ✅ fixed
            'user_id' => 'required|exists:users,user_id',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:1000'
        ]);

        $review = Review::create($request->only([
            'product_id',
            'user_id',
            'rating',
            'message'
        ]));

        return response()->json([
            'message' => 'Review created successfully',
            'review' => $review->load(['user', 'product']), // ✅ include relations
        ], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



    /**
     * Update the specified review
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'rating' => 'sometimes|integer|min:1|max:5'
        ]);

        $review->update($request->only(['message', 'rating']));

        return response()->json([
            'message' => 'Review updated successfully',
            'review' => $review->load(['user:user_id,name,email', 'product:product_id,title']),

        ]);
    }

    /**
     * Remove the specified review
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }

    /**
     * Add/update reply to a review
     */
    public function reply(Request $request, Review $review)
    {
        $request->validate([
            'reply' => 'required|string|max:1000'
        ]);

        $review->update(['reply' => $request->reply]);

        return response()->json([
            'message' => 'Reply saved successfully',
            'review' => $review->load(['user', 'product'])
        ]);
    }

    /**
     * Get review statistics
     */
    public function stats()
    {
        return response()->json([
            'total_reviews' => Review::count(),
            'average_rating' => round(Review::avg('rating'), 1),
            'reviews_without_reply' => Review::whereNull('reply')->count(),
            'rating_distribution' => Review::selectRaw('rating, count(*) as count')
                ->groupBy('rating')
                ->orderBy('rating', 'desc')
                ->get()
        ]);
    }

}
