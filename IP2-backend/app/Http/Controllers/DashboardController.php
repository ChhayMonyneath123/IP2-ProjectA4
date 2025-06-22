<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     */
    public function getStats()
    {
        try {
            $totalOrders = DB::table("orders")->count();
            
            $totalCustomers = DB::table("orders")
                ->distinct("user_id")
                ->count();
            
            $totalRevenue = DB::table("orders")
                ->where("status", "completed")
                ->sum("total_price");
            
            $totalMenue = DB::table("products")->count();

            return response()->json([
                "totalOrders" => $totalOrders,
                "totalCustomers" => $totalCustomers,
                "totalRevenue" => (float) $totalRevenue,
                "totalMenue" => $totalMenue
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "error" => "Failed to fetch dashboard stats",
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get order summary percentages for today
     */
    public function getOrderSummary()
    {
        try {
            $today = Carbon::today();
            
            $totalToday = DB::table("orders")
                ->whereDate("order_date", $today)
                ->count();

            $dineInToday = DB::table("orders")
                ->where("order_type", "dine-in")
                ->whereDate("order_date", $today)
                ->count();

            $deliveredToday = DB::table("orders")
                ->where("status", "delivered")
                ->whereDate("order_date", $today)
                ->count();

            $cancelledToday = DB::table("orders")
                ->where("status", "cancelled")
                ->whereDate("order_date", $today)
                ->count();

            return response()->json([
                "dineIn" => $totalToday > 0 ? round(($dineInToday / $totalToday) * 100) : 0,
                "delivered" => $totalToday > 0 ? round(($deliveredToday / $totalToday) * 100) : 0,
                "cancelled" => $totalToday > 0 ? round(($cancelledToday / $totalToday) * 100) : 0
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "error" => "Failed to fetch order summary",
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get top food items this week
     */
    public function getTopFood()
    {
        try {
            return response()->json([
                ["name" => "Pizza", "percentage" => 45, "color" => "#4A5568"],
                ["name" => "Burger", "percentage" => 35, "color" => "#48BB78"],
                ["name" => "Pasta", "percentage" => 20, "color" => "#805AD5"]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Failed to fetch top food items",
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get top drinks this week
     */
    public function getTopDrinks()
    {
        try {
            return response()->json([
                ["name" => "Coffee", "percentage" => 50, "color" => "#805AD5"],
                ["name" => "Tea", "percentage" => 30, "color" => "#48BB78"],
                ["name" => "Soda", "percentage" => 20, "color" => "#4299E1"]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Failed to fetch top drinks",
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Debug endpoint
     */
    public function debugData()
    {
        try {
            $orders = DB::table("orders")->limit(3)->get();
            $products = DB::table("products")->limit(3)->get();
            
            return response()->json([
                "message" => "Debug working!",
                "orders_count" => DB::table("orders")->count(),
                // ...rest of your code
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Failed to fetch debug data",
                "message" => $e->getMessage()
            ], 500);
        }
    }
}