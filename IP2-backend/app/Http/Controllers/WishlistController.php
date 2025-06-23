<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WishlistController extends Controller
{
    /**
     * Get wishlist items for a user
     */
    public function getWishlistItems(Request $request)
    {
        try {
            $userId = $request->get('user_id');
            
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User ID is required'
                ], 400);
            }

            $wishlistItems = DB::table('wishlists')
                ->join('products', 'wishlists.product_id', '=', 'products.product_id')
                ->leftJoin('categories', 'products.category_id', '=', 'categories.category_id')
                ->select(
                    'wishlists.*',
                    'products.title as product_name',
                    'products.description as product_description',
                    'products.price as product_price',
                    'products.image as product_image',
                    'categories.name as category_name'
                )
                ->where('wishlists.user_id', $userId)
                ->orderBy('wishlists.created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'wishlist_items' => $wishlistItems,
                'wishlist_summary' => [
                    'total_items' => $wishlistItems->count()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch wishlist items',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add item to wishlist
     */
    public function addToWishlist(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|integer',
                'user_id' => 'required|integer'
            ]);

            $productId = $request->product_id;
            $userId = $request->user_id;

            // Check if product exists
            $product = DB::table('products')
                ->where('product_id', $productId)
                ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            // Check if item already exists in wishlist
            $existingWishlistItem = DB::table('wishlists')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($existingWishlistItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item already in wishlist'
                ], 400);
            }

            // Add new item to wishlist
            $now = Carbon::now();
            
            DB::table('wishlists')->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            // Get wishlist count
            $wishlistCount = DB::table('wishlists')
                ->where('user_id', $userId)
                ->count();

            return response()->json([
                'success' => true,
                'message' => 'Item added to wishlist successfully',
                'wishlist_count' => $wishlistCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add item to wishlist',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove item from wishlist
     */
    public function removeFromWishlist($wishlistId, Request $request)
    {
        try {
            $userId = $request->user_id;

            $deleted = DB::table('wishlists')
                ->where('wishlist_id', $wishlistId)
                ->where('user_id', $userId)
                ->delete();

            if ($deleted) {
                // Get updated wishlist count
                $wishlistCount = DB::table('wishlists')
                    ->where('user_id', $userId)
                    ->count();

                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from wishlist successfully',
                    'wishlist_count' => $wishlistCount
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Wishlist item not found'
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from wishlist',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check if item is in wishlist
     */
    public function checkWishlistStatus(Request $request)
    {
        try {
            $userId = $request->get('user_id');
            $productId = $request->get('product_id');

            if (!$userId || !$productId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User ID and Product ID are required'
                ], 400);
            }

            $exists = DB::table('wishlists')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->exists();

            return response()->json([
                'success' => true,
                'in_wishlist' => $exists
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check wishlist status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Test endpoint
     */
    public function test()
    {
        return response()->json([
            'success' => true,
            'message' => 'Wishlist API is working!',
            'timestamp' => now()
        ]);
    }
}