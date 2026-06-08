<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0;">Manajemen Kategori</h3>
                        <p style="font-size: 0.875rem; color: #6B7280; margin: 0;">Daftar pengelompokan jenis barang toko online.</p>
                    </div>
                    <button style="background-color: #4F46E5; color: white; padding: 8px 16px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                        + Tambah Kategori
                    </button>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr style="background-color: #F9FAFB; border-bottom: 2px solid #E5E7EB;">
                                <th style="padding: 12px; width: 15%; color: #374151; font-weight: 600;">ID</th>
                                <th style="padding: 12px; width: 50%; color: #374151; font-weight: 600;">Nama Kategori</th>
                                <th style="padding: 12px; width: 20%; color: #374151; font-weight: 600;">Jumlah Produk</th>
                                <th style="padding: 12px; width: 15%; text-align: center; color: #374151; font-weight: 600;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr style="border-bottom: 1px solid #E5E7EB;">
                                    <td style="padding: 12px; font-weight: bold; color: #4B5563;">#{{ $category->id }}</td>
                                    <td style="padding: 12px; font-weight: 600; color: #111827;">{{ $category->name }}</td>
                                    <td style="padding: 12px;">
                                        <span style="background-color: #F3F4F6; color: #1F2937; padding: 4px 10px; border-radius: 9999px; font-size: 0.85rem; border: 1px solid #E5E7EB;">
                                            {{ $category->products_count }} Item
                                        </span>
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        <button style="color: #D97706; background: none; border: none; font-weight: 600; margin-right: 10px; cursor: pointer;">Edit</button>
                                        <button style="color: #DC2626; background: none; border: none; font-weight: 600; cursor: pointer;">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding: 24px; text-align: center; color: #9CA3AF;">
                                        Belum ada data kategori.
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