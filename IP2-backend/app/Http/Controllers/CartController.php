<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CartController extends Controller
{
    /**
     * Test endpoint
     */
    public function test()
    {
        return response()->json([
            'success' => true,
            'message' => 'Cart API is working!',
            'timestamp' => now()
        ]);
    }

    /**
     * Add item to cart
     */
    public function addToCart(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'integer|min:1',
                'user_id' => 'required|integer'
            ]);

            $productId = $request->product_id;
            $quantity = $request->quantity ?? 1;
            $userId = $request->user_id;

            $product = DB::table('products')
                ->where('product_id', $productId)
                ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            $unitPrice = (float) $product->price;
            $subtotal = $quantity * $unitPrice;
            $now = Carbon::now();

            $existingCartItem = DB::table('cart')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($existingCartItem) {
                $newQuantity = $existingCartItem->quantity + $quantity;
                $newSubtotal = $newQuantity * $unitPrice;

                DB::table('cart')
                    ->where('cart_id', $existingCartItem->cart_id)
                    ->update([
                        'quantity' => $newQuantity,
                        'unit_price' => $unitPrice,
                        'subtotal' => $newSubtotal,
                        'updated_at' => $now
                    ]);

                $message = 'Cart item quantity updated successfully';
            } else {
                DB::table('cart')->insert([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);

                $message = 'Item added to cart successfully';
            }

            $cartTotal = DB::table('cart')
                ->where('user_id', $userId)
                ->sum('subtotal');

            $cartItemCount = DB::table('cart')
                ->where('user_id', $userId)
                ->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_total' => (float) $cartTotal,
                'cart_item_count' => (int) $cartItemCount
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add item to cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cart items for a user
     */
    public function getCartItems(Request $request)
    {
        try {
            $userId = $request->get('user_id');
            
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User ID is required'
                ], 400);
            }

            $cartItems = DB::table('cart')
                ->join('products', 'cart.product_id', '=', 'products.product_id')
                ->leftJoin('categories', 'products.category_id', '=', 'categories.category_id')
                ->select(
                    'cart.*',
                    'products.title as product_name',
                    'products.description as product_description',
                    'products.image as product_image',
                    'categories.name as category_name'
                )
                ->where('cart.user_id', $userId)
                ->orderBy('cart.created_at', 'desc')
                ->get();

            $cartTotal = $cartItems->sum('subtotal');
            $itemCount = $cartItems->sum('quantity');

            return response()->json([
                'success' => true,
                'cart_items' => $cartItems,
                'cart_summary' => [
                    'total_items' => $itemCount,
                    'total_amount' => $cartTotal,
                    'item_count' => $cartItems->count()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch cart items',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart($cartId, Request $request)
    {
        try {
            $userId = $request->user_id;

            $deleted = DB::table('cart')
                ->where('cart_id', $cartId)
                ->where('user_id', $userId)
                ->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from cart successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart item not found'
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart item quantity
     */
    
    public function updateCartItem(Request $request, $cartId)
{
    try {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'user_id' => 'required|integer',
        ]);

        $quantity = $request->quantity;
        $userId = $request->user_id;

        // Find the cart item
        $cartItem = DB::table('cart')
            ->where('cart_id', $cartId)
            ->where('user_id', $userId)
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found',
            ], 404);
        }

        // Get product price
        $product = DB::table('products')
            ->where('product_id', $cartItem->product_id)
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $unitPrice = (float) $product->price;
        $subtotal = $unitPrice * $quantity;
        $now = Carbon::now();

        // Update the cart item
        DB::table('cart')
            ->where('cart_id', $cartId)
            ->update([
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
                'updated_at' => $now,
            ]);

        // Optionally return updated cart summary
        $cartTotal = DB::table('cart')
            ->where('user_id', $userId)
            ->sum('subtotal');

        $cartItemCount = DB::table('cart')
            ->where('user_id', $userId)
            ->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Cart item updated successfully',
            'cart_total' => (float) $cartTotal,
            'cart_item_count' => (int) $cartItemCount,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update cart item',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
