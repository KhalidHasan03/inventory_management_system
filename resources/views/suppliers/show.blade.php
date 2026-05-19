@extends('layouts.app')

@section('title', 'Supplier Details')
@section('page-title', 'Supplier Details')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                <i class="fas fa-truck text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">{{ $supplier->name }}</h2>
                <p class="text-dark-400 text-sm">{{ $supplier->company_name }}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="classic-btn flex items-center gap-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('suppliers.index') }}" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-dark-900 rounded-xl p-5 space-y-4">
            <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                <i class="fas fa-building text-purple-500"></i> Company Details
            </h3>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-user text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Supplier Name</p>
                        <p class="text-white">{{ $supplier->name }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-building text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Company</p>
                        <p class="text-white">{{ $supplier->company_name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-dark-900 rounded-xl p-5 space-y-4">
            <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                <i class="fas fa-address-book text-purple-500"></i> Contact Information
            </h3>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-phone text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Phone</p>
                        <p class="text-white">{{ $supplier->phone }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-envelope text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Email</p>
                        <p class="text-white">{{ $supplier->email ?: 'Not provided' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Address</p>
                        <p class="text-white">{{ $supplier->address ?: 'Not provided' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-dark-900 rounded-xl p-5">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-purple-500/20 flex items-center justify-center">
                    <i class="fas fa-box text-purple-400 text-lg"></i>
                </div>
                <div>
                    <p class="text-dark-400 text-sm">Total Products Supplied</p>
                    <p class="text-white font-bold text-xl">{{ $supplier->products->count() }}</p>
                </div>
            </div>
            <a href="{{ route('products.index') }}?supplier={{ $supplier->id }}" class="classic-btn-secondary text-sm">
                View Products <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</div>
@endsection