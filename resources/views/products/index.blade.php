@extends('layouts.app')

@section('title', 'Products')
@section('page-title', 'Product Management')

@section('content')
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-4 lg:p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4 lg:mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                <i class="fas fa-box text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Product List</h2>
                <p class="text-dark-400 text-sm">Manage your inventory</p>
            </div>
        </div>
        <a href="{{ route('products.create') }}" class="classic-btn inline-flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i><span class="hidden sm:inline">Add Product</span>
        </a>
    </div>

    <!-- Search & Filter -->
    <form method="GET" class="flex flex-wrap gap-3 mb-6 p-4 bg-dark-900 rounded-xl">
        <div class="relative flex-1 min-w-[200px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="classic-input pl-10">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-dark-500"></i>
        </div>
        <select name="category" class="classic-select" style="width: auto; min-width: 150px;">
            <option value="">All Categories</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="supplier" class="classic-select" style="width: auto; min-width: 150px;">
            <option value="">All Suppliers</option>
            @foreach($suppliers as $supplier)
            <option value="{{ $supplier->id }}" {{ request('supplier') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="classic-btn" style="padding: 10px 20px;">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
        @if(request('search') || request('category') || request('supplier'))
        <a href="{{ route('products.index') }}" class="classic-btn-secondary" style="padding: 10px 16px;">
            <i class="fas fa-times mr-2"></i>Clear
        </a>
        @endif
    </form>

    <div class="overflow-x-auto rounded-xl border border-dark-700">
        <table class="w-full">
            <thead>
                <tr class="bg-dark-900">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-4 py-4">Img</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-4 py-4">Product Name</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-4 py-4 hidden md:table-cell">Code</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-4 py-4 hidden lg:table-cell">Category</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider px-4 py-4 hidden lg:table-cell">Supplier</th>
                    <th class="text-center text-xs font-semibold text-dark-400 uppercase tracking-wider px-4 py-4">Qty</th>
                    <th class="text-right text-xs font-semibold text-dark-400 uppercase tracking-wider px-4 py-4 hidden sm:table-cell">Price</th>
                    <th class="text-center text-xs font-semibold text-dark-400 uppercase tracking-wider px-4 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                @foreach($products as $product)
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="px-4 py-4">
                        @if($product->image)
                        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover border border-dark-600">
                        @else
                        <div class="w-10 h-10 rounded-lg bg-dark-700 flex items-center justify-center border border-dark-600">
                            <i class="fas fa-box text-dark-500"></i>
                        </div>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <span class="text-white font-medium text-sm">{{ $product->name }}</span>
                    </td>
                    <td class="px-4 py-4 hidden md:table-cell">
                        <span class="px-2 py-1 rounded-lg bg-dark-700 text-dark-400 text-xs font-mono">{{ $product->code }}</span>
                    </td>
                    <td class="px-4 py-4 hidden lg:table-cell">
                        <span class="text-dark-300 text-sm">{{ $product->category->name }}</span>
                    </td>
                    <td class="px-4 py-4 hidden lg:table-cell">
                        <span class="text-dark-300 text-sm">{{ $product->supplier->name }}</span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <span class="{{ $product->quantity < 10 ? 'text-red-400 bg-red-500/10' : 'text-white' }} font-semibold text-sm px-2.5 py-1 rounded-lg">
                            {{ $product->quantity }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-right hidden sm:table-cell">
                        <span class="text-yellow-400 font-bold text-sm">${{ number_format($product->selling_price, 2) }}</span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('products.show', $product->id) }}" class="p-2.5 rounded-lg hover:bg-blue-500/20 text-blue-400 transition-smooth" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="p-2.5 rounded-lg hover:bg-yellow-500/20 text-yellow-400 transition-smooth" title="Edit Product">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $product->id }}')" class="p-2.5 rounded-lg hover:bg-red-500/20 text-red-400 transition-smooth" title="Delete Product">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($products->isEmpty())
        <div class="p-8 text-center">
            <i class="fas fa-box-open text-dark-500 text-4xl mb-3"></i>
            <p class="text-dark-400">No products found</p>
        </div>
        @endif
    </div>
</div>
@endsection