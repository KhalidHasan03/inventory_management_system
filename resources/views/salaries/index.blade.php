@extends('layouts.app')

@section('title', 'Salaries')
@section('page-title', 'Salary Management')

@section('content')
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-white">All Salaries</h3>
        <a href="{{ route('salaries.create') }}" class="classic-btn">
            <i class="fas fa-plus mr-2"></i>Add Salary
        </a>
    </div>

    <!-- Filters -->
    <form method="GET" class="flex flex-wrap gap-4 mb-6">
        <select name="month" class="classic-select" style="width: auto;">
            <option value="">All Months</option>
            @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>{{ $month }}</option>
            @endforeach
        </select>
        <select name="year" class="classic-select" style="width: auto;">
            <option value="">All Years</option>
            @for($y = now()->year; $y >= now()->year - 5; $y--)
            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
        <select name="status" class="classic-select" style="width: auto;">
            <option value="">All Status</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        </select>
        <button type="submit" class="classic-btn" style="padding: 10px 16px;">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Employee</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Month</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Year</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Amount</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Status</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Payment Date</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                @foreach($salaries as $salary)
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white text-xs font-bold">{{ substr($salary->employee->user->name, 0, 1) }}</span>
                            </div>
                            <span class="text-white font-medium">{{ $salary->employee->user->name }}</span>
                        </div>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-300">{{ $salary->month }}</span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400">{{ $salary->year }}</span>
                    </td>
                    <td class="py-4">
                        <span class="text-white font-semibold">${{ number_format($salary->amount, 2) }}</span>
                    </td>
                    <td class="py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $salary->status === 'paid' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ ucfirst($salary->status) }}
                        </span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400 text-sm">{{ $salary->payment_date ?? '-' }}</span>
                    </td>
                    <td class="py-4">
                        <div class="flex items-center gap-2">
                            @if($salary->status === 'pending')
                            <form action="{{ route('salaries.pay', $salary->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-2 rounded-lg hover:bg-dark-700 text-emerald-400 transition-smooth" title="Pay">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('salaries.edit', $salary->id) }}" class="p-2 rounded-lg hover:bg-dark-700 text-yellow-400 transition-smooth">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $salary->id }}" action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $salary->id }}')" class="p-2 rounded-lg hover:bg-dark-700 text-red-400 transition-smooth">
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