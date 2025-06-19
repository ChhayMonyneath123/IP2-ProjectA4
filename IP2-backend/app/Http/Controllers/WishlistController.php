<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json($user->wishlistItems()->with('product')->get());
    }

    public function store(Request $request)
    {
        $user = $request->user();
        
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id'
        ]);

        $wishlistItem = Wishlist::firstOrCreate([
            'user_id' => $user->user_id,
            'product_id' => $validated['product_id']
        ]);

        return response()->json($wishlistItem->load('product'), 201);
    }

    public function destroy(Wishlist $wishlist)
    {
        $this->authorize('delete', $wishlist);
        
        $wishlist->delete();
        return response()->json(null, 204);
    }
}