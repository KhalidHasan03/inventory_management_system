<?php $__env->startSection('title', 'Add Category'); ?>
<?php $__env->startSection('page-title', 'Add New Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-dark-800 border border-dark-700 rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Add New Category</h3>
        <form action="<?php echo e(route('categories.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-dark-300 mb-2">Category Name</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-dark-500 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-smooth">
                </div>
                <div>
                    <label class="block text-sm font-medium text-dark-300 mb-2">Description</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-dark-500 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-smooth"></textarea>
                </div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="status" value="1" checked class="w-4 h-4 rounded bg-dark-700 border-dark-600 text-yellow-500 focus:ring-yellow-500 focus:ring-offset-dark-800">
                    <span class="text-sm text-dark-300">Active</span>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-medium rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition-smooth">
                    Add Category
                </button>
                <a href="<?php echo e(route('categories.index')); ?>" class="px-6 py-2.5 bg-dark-700 text-dark-300 font-medium rounded-lg hover:bg-dark-600 transition-smooth">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/categories/create.blade.php ENDPATH**/ ?>