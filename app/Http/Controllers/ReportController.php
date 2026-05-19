<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesReportExport;

class ReportController extends Controller
{
    public function salesReport(Request $request)
    {
        $query = Order::with('customer');

        if ($request->type) {
            $type = $request->type;
        } else {
            $type = 'daily';
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('order_date', [$request->start_date, $request->end_date]);
        } else {
            switch ($type) {
                case 'daily':
                    $query->whereDate('order_date', today());
                    break;
                case 'monthly':
                    $query->whereMonth('order_date', now()->month)
                        ->whereYear('order_date', now()->year);
                    break;
                case 'yearly':
                    $query->whereYear('order_date', now()->year);
                    break;
            }
        }

        $orders = $query->orderBy('order_date', 'desc')->get();

        $totalSales = $orders->sum('grand_total');
        $totalVat = $orders->sum('vat');
        $totalPaid = $orders->sum('paid_amount');
        $totalDue = $orders->sum('due_amount');
        $orderCount = $orders->count();

        $expenses = Expense::query();
        if ($request->start_date && $request->end_date) {
            $expenses->whereBetween('date', [$request->start_date, $request->end_date]);
        } else {
            switch ($type) {
                case 'daily':
                    $expenses->whereDate('date', today());
                    break;
                case 'monthly':
                    $expenses->whereMonth('date', now()->month)
                        ->whereYear('date', now()->year);
                    break;
                case 'yearly':
                    $expenses->whereYear('date', now()->year);
                    break;
            }
        }
        $totalExpenses = $expenses->sum('amount');

        $profit = $totalSales - $totalExpenses;

        return view('reports.sales', compact(
            'orders',
            'totalSales',
            'totalVat',
            'totalPaid',
            'totalDue',
            'totalExpenses',
            'profit',
            'orderCount',
            'type'
        ));
    }

    public function export(Request $request, $type)
    {
        $query = Order::with('customer');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('order_date', [$request->start_date, $request->end_date]);
        } else {
            switch ($type) {
                case 'daily':
                    $query->whereDate('order_date', today());
                    break;
                case 'monthly':
                    $query->whereMonth('order_date', now()->month)
                        ->whereYear('order_date', now()->year);
                    break;
                case 'yearly':
                    $query->whereYear('order_date', now()->year);
                    break;
            }
        }

        $orders = $query->orderBy('order_date', 'desc')->get();

        return Excel::download(new SalesReportExport($orders), 'sales_report_' . date('Y-m-d') . '.xlsx');
    }

    public function profitLoss(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->toDateString();
        $endDate = $request->end_date ?? now()->endOfMonth()->toDateString();

        $sales = Order::whereBetween('order_date', [$startDate, $endDate])
            ->where('status', 'completed')
            ->sum('grand_total');

        $expenses = Expense::whereBetween('date', [$startDate, $endDate])
            ->sum('amount');

        $profit = $sales - $expenses;

        return view('reports.profit-loss', compact('sales', 'expenses', 'profit', 'startDate', 'endDate'));
    }
}