@extends('layouts.app')

@section('title', 'Suppliers')
@section('page-title', 'Supplier Management')

@section('content')
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-4 lg:p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4 lg:mb-6">
        <h3 class="text-lg font-semibold text-white">All Suppliers</h3>
        <a href="{{ route('suppliers.create') }}" class="classic-btn inline-flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i><span class="hidden sm:inline">Add Supplier</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Supplier</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3 hidden md:table-cell">Company</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3 hidden sm:table-cell">Phone</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3 hidden lg:table-cell">Email</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                @foreach($suppliers as $supplier)
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-3 lg:py-4">
                        <div class="flex items-center gap-2 lg:gap-3">
                            <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-gradient-to-br from-teal-500 to-cyan-600 flex items-center justify-center">
                                <span class="text-white font-bold text-xs lg:text-sm">{{ substr($supplier->name, 0, 1) }}</span>
                            </div>
                            <span class="text-white font-medium text-sm">{{ $supplier->name }}</span>
                        </div>
                    </td>
                    <td class="py-3 lg:py-4 hidden md:table-cell"><span class="text-dark-300 text-sm">{{ $supplier->company_name }}</span></td>
                    <td class="py-3 lg:py-4 hidden sm:table-cell"><span class="text-dark-400 text-sm">{{ $supplier->phone }}</span></td>
                    <td class="py-3 lg:py-4 hidden lg:table-cell"><span class="text-dark-400 text-sm">{{ $supplier->email }}</span></td>
                    <td class="py-3 lg:py-4">
                        <div class="flex items-center gap-1 lg:gap-2">
                            <a href="{{ route('suppliers.show', $supplier->id) }}" class="p-1.5 lg:p-2 rounded-lg hover:bg-dark-700 text-blue-400"><i class="fas fa-eye text-xs lg:text-sm"></i></a>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="p-1.5 lg:p-2 rounded-lg hover:bg-dark-700 text-yellow-400"><i class="fas fa-edit text-xs lg:text-sm"></i></a>
                            <form id="delete-form-{{ $supplier->id }}" action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $supplier->id }}')" class="p-1.5 lg:p-2 rounded-lg hover:bg-dark-700 text-red-400"><i class="fas fa-trash text-xs lg:text-sm"></i></button>
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