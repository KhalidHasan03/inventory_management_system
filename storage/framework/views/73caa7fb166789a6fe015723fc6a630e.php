<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard Overview'); ?>

<?php $__env->startSection('content'); ?>
<?php
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Employee;
use App\Models\Expense;

$todaySales = Order::whereDate('order_date', today())->sum('grand_total');
$totalSales = Order::sum('grand_total');
$totalCustomers = Customer::count();
$totalOrders = Order::count();
$totalProducts = Product::count();
$totalCategories = Category::count();
$totalSuppliers = Supplier::count();
$totalEmployees = Employee::count();
$totalExpenses = Expense::sum('amount');

$recentOrders = Order::with('customer')->orderBy('created_at', 'desc')->limit(5)->get();

$monthlySales = Order::select(
    DB::raw('MONTH(order_date) as month'),
    DB::raw('SUM(grand_total) as total')
)->whereYear('order_date', now()->year)->groupBy('month')->get();

$salesData = array_fill(0, 12, 0);
foreach ($monthlySales as $sale) {
    $salesData[$sale->month - 1] = (float) $sale->total;
}
?>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6 mb-4 lg:mb-8">
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-3 lg:p-6 hover:border-yellow-500/50 transition-smooth">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <div class="w-8 h-8 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center">
                <i class="fas fa-dollar-sign text-white text-sm lg:text-xl"></i>
            </div>
            <span class="text-emerald-400 text-xs"><i class="fas fa-arrow-up"></i> Today</span>
        </div>
        <p class="text-dark-400 text-xs lg:text-sm">Today's Sales</p>
        <p class="text-lg lg:text-2xl font-bold text-white mt-1">$<?php echo e(number_format($todaySales, 2)); ?></p>
    </div>

    <div class="bg-dark-800 border border-dark-700 rounded-xl p-3 lg:p-6 hover:border-yellow-500/50 transition-smooth">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <div class="w-8 h-8 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                <i class="fas fa-chart-line text-white text-sm lg:text-xl"></i>
            </div>
        </div>
        <p class="text-dark-400 text-xs lg:text-sm">Total Sales</p>
        <p class="text-lg lg:text-2xl font-bold text-white mt-1">$<?php echo e(number_format($totalSales, 2)); ?></p>
    </div>

    <div class="bg-dark-800 border border-dark-700 rounded-xl p-3 lg:p-6 hover:border-yellow-500/50 transition-smooth">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <div class="w-8 h-8 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                <i class="fas fa-users text-white text-sm lg:text-xl"></i>
            </div>
        </div>
        <p class="text-dark-400 text-xs lg:text-sm">Customers</p>
        <p class="text-lg lg:text-2xl font-bold text-white mt-1"><?php echo e(number_format($totalCustomers)); ?></p>
    </div>

    <div class="bg-dark-800 border border-dark-700 rounded-xl p-3 lg:p-6 hover:border-yellow-500/50 transition-smooth">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <div class="w-8 h-8 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center">
                <i class="fas fa-shopping-cart text-white text-sm lg:text-xl"></i>
            </div>
        </div>
        <p class="text-dark-400 text-xs lg:text-sm">Orders</p>
        <p class="text-lg lg:text-2xl font-bold text-white mt-1"><?php echo e(number_format($totalOrders)); ?></p>
    </div>
</div>

