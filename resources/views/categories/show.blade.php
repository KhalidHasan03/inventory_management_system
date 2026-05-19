@extends('layouts.app')

@section('title', 'Category Details')
@section('page-title', 'Category Details')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                <i class="fas fa-tag text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">{{ $category->name }}</h2>
                <p class="text-dark-400 text-sm">Category details</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('categories.edit', $category->id) }}" class="classic-btn flex items-center gap-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('categories.index') }}" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-dark-900 rounded-xl p-5">
            <p class="text-dark-400 text-sm mb-2">Status</p>
            <span class="px-3 py-1.5 rounded-lg text-sm font-medium {{ $category->status ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                <i class="fas {{ $category->status ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                {{ $category->status ? 'Active' : 'Inactive' }}
            </span>
        </div>

        <div class="bg-dark-900 rounded-xl p-5">
            <p class="text-dark-400 text-sm mb-2">Total Products</p>
            <p class="text-white font-bold text-2xl">{{ $category->products->count() }}</p>
        </div>

        <div class="bg-dark-900 rounded-xl p-5">
            <p class="text-dark-400 text-sm mb-2">Created</p>
            <p class="text-white font-semibold">{{ $category->created_at->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="mt-6 bg-dark-900 rounded-xl p-5">
        <p class="text-dark-400 text-sm mb-2">Description</p>
        <p class="text-white">{{ $category->description ?: 'No description provided' }}</p>
    </div>
</div>
@endsection