<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Inventory Management System'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        dark: { 50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0', 300: '#cbd5e1', 400: '#94a3b8', 500: '#64748b', 600: '#475569', 700: '#334155', 800: '#1e293b', 900: '#0f172a', 950: '#020617' }
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        /* Classic Input Styles */
        .classic-input { background: #1e293b; border: 1px solid #334155; color: #f1f5f9; padding: 10px 14px; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s ease; width: 100%; }
        .classic-input:focus { border-color: #d4af37; box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.1); }
        .classic-input::placeholder { color: #64748b; }
        
        .classic-select { background: #1e293b; border: 1px solid #334155; color: #f1f5f9; padding: 10px 14px; border-radius: 8px; font-size: 14px; outline: none; transition: all 0.2s ease; width: 100%; cursor: pointer; }
        .classic-select:focus { border-color: #d4af37; box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.1); }
        .classic-select option { background: #1e293b; color: #f1f5f9; }
        
        .classic-btn { background: linear-gradient(135deg, #d4af37 0%, #b8962e 100%); color: #0f172a; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; border: none; cursor: pointer; transition: all 0.2s ease; }
        .classic-btn:hover { background: linear-gradient(135deg, #e5c04b 0%, #d4af37 100%); transform: translateY(-1px); }
        
        .classic-btn-secondary { background: #334155; color: #94a3b8; padding: 10px 20px; border-radius: 8px; font-weight: 500; font-size: 14px; border: none; cursor: pointer; transition: all 0.2s ease; }
        .classic-btn-secondary:hover { background: #475569; }
        
        .neon-glow { box-shadow: 0 0 20px rgba(212, 175, 55, 0.3); }
        .transition-smooth { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .sidebar-active { background: linear-gradient(90deg, rgba(212, 175, 55, 0.2) 0%, transparent 100%); border-left: 3px solid #d4af37; }
        
        .dropdown-menu { animation: slideDown 0.2s ease-out; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Mobile Sidebar */
        .mobile-sidebar { transform: translateX(-100%); }
        .mobile-sidebar.active { transform: translateX(0); }
        @media (min-width: 1024px) {
            .mobile-sidebar { transform: translateX(0) !important; }
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #1e293b; }
        ::-webkit-scrollbar-thumb { background: #475569; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }
    </style>
</head>
<body class="bg-dark-900 text-white font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <!-- Mobile Menu Button -->
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-dark-800 border border-dark-700 rounded-lg text-white">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Sidebar -->
        <aside id="sidebar" :class="sidebarOpen ? 'active' : ''" class="w-72 bg-dark-950 border-r border-dark-800 fixed h-full z-50 mobile-sidebar transition-smooth overflow-y-auto">
            <!-- Logo -->
            <div class="p-6 border-b border-dark-800 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center neon-glow">
                        <i class="fas fa-boxes-stacked text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-white">Inventory Pro</h1>
                        <p class="text-xs text-dark-400">Management</p>
                    </div>
                </div>
                <!-- Close button for mobile -->
                <button @click="sidebarOpen = false" class="lg:hidden p-1 text-dark-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <p class="text-xs font-semibold text-dark-500 uppercase tracking-wider mb-2 px-3">Main Menu</p>
                
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('dashboard') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-chart-pie w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="<?php echo e(route('pos.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('pos.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-cash-register w-5 text-center"></i>
                    <span class="font-medium">POS System</span>
                </a>

                <a href="<?php echo e(route('orders.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('orders.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-shopping-bag w-5 text-center"></i>
                    <span class="font-medium">Orders</span>
                </a>

                <a href="<?php echo e(route('products.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('products.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-box w-5 text-center"></i>
                    <span class="font-medium">Products</span>
                </a>

                <a href="<?php echo e(route('categories.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('categories.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-tags w-5 text-center"></i>
                    <span class="font-medium">Categories</span>
                </a>

                <p class="text-xs font-semibold text-dark-500 uppercase tracking-wider mb-2 mt-4 px-3">People</p>

                <a href="<?php echo e(route('customers.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('customers.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span class="font-medium">Customers</span>
                </a>

                <a href="<?php echo e(route('employees.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('employees.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-user-tie w-5 text-center"></i>
                    <span class="font-medium">Employees</span>
                </a>

                <a href="<?php echo e(route('suppliers.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('suppliers.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-truck-loading w-5 text-center"></i>
                    <span class="font-medium">Suppliers</span>
                </a>

                <p class="text-xs font-semibold text-dark-500 uppercase tracking-wider mb-2 mt-4 px-3">Finance</p>

                <a href="<?php echo e(route('salaries.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('salaries.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-money-bill-wave w-5 text-center"></i>
                    <span class="font-medium">Salaries</span>
                </a>

                <a href="<?php echo e(route('expenses.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('expenses.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-file-invoice-dollar w-5 text-center"></i>
                    <span class="font-medium">Expenses</span>
                </a>

                <a href="<?php echo e(route('reports.sales')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg text-dark-300 hover:bg-dark-800 hover:text-white transition-smooth <?php echo e(request()->routeIs('reports.*') ? 'sidebar-active text-white' : ''); ?>">
                    <i class="fas fa-chart-line w-5 text-center"></i>
                    <span class="font-medium">Reports</span>
                </a>
            </nav>

            <!-- User Section -->
            <div class="p-4 border-t border-dark-800 bg-dark-950">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                        <span class="text-white font-bold"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate"><?php echo e(Auth::user()->name); ?></p>
                        <p class="text-xs text-dark-400"><?php echo e(ucfirst(Auth::user()->role)); ?></p>
                    </div>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="p-2 rounded-lg hover:bg-dark-800 text-dark-400 hover:text-red-400 transition-smooth">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="lg:hidden fixed inset-0 bg-black/50 z-40"></div>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-72 p-4 lg:p-8 pt-16 lg:pt-8">
            <!-- Header -->
            <header class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 mb-6 lg:mb-8">
                <div>
                    <h2 class="text-xl lg:text-2xl font-bold text-white"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h2>
                    <p class="text-dark-400 text-sm mt-1">Welcome back, <?php echo e(Auth::user()->name); ?></p>
                </div>
                <div class="flex flex-wrap items-center gap-3 lg:gap-4">
                    <!-- Search -->
                    <div class="relative w-full lg:w-64" id="search-container">
                        <input type="text" id="global-search" placeholder="Search products, orders, customers..." class="classic-input pl-10 w-full">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-dark-500"></i>
                        
                        <!-- Search Results Dropdown -->
                        <div id="search-results" class="absolute right-0 mt-2 w-80 lg:w-96 bg-dark-800 border border-dark-700 rounded-xl shadow-2xl z-50 max-h-96 overflow-y-auto hidden">
                        </div>
                    </div>
                    
                    <!-- Notifications -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="relative p-2 bg-dark-800 border border-dark-700 rounded-lg hover:bg-dark-700 transition-smooth">
                            <i class="fas fa-bell text-dark-400"></i>
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-xs flex items-center justify-center">5</span>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-72 lg:w-80 bg-dark-800 border border-dark-700 rounded-xl shadow-2xl z-50 dropdown-menu max-h-96 overflow-y-auto">
                            <div class="p-3 border-b border-dark-700 flex justify-between items-center">
                                <h3 class="font-semibold text-white">Notifications</h3>
                                <button class="text-xs text-yellow-500 hover:text-yellow-400">Mark all read</button>
                            </div>
                            <a href="#" class="block p-3 border-b border-dark-700 hover:bg-dark-700/50">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0"><i class="fas fa-shopping-cart text-blue-400 text-sm"></i></div>
                                    <div class="flex-1 min-w-0"><p class="text-white text-sm truncate">New order received</p><p class="text-dark-500 text-xs">2 minutes ago</p></div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 border-b border-dark-700 hover:bg-dark-700/50">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center flex-shrink-0"><i class="fas fa-check-circle text-green-400 text-sm"></i></div>
                                    <div class="flex-1 min-w-0"><p class="text-white text-sm truncate">Payment confirmed</p><p class="text-dark-500 text-xs">15 minutes ago</p></div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 border-b border-dark-700 hover:bg-dark-700/50">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-yellow-500/20 flex items-center justify-center flex-shrink-0"><i class="fas fa-exclamation-triangle text-yellow-400 text-sm"></i></div>
                                    <div class="flex-1 min-w-0"><p class="text-white text-sm truncate">Low stock alert</p><p class="text-dark-500 text-xs">1 hour ago</p></div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 hover:bg-dark-700/50">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-purple-500/20 flex items-center justify-center flex-shrink-0"><i class="fas fa-user-plus text-purple-400 text-sm"></i></div>
                                    <div class="flex-1 min-w-0"><p class="text-white text-sm truncate">New customer registered</p><p class="text-dark-500 text-xs">2 hours ago</p></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="mb-4 lg:mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg flex items-center gap-3">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="text-green-400 text-sm"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div class="mb-4 lg:mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <span class="text-red-400 text-sm"><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <script>
        function confirmDelete(formId) {
            if(confirm('Are you sure you want to delete this item?')) {
                document.getElementById(formId).submit();
            }
        }
        
        // Global Search
        const searchInput = document.getElementById('global-search');
        const searchResults = document.getElementById('search-results');
        const searchContainer = document.getElementById('search-container');
        let searchTimeout;
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value;
                
                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    searchResults.innerHTML = '';
                    return;
                }
                
                searchResults.classList.remove('hidden');
                searchResults.innerHTML = '<div class="p-4 text-center text-dark-500"><i class="fas fa-spinner fa-spin"></i> Searching...</div>';
                
                searchTimeout = setTimeout(async function() {
                    try {
                        const response = await fetch('<?php echo e(route("search")); ?>?q=' + encodeURIComponent(query));
                        const data = await response.json();
                        
                        let html = '';
                        
                        // Products
                        if (data.products.length > 0) {
                            html += '<div class="p-2 border-b border-dark-700"><p class="text-xs font-semibold text-dark-400 uppercase px-2">Products</p></div>';
                            data.products.forEach(product => {
                                html += `<a href="/products/${product.id}" class="block p-3 border-b border-dark-700 hover:bg-dark-700/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded bg-dark-700 flex items-center justify-center"><i class="fas fa-box text-dark-400"></i></div>
                                        <div><p class="text-white text-sm">${product.name}</p><p class="text-dark-500 text-xs">${product.code} - $${product.selling_price}</p></div>
                                    </div>
                                </a>`;
                            });
                        }
                        
                        // Orders
                        if (data.orders.length > 0) {
                            html += '<div class="p-2 border-b border-dark-700"><p class="text-xs font-semibold text-dark-400 uppercase px-2">Orders</p></div>';
                            data.orders.forEach(order => {
                                html += `<a href="/orders/${order.id}" class="block p-3 border-b border-dark-700 hover:bg-dark-700/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded bg-dark-700 flex items-center justify-center"><i class="fas fa-file-invoice text-dark-400"></i></div>
                                        <div><p class="text-white text-sm">${order.invoice_no}</p><p class="text-dark-500 text-xs">${order.customer ? order.customer.name : 'N/A'} - $${order.grand_total}</p></div>
                                    </div>
                                </a>`;
                            });
                        }
                        
                        // Customers
                        if (data.customers.length > 0) {
                            html += '<div class="p-2 border-b border-dark-700"><p class="text-xs font-semibold text-dark-400 uppercase px-2">Customers</p></div>';
                            data.customers.forEach(customer => {
                                html += `<a href="/customers/${customer.id}" class="block p-3 border-b border-dark-700 hover:bg-dark-700/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center"><span class="text-white text-xs">${customer.name.charAt(0)}</span></div>
                                        <div><p class="text-white text-sm">${customer.name}</p><p class="text-dark-500 text-xs">${customer.phone}</p></div>
                                    </div>
                                </a>`;
                            });
                        }
                        
                        if (data.products.length === 0 && data.orders.length === 0 && data.customers.length === 0) {
                            html = '<div class="p-4 text-center text-dark-500">No results found</div>';
                        }
                        
                        searchResults.innerHTML = html;
                    } catch (error) {
                        searchResults.innerHTML = '<div class="p-4 text-center text-red-400">Error searching</div>';
                    }
                }, 300);
            });
            
            // Close search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchContainer.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });
        }
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH E:\inventory_manage\inventory_management_system\resources\views/layouts/app.blade.php ENDPATH**/ ?>