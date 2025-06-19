<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::with(['user', 'items.product', 'payment', 'delivery'])->get());
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,user_id',
                'order_type' => 'required|in:dine-in,delivery',
                'table_number' => 'nullable|integer|required_if:order_type,dine-in',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,product_id',
                'items.*.quantity' => 'required|integer|min:1',
                'delivery_address' => 'nullable|string|required_if:order_type,delivery'
            ]);

            $order = Order::create([
                'user_id' => $validated['user_id'],
                'order_type' => $validated['order_type'],
                'status' => 'pending',
                'order_date' => now(),
                'total_price' => 0,
                'table_number' => $validated['table_number'] ?? null
            ]);

            $totalPrice = 0;

            foreach ($validated['items'] as $item) {
                $product = Product::find($item['product_id']);
                $subtotal = $product->price * $item['quantity'];
                
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal
                ]);

                $totalPrice += $subtotal;
            }

            $order->update(['total_price' => $totalPrice]);

            if ($validated['order_type'] === 'delivery') {
                $order->delivery()->create([
                    'user_id' => $validated['user_id'],
                    'delivery_address' => $validated['delivery_address'],
                    'delivery_status' => 'pending'
                ]);
            }

            DB::commit();
            return response()->json($order->load(['items.product', 'delivery']), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Order $order)
    {
        return response()->json($order->load(['user', 'items.product', 'payment', 'delivery']));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,preparing,completed,cancelled'
        ]);

        $order->update(['status' => $validated['status']]);
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}