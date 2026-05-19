<?php $__env->startSection('title', 'Order Details'); ?>
<?php $__env->startSection('page-title', 'Order Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Order Header Card -->
    <div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                    <i class="fas fa-file-invoice text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Order <?php echo e($order->invoice_no); ?></h2>
                    <p class="text-dark-400 text-sm"><?php echo e($order->order_date); ?></p>
                </div>
            </div>
            <span class="px-4 py-2 rounded-lg text-sm font-semibold
                <?php echo e($order->status === 'completed' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 
                   ($order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' : 'bg-red-500/20 text-red-400 border border-red-500/30')); ?>">
                <i class="fas <?php echo e($order->status === 'completed' ? 'fa-check-circle' : ($order->status === 'pending' ? 'fa-clock' : 'fa-times-circle')); ?> mr-2"></i>
                <?php echo e(ucfirst($order->status)); ?>

            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Customer Info -->
            <div class="bg-dark-900 rounded-xl p-5">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-user text-blue-500"></i> Customer Details
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white font-bold"><?php echo e(substr($order->customer->name, 0, 1)); ?></span>
                        </div>
                        <div>
                            <p class="text-white font-semibold"><?php echo e($order->customer->name); ?></p>
                            <p class="text-dark-400 text-sm"><?php echo e($order->customer->phone); ?></p>
                        </div>
                    </div>
                    <div class="pt-2 border-t border-dark-700">
                        <p class="text-dark-400 text-sm">Address</p>
                        <p class="text-white"><?php echo e($order->customer->address ?: 'Not provided'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="bg-dark-900 rounded-xl p-5">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-credit-card text-purple-500"></i> Payment Details
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                        <span class="text-dark-400">Payment Method</span>
                        <span class="text-white font-medium capitalize"><?php echo e($order->payment_method); ?></span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                        <span class="text-dark-400">Paid Amount</span>
                        <span class="text-emerald-400 font-bold">$<?php echo e(number_format($order->paid_amount, 2)); ?></span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-dark-800 rounded-lg">
                        <span class="text-dark-400">Due Amount</span>
                        <span class="text-red-400 font-bold">$<?php echo e(number_format($order->due_amount, 2)); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items Table -->
    <div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-box text-yellow-500"></i> Order Items
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-dark-700">
                        <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Product</th>
                        <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Code</th>
                        <th class="text-center text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Quantity</th>
                        <th class="text-right text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Unit Cost</th>
                        <th class="text-right text-xs font-semibold text-dark-400 uppercase tracking-wider pb-4">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-700">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-dark-700/30 transition-smooth">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-dark-700 flex items-center justify-center">
                                    <i class="fas fa-box text-dark-400"></i>
                                </div>
                                <span class="text-white font-medium"><?php echo e($item->product->name); ?></span>
                            </div>
                        </td>
                        <td class="py-4">
                            <span class="text-dark-400 text-sm"><?php echo e($item->product->code); ?></span>
                        </td>
                        <td class="py-4 text-center">
                            <span class="text-white font-semibold"><?php echo e($item->quantity); ?></span>
                        </td>
                        <td class="py-4 text-right">
                            <span class="text-dark-300">$<?php echo e(number_format($item->unit_cost, 2)); ?></span>
                        </td>
                        <td class="py-4 text-right">
                            <span class="text-yellow-400 font-bold">$<?php echo e(number_format($item->total, 2)); ?></span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Order Summary -->
        <div class="mt-6 bg-dark-900 rounded-xl p-5">
            <div class="flex flex-col lg:flex-row justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex justify-between gap-32">
                        <span class="text-dark-400">Subtotal</span>
                        <span class="text-white font-medium">$<?php echo e(number_format($order->total_amount, 2)); ?></span>
                    </div>
                    <div class="flex justify-between gap-32">
                        <span class="text-dark-400">VAT</span>
                        <span class="text-white font-medium">$<?php echo e(number_format($order->vat, 2)); ?></span>
                    </div>
                    <div class="flex justify-between gap-32 pt-2 border-t border-dark-700">
                        <span class="text-white font-bold">Grand Total</span>
                        <span class="text-yellow-400 font-bold text-xl">$<?php echo e(number_format($order->grand_total, 2)); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Status Card -->
    <div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
        <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-pen text-blue-500"></i> Update Order Status
        </h3>
        <form action="<?php echo e(route('orders.updateStatus', $order->id)); ?>" method="POST" class="flex flex-col lg:flex-row gap-4 items-start lg:items-center">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="flex-1 w-full lg:w-auto">
                <select name="status" class="classic-select">
                    <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="completed" <?php echo e($order->status === 'completed' ? 'selected' : ''); ?>>Completed</option>
                    <option value="cancelled" <?php echo e($order->status === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="classic-btn flex items-center gap-2">
                <i class="fas fa-check"></i> Update Status
            </button>
            <a href="<?php echo e(route('orders.invoice', $order->id)); ?>" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-print"></i> Print Invoice
            </a>
            <a href="<?php echo e(route('orders.index')); ?>" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/orders/show.blade.php ENDPATH**/ ?>