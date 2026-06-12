<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: #F9FAFB; min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div style="background-color: #D1FAE5; border-left: 4px solid #10B981; color: #065F46; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-size: 0.9rem; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.01);">
                    <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
                </div>
            @endif

            <div style="background-color: white; border-radius: 20px; border: 1px solid #E5E7EB; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; flex-wrap: wrap; gap: 16px;">
                    <div>
                        <h3 style="font-size: 1.5rem; font-weight: 800; color: #111827; margin: 0; letter-spacing: -0.02em;">Daftar Produk Toko</h3>
                        <p style="font-size: 0.875rem; color: #6B7280; margin-top: 4px; margin-bottom: 0;">Kelola stok, harga, kategori, dan foto produk jualan Anda secara real-time.</p>
                    </div>
                    <a href="{{ route('products.create') }}" class="btn-add-product-premium">
                        <i class="fa-solid fa-plus"></i> Tambah Produk Baru
                    </a>
                </div>

                <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 24px;">
                    <form action="{{ url('/dashboard/products') }}" method="GET" style="display: flex; gap: 8px; width: 100%; max-width: 420px; margin: 0;">
                        <div style="position: relative; width: 100%;">
                            <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9CA3AF; font-size: 0.9rem;"></i>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau deskripsi produk..." style="width: 100%; border: 1px solid #E5E7EB; border-radius: 10px; padding: 10px 14px 10px 40px; color: #111827; font-size: 0.875rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#4F46E5'" onblur="this.style.borderColor='#E5E7EB'">
                        </div>
                        <button type="submit" style="background-color: #111827; color: white; padding: 10px 24px; border: none; border-radius: 10px; font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#4F46E5'" onmouseout="this.style.backgroundColor='#111827'">
                            Cari
                        </button>
                    </form>
                </div>

                <div style="overflow-x: auto; border: 1px solid #E5E7EB; border-radius: 14px; background-color: white;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                        <thead>
                            <tr style="background-color: #F9FAFB; border-bottom: 1px solid #E5E7EB;">
                                <th style="padding: 16px; color: #4B5563; font-weight: 700; width: 12%;">Gambar</th>
                                <th style="padding: 16px; color: #4B5563; font-weight: 700; width: 23%;">Nama Produk</th>
                                <th style="padding: 16px; color: #4B5563; font-weight: 700; width: 15%;">Kategori</th>
                                <th style="padding: 16px; color: #4B5563; font-weight: 700; width: 20%;">Deskripsi</th> 
                                <th style="padding: 16px; color: #4B5563; font-weight: 700; width: 15%;">Harga</th>
                                <th style="padding: 16px; color: #4B5563; font-weight: 700; width: 5%; text-align: center;">Stok</th>
                                <th style="padding: 16px; color: #4B5563; font-weight: 700; text-align: center; width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr style="border-bottom: 1px solid #F3F4F6;" class="table-row-hover">
                                    <td style="padding: 16px;">
                                        @if($product->image)
                                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 52px; height: 52px; object-fit: cover; border-radius: 10px; border: 1px solid #E5E7EB;">
                                        @else
                                            <div style="width: 52px; height: 52px; background-color: #F3F4F6; border-radius: 10px; display: flex; flex-direction: column; align-items: center; justify-content: center; font-size: 0.65rem; color: #9CA3AF; font-weight: 700; border: 1px dashed #D1D5DB;">
                                                <i class="fa-regular fa-image" style="font-size: 0.9rem; margin-bottom: 2px;"></i> KOSONG
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <td style="padding: 16px; color: #111827; font-weight: 600;">
                                        {{ $product->name }}
                                    </td>
                                    
                                    <td style="padding: 16px; color: #4B5563;">
                                        <span style="background-color: #F3F4F6; padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; color: #374151;">
                                            {{ $product->category->name ?? 'Umum' }}
                                        </span>
                                    </td>

                                    <td style="padding: 16px; color: #6B7280; font-size: 0.85rem; line-height: 1.5;">
                                        {{ Str::limit($product->description, 40, '...') ?? '-' }}
                                    </td>
                                    
                                    <td style="padding: 16px; color: #4F46E5; font-weight: 700;">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    
                                    <td style="padding: 16px; text-align: center; color: #111827; font-weight: 600;">
                                        {{ $product->stock }}
                                    </td>
                                    
                                    <td style="padding: 16px; text-align: center;">
                                        <div style="display: flex; gap: 6px; justify-content: center; align-items: center;">
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn-action-edit" title="Edit Produk">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }} ini, bro?');" 
                                                  style="margin: 0; display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-delete" title="Hapus Produk">
                                                    <i class="fa-solid fa-trash-can"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="padding: 48px; text-align: center; color: #9CA3AF; font-weight: 500;">
                                        <i class="fa-solid fa-box-open" style="font-size: 2rem; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                                        Belum ada data produk jualan yang terdaftar atau hasil pencarian tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <style>
        .btn-add-product-premium {
            background-color: #10B981;
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
            transition: all 0.2s ease;
        }
        .btn-add-product-premium:hover {
            background-color: #059669;
            box-shadow: 0 6px 16px rgba(5, 150, 105, 0.3);
            color: white;
        }
        .btn-action-edit {
            background-color: #FFFBEB;
            color: #D97706;
            border: 1px solid #FDE68A;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s ease;
        }
        .btn-action-edit:hover {
            background-color: #F59E0B;
            color: white;
            border-color: #F59E0B;
        }
        .btn-action-delete {
            background-color: #FEF2F2;
            color: #DC2626;
            border: 1px solid #FEE2E2;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s ease;
        }
        .btn-action-delete:hover {
            background-color: #EF4444;
            color: white;
            border-color: #EF4444;
        }
        .table-row-hover {
            transition: background-color 0.15s ease;
        }
        .table-row-hover:hover {
            background-color: #F9FAFB;
        }
    </style>
</x-app-layout>