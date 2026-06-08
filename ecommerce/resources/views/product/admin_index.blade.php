<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0;">Inventori Produk</h3>
                        <p style="font-size: 0.875rem; color: #6B7280; margin: 0;">Manajemen data stok barang gudang toko.</p>
                    </div>
                    <button style="background-color: #4F46E5; color: white; padding: 8px 16px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                        + Tambah Produk
                    </button>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr style="background-color: #F9FAFB; border-bottom: 2px solid #E5E7EB;">
                                <th style="padding: 12px; width: 10%;">ID</th>
                                <th style="padding: 12px; width: 30%;">Nama Produk</th>
                                <th style="padding: 12px; width: 30%;">Deskripsi</th>
                                <th style="padding: 12px; width: 15%;">Stok</th>
                                <th style="padding: 12px; width: 15%;">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr style="border-bottom: 1px solid #E5E7EB;">
                                    <td style="padding: 12px; font-weight: bold; color: #4B5563;">#{{ $product->id }}</td>
                                    <td style="padding: 12px; font-weight: 600; color: #111827;">
                                        {{ $product->name }}
                                        <br>
                                        <small style="color: #6B7280; font-weight: normal; background-color: #F3F4F6; padding: 2px 6px; border-radius: 4px;">
                                            {{ $product->category->name ?? 'Tanpa Kategori' }}
                                        </small>
                                    </td>
                                    <td style="padding: 12px; color: #4B5563; font-size: 0.9rem;">
                                        {{ \Illuminate\Support\Str::limit($product->description, 40, '...') }}
                                    </td>
                                    <td style="padding: 12px; font-weight: 600;">{{ $product->stock }} Pcs</td>
                                    <td style="padding: 12px; font-weight: bold; color: #4F46E5;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="padding: 24px; text-align: center; color: #9CA3AF;">
                                        Belum ada data produk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>