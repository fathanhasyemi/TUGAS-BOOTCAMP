<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products Management') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #F9FAFB;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div style="background-color: #D1FAE5; border-left: 4px solid #10B981; color: #065F46; padding: 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background-color: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); padding: 24px; border: 1px solid #F3F4F6;">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0;">Daftar Produk Toko</h3>
                        <p style="font-size: 0.875rem; color: #6B7280; margin-top: 4px; margin-bottom: 0;">Kelola stok, harga, kategori, dan foto produk jualan Anda.</p>
                    </div>
                    <a href="{{ route('products.create') }}" style="background-color: #10B981; color: white; padding: 10px 18px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 0.875rem; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);">
                        + Add Product
                    </a>
                </div>

                <div style="overflow-x: auto; border: 1px solid #E5E7EB; border-radius: 10px;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.925rem;">
                        <thead>
                            <tr style="background-color: #F9FAFB; border-bottom: 1px solid #E5E7EB;">
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; width: 10%;">Gambar</th>
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; width: 30%;">Nama Produk</th>
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; width: 15%;">Kategori</th>
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; width: 15%;">Harga</th>
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; width: 10%; text-align: center;">Stok</th>
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; text-align: center; width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: white;">
                            @forelse($products as $product)
                                <tr style="border-bottom: 1px solid #F3F4F6;">
                                    <td style="padding: 12px 16px;">
                                        @if($product->image)
                                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #E5E7EB;">
                                        @else
                                            <div style="width: 50px; height: 50px; background-color: #E5E7EB; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #6B7280; font-weight: 600;">No Pic</div>
                                        @endif
                                    </td>
                                    
                                    <td style="padding: 16px; color: #111827; font-weight: 600;">
                                        {{ $product->name }}
                                    </td>
                                    
                                    <td style="padding: 16px; color: #4B5563;">
                                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                                    </td>
                                    
                                    <td style="padding: 16px; color: #111827; font-weight: 600;">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    
                                    <td style="padding: 16px; text-align: center; color: #4B5563;">
                                        {{ $product->stock }}
                                    </td>
                                    
                                    <td style="padding: 16px; text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                            
                                            <a href="{{ route('products.edit', $product->id) }}" 
                                               style="background-color: #F59E0B; color: white; padding: 6px 14px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; text-decoration: none; display: inline-block; transition: 0.2s;">
                                                Edit
                                            </a>
                                            
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }} ini, bro?');" 
                                                  style="margin: 0; display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        style="background-color: #EF4444; color: white; padding: 6px 14px; border: none; border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: 0.2s;">
                                                    Delete
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 32px; text-align: center; color: #9CA3AF;">
                                        Belum ada data produk jualan yang terdaftar.
                                    </td>
                                endtr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>