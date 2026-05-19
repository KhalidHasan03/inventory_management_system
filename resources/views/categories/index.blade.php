@extends('layouts.app')

@section('title', 'Categories')
@section('page-title', 'Category Management')

@section('content')
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-white">Category List</h3>
        <a href="{{ route('categories.create') }}" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition-smooth">
            <i class="fas fa-plus"></i>
            <span>Add Category</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Name</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Description</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Status</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Products</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                @foreach($categories as $category)
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-4">
                        <span class="text-white font-medium">{{ $category->name }}</span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400 text-sm">{{ $category->description }}</span>
                    </td>
                    <td class="py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $category->status ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                            {{ $category->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-300">{{ $category->products->count() }}</span>
                    </td>
                    <td class="py-4">
                        <div class="flex items-center gap-2">
                            <form action="{{ route('categories.toggleStatus', $category->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 rounded-lg hover:bg-dark-700 text-{{ $category->status ? 'red' : 'emerald' }}-400 transition-smooth" title="{{ $category->status ? 'Deactivate' : 'Activate' }}">
                                    <i class="fas fa-toggle-{{ $category->status ? 'on' : 'off' }}"></i>
                                </button>
                            </form>
                            <a href="{{ route('categories.edit', $category->id) }}" class="p-2 rounded-lg hover:bg-dark-700 text-yellow-400 transition-smooth">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $category->id }}')" class="p-2 rounded-lg hover:bg-dark-700 text-red-400 transition-smooth">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection