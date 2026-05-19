<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('salaries')->truncate();
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('expenses')->truncate();
        DB::table('products')->truncate();
        DB::table('salaries')->truncate();
        DB::table('employees')->truncate();
        DB::table('categories')->truncate();
        DB::table('suppliers')->truncate();
        DB::table('customers')->truncate();
        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@inventory.com',
            'password' => Hash::make('password'),
            'phone' => '0123456789',
            'address' => '123 Admin Street, City',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $employeeUserIds = [];
        $employeeNames = [
            ['name' => 'John Smith', 'email' => 'john@inventory.com', 'phone' => '0123456780', 'salary' => 1500],
            ['name' => 'Sarah Johnson', 'email' => 'sarah@inventory.com', 'phone' => '0123456781', 'salary' => 1800],
            ['name' => 'Mike Davis', 'email' => 'mike@inventory.com', 'phone' => '0123456782', 'salary' => 1200],
            ['name' => 'Emily Brown', 'email' => 'emily@inventory.com', 'phone' => '0123456783', 'salary' => 2000],
        ];

        foreach ($employeeNames as $emp) {
            $userId = DB::table('users')->insertGetId([
                'name' => $emp['name'],
                'email' => $emp['email'],
                'password' => Hash::make('password'),
                'phone' => $emp['phone'],
                'address' => '456 Employee Ave, City',
                'role' => 'employee',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $employeeUserIds[] = ['user_id' => $userId, 'salary' => $emp['salary']];
        }

        foreach ($employeeUserIds as $emp) {
            DB::table('employees')->insert([
                'user_id' => $emp['user_id'],
                'salary' => $emp['salary'],
                'join_date' => Carbon::now()->subMonths(rand(1, 12))->toDateString(),
                'profile_pic' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $customerIds = [];
        $customers = [
            ['name' => 'Alice Williams', 'email' => 'alice@example.com', 'phone' => '01811111111', 'address' => '10 Customer Lane'],
            ['name' => 'Bob Miller', 'email' => 'bob@example.com', 'phone' => '01822222222', 'address' => '20 Buyer Street'],
            ['name' => 'Charlie Wilson', 'email' => 'charlie@example.com', 'phone' => '01833333333', 'address' => '30 Shop Road'],
            ['name' => 'Diana Taylor', 'email' => 'diana@example.com', 'phone' => '01844444444', 'address' => '40 Market Ave'],
            ['name' => 'Edward Anderson', 'email' => 'edward@example.com', 'phone' => '01855555555', 'address' => '50 Commerce Blvd'],
        ];

        foreach ($customers as $customer) {
            $customerIds[] = DB::table('customers')->insertGetId([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'phone' => $customer['phone'],
                'address' => $customer['address'],
                'total_purchases' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $supplierIds = [];
        $suppliers = [
            ['name' => 'Global Supplies Ltd', 'company_name' => 'Global Supplies', 'phone' => '01511111111', 'email' => 'global@supplier.com'],
            ['name' => 'Tech Solutions Inc', 'company_name' => 'Tech Solutions', 'phone' => '01522222222', 'email' => 'tech@supplier.com'],
            ['name' => 'Prime Products Co', 'company_name' => 'Prime Products', 'phone' => '01533333333', 'email' => 'prime@supplier.com'],
        ];

        foreach ($suppliers as $supplier) {
            $supplierIds[] = DB::table('suppliers')->insertGetId([
                'name' => $supplier['name'],
                'company_name' => $supplier['company_name'],
                'phone' => $supplier['phone'],
                'email' => $supplier['email'],
                'address' => '100 Supplier Way, Industrial Zone',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $categoryIds = [];
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and accessories'],
            ['name' => 'Office Supplies', 'description' => 'Office and stationery items'],
            ['name' => 'Furniture', 'description' => 'Office and home furniture'],
            ['name' => 'Software', 'description' => 'Software licenses and subscriptions'],
            ['name' => 'Accessories', 'description' => 'Computer and phone accessories'],
        ];

        foreach ($categories as $category) {
            $categoryIds[] = DB::table('categories')->insertGetId([
                'name' => $category['name'],
                'description' => $category['description'],
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $products = [
            ['name' => 'Laptop Pro 15', 'code' => 'LAP-001', 'category_id' => $categoryIds[0], 'supplier_id' => $supplierIds[0], 'quantity' => 25, 'unit_cost' => 800, 'selling_price' => 999],
            ['name' => 'Wireless Mouse', 'code' => 'MOU-001', 'category_id' => $categoryIds[4], 'supplier_id' => $supplierIds[1], 'quantity' => 100, 'unit_cost' => 15, 'selling_price' => 25],
            ['name' => 'USB Keyboard', 'code' => 'KEY-001', 'category_id' => $categoryIds[4], 'supplier_id' => $supplierIds[1], 'quantity' => 80, 'unit_cost' => 20, 'selling_price' => 35],
            ['name' => 'Office Chair', 'code' => 'CHR-001', 'category_id' => $categoryIds[2], 'supplier_id' => $supplierIds[2], 'quantity' => 15, 'unit_cost' => 150, 'selling_price' => 250],
            ['name' => 'Desk Lamp', 'code' => 'LMP-001', 'category_id' => $categoryIds[1], 'supplier_id' => $supplierIds[2], 'quantity' => 50, 'unit_cost' => 25, 'selling_price' => 45],
            ['name' => 'Monitor 24"', 'code' => 'MON-001', 'category_id' => $categoryIds[0], 'supplier_id' => $supplierIds[0], 'quantity' => 30, 'unit_cost' => 180, 'selling_price' => 249],
            ['name' => 'Printer Ink', 'code' => 'PRN-001', 'category_id' => $categoryIds[1], 'supplier_id' => $supplierIds[1], 'quantity' => 200, 'unit_cost' => 20, 'selling_price' => 35],
            ['name' => 'Webcam HD', 'code' => 'CAM-001', 'category_id' => $categoryIds[0], 'supplier_id' => $supplierIds[1], 'quantity' => 45, 'unit_cost' => 40, 'selling_price' => 65],
            ['name' => 'Filing Cabinet', 'code' => 'CAB-001', 'category_id' => $categoryIds[2], 'supplier_id' => $supplierIds[2], 'quantity' => 20, 'unit_cost' => 100, 'selling_price' => 175],
            ['name' => 'Notebook Pack', 'code' => 'NTB-001', 'category_id' => $categoryIds[1], 'supplier_id' => $supplierIds[2], 'quantity' => 500, 'unit_cost' => 5, 'selling_price' => 10],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'code' => $product['code'],
                'category_id' => $product['category_id'],
                'supplier_id' => $product['supplier_id'],
                'quantity' => $product['quantity'],
                'unit_cost' => $product['unit_cost'],
                'selling_price' => $product['selling_price'],
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $expenses = [
            ['category' => 'Rent', 'amount' => 1500, 'date' => Carbon::now()->subDays(5)->toDateString(), 'description' => 'Monthly office rent'],
            ['category' => 'Utilities', 'amount' => 350, 'date' => Carbon::now()->subDays(10)->toDateString(), 'description' => 'Electricity and water bill'],
            ['category' => 'Internet', 'amount' => 500, 'date' => Carbon::now()->subDays(15)->toDateString(), 'description' => 'Monthly internet service'],
            ['category' => 'Supplies', 'amount' => 200, 'date' => Carbon::now()->subDays(20)->toDateString(), 'description' => 'Office supplies purchase'],
            ['category' => 'Maintenance', 'amount' => 300, 'date' => Carbon::now()->subDays(25)->toDateString(), 'description' => 'Equipment maintenance'],
        ];

        foreach ($expenses as $expense) {
            DB::table('expenses')->insert([
                'category' => $expense['category'],
                'amount' => $expense['amount'],
                'date' => $expense['date'],
                'description' => $expense['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $employees = DB::table('employees')->get();
        foreach ($employees as $employee) {
            DB::table('salaries')->insert([
                'employee_id' => $employee->id,
                'month' => Carbon::now()->format('F'),
                'year' => Carbon::now()->year,
                'amount' => $employee->salary,
                'status' => 'paid',
                'payment_date' => Carbon::now()->subDays(rand(1, 10))->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $paymentMethods = ['cash', 'bank', 'mobile'];
        $statuses = ['completed', 'pending', 'completed', 'completed'];
        
        for ($i = 0; $i < 15; $i++) {
            $customerId = $customerIds[array_rand($customerIds)];
            $productIds = array_rand(array_flip(range(1, 10)), rand(2, 5));
            $items = [];
            $subtotal = 0;
            
            foreach ($productIds as $pid) {
                $product = DB::table('products')->where('id', $pid)->first();
                $qty = rand(1, 3);
                $total = $product->selling_price * $qty;
                $subtotal += $total;
                $items[] = ['product_id' => $pid, 'quantity' => $qty, 'price' => $product->selling_price, 'total' => $total];
            }
            
            $vat = $subtotal * 0.15;
            $grandTotal = $subtotal + $vat;
            $paidAmount = $grandTotal;
            $status = $statuses[array_rand($statuses)];
            
            $orderId = DB::table('orders')->insertGetId([
                'invoice_no' => 'INV-' . strtoupper(uniqid()),
                'customer_id' => $customerId,
                'total_amount' => $subtotal,
                'vat' => $vat,
                'grand_total' => $grandTotal,
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'paid_amount' => $paidAmount,
                'due_amount' => 0,
                'status' => $status,
                'order_date' => Carbon::now()->subDays(rand(1, 30))->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($items as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_cost' => $item['price'],
                    'total' => $item['total'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            $customer = DB::table('customers')->where('id', $customerId)->first();
            DB::table('customers')->where('id', $customerId)->update([
                'total_purchases' => $customer->total_purchases + $grandTotal
            ]);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin login: admin@inventory.com / password');
    }
}