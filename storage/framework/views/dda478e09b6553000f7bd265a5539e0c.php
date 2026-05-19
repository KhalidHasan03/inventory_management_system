<?php $__env->startSection('title', 'Edit Product'); ?>
<?php $__env->startSection('page-title', 'Edit Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                <i class="fas fa-edit text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Edit Product</h2>
                <p class="text-dark-400 text-sm">Update product information</p>
            </div>
        </div>
        <a href="<?php echo e(route('products.index')); ?>" class="classic-btn-secondary flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Product Name</label>
                <input type="text" name="name" value="<?php echo e($product->name); ?>" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Product Code</label>
                <input type="text" name="code" value="<?php echo e($product->code); ?>" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Category</label>
                <select name="category_id" required class="classic-select">
                    <option value="">Select Category</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Supplier</label>
                <select name="supplier_id" required class="classic-select">
                    <option value="">Select Supplier</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($supplier->id); ?>" <?php echo e($product->supplier_id == $supplier->id ? 'selected' : ''); ?>><?php echo e($supplier->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Quantity</label>
                <input type="number" name="quantity" value="<?php echo e($product->quantity); ?>" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Unit Cost ($)</label>
                <input type="number" name="unit_cost" step="0.01" value="<?php echo e($product->unit_cost); ?>" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Selling Price ($)</label>
                <input type="number" name="selling_price" step="0.01" value="<?php echo e($product->selling_price); ?>" required class="classic-input">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-dark-300">Product Image</label>
                <div class="flex items-center gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->image): ?>
                    <img src="<?php echo e(asset('uploads/products/' . $product->image)); ?>" class="w-16 h-16 rounded-lg object-cover border-2 border-yellow-500">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <input type="file" name="image" accept="image/*" class="classic-input">
                </div>
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="classic-btn flex items-center gap-2">
                <i class="fas fa-save"></i> Update Product
            </button>
            <a href="<?php echo e(route('products.index')); ?>" class="classic-btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/products/edit.blade.php ENDPATH**/ ?>