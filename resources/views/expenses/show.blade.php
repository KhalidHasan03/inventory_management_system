@extends('layouts.app')

@section('title', 'Expense Details')
@section('page-title', 'Expense Details')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center">
                <i class="fas fa-file-invoice-dollar text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">{{ $expense->category }}</h2>
                <p class="text-dark-400 text-sm">Expense details</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('expenses.edit', $expense->id) }}" class="classic-btn flex items-center gap-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('expenses.index') }}" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-dark-900 rounded-xl p-5 border-l-4 border-red-500">
            <p class="text-dark-400 text-sm mb-2">Amount</p>
            <p class="text-red-400 font-bold text-2xl">${{ number_format($expense->amount, 2) }}</p>
        </div>

        <div class="bg-dark-900 rounded-xl p-5">
            <p class="text-dark-400 text-sm mb-2">Date</p>
            <p class="text-white font-semibold">{{ $expense->date }}</p>
        </div>

        <div class="bg-dark-900 rounded-xl p-5">
            <p class="text-dark-400 text-sm mb-2">Created</p>
            <p class="text-white font-semibold">{{ $expense->created_at->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="mt-6 bg-dark-900 rounded-xl p-5">
        <p class="text-dark-400 text-sm mb-2">Description</p>
        <p class="text-white">{{ $expense->description ?: 'No description provided' }}</p>
    </div>
</div>
@endsection