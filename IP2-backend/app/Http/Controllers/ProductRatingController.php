<?php

namespace App\Http\Controllers;

use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    // GET /api/product-ratings
   public function index(Request $request)
{
    $query = ProductRating::with(['product', 'user']);

    // Optional: filter by product_id or user_id from query string
    if ($request->has('product_id')) {
        $query->where('product_id', $request->input('product_id'));
    }

    if ($request->has('user_id')) {
        $query->where('user_id', $request->input('user_id'));
    }

    return response()->json($query->get());
}

}