<!-- Second Row Stats -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6 mb-4 lg:mb-8">
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-3 lg:p-6 hover:border-yellow-500/50 transition-smooth">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <div class="w-8 h-8 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center">
                <i class="fas fa-eye text-white text-sm lg:text-xl"></i>
            </div>
        </div>
        <p class="text-dark-400 text-xs lg:text-sm">Products</p>
        <p class="text-lg lg:text-2xl font-bold text-white mt-1"><?php echo e(number_format($totalProducts)); ?></p>
    </div>

    <div class="bg-dark-800 border border-dark-700 rounded-xl p-3 lg:p-6 hover:border-yellow-500/50 transition-smooth">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <div class="w-8 h-8 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-pink-500 to-pink-600 flex items-center justify-center">
                <i class="fas fa-tags text-white text-sm lg:text-xl"></i>
            </div>
        </div>
        <p class="text-dark-400 text-xs lg:text-sm">Categories</p>
        <p class="text-lg lg:text-2xl font-bold text-white mt-1"><?php echo e(number_format($totalCategories)); ?></p>
    </div>

    <div class="bg-dark-800 border border-dark-700 rounded-xl p-3 lg:p-6 hover:border-yellow-500/50 transition-smooth">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <div class="w-8 h-8 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center">
                <i class="fas fa-truck text-white text-sm lg:text-xl"></i>
            </div>
        </div>
        <p class="text-dark-400 text-xs lg:text-sm">Suppliers</p>
        <p class="text-lg lg:text-2xl font-bold text-white mt-1"><?php echo e(number_format($totalSuppliers)); ?></p>
    </div>

    <div class="bg-dark-800 border border-dark-700 rounded-xl p-3 lg:p-6 hover:border-yellow-500/50 transition-smooth">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <div class="w-8 h-8 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                <i class="fas fa-user-tie text-white text-sm lg:text-xl"></i>
            </div>
        </div>
        <p class="text-dark-400 text-xs lg:text-sm">Employees</p>
        <p class="text-lg lg:text-2xl font-bold text-white mt-1"><?php echo e(number_format($totalEmployees)); ?></p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6 mb-4 lg:mb-8">
    <!-- Sales Chart -->
    <div class="lg:col-span-2 bg-dark-800 border border-dark-700 rounded-xl p-4 lg:p-6">
        <div class="flex items-center justify-between mb-4 lg:mb-6">
            <h3 class="text-base lg:text-lg font-semibold text-white">Sales Overview</h3>
            <select class="classic-select text-xs lg:text-sm" style="width: auto;">
                <option>This Year</option>
                <option>Last Year</option>
            </select>
        </div>
        <canvas id="salesChart" height="200"></canvas>
    </div>

    <!-- Quick Stats -->
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-4 lg:p-6">
        <h3 class="text-base lg:text-lg font-semibold text-white mb-4 lg:mb-6">Quick Stats</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-2 lg:p-3 bg-dark-700/50 rounded-lg">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 lg:w-8 lg:h-8 rounded-lg bg-blue-500/20 flex items-center justify-center"><i class="fas fa-box text-blue-400 text-xs lg:text-sm"></i></div>
                    <span class="text-dark-300 text-xs lg:text-sm">Total Products</span>
                </div>
                <span class="text-white font-semibold text-xs lg:text-sm"><?php echo e($totalProducts); ?></span>
            </div>
            <div class="flex items-center justify-between p-2 lg:p-3 bg-dark-700/50 rounded-lg">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 lg:w-8 lg:h-8 rounded-lg bg-purple-500/20 flex items-center justify-center"><i class="fas fa-tags text-purple-400 text-xs lg:text-sm"></i></div>
                    <span class="text-dark-300 text-xs lg:text-sm">Categories</span>
                </div>
                <span class="text-white font-semibold text-xs lg:text-sm"><?php echo e($totalCategories); ?></span>
            </div>
            <div class="flex items-center justify-between p-2 lg:p-3 bg-dark-700/50 rounded-lg">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 lg:w-8 lg:h-8 rounded-lg bg-green-500/20 flex items-center justify-center"><i class="fas fa-truck text-green-400 text-xs lg:text-sm"></i></div>
                    <span class="text-dark-300 text-xs lg:text-sm">Suppliers</span>
                </div>
                <span class="text-white font-semibold text-xs lg:text-sm"><?php echo e($totalSuppliers); ?></span>
            </div>
            <div class="flex items-center justify-between p-2 lg:p-3 bg-dark-700/50 rounded-lg">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 lg:w-8 lg:h-8 rounded-lg bg-orange-500/20 flex items-center justify-center"><i class="fas fa-user-tie text-orange-400 text-xs lg:text-sm"></i></div>
                    <span class="text-dark-300 text-xs lg:text-sm">Employees</span>
                </div>
                <span class="text-white font-semibold text-xs lg:text-sm"><?php echo e($totalEmployees); ?></span>
            </div>
            <div class="flex items-center justify-between p-2 lg:p-3 bg-dark-700/50 rounded-lg">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 lg:w-8 lg:h-8 rounded-lg bg-red-500/20 flex items-center justify-center"><i class="fas fa-file-invoice-dollar text-red-400 text-xs lg:text-sm"></i></div>
                    <span class="text-dark-300 text-xs lg:text-sm">Total Expenses</span>
                </div>
                <span class="text-red-400 font-semibold text-xs lg:text-sm">$<?php echo e(number_format($totalExpenses, 2)); ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-dark-800 border border-dark-700 rounded-xl p-4 lg:p-6">
    <div class="flex items-center justify-between mb-4 lg:mb-6">
        <h3 class="text-base lg:text-lg font-semibold text-white">Recent Orders</h3>
        <a href="<?php echo e(route('orders.index')); ?>" class="text-yellow-500 hover:text-yellow-400 text-xs lg:text-sm font-medium">View All <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-2 lg:pb-3">Invoice</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-2 lg:pb-3 hidden sm:table-cell">Customer</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-2 lg:pb-3">Amount</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-2 lg:pb-3 hidden xs:table-cell">Status</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-2 lg:pb-3 hidden md:table-cell">Date</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-2 lg:pb-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-2 lg:py-3"><span class="text-white font-medium text-xs lg:text-sm"><?php echo e($order->invoice_no); ?></span></td>
                    <td class="py-2 lg:py-3 hidden sm:table-cell"><span class="text-dark-300 text-xs lg:text-sm"><?php echo e($order->customer->name); ?></span></td>
                    <td class="py-2 lg:py-3"><span class="text-white font-semibold text-xs lg:text-sm">$<?php echo e(number_format($order->grand_total, 2)); ?></span></td>
                    <td class="py-2 lg:py-3 hidden xs:table-cell">
                        <span class="px-2 py-0.5 lg:py-1 rounded-full text-xs font-medium <?php echo e($order->status === 'completed' ? 'bg-emerald-500/20 text-emerald-400' : ($order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400')); ?>">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </td>
                    <td class="py-2 lg:py-3 hidden md:table-cell"><span class="text-dark-400 text-xs"><?php echo e($order->order_date); ?></span></td>
                    <td class="py-2 lg:py-3">
                        <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="text-yellow-500 hover:text-yellow-400"><i class="fas fa-eye text-xs lg:text-sm"></i></a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="py-4 text-center text-dark-500">No orders found</td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(234, 179, 8, 0.3)');
    gradient.addColorStop(1, 'rgba(234, 179, 8, 0)');
    
    const salesData = <?php echo e(json_encode($salesData)); ?>;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Sales',
                data: salesData,
                borderColor: '#d4af37',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#d4af37',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } },
                y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8', callback: v => '$' + v/1000 + 'k' } }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/dashboard.blade.php ENDPATH**/ ?>