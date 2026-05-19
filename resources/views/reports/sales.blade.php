@extends('layouts.app')

@section('title', 'Sales Report')
@section('page-title', 'Sales Report')

@section('content')
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-6 mb-6">
    <h3 class="text-lg font-semibold text-white mb-4">Filter Options</h3>
    <form method="GET" class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-sm font-medium text-dark-300 mb-2">Report Type</label>
            <select name="type" class="classic-select" style="width: auto;" onchange="this.form.submit()">
                <option value="daily" {{ $type == 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="monthly" {{ $type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="yearly" {{ $type == 'yearly' ? 'selected' : '' }}>Yearly</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-dark-300 mb-2">Start Date</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="classic-input" style="width: auto;">
        </div>
        <div>
            <label class="block text-sm font-medium text-dark-300 mb-2">End Date</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="classic-input" style="width: auto;">
        </div>
        <button type="submit" class="classic-btn" style="padding: 10px 16px;">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
        <a href="{{ route('reports.sales') }}" class="classic-btn-secondary">
            Reset
        </a>
    </form>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
        <p class="text-dark-400 text-sm">Total Orders</p>
        <p class="text-2xl font-bold text-white">{{ $orderCount }}</p>
    </div>
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
        <p class="text-dark-400 text-sm">Total Sales</p>
        <p class="text-2xl font-bold text-emerald-400">${{ number_format($totalSales, 2) }}</p>
    </div>
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
        <p class="text-dark-400 text-sm">Total Expenses</p>
        <p class="text-2xl font-bold text-red-400">${{ number_format($totalExpenses, 2) }}</p>
    </div>
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
        <p class="text-dark-400 text-sm">Net Profit</p>
        <p class="text-2xl font-bold {{ $profit >= 0 ? 'text-blue-400' : 'text-red-400' }}">${{ number_format($profit, 2) }}</p>
    </div>
</div>

<!-- Order Details -->
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-white">Order Details</h3>
        @if($orders->count() > 0)
        <a href="{{ route('reports.export', $type) }}" class="classic-btn" style="padding: 8px 16px;">
            <i class="fas fa-download mr-2"></i>Export to Excel
        </a>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Invoice No</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Customer</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Total</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">VAT</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Paid</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Due</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Status</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                @foreach($orders as $order)
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-4">
                        <span class="text-white font-medium">{{ $order->invoice_no }}</span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-300">{{ $order->customer->name }}</span>
                    </td>
                    <td class="py-4">
                        <span class="text-white font-semibold">${{ number_format($order->grand_total, 2) }}</span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400">${{ number_format($order->vat, 2) }}</span>
                    </td>
                    <td class="py-4">
                        <span class="text-emerald-400">${{ number_format($order->paid_amount, 2) }}</span>
                    </td>
                    <td class="py-4">
                        <span class="text-{{ $order->due_amount > 0 ? 'red' : 'dark-400' }}-400">${{ number_format($order->due_amount, 2) }}</span>
                    </td>
                    <td class="py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $order->status === 'completed' ? 'bg-emerald-500/20 text-emerald-400' : ($order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400 text-sm">{{ $order->order_date }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection