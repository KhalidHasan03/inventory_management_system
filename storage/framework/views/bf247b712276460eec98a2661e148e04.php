<?php $__env->startSection('title', 'Sales Report'); ?>
<?php $__env->startSection('page-title', 'Sales Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-6 mb-6">
    <h3 class="text-lg font-semibold text-white mb-4">Filter Options</h3>
    <form method="GET" class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-sm font-medium text-dark-300 mb-2">Report Type</label>
            <select name="type" class="classic-select" style="width: auto;" onchange="this.form.submit()">
                <option value="daily" <?php echo e($type == 'daily' ? 'selected' : ''); ?>>Daily</option>
                <option value="monthly" <?php echo e($type == 'monthly' ? 'selected' : ''); ?>>Monthly</option>
                <option value="yearly" <?php echo e($type == 'yearly' ? 'selected' : ''); ?>>Yearly</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-dark-300 mb-2">Start Date</label>
            <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="classic-input" style="width: auto;">
        </div>
        <div>
            <label class="block text-sm font-medium text-dark-300 mb-2">End Date</label>
            <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="classic-input" style="width: auto;">
        </div>
        <button type="submit" class="classic-btn" style="padding: 10px 16px;">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
        <a href="<?php echo e(route('reports.sales')); ?>" class="classic-btn-secondary">
            Reset
        </a>
    </form>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
        <p class="text-dark-400 text-sm">Total Orders</p>
        <p class="text-2xl font-bold text-white"><?php echo e($orderCount); ?></p>
    </div>
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
        <p class="text-dark-400 text-sm">Total Sales</p>
        <p class="text-2xl font-bold text-emerald-400">$<?php echo e(number_format($totalSales, 2)); ?></p>
    </div>
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
        <p class="text-dark-400 text-sm">Total Expenses</p>
        <p class="text-2xl font-bold text-red-400">$<?php echo e(number_format($totalExpenses, 2)); ?></p>
    </div>
    <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
        <p class="text-dark-400 text-sm">Net Profit</p>
        <p class="text-2xl font-bold <?php echo e($profit >= 0 ? 'text-blue-400' : 'text-red-400'); ?>">$<?php echo e(number_format($profit, 2)); ?></p>
    </div>
</div>

<!-- Order Details -->
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-white">Order Details</h3>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($orders->count() > 0): ?>
        <a href="<?php echo e(route('reports.export', $type)); ?>" class="classic-btn" style="padding: 8px 16px;">
            <i class="fas fa-download mr-2"></i>Export to Excel
        </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Invoice No</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Customer</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Total</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">VAT</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Paid</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Due</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Status</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-4">
                        <span class="text-white font-medium"><?php echo e($order->invoice_no); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-300"><?php echo e($order->customer->name); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-white font-semibold">$<?php echo e(number_format($order->grand_total, 2)); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400">$<?php echo e(number_format($order->vat, 2)); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-emerald-400">$<?php echo e(number_format($order->paid_amount, 2)); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-<?php echo e($order->due_amount > 0 ? 'red' : 'dark-400'); ?>-400">$<?php echo e(number_format($order->due_amount, 2)); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium <?php echo e($order->status === 'completed' ? 'bg-emerald-500/20 text-emerald-400' : ($order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400')); ?>">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400 text-sm"><?php echo e($order->order_date); ?></span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/reports/sales.blade.php ENDPATH**/ ?>