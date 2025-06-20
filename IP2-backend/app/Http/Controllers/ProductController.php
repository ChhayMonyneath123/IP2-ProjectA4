<?php

namespace App\Http\Controllers;
use App\Models\Product; // Ensure you have the Product model imported

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Assuming you have a Product model
        return response()->json($products);
    }
}
