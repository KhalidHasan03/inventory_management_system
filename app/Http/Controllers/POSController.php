<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->where('quantity', '>', 0)->get();
        $customers = Customer::all();
        
        $cart = Session::get('cart', []);
        
        return view('pos.index', compact('products', 'customers', 'cart'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        $cart = Session::get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'code' => $product->code,
                'price' => $product->selling_price,
                'quantity' => 1,
            ];
        }
        
        Session::put('cart', $cart);
        
        return response()->json(['cart' => $cart, 'count' => count($cart)]);
    }

    public function updateCart(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }
        
        return response()->json(['cart' => $cart]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = Session::get('cart', []);
        
        unset($cart[$request->product_id]);
        
        Session::put('cart', $cart);
        
        return response()->json(['cart' => $cart, 'count' => count($cart)]);
    }

    public function clearCart()
    {
        Session::forget('cart');
        
        return response()->json(['success' => true]);
    }

    public function processOrder(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'payment_method' => 'required',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $vat = $subtotal * 0.15;
        $grandTotal = $subtotal + $vat;
        $paidAmount = $request->paid_amount;
        $dueAmount = $grandTotal - $paidAmount;

        $invoiceNo = 'INV-' . Str::upper(Str::random(8));

        $order = Order::create([
            'invoice_no' => $invoiceNo,
            'customer_id' => $request->customer_id,
            'total_amount' => $subtotal,
            'vat' => $vat,
            'grand_total' => $grandTotal,
            'payment_method' => $request->payment_method,
            'paid_amount' => $paidAmount,
            'due_amount' => $dueAmount > 0 ? $dueAmount : 0,
            'status' => $dueAmount > 0 ? 'pending' : 'completed',
            'order_date' => now()->toDateString(),
        ]);

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_cost' => $product->selling_price,
                'total' => $item['price'] * $item['quantity'],
            ]);

            $product->decrement('quantity', $item['quantity']);
        }

        $customer = \App\Models\Customer::find($request->customer_id);
        $customer->increment('total_purchases', $grandTotal);

        Session::forget('cart');

        return redirect()->route('pos.invoice', $order->id)->with('success', 'Order placed successfully!');
    }

    public function invoice($id)
    {
        $order = Order::with(['customer', 'orderItems.product'])->findOrFail($id);
        
        return view('pos.invoice', compact('order'));
    }

    public function searchProducts(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('code', 'like', '%' . $request->search . '%')
            ->where('quantity', '>', 0)
            ->get();

        return response()->json($products);
    }
}