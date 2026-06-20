<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('product')
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }

    public function adminIndex()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Anda tidak memiliki akses admin.');
        }

        $orders = Order::with(['user', 'product'])
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Anda tidak memiliki akses admin.');
        }

        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string', 'max:500'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);

                if (!$product) {
                    throw new \Exception('Produk tidak ditemukan.');
                }

                if ($item['quantity'] > $product->stock) {
                    throw new \Exception('Stok produk ' . $product->name . ' tidak mencukupi.');
                }

                $total += $item['price'] * $item['quantity'];
            }

            $orderNumber = 'ORD-' . now()->format('YmdHis') . '-' . rand(1000, 9999);

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);

                if (!$product) {
                    throw new \Exception('Produk tidak ditemukan.');
                }

                $product->decrement('stock', $item['quantity']);

                Order::create([
                    'order_number' => $orderNumber,
                    'status' => 'pending',
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
