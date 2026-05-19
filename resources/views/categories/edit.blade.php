@extends('layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-dark-800 border border-dark-700 rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Edit Category</h3>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-dark-300 mb-2">Category Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" required class="classic-input">
                </div>
                <div>
                    <label class="block text-sm font-medium text-dark-300 mb-2">Description</label>
                    <textarea name="description" rows="3" class="classic-input" style="min-height: 100px;">{{ $category->description }}</textarea>
                </div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="status" value="1" {{ $category->status ? 'checked' : '' }} class="w-4 h-4 rounded bg-dark-700 border-dark-600 text-yellow-500 focus:ring-yellow-500 focus:ring-offset-dark-800">
                    <span class="text-sm text-dark-300">Active</span>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="classic-btn">
                    <i class="fas fa-save mr-2"></i>Update Category
                </button>
                <a href="{{ route('categories.index') }}" class="classic-btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection