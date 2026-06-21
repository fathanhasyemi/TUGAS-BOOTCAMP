<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Manajemen Pesanan</h2>

                    @if(session('success'))
                        <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left p-2">Order</th>
                                    <th class="text-left p-2">Customer</th>
                                    <th class="text-left p-2">Produk</th>
                                    <th class="text-left p-2">Qty</th>
                                    <th class="text-left p-2">Total</th>
                                    <th class="text-left p-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="border-b">
                                        <td class="p-2">{{ $order->order_number }}</td>
                                        <td class="p-2">{{ $order->name }}</td>
                                        <td class="p-2">{{ $order->product->name ?? '-' }}</td>
                                        <td class="p-2">{{ $order->quantity }}</td>
                                        <td class="p-2">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td class="p-2">
                                            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1">
                                                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $status)
                                                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>