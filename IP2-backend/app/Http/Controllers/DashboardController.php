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
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();

            // Get top food items based on order_items table
            $topFoodItems = DB::table("order_items")
                ->join("orders", "order_items.order_id", "=", "orders.order_id")
                ->join("products", "order_items.product_id", "=", "products.product_id")
                ->join("categories", "products.category_id", "=", "categories.category_id")
                ->select(
                    "products.title as name",
                    DB::raw("SUM(order_items.quantity) as total_quantity"),
                    DB::raw("COUNT(DISTINCT orders.order_id) as order_count")
                )
                ->where("categories.name", "LIKE", "%food%") // Assuming food category contains 'food'
                ->orWhere("categories.name", "IN", ["Main Course", "Appetizers", "Desserts", "Snacks"])
                ->whereBetween("orders.order_date", [$startOfWeek, $endOfWeek])
                ->groupBy("products.product_id", "products.title")
                ->orderBy("total_quantity", "desc")
                ->limit(3)
                ->get();

            // If no food category found, try with common food product names
            if ($topFoodItems->isEmpty()) {
                $topFoodItems = DB::table("order_items")
                    ->join("orders", "order_items.order_id", "=", "orders.order_id")
                    ->join("products", "order_items.product_id", "=", "products.product_id")
                    ->select(
                        "products.title as name",
                        DB::raw("SUM(order_items.quantity) as total_quantity"),
                        DB::raw("COUNT(DISTINCT orders.order_id) as order_count")
                    )
                    ->where(function($query) {
                        $query->where("products.title", "LIKE", "%pizza%")
                              ->orWhere("products.title", "LIKE", "%burger%")
                              ->orWhere("products.title", "LIKE", "%pasta%")
                              ->orWhere("products.title", "LIKE", "%sandwich%")
                              ->orWhere("products.title", "LIKE", "%salad%")
                              ->orWhere("products.title", "LIKE", "%soup%")
                              ->orWhere("products.title", "LIKE", "%chicken%")
                              ->orWhere("products.title", "LIKE", "%beef%")
                              ->orWhere("products.title", "LIKE", "%fish%")
                              ->orWhere("products.title", "LIKE", "%rice%");
                    })
                    ->whereBetween("orders.order_date", [$startOfWeek, $endOfWeek])
                    ->groupBy("products.product_id", "products.title")
                    ->orderBy("total_quantity", "desc")
                    ->limit(3)
                    ->get();
            }

            // If still no results, get top 3 products by quantity this week (excluding drinks)
            if ($topFoodItems->isEmpty()) {
                $topFoodItems = DB::table("order_items")
                    ->join("orders", "order_items.order_id", "=", "orders.order_id")
                    ->join("products", "order_items.product_id", "=", "products.product_id")
                    ->select(
                        "products.title as name",
                        DB::raw("SUM(order_items.quantity) as total_quantity"),
                        DB::raw("COUNT(DISTINCT orders.order_id) as order_count")
                    )
                    ->where("products.title", "NOT LIKE", "%coffee%")
                    ->where("products.title", "NOT LIKE", "%tea%")
                    ->where("products.title", "NOT LIKE", "%juice%")
                    ->where("products.title", "NOT LIKE", "%soda%")
                    ->where("products.title", "NOT LIKE", "%water%")
                    ->where("products.title", "NOT LIKE", "%drink%")
                    ->whereBetween("orders.order_date", [$startOfWeek, $endOfWeek])
                    ->groupBy("products.product_id", "products.title")
                    ->orderBy("total_quantity", "desc")
                    ->limit(3)
                    ->get();
            }

            // Calculate percentages and add colors
            $totalQuantity = $topFoodItems->sum('total_quantity');
            $colors = ["#4A5568", "#48BB78", "#805AD5"];
            $result = [];

            foreach ($topFoodItems as $index => $item) {
                $percentage = $totalQuantity > 0 ?
                    round(($item->total_quantity / $totalQuantity) * 100) : 0;

                $result[] = [
                    "name" => $item->name,
                    "percentage" => max($percentage, 1), // Minimum 1%
                    "color" => $colors[$index % count($colors)]
                ];
            }

            return response()->json($result);

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
