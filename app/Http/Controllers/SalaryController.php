<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $query = Salary::with('employee.user');

        if ($request->month && $request->year) {
            $query->where('month', $request->month)->where('year', $request->year);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $salaries = $query->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $employees = Employee::with('user')->get();

        return view('salaries.index', compact('salaries', 'employees'));
    }

    public function create()
    {
        $employees = Employee::with('user')->get();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|string',
            'year' => 'required|integer',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,pending',
        ]);

        $existingSalary = Salary::where('employee_id', $request->employee_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->first();

        if ($existingSalary) {
            return redirect()->back()->with('error', 'Salary already paid for this month!');
        }

        $salary = Salary::create([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount,
            'status' => $request->status,
            'payment_date' => $request->status === 'paid' ? now()->toDateString() : null,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Salary created successfully!');
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::with('user')->get();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|string',
            'year' => 'required|integer',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,pending',
        ]);

        $salary->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount,
            'status' => $request->status,
            'payment_date' => $request->status === 'paid' ? now()->toDateString() : null,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Salary updated successfully!');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->route('salaries.index')->with('success', 'Salary deleted successfully!');
    }

    public function paySalary(Salary $salary)
    {
        $salary->update([
            'status' => 'paid',
            'payment_date' => now()->toDateString(),
        ]);

        return redirect()->route('salaries.index')->with('success', 'Salary paid successfully!');
    }
}