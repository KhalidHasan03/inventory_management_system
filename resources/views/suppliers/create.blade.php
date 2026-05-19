@extends('layouts.app')

@section('title', 'Add Supplier')
@section('page-title', 'Add Supplier')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                <i class="fas fa-truck-loading text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Add New Supplier</h2>
                <p class="text-dark-400 text-sm">Create a new supplier entry</p>
            </div>
        </div>
        <a href="{{ route('suppliers.index') }}" class="classic-btn-secondary flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Supplier Name</label>
                <input type="text" name="name" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Company Name</label>
                <input type="text" name="company_name" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Phone Number</label>
                <input type="text" name="phone" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Email Address</label>
                <input type="email" name="email" class="classic-input">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-dark-300">Address</label>
                <textarea name="address" rows="3" class="classic-input"></textarea>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="classic-btn flex items-center gap-2">
                <i class="fas fa-plus"></i> Add Supplier
            </button>
            <a href="{{ route('suppliers.index') }}" class="classic-btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection