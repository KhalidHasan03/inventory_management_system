@extends('layouts.app')

@section('title', 'Edit Expense')
@section('page-title', 'Edit Expense')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center">
                <i class="fas fa-edit text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Edit Expense</h2>
                <p class="text-dark-400 text-sm">Update expense information</p>
            </div>
        </div>
        <a href="{{ route('expenses.index') }}" class="classic-btn-secondary flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('expenses.update', $expense->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Expense Category</label>
                <input type="text" name="category" value="{{ $expense->category }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Amount ($)</label>
                <input type="number" name="amount" step="0.01" value="{{ $expense->amount }}" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Date</label>
                <input type="date" name="date" value="{{ $expense->date }}" required class="classic-input">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-dark-300">Description</label>
                <textarea name="description" rows="3" class="classic-input">{{ $expense->description }}</textarea>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="classic-btn flex items-center gap-2">
                <i class="fas fa-save"></i> Update Expense
            </button>
            <a href="{{ route('expenses.index') }}" class="classic-btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection