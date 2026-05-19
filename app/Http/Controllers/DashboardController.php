<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $todaySales = Order::whereDate('order_date', today())->sum('grand_total');
        $totalSales = Order::sum('grand_total');
        
        $lastMonthSales = Order::whereMonth('order_date', now()->subMonth()->month)
            ->whereYear('order_date', now()->subMonth()->year)
            ->sum('grand_total');
        
        $salesPercentage = $lastMonthSales > 0 
            ? (($todaySales - ($lastMonthSales / 30)) / ($lastMonthSales / 30)) * 100 
            : 0;

        $totalCustomers = Customer::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();

        $monthlySales = Order::select(
            DB::raw('MONTH(order_date) as month'),
            DB::raw('SUM(grand_total) as total')
        )
        ->whereYear('order_date', now()->year)
        ->groupBy('month')
        ->get();

        $salesData = array_fill(0, 12, 0);
        foreach ($monthlySales as $sale) {
            $salesData[$sale->month - 1] = (float) $sale->total;
        }

        $recentOrders = Order::with('customer')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'todaySales',
            'totalSales',
            'salesPercentage',
            'totalCustomers',
            'totalProducts',
            'totalOrders',
            'salesData',
            'recentOrders'
        ));
    }
}