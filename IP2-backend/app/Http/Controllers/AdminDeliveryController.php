<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDeliveryController extends Controller
{
    /**
     * Get all deliveries for admin
     */
    public function index()
    {
        try {
            $deliveries = DB::table('deliveries')
                ->join('orders', 'deliveries.order_id', '=', 'orders.order_id')
                ->join('users', 'orders.user_id', '=', 'users.user_id')
                ->select(
                    'deliveries.*',
                    'orders.total_price',
                    'orders.order_date',
                    'users.name as customer_name'
                )
                ->orderBy('deliveries.created_at', 'desc')
                ->get();

            return response()->json($deliveries);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch deliveries',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update delivery status
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'delivery_status' => 'required|string'
            ]);

            DB::table('deliveries')
                ->where('delivery_id', $id)
                ->update([
                    'delivery_status' => $request->delivery_status,
                    'updated_at' => now()
                ]);

            return response()->json([
                'message' => 'Delivery status updated successfully',
                'status' => $request->delivery_status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update delivery status',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
