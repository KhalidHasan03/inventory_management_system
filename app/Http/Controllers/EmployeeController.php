<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'salary' => 'required|numeric|min:0',
            'join_date' => 'required|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $profilePic = null;
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $profilePic = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/employees'), $profilePic);
        }

        Employee::create([
            'user_id' => $user->id,
            'salary' => $request->salary,
            'join_date' => $request->join_date,
            'profile_pic' => $profilePic,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $employee->user_id,
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'salary' => 'required|numeric|min:0',
            'join_date' => 'required|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employee->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($request->password) {
            $employee->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if ($request->hasFile('profile_pic')) {
            if ($employee->profile_pic && File::exists(public_path('uploads/employees/' . $employee->profile_pic))) {
                File::delete(public_path('uploads/employees/' . $employee->profile_pic));
            }

            $file = $request->file('profile_pic');
            $profilePic = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/employees'), $profilePic);
            $employee->update(['profile_pic' => $profilePic]);
        }

        $employee->update([
            'salary' => $request->salary,
            'join_date' => $request->join_date,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->profile_pic && File::exists(public_path('uploads/employees/' . $employee->profile_pic))) {
            File::delete(public_path('uploads/employees/' . $employee->profile_pic));
        }

        $employee->user->delete();
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}