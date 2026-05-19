<?php $__env->startSection('title', 'Salaries'); ?>
<?php $__env->startSection('page-title', 'Salary Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-white">All Salaries</h3>
        <a href="<?php echo e(route('salaries.create')); ?>" class="classic-btn">
            <i class="fas fa-plus mr-2"></i>Add Salary
        </a>
    </div>

    <!-- Filters -->
    <form method="GET" class="flex flex-wrap gap-4 mb-6">
        <select name="month" class="classic-select" style="width: auto;">
            <option value="">All Months</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($month); ?>" <?php echo e(request('month') == $month ? 'selected' : ''); ?>><?php echo e($month); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>
        <select name="year" class="classic-select" style="width: auto;">
            <option value="">All Years</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($y = now()->year; $y >= now()->year - 5; $y--): ?>
            <option value="<?php echo e($y); ?>" <?php echo e(request('year') == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>
        <select name="status" class="classic-select" style="width: auto;">
            <option value="">All Status</option>
            <option value="paid" <?php echo e(request('status') == 'paid' ? 'selected' : ''); ?>>Paid</option>
            <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
        </select>
        <button type="submit" class="classic-btn" style="padding: 10px 16px;">
            <i class="fas fa-filter mr-2"></i>Filter
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Employee</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Month</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Year</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Amount</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Status</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Payment Date</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white text-xs font-bold"><?php echo e(substr($salary->employee->user->name, 0, 1)); ?></span>
                            </div>
                            <span class="text-white font-medium"><?php echo e($salary->employee->user->name); ?></span>
                        </div>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-300"><?php echo e($salary->month); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400"><?php echo e($salary->year); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="text-white font-semibold">$<?php echo e(number_format($salary->amount, 2)); ?></span>
                    </td>
                    <td class="py-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium <?php echo e($salary->status === 'paid' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400'); ?>">
                            <?php echo e(ucfirst($salary->status)); ?>

                        </span>
                    </td>
                    <td class="py-4">
                        <span class="text-dark-400 text-sm"><?php echo e($salary->payment_date ?? '-'); ?></span>
                    </td>
                    <td class="py-4">
                        <div class="flex items-center gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($salary->status === 'pending'): ?>
                            <form action="<?php echo e(route('salaries.pay', $salary->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="p-2 rounded-lg hover:bg-dark-700 text-emerald-400 transition-smooth" title="Pay">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <a href="<?php echo e(route('salaries.edit', $salary->id)); ?>" class="p-2 rounded-lg hover:bg-dark-700 text-yellow-400 transition-smooth">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-<?php echo e($salary->id); ?>" action="<?php echo e(route('salaries.destroy', $salary->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="button" onclick="confirmDelete('delete-form-<?php echo e($salary->id); ?>')" class="p-2 rounded-lg hover:bg-dark-700 text-red-400 transition-smooth">
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/salaries/index.blade.php ENDPATH**/ ?>