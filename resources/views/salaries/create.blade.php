@extends('layouts.app')

@section('title', 'Add Salary')
@section('page-title', 'Add Salary')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Pay Salary</h2>
                <p class="text-dark-400 text-sm">Record employee salary payment</p>
            </div>
        </div>
        <a href="{{ route('salaries.index') }}" class="classic-btn-secondary flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('salaries.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Employee</label>
                <select name="employee_id" required class="classic-select">
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->user->name }} - ${{ number_format($employee->salary, 2) }}/month</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Amount ($)</label>
                <input type="number" name="amount" step="0.01" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Month</label>
                <select name="month" required class="classic-select">
                    @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Year</label>
                <select name="year" required class="classic-select">
                    @for($y = now()->year; $y >= now()->year - 5; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Status</label>
                <select name="status" required class="classic-select">
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="classic-btn flex items-center gap-2">
                <i class="fas fa-plus"></i> Add Salary
            </button>
            <a href="{{ route('salaries.index') }}" class="classic-btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection