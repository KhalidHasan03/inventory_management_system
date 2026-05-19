<?php $__env->startSection('title', 'Expenses'); ?>
<?php $__env->startSection('page-title', 'Expense Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-white">All Expenses</h3>
        <a href="<?php echo e(route('expenses.create')); ?>" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition-smooth">
            <i class="fas fa-plus"></i>
            <span>Add Expense</span>
        </a>
    </div>

    <!-- Filters -->
    <form method="GET" class="flex flex-wrap gap-4 mb-6">
        <input type="text" name="category" placeholder="Category" value="<?php echo e(request('category')); ?>" class="px-4 py-2 bg-dark-700 border border-dark-600 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500 w-auto">
        <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="px-4 py-2 bg-dark-700 border border-dark-600 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500">
        <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="px-4 py-2 bg-dark-700 border border-dark-600 rounded-lg text-white text-sm focus:outline-none focus:border-yellow-500">
        <button type="submit" class="px-4 py-2 bg-yellow-500/20 text-yellow-400 rounded-lg hover:bg-yellow-500/30 transition-smooth">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
    </form>

    <!-- Total -->
    <div class="mb-6 p-4 bg-gradient-to-r from-red-500/10 to-orange-500/10 rounded-xl border border-red-500/20">
        <div class="flex items-center justify-between">
            <span class="text-dark-400">Total Expenses</span>
            <span class="text-2xl font-bold text-red-400">$<?php echo e(number_format($totalAmount, 2)); ?></span>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Category</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Amount</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Date</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Description</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-500/20 text-blue-400"><?php echo e($expense->category); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-red-400 font-semibold">$<?php echo e(number_format($expense->amount, 2)); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400 text-sm"><?php echo e($expense->date); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-300 text-sm"><?php echo e($expense->description); ?></span>
                    </td>
                    <td class="py-4">
                        <div class="flex items-center gap-2">
                            <a href="<?php echo e(route('expenses.edit', $expense->id)); ?>" class="p-2 rounded-lg hover:bg-dark-700 text-yellow-400 transition-smooth">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-<?php echo e($expense->id); ?>" action="<?php echo e(route('expenses.destroy', $expense->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="button" onclick="confirmDelete('delete-form-<?php echo e($expense->id); ?>')" class="p-2 rounded-lg hover:bg-dark-700 text-red-400 transition-smooth">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/expenses/index.blade.php ENDPATH**/ ?>