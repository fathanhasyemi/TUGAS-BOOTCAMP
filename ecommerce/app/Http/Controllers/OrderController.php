<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    private function getCartItemsForUser()
    {
        if (!Auth::check()) {
            return collect();
        }

        return Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
    }

    private function generateUniqueOrderNumber(): string
    {
        return 'ORD-' . now()->format('YmdHis') . '-' . Str::upper(Str::substr(Str::uuid()->toString(), 0, 8));
    }

    public function checkout()
    {
        $cartItems = $this->getCartItemsForUser();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $cart = [];
        $total = 0;

        foreach ($cartItems as $item) {
            if (!$item->product) {
                continue;
            }

            $cart[] = [
                'id' => $item->product->id,
                'name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ];

            $total += $item->product->price * $item->quantity;
        }

        return view('checkout', compact('cart', 'total', 'cartItems'));
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

        $previousStatus = $order->status;

        if ($request->status === 'cancelled' && $previousStatus !== 'cancelled') {
            $product = $order->product;

            if ($product) {
                $product->increment('stock', $order->quantity);
            }
        }

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

        $cartItems = $this->getCartItemsForUser();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        DB::beginTransaction();

        try {
            foreach ($cartItems as $item) {
                $product = $item->product;

                if (!$product) {
                    throw new \Exception('Produk tidak ditemukan.');
                }

                if ($item->quantity > $product->stock) {
                    throw new \Exception('Stok produk ' . $product->name . ' tidak mencukupi.');
                }

                $product->decrement('stock', $item->quantity);

                Order::create([
                    'order_number' => $this->generateUniqueOrderNumber(),
                    'status' => 'pending',
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'total' => $product->price * $item->quantity,
                ]);
            }

            DB::commit();
            Cart::where('user_id', Auth::id())->delete();

            return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
