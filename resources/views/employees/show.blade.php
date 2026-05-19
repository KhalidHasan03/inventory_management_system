@extends('layouts.app')

@section('title', 'Employee Details')
@section('page-title', 'Employee Details')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            @if($employee->profile_pic)
            <img src="{{ asset('uploads/employees/' . $employee->profile_pic) }}" alt="{{ $employee->user->name }}" class="w-20 h-20 rounded-full object-cover border-4 border-green-500">
            @else
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center border-4 border-green-500/30">
                <span class="text-white font-bold text-2xl">{{ substr($employee->user->name, 0, 1) }}</span>
            </div>
            @endif
            <div>
                <h2 class="text-xl font-bold text-white">{{ $employee->user->name }}</h2>
                <p class="text-dark-400 text-sm">{{ $employee->user->email }}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('employees.edit', $employee->id) }}" class="classic-btn flex items-center gap-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('employees.index') }}" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-dark-900 rounded-xl p-5 space-y-4">
            <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                <i class="fas fa-id-card text-green-500"></i> Personal Information
            </h3>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-phone text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Phone</p>
                        <p class="text-white">{{ $employee->user->phone }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-dark-700 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-dark-400"></i>
                    </div>
                    <div>
                        <p class="text-dark-400 text-xs">Address</p>
                        <p class="text-white">{{ $employee->user->address ?: 'Not provided' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-dark-900 rounded-xl p-5 space-y-4">
            <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                <i class="fas fa-briefcase text-green-500"></i> Employment Details
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                    <span class="text-dark-400">Monthly Salary</span>
                    <span class="text-yellow-400 font-bold text-lg">${{ number_format($employee->salary, 2) }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                    <span class="text-dark-400">Join Date</span>
                    <span class="text-white font-semibold">{{ $employee->join_date }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection