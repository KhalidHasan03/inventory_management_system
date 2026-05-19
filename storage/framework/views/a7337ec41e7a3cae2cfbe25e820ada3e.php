<?php $__env->startSection('title', 'Product Details'); ?>
<?php $__env->startSection('page-title', 'Product Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-dark-800 rounded-2xl border border-dark-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                <i class="fas fa-box text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white"><?php echo e($product->name); ?></h2>
                <p class="text-dark-400 text-sm">Code: <?php echo e($product->code); ?></p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="classic-btn flex items-center gap-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="<?php echo e(route('products.index')); ?>" class="classic-btn-secondary flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Product Image -->
        <div class="bg-dark-900 rounded-xl p-6 flex items-center justify-center">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->image): ?>
            <img src="<?php echo e(asset('uploads/products/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-48 h-48 rounded-xl object-cover border-4 border-yellow-500/30">
            <?php else: ?>
            <div class="w-48 h-48 rounded-xl bg-dark-800 flex items-center justify-center border-2 border-dashed border-dark-600">
                <i class="fas fa-box text-dark-500 text-6xl"></i>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="lg:col-span-2 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-dark-900 rounded-xl p-4">
                    <p class="text-dark-400 text-sm mb-1">Category</p>
                    <p class="text-white font-semibold"><?php echo e($product->category->name); ?></p>
                </div>
                <div class="bg-dark-900 rounded-xl p-4">
                    <p class="text-dark-400 text-sm mb-1">Supplier</p>
                    <p class="text-white font-semibold"><?php echo e($product->supplier->name); ?></p>
                </div>
                <div class="bg-dark-900 rounded-xl p-4">
                    <p class="text-dark-400 text-sm mb-1">Quantity</p>
                    <p class="text-white font-semibold <?php echo e($product->quantity < 10 ? 'text-red-400' : ''); ?>"><?php echo e($product->quantity); ?> units</p>
                </div>
                <div class="bg-dark-900 rounded-xl p-4">
                    <p class="text-dark-400 text-sm mb-1">Unit Cost</p>
                    <p class="text-white font-semibold">$<?php echo e(number_format($product->unit_cost, 2)); ?></p>
                </div>
                <div class="bg-dark-900 rounded-xl p-4">
                    <p class="text-dark-400 text-sm mb-1">Selling Price</p>
                    <p class="text-yellow-400 font-bold text-lg">$<?php echo e(number_format($product->selling_price, 2)); ?></p>
                </div>
                <div class="bg-dark-900 rounded-xl p-4">
                    <p class="text-dark-400 text-sm mb-1">Stock Value</p>
                    <p class="text-green-400 font-bold text-lg">$<?php echo e(number_format($product->quantity * $product->unit_cost, 2)); ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->quantity < 10): ?>
    <div class="mt-6 bg-red-500/10 border border-red-500/30 rounded-xl p-4 flex items-center gap-3">
        <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
        <div>
            <p class="text-red-400 font-semibold">Low Stock Alert</p>
            <p class="text-dark-400 text-sm">This product is running low on stock. Consider restocking soon.</p>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/products/show.blade.php ENDPATH**/ ?>