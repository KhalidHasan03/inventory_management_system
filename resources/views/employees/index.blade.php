@extends('layouts.app')

@section('title', 'Employees')
@section('page-title', 'Employee Management')

@section('content')
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-4 lg:p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4 lg:mb-6">
        <h3 class="text-lg font-semibold text-white">All Employees</h3>
        <a href="{{ route('employees.create') }}" class="classic-btn inline-flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i><span class="hidden sm:inline">Add Employee</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Employee</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3 hidden md:table-cell">Email</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3 hidden sm:table-cell">Phone</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Salary</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3 hidden lg:table-cell">Join Date</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                @foreach($employees as $employee)
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-3 lg:py-4">
                        <div class="flex items-center gap-2 lg:gap-3">
                            @if($employee->profile_pic)
                            <img src="{{ asset('uploads/employees/' . $employee->profile_pic) }}" alt="{{ $employee->user->name }}" class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover">
                            @else
                            <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                <span class="text-white font-bold text-xs lg:text-sm">{{ substr($employee->user->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div><span class="text-white font-medium text-sm block">{{ $employee->user->name }}</span></div>
                        </div>
                    </td>
                    <td class="py-3 lg:py-4 hidden md:table-cell"><span class="text-dark-400 text-sm">{{ $employee->user->email }}</span></td>
                    <td class="py-3 lg:py-4 hidden sm:table-cell"><span class="text-dark-300 text-sm">{{ $employee->user->phone }}</span></td>
                    <td class="py-3 lg:py-4"><span class="text-emerald-400 font-semibold text-sm">${{ number_format($employee->salary, 2) }}</span></td>
                    <td class="py-3 lg:py-4 hidden lg:table-cell"><span class="text-dark-400 text-sm">{{ $employee->join_date }}</span></td>
                    <td class="py-3 lg:py-4">
                        <div class="flex items-center gap-1 lg:gap-2">
                            <a href="{{ route('employees.show', $employee->id) }}" class="p-1.5 lg:p-2 rounded-lg hover:bg-dark-700 text-blue-400"><i class="fas fa-eye text-xs lg:text-sm"></i></a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="p-1.5 lg:p-2 rounded-lg hover:bg-dark-700 text-yellow-400"><i class="fas fa-edit text-xs lg:text-sm"></i></a>
                            <form id="delete-form-{{ $employee->id }}" action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-{{ $employee->id }}')" class="p-1.5 lg:p-2 rounded-lg hover:bg-dark-700 text-red-400"><i class="fas fa-trash text-xs lg:text-sm"></i></button>
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