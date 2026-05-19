@extends('layouts.app')

@section('title', 'Add Employee')
@section('page-title', 'Add Employee')

@section('content')
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                <i class="fas fa-user-plus text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Add New Employee</h2>
                <p class="text-dark-400 text-sm">Create a new employee entry</p>
            </div>
        </div>
        <a href="{{ route('employees.index') }}" class="classic-btn-secondary flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Employee Name</label>
                <input type="text" name="name" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Email Address</label>
                <input type="email" name="email" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Password</label>
                <input type="password" name="password" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Phone Number</label>
                <input type="text" name="phone" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Monthly Salary ($)</label>
                <input type="number" name="salary" step="0.01" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Join Date</label>
                <input type="date" name="join_date" required class="classic-input">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-dark-300">Address</label>
                <textarea name="address" rows="2" class="classic-input"></textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Profile Picture</label>
                <input type="file" name="profile_pic" accept="image/*" class="classic-input">
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="classic-btn flex items-center gap-2">
                <i class="fas fa-plus"></i> Add Employee
            </button>
            <a href="{{ route('employees.index') }}" class="classic-btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection