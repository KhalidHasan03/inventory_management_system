<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([
                'products' => [],
                'orders' => [],
                'customers' => []
            ]);
        }

        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('code', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        $orders = Order::where('invoice_no', 'like', "%{$query}%")
            ->with('customer')
            ->limit(5)
            ->get();

        $customers = Customer::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        return response()->json([
            'products' => $products,
            'orders' => $orders,
            'customers' => $customers
        ]);
    }
}