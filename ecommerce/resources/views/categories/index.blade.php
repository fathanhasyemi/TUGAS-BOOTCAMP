<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Categories Management') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #F9FAFB;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div style="background-color: #D1FAE5; border-left: 4px solid #10B981; color: #065F46; padding: 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    {{ session('success') }}
                </div>
            @endif
            
            <div style="background-color: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); padding: 24px; border: 1px solid #F3F4F6;">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin: 0;">Daftar Kategori Produk</h3>
                        <p style="font-size: 0.875rem; color: #6B7280; margin-top: 4px; margin-bottom: 0;">Kelola pengelompokan jenis barang dan pantau jumlah produk aktif.</p>
                    </div>
                    <a href="{{ route('categories.create') }}" style="background-color: #10B981; color: white; padding: 10px 18px; border-radius: 8px; font-weight: 600; text-decoration: none;">
                        + Add Category
                    </a>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 16px;">
                    <div>
                        <select style="border: 1px solid #E5E7EB; border-radius: 8px; padding: 8px 36px 8px 12px; background-color: white; color: #4B5563; font-size: 0.875rem; font-weight: 500; cursor: pointer; outline: none;">
                            <option>Sort by Default</option>
                            <option>Nama A - Z</option>
                            <option>Jumlah Produk Terbanyak</option>
                        </select>
                    </div>
                    <div style="display: flex; gap: 8px; width: 100%; max-width: 420px;">
                        <input type="text" placeholder="Search categories..." style="width: 100%; border: 1px solid #E5E7EB; border-radius: 8px; padding: 8px 14px; color: #111827; font-size: 0.875rem; outline: none;">
                        <button style="background-color: #4F46E5; color: white; padding: 8px 20px; border: none; border-radius: 8px; font-weight: 600; font-size: 0.875rem; cursor: pointer; box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);">
                            Search
                        </button>
                    </div>
                </div>

                <div style="overflow-x: auto; border: 1px solid #E5E7EB; border-radius: 10px;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.925rem;">
                        <thead>
                            <tr style="background-color: #F9FAFB; border-bottom: 1px solid #E5E7EB;">
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; text-align: center; width: 10%;">ID</th>
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; width: 50%;">Nama Kategori</th>
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; width: 25%; text-align: center;">Jumlah Produk Terkait</th>
                                <th style="padding: 14px 16px; color: #374151; font-weight: 600; text-align: center; width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: white;">
                            @forelse($categories as $category)
                                <tr style="border-bottom: 1px solid #F3F4F6; transition: background-color 0.2s;">
                                    
                                    <td style="padding: 16px; text-align: center; color: #6B7280; font-weight: 600;">
                                        #{{ $category->id }}
                                    </td>
                                    
                                    <td style="padding: 16px; color: #111827; font-weight: 600; font-size: 1rem;">
                                        {{ $category->name }}
                                    </td>
                                    
                                    <td style="padding: 16px; text-align: center;">
                                        <span style="background-color: #EEF2FF; color: #4F46E5; padding: 6px 14px; border-radius: 9999px; font-size: 0.85rem; font-weight: 600; border: 1px solid #E0E7FF;">
                                            {{ $category->products_count ?? 0 }} Items
                                        </span>
                                    </td>
                                    
                                    <td style="padding: 16px; text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                            
                                            <a href="{{ route('categories.edit', $category->id) }}" 
                                            style="background-color: #F59E0B; color: white; padding: 6px 14px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; text-decoration: none; display: inline-block; transition: 0.2s;">
                                                Edit
                                            </a>
                                            
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" 
                                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus kategori ini, bro? All linked products will be affected.');" 
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
                                    <td colspan="4" style="padding: 32px; text-align: center; color: #9CA3AF;">
                                        Belum ada kategori produk yang terdaftar.
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