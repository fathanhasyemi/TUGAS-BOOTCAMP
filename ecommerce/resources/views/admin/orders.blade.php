<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#F9FAFB] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Wrapper Utama Kontainer --}}
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-[0_1px_3px_0_rgba(0,0,0,0.05),0_1px_2px_0_rgba(0,0,0,0.03)] overflow-hidden">
                
                {{-- Header Bagian Dalam --}}
                <div class="p-6 sm:p-8 border-b border-gray-100 bg-white">
                    <h2 class="text-xl font-bold text-gray-900 tracking-tight">Daftar Pesanan Masuk</h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Pantau rincian transaksi, kuantitas produk, dan perbarui status pengiriman secara real-time.</p>
                </div>

                {{-- Alert Sukses Premium --}}
                @if(session('success'))
                    <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-800 flex items-center gap-3 text-sm font-medium shadow-sm">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-base"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Kontainer Tabel Full-Width --}}
                <div class="p-6 sm:p-8">
                    <div class="overflow-x-auto border border-gray-100 rounded-xl">
                        <table class="w-full text-left border-collapse table-auto text-sm">
                            <thead>
                                <tr class="bg-gray-50/70 border-b border-gray-100">
                                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">No. Order</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Qty</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Total Transaksi</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider pr-10">Aksi Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 font-medium">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                        {{-- No. Order Monospace --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-mono text-xs font-semibold bg-gray-100 text-gray-700 px-2.5 py-1.5 rounded-md border border-gray-200 shadow-sm">
                                                {{ $order->order_number }}
                                            </span>
                                        </td>
                                        
                                        {{-- Customer --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-semibold">
                                            {{ $order->name }}
                                        </td>
                                        
                                        {{-- Nama Produk --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 max-w-xs truncate">
                                            {{ $order->product->name ?? '-' }}
                                        </td>
                                        
                                        {{-- Kuantitas --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900 font-semibold">
                                            {{ $order->quantity }}
                                        </td>
                                        
                                        {{-- Total Belanja --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-indigo-600 font-bold">
                                            Rp{{ number_format($order->total, 0, ',', '.') }}
                                        </td>
                                        
                                        {{-- Kolom Aksi Status di Kanan Sempurna --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right pr-10">
                                            @php
                                                $badgeStyles = [
                                                    'pending' => 'bg-amber-50 border-amber-200 text-amber-800 focus:ring-amber-400',
                                                    'processing' => 'bg-blue-50 border-blue-200 text-blue-800 focus:ring-blue-400',
                                                    'shipped' => 'bg-indigo-50 border-indigo-200 text-indigo-800 focus:ring-indigo-400',
                                                    'delivered' => 'bg-emerald-50 border-emerald-200 text-emerald-800 focus:ring-emerald-400',
                                                    'cancelled' => 'bg-rose-50 border-rose-200 text-rose-800 focus:ring-rose-400',
                                                ][$order->status] ?? 'bg-gray-50 border-gray-200 text-gray-800 focus:ring-gray-400';
                                            @endphp

                                            <div class="inline-block text-left">
                                                <form action="{{ url('/admin/orders/' . $order->id . '/status') }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" onchange="this.form.submit()" 
                                                            class="text-xs font-bold uppercase tracking-wide rounded-lg border px-3 py-2 cursor-pointer shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-1 transition-all duration-200 pr-8 {{ $badgeStyles }}">
                                                        @foreach(['pending','processing','shipped','delivered','cancelled'] as $status)
                                                            <option value="{{ $status }}" class="bg-white text-gray-800 normal-case font-medium" {{ $order->status == $status ? 'selected' : '' }}>
                                                                {{ ucfirst($status) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                                            <div class="flex flex-col items-center justify-center gap-3">
                                                <i class="fa-regular fa-folder-open text-4xl text-gray-300"></i>
                                                <span class="text-sm font-medium text-gray-500">Belum ada data pesanan masuk.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</x-app-layout>