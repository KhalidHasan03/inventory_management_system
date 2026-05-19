@extends('layouts.app')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                <i class="fas fa-edit text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Edit Product</h2>
                <p class="text-dark-400 text-sm">Update product information</p>
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="classic-btn-secondary flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Product Code</label>
                <input type="text" name="code" value="{{ $product->code }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Category</label>
                <select name="category_id" required class="classic-select">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Supplier</label>
                <select name="supplier_id" required class="classic-select">
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Quantity</label>
                <input type="number" name="quantity" value="{{ $product->quantity }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Unit Cost ($)</label>
                <input type="number" name="unit_cost" step="0.01" value="{{ $product->unit_cost }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Selling Price ($)</label>
                <input type="number" name="selling_price" step="0.01" value="{{ $product->selling_price }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Product Image</label>
                <div class="flex items-center gap-4">
                    @if($product->image)
                    <img src="{{ asset('uploads/products/' . $product->image) }}" class="w-16 h-16 rounded-lg object-cover border-2 border-yellow-500">
                    @endif
                    <input type="file" name="image" accept="image/*" class="classic-input">
                </div>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="classic-btn flex items-center gap-2">
                <i class="fas fa-save"></i> Update Product
            </button>
            <a href="{{ route('products.index') }}" class="classic-btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection