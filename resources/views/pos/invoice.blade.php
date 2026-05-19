@extends('layouts.app')

@section('title', 'Invoice')
@section('page-title', 'Invoice')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <div class="text-center border-b pb-4 mb-4">
            <h1 class="text-2xl font-bold">INVOICE</h1>
            <p class="text-gray-600">{{ $order->invoice_no }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-sm text-gray-500">Customer</p>
                <p class="font-semibold">{{ $order->customer->name }}</p>
                <p class="text-sm">{{ $order->customer->phone }}</p>
                <p class="text-sm">{{ $order->customer->address }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Date</p>
                <p class="font-semibold">{{ $order->order_date }}</p>
                <p class="text-sm text-gray-500">Status</p>
                <span class="px-2 py-1 rounded text-xs font-medium
                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                       ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <table class="table mb-6">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->unit_cost, 2) }}</td>
                    <td>${{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="border-t pt-4">
            <div class="flex justify-between mb-2">
                <span>Subtotal</span>
                <span>${{ number_format($order->total_amount, 2) }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>VAT (15%)</span>
                <span>${{ number_format($order->vat, 2) }}</span>
            </div>
            <div class="flex justify-between text-xl font-bold">
                <span>Grand Total</span>
                <span>${{ number_format($order->grand_total, 2) }}</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-6 pt-4 border-t">
            <div>
                <p class="text-sm text-gray-500">Payment Method</p>
                <p class="font-semibold">{{ ucfirst($order->payment_method) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Paid Amount</p>
                <p class="font-semibold">${{ number_format($order->paid_amount, 2) }}</p>
                <p class="text-sm text-gray-500">Due Amount</p>
                <p class="font-semibold">${{ number_format($order->due_amount, 2) }}</p>
            </div>
        </div>

        <div class="text-center mt-8">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Print Invoice
            </button>
            <a href="{{ route('pos.index') }}" class="btn btn-secondary ml-2">
                Back to POS
            </a>
        </div>
    </div>
</div>
@endsection