<?php $__env->startSection('title', 'Employees'); ?>
<?php $__env->startSection('page-title', 'Employee Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-dark-800 border border-dark-700 rounded-2xl p-4 lg:p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4 lg:mb-6">
        <h3 class="text-lg font-semibold text-white">All Employees</h3>
        <a href="<?php echo e(route('employees.create')); ?>" class="classic-btn inline-flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i><span class="hidden sm:inline">Add Employee</span>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-dark-700">
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Employee</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3 hidden md:table-cell">Email</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3 hidden sm:table-cell">Phone</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Salary</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3 hidden lg:table-cell">Join Date</th>
                    <th class="text-left text-xs font-semibold text-dark-400 uppercase tracking-wider pb-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-700">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-dark-700/30 transition-smooth">
                    <td class="py-3 lg:py-4">
                        <div class="flex items-center gap-2 lg:gap-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($employee->profile_pic): ?>
                            <img src="<?php echo e(asset('uploads/employees/' . $employee->profile_pic)); ?>" alt="<?php echo e($employee->user->name); ?>" class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover">
                            <?php else: ?>
                            <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                <span class="text-white font-bold text-xs lg:text-sm"><?php echo e(substr($employee->user->name, 0, 1)); ?></span>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div><span class="text-white font-medium text-sm block"><?php echo e($employee->user->name); ?></span></div>
                        </div>
                    </td>
                    <td class="py-3 lg:py-4 hidden md:table-cell"><span class="text-dark-400 text-sm"><?php echo e($employee->user->email); ?></span></td>
                    <td class="py-3 lg:py-4 hidden sm:table-cell"><span class="text-dark-300 text-sm"><?php echo e($employee->user->phone); ?></span></td>
                    <td class="py-3 lg:py-4"><span class="text-emerald-400 font-semibold text-sm">$<?php echo e(number_format($employee->salary, 2)); ?></span></td>
                    <td class="py-3 lg:py-4 hidden lg:table-cell"><span class="text-dark-400 text-sm"><?php echo e($employee->join_date); ?></span></td>
                    <td class="py-3 lg:py-4">
                        <div class="flex items-center gap-1 lg:gap-2">
                            <a href="<?php echo e(route('employees.show', $employee->id)); ?>" class="p-1.5 lg:p-2 rounded-lg hover:bg-dark-700 text-blue-400"><i class="fas fa-eye text-xs lg:text-sm"></i></a>
                            <a href="<?php echo e(route('employees.edit', $employee->id)); ?>" class="p-1.5 lg:p-2 rounded-lg hover:bg-dark-700 text-yellow-400"><i class="fas fa-edit text-xs lg:text-sm"></i></a>
                            <form id="delete-form-<?php echo e($employee->id); ?>" action="<?php echo e(route('employees.destroy', $employee->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="button" onclick="confirmDelete('delete-form-<?php echo e($employee->id); ?>')" class="p-1.5 lg:p-2 rounded-lg hover:bg-dark-700 text-red-400"><i class="fas fa-trash text-xs lg:text-sm"></i></button>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/employees/index.blade.php ENDPATH**/ ?>