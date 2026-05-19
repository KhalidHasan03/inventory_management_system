<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesReportExport implements FromCollection, WithHeadings
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders->map(function ($order) {
            return [
                'Invoice No' => $order->invoice_no,
                'Customer' => $order->customer->name,
                'Total Amount' => $order->grand_total,
                'VAT' => $order->vat,
                'Paid Amount' => $order->paid_amount,
                'Due Amount' => $order->due_amount,
                'Payment Method' => $order->payment_method,
                'Status' => $order->status,
                'Date' => $order->order_date,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Invoice No',
            'Customer',
            'Total Amount',
            'VAT',
            'Paid Amount',
            'Due Amount',
            'Payment Method',
            'Status',
            'Date',
        ];
    }
}