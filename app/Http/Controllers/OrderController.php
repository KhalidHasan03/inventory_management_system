<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('order_date', [$request->start_date, $request->end_date]);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('customer', 'orderItems.product');
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Order status updated!');
    }

    public function invoice(Order $order)
    {
        $order->load('customer', 'orderItems.product');
        return view('orders.invoice', compact('order'));
    }

    public function destroy(Order $order)
    {
        foreach ($order->orderItems as $item) {
            $item->product->increment('quantity', $item->quantity);
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}