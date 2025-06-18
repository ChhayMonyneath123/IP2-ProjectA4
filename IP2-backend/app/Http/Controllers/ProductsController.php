<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProductsController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index()
    {
        try {
            $products = Product::with(['category', 'subcategory', 'ratings'])->get();
            
            // Calculate average rating for each product
            $products->each(function ($product) {
            $product->average_rating = $product->ratings->avg('rating') ?? 0;
            $product->category_name = $product->category->name ?? 'Unknown';
            $product->subcategory_name = $product->subcategory->name ?? 'Unknown';
        });
            
            return response()->json([
                'status' => 'success',
                'data' => $products,
                'message' => 'Products retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            return $this->errorResponse('Failed to retrieve products', $e);
        }
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'image' => 'required|url|max:255',
            'quantity' => 'required|integer|min:0|max:999999',
            'category_id' => 'required|exists:categories,category_id',
            'subcategory_id' => 'nullable|exists:subcategories,subcategory_id',

            'estimated_delivery_minutes' => 'required|integer|min:5|max:300',
        ]);

        try {
            $product = Product::create($validated);
            
            return response()->json([
                'status' => 'success',
                'data' => $product,
                'message' => 'Product created successfully'
            ], 201);
        } catch (\Exception $e) {
            Log::error('Product creation failed: ' . $e->getMessage());
            return $this->errorResponse('Failed to create product', $e);
        }
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        try {
            // Load relationships and calculate average rating
            $product->load(['category', 'subcategory', 'ratings']);
            $product->average_rating = $product->ratings->avg('rating') ?? 0;
            $product->rating_count = $product->ratings->count();
            
            // Calculate estimated delivery time
            $product->estimated_delivery_time = Carbon::now()
                ->addMinutes($product->estimated_delivery_minutes)
                ->format('H:i');
            
            return response()->json([
                'status' => 'success',
                'data' => $product,
                'message' => 'Product retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch product: ' . $e->getMessage());
            return $this->errorResponse('Failed to retrieve product', $e);
        }
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0|max:999999.99',
            'image' => 'sometimes|url|max:255',
            'quantity' => 'sometimes|integer|min:0|max:999999',
            'category_id' => 'sometimes|exists:categories,id',
            'subcategory_id' => 'sometimes|exists:subcategories,id',
            'estimated_delivery_minutes' => 'sometimes|integer|min:5|max:300',
        ]);

        try {
            $product->update($validated);
            
            return response()->json([
                'status' => 'success',
                'data' => $product->fresh(['category', 'subcategory']),
                'message' => 'Product updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Product update failed: ' . $e->getMessage());
            return $this->errorResponse('Failed to update product', $e);
        }
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ], 204);
        } catch (\Exception $e) {
            Log::error('Product deletion failed: ' . $e->getMessage());
            return $this->errorResponse('Failed to delete product', $e);
        }
    }

    /**
     * Rate a product
     */
    public function rateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|numeric|between:1,5',
            'comment' => 'nullable|string|max:500'
        ]);

        try {
            // Check if user already rated this product
            $existingRating = ProductRating::where('product_id', $product->id)
                ->where('user_id', $validated['user_id'])
                ->first();

            if ($existingRating) {
                $existingRating->update([
                    'rating' => $validated['rating'],
                    'comment' => $validated['comment'] ?? $existingRating->comment
                ]);
            } else {
                ProductRating::create([
                    'product_id' => $product->id,
                    'user_id' => $validated['user_id'],
                    'rating' => $validated['rating'],
                    'comment' => $validated['comment'] ?? null
                ]);
            }

            // Calculate new average rating
            $averageRating = $product->ratings()->avg('rating') ?? 0;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'product_id' => $product->id,
                    'average_rating' => round($averageRating, 2),
                    'rating_count' => $product->ratings()->count()
                ],
                'message' => 'Product rated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Product rating failed: ' . $e->getMessage());
            return $this->errorResponse('Failed to rate product', $e);
        }
    }

    /**
     * Filter products by category.
     */
    public function filterByCategory($categoryId)
    {
        try {
            $products = Product::where('category_id', $categoryId)
                ->with(['category', 'subcategory', 'ratings'])
                ->get();
            
            // Calculate average ratings and delivery times
            $products->each(function ($product) {
                $product->average_rating = $product->ratings->avg('rating') ?? 0;
                $product->estimated_delivery_time = Carbon::now()
                    ->addMinutes($product->estimated_delivery_minutes)
                    ->format('H:i');
            });
                
            return response()->json([
                'status' => 'success',
                'data' => $products,
                'message' => 'Products filtered by category successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Product filtering failed: ' . $e->getMessage());
            return $this->errorResponse('Failed to filter products by category', $e);
        }
    }

    /**
     * Helper method for error responses
     */
    private function errorResponse(string $message, \Exception $e)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'error' => env('APP_DEBUG') ? $e->getMessage() : null
        ], 500);
    }
}