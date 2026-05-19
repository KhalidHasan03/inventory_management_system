@extends('layouts.app')

@section('title', 'Edit Supplier')
@section('page-title', 'Edit Supplier')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                <i class="fas fa-truck-loading text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Edit Supplier</h2>
                <p class="text-dark-400 text-sm">Update supplier information</p>
            </div>
        </div>
        <a href="{{ route('suppliers.index') }}" class="classic-btn-secondary flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Supplier Name</label>
                <input type="text" name="name" value="{{ $supplier->name }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Company Name</label>
                <input type="text" name="company_name" value="{{ $supplier->company_name }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Phone Number</label>
                <input type="text" name="phone" value="{{ $supplier->phone }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Email Address</label>
                <input type="email" name="email" value="{{ $supplier->email }}" class="classic-input">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-dark-300">Address</label>
                <textarea name="address" rows="3" class="classic-input">{{ $supplier->address }}</textarea>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="classic-btn flex items-center gap-2">
                <i class="fas fa-save"></i> Update Supplier
            </button>
            <a href="{{ route('suppliers.index') }}" class="classic-btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection