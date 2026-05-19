@extends('layouts.app')

@section('title', 'POS - Point of Sale')
@section('page-title', 'Point of Sale')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6">
    <!-- Product Grid -->
    <div class="lg:col-span-2 space-y-4 lg:space-y-6">
        <!-- Search -->
        <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <div class="relative flex-1">
                    <input type="text" id="searchProduct" placeholder="Search products by name or code..." class="classic-input pl-11">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-dark-500"></i>
                </div>
                <button onclick="location.reload()" class="classic-btn-secondary px-4">
                    <i class="fas fa-redo-alt"></i>
                </button>
            </div>
        </div>

        <!-- Products -->
        <div class="bg-dark-800 border border-dark-700 rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                    <i class="fas fa-box text-yellow-500"></i> Available Products
                </h3>
                <span class="text-dark-400 text-sm">{{ $products->count() }} products</span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 lg:gap-4" id="productGrid">
                @foreach($products as $product)
                <button type="button" onclick="addToCart({{ $product->id }})" class="group border-2 border-dark-700 rounded-xl p-3 hover:border-yellow-500/50 hover:bg-dark-700/50 transition-all text-left">
                    @if($product->image)
                    <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-16 lg:h-20 object-cover rounded-lg mb-2">
                    @else
                    <div class="w-full h-16 lg:h-20 bg-dark-700 rounded-lg mb-2 flex items-center justify-center"><i class="fas fa-box text-dark-500 text-xl"></i></div>
                    @endif
                    <p class="font-medium text-white text-xs lg:text-sm truncate">{{ $product->name }}</p>
                    <p class="text-xs text-dark-500">Code: {{ $product->code }}</p>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-yellow-400 font-bold text-sm">${{ number_format($product->selling_price, 2) }}</p>
                        <p class="text-xs {{ $product->quantity < 10 ? 'text-red-400' : 'text-dark-500' }}">{{ $product->quantity }} in stock</p>
                    </div>
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Cart & Checkout -->
    <div class="space-y-4 lg:space-y-6">
        <!-- Cart -->
        <div class="bg-dark-800 border border-dark-700 rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                    <i class="fas fa-shopping-cart text-yellow-500"></i> Shopping Cart
                </h3>
                <button onclick="clearCart()" class="text-red-400 hover:text-red-300 text-sm flex items-center gap-1">
                    <i class="fas fa-trash"></i> Clear
                </button>
            </div>

            <div id="cartItems" class="space-y-2 max-h-48 lg:max-h-64 overflow-y-auto mb-4 pr-1">
                @php $subtotal = 0; @endphp
                @foreach($cart as $id => $item)
                @php $subtotal += $item['price'] * $item['quantity']; @endphp
                <div class="flex items-center justify-between p-3 bg-dark-900 rounded-lg border border-dark-700">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-white text-sm truncate">{{ $item['name'] }}</p>
                        <p class="text-xs text-dark-500">${{ number_format($item['price'], 2) }} x {{ $item['quantity'] }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-yellow-400 font-semibold text-sm">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        <button onclick="removeFromCart({{ $id }})" class="p-1.5 rounded-lg hover:bg-red-500/20 text-red-400 transition-smooth">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endforeach
                @if(empty($cart))
                <div class="text-center py-8">
                    <i class="fas fa-shopping-cart text-dark-600 text-4xl mb-3"></i>
                    <p class="text-dark-500">Cart is empty</p>
                    <p class="text-dark-600 text-xs mt-1">Click products to add</p>
                </div>
                @endif
            </div>

            <div class="border-t border-dark-700 pt-4 space-y-3">
                <div class="flex justify-between text-dark-400 text-sm">
                    <span>Subtotal</span>
                    <span class="text-white font-medium">${{ number_format($subtotal, 2) }}</span>
                </div>
                @php $vat = $subtotal * 0.15; @endphp
                <div class="flex justify-between text-dark-400 text-sm">
                    <span>VAT (15%)</span>
                    <span class="text-white font-medium">${{ number_format($vat, 2) }}</span>
                </div>
                <div class="flex justify-between text-xl font-bold text-white pt-3 border-t border-dark-700">
                    <span>Total</span>
                    <span class="text-yellow-400">${{ number_format($subtotal + $vat, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Checkout -->
        <div class="bg-dark-800 border border-dark-700 rounded-xl p-5">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <i class="fas fa-credit-card text-blue-500"></i> Checkout
            </h3>
            <form action="{{ route('pos.processOrder') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-medium text-dark-300">Customer</label>
                    <select name="customer_id" required class="classic-select">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->phone }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-dark-300">Payment Method</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="cash" checked class="hidden">
                            <div class="p-3 rounded-lg border border-dark-600 text-center hover:border-yellow-500 transition-smooth payment-option">
                                <i class="fas fa-money-bill-wave text-dark-400 mb-1"></i>
                                <p class="text-xs text-dark-400">Cash</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="bank" class="hidden">
                            <div class="p-3 rounded-lg border border-dark-600 text-center hover:border-yellow-500 transition-smooth payment-option">
                                <i class="fas fa-university text-dark-400 mb-1"></i>
                                <p class="text-xs text-dark-400">Bank</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="mobile" class="hidden">
                            <div class="p-3 rounded-lg border border-dark-600 text-center hover:border-yellow-500 transition-smooth payment-option">
                                <i class="fas fa-mobile-alt text-dark-400 mb-1"></i>
                                <p class="text-xs text-dark-400">Mobile</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-dark-300">Paid Amount ($)</label>
                    <input type="number" name="paid_amount" step="0.01" value="{{ number_format($subtotal + $vat, 2) }}" required class="classic-input">
                </div>
                <button type="submit" class="classic-btn w-full flex items-center justify-center gap-2 py-3 text-base">
                    <i class="fas fa-check-circle"></i> Complete Order
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function addToCart(productId) {
        fetch('{{ route('pos.addToCart') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ product_id: productId })
        }).then(() => location.reload());
    }
    function removeFromCart(productId) {
        fetch('{{ route('pos.removeFromCart') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ product_id: productId })
        }).then(() => location.reload());
    }
    function clearCart() {
        if(confirm('Clear all items from cart?')) {
            fetch('{{ route('pos.clearCart') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => location.reload());
        }
    }
    document.getElementById('searchProduct').addEventListener('input', function(e) {
        if(e.target.value.length >= 2) {
            fetch('{{ route('pos.searchProducts') }}?search=' + e.target.value)
                .then(r => r.json())
                .then(products => {
                    if(products.length === 0) {
                        document.getElementById('productGrid').innerHTML = '<div class="col-span-full text-center py-8 text-dark-500">No products found</div>';
                    } else {
                        document.getElementById('productGrid').innerHTML = products.map(p => `
                            <button type="button" onclick="addToCart(${p.id})" class="border-2 border-dark-700 rounded-xl p-3 hover:border-yellow-500/50 hover:bg-dark-700/50 text-left">
                                <div class="w-full h-20 bg-dark-700 rounded-lg mb-2 flex items-center justify-center"><i class="fas fa-box text-dark-500 text-xl"></i></div>
                                <p class="font-medium text-white text-xs truncate">${p.name}</p>
                                <p class="text-xs text-dark-500">${p.code}</p>
                                <div class="flex items-center justify-between mt-1">
                                    <p class="text-yellow-400 font-bold text-sm">$${p.selling_price}</p>
                                    <p class="text-xs ${p.quantity < 10 ? 'text-red-400' : 'text-dark-500'}">${p.quantity} stock</p>
                                </div>
                            </button>
                        `).join('');
                    }
                });
        }
    });
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-option').forEach(opt => {
                opt.classList.remove('border-yellow-500', 'bg-yellow-500/10');
                opt.classList.add('border-dark-600');
            });
            this.closest('label').querySelector('.payment-option').classList.add('border-yellow-500', 'bg-yellow-500/10');
        });
    });
</script>
<style>
    input[name="payment_method"]:checked + .payment-option {
        border-color: #d4af37;
        background: rgba(212, 175, 55, 0.1);
    }
    input[name="payment_method"]:checked + .payment-option i,
    input[name="payment_method"]:checked + .payment-option p {
        color: #d4af37;
    }
</style>
@endsection