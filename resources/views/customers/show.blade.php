@extends('layouts.app')

@section('title', 'Customer Details')
@section('page-title', 'Customer Details')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                <span class="text-white font-bold text-xl">{{ substr($customer->name, 0, 1) }}</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">{{ $customer->name }}</h2>
                <p class="text-dark-400 text-sm">Customer since {{ $customer->created_at->format('M Y') }}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('customers.edit', $customer->id) }}" class="classic-btn flex items-center gap-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('customers.index') }}" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-dark-900 rounded-xl p-5 space-y-4">
            <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                <i class="fas fa-user text-yellow-500"></i> Contact Information
            </h3>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-envelope text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Email</p>
                        <p class="text-white">{{ $customer->email }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-phone text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Phone</p>
                        <p class="text-white">{{ $customer->phone }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Address</p>
                        <p class="text-white">{{ $customer->address ?: 'Not provided' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-dark-900 rounded-xl p-5 space-y-4">
            <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                <i class="fas fa-chart-line text-yellow-500"></i> Purchase Statistics
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                    <span class="text-dark-400">Total Purchases</span>
                    <span class="text-green-400 font-bold text-lg">${{ number_format($customer->total_purchases, 2) }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                    <span class="text-dark-400">Total Orders</span>
                    <span class="text-white font-bold text-lg">{{ $customer->orders ? $customer->orders->count() : 0 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection