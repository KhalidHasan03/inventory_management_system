@extends('layouts.app')

@section('title', 'Add Category')
@section('page-title', 'Add New Category')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-dark-800 border border-dark-700 rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Add New Category</h3>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-dark-300 mb-2">Category Name</label>
                    <input type="text" name="name" required class="classic-input">
                </div>
                <div>
                    <label class="block text-sm font-medium text-dark-300 mb-2">Description</label>
                    <textarea name="description" rows="3" class="classic-input" style="min-height: 100px;"></textarea>
                </div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="status" value="1" checked class="w-4 h-4 rounded bg-dark-700 border-dark-600 text-yellow-500 focus:ring-yellow-500 focus:ring-offset-dark-800">
                    <span class="text-sm text-dark-300">Active</span>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="classic-btn">
                    <i class="fas fa-plus mr-2"></i>Add Category
                </button>
                <a href="{{ route('categories.index') }}" class="classic-btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection