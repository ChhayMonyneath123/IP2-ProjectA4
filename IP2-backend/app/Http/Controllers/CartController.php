<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json($user->cartItems()->with('product')->get());
    }

    public function store(Request $request)
    {
        $user = $request->user();
        
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::find($validated['product_id']);

        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => $user->user_id,
                'product_id' => $validated['product_id']
            ],
            [
                'quantity' => $validated['quantity'],
                'unit_price' => $product->price
            ]
        );

        return response()->json($cartItem->load('product'), 201);
    }

    public function update(Request $request, Cart $cart)
    {
        $this->authorize('update', $cart);
        
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update(['quantity' => $validated['quantity']]);
        return response()->json($cart->load('product'));
    }

    public function destroy(Cart $cart)
    {
        $this->authorize('delete', $cart);
        
        $cart->delete();
        return response()->json(null, 204);
    }

    public function clear(Request $request)
    {
        $user = $request->user();
        $user->cartItems()->delete();
        return response()->json(null, 204);
    }
}