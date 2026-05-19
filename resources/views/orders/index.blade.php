@extends('layouts.app')

@section('title', 'Orders')
@section('page-title', 'Order Management')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                <i class="fas fa-shopping-bag text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">All Orders</h2>
                <p class="text-dark-400 text-sm">Manage and track orders</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <form method="GET" class="flex flex-wrap gap-4 mb-6 p-4 bg-dark-900 rounded-xl">
        <select name="status" class="classic-select" style="width: auto; min-width: 150px;">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="classic-input" style="width: auto; min-width: 150px;" placeholder="Start Date">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="classic-input" style="width: auto; min-width: 150px;" placeholder="End Date">
        <button type="submit" class="classic-btn" style="padding: 10px 20px;">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
        @if(request('status') || request('start_date') || request('end_date'))
        <a href="{{ route('orders.index') }}" class="classic-btn-secondary" style="padding: 10px 16px;">
            <i class="fas fa-times mr-2"></i>Clear
        </a>
        @endif
    </form>

    <div class="overflow-x-auto rounded-xl border border-dark-700">
        <table class="w-full">
            <thead>
                <tr class="bg-dark-900">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-6 py-4">Invoice</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-6 py-4">Customer</th>
                    <th class="text-right text-xs font-semibold text-dark-400 uppercase tracking-wider px-6 py-4">Total</th>
                    <th class="text-right text-xs font-semibold text-dark-400 uppercase tracking-wider px-6 py-4">Paid</th>
                    <th class="text-right text-xs font-semibold text-dark-400 uppercase tracking-wider px-6 py-4">Due</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-6 py-4">Payment</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-6 py-4">Status</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-6 py-4">Date</th>
                    <th class="text-center text-xs font-semibold text-dark-400 uppercase tracking-wider px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                @foreach($orders as $order)
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="px-6 py-4">
                        <span class="text-white font-medium">{{ $order->invoice_no }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white text-xs font-bold">{{ substr($order->customer->name, 0, 1) }}</span>
                            </div>
                            <span class="text-dark-300">{{ $order->customer->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-white font-bold">${{ number_format($order->grand_total, 2) }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-emerald-400 font-medium">${{ number_format($order->paid_amount, 2) }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-{{ $order->due_amount > 0 ? 'red' : 'dark-400' }}-400 font-medium">${{ number_format($order->due_amount, 2) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-dark-700 text-dark-300 capitalize">{{ $order->payment_method }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1.5 rounded-lg text-xs font-semibold
                            {{ $order->status === 'completed' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 
                               ($order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' : 'bg-red-500/20 text-red-400 border border-red-500/30') }}">
                            <i class="fas {{ $order->status === 'completed' ? 'fa-check' : ($order->status === 'pending' ? 'fa-clock' : 'fa-times') }} mr-1"></i>
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-dark-400 text-sm">{{ $order->order_date }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="p-2.5 rounded-lg hover:bg-blue-500/20 text-blue-400 transition-smooth" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('orders.invoice', $order->id) }}" class="p-2.5 rounded-lg hover:bg-green-500/20 text-green-400 transition-smooth" title="Print Invoice">
                                <i class="fas fa-print"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($orders->isEmpty())
        <div class="p-8 text-center">
            <i class="fas fa-inbox text-dark-500 text-4xl mb-3"></i>
            <p class="text-dark-400">No orders found</p>
        </div>
        @endif
    </div>
</div>
@endsection