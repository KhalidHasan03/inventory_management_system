@extends('layouts.app')

@section('title', 'Order Details')
@section('page-title', 'Order Details')

@section('content')
<div class="space-y-6">
    <!-- Order Header Card -->
    <div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                    <i class="fas fa-file-invoice text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Order {{ $order->invoice_no }}</h2>
                    <p class="text-dark-400 text-sm">{{ $order->order_date }}</p>
                </div>
            </div>
            <span class="px-4 py-2 rounded-lg text-sm font-semibold
                {{ $order->status === 'completed' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 
                   ($order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' : 'bg-red-500/20 text-red-400 border border-red-500/30') }}">
                <i class="fas {{ $order->status === 'completed' ? 'fa-check-circle' : ($order->status === 'pending' ? 'fa-clock' : 'fa-times-circle') }} mr-2"></i>
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Customer Info -->
            <div class="bg-dark-900 rounded-xl p-5">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-user text-blue-500"></i> Customer Details
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white font-bold">{{ substr($order->customer->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="text-white font-semibold">{{ $order->customer->name }}</p>
                            <p class="text-dark-400 text-sm">{{ $order->customer->phone }}</p>
                        </div>
                    </div>
                    <div class="pt-2 border-t border-dark-700">
                        <p class="text-dark-400 text-sm">Address</p>
                        <p class="text-white">{{ $order->customer->address ?: 'Not provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="bg-dark-900 rounded-xl p-5">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-credit-card text-purple-500"></i> Payment Details
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                        <span class="text-dark-400">Payment Method</span>
                        <span class="text-white font-medium capitalize">{{ $order->payment_method }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                        <span class="text-dark-400">Paid Amount</span>
                        <span class="text-emerald-400 font-bold">${{ number_format($order->paid_amount, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                        <span class="text-dark-400">Due Amount</span>
                        <span class="text-red-400 font-bold">${{ number_format($order->due_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items Table -->
    <div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-box text-yellow-500"></i> Order Items
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-dark-700">
                        <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Product</th>
                        <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Code</th>
                        <th class="text-center text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Quantity</th>
                        <th class="text-right text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Unit Cost</th>
                        <th class="text-right text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-700">
                    @foreach($order->orderItems as $item)
                    <tr class="hover:bg-dark-700/30 transition-smooth">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-dark-700 flex items-center justify-center">
                                    <i class="fas fa-box text-dark-400"></i>
                                </div>
                                <span class="text-white font-medium">{{ $item->product->name }}</span>
                            </div>
                        </td>
                        <td class="py-4">
                            <span class="text-dark-400 text-sm">{{ $item->product->code }}</span>
                        </td>
                        <td class="py-4 text-center">
                            <span class="text-white font-semibold">{{ $item->quantity }}</span>
                        </td>
                        <td class="py-4 text-right">
                            <span class="text-dark-300">${{ number_format($item->unit_cost, 2) }}</span>
                        </td>
                        <td class="py-4 text-right">
                            <span class="text-yellow-400 font-bold">${{ number_format($item->total, 2) }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Order Summary -->
        <div class="mt-6 bg-dark-900 rounded-xl p-5">
            <div class="flex flex-col lg:flex-row justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex justify-between gap-32">
                        <span class="text-dark-400">Subtotal</span>
                        <span class="text-white font-medium">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between gap-32">
                        <span class="text-dark-400">VAT</span>
                        <span class="text-white font-medium">${{ number_format($order->vat, 2) }}</span>
                    </div>
                    <div class="flex justify-between gap-32 pt-2 border-t border-dark-700">
                        <span class="text-white font-bold">Grand Total</span>
                        <span class="text-yellow-400 font-bold text-xl">${{ number_format($order->grand_total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Status Card -->
    <div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-pen text-blue-500"></i> Update Order Status
        </h3>
        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="flex flex-col lg:flex-row gap-4 items-start lg:items-center">
            @csrf
            @method('PUT')
            <div class="flex-1 w-full lg:w-auto">
                <select name="status" class="classic-select">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="classic-btn flex items-center gap-2">
                <i class="fas fa-check"></i> Update Status
            </button>
            <a href="{{ route('orders.invoice', $order->id) }}" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-print"></i> Print Invoice
            </a>
            <a href="{{ route('orders.index') }}" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </form>
    </div>
</div>
@endsection