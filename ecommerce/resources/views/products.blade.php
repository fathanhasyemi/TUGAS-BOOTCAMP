@extends('components.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div style="background-color: #F9FAFB; padding: 40px 20px; font-family: 'Inter', sans-serif; min-height: 100vh;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div style="text-align: center; margin-bottom: 48px;">
            <span style="background-color: #EEF2FF; color: #4F46E5; padding: 6px 18px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; box-shadow: 0 2px 8px rgba(79, 70, 229, 0.05);">Our Collection</span>
            <h1 style="font-size: 2.75rem; font-weight: 800; color: #111827; letter-spacing: -0.03em; margin-top: 16px; margin-bottom: 12px;">Daftar Produk Kami</h1>
            <p style="font-size: 1.05rem; color: #6B7280; max-width: 520px; margin: 0 auto; line-height: 1.6;">Pilih dan bawa pulang produk favoritmu hari ini dengan penawaran terbaik dan kualitas nomor satu.</p>
        </div>

        <div style="display: flex; justify-content: center; gap: 12px; margin-bottom: 48px; flex-wrap: wrap;">
            <a href="{{ route('products.all') }}" class="filter-btn active">Semua</a>
            <a href="{{ route('products.all', ['category' => 1]) }}" class="filter-btn">Fashion</a>
            <a href="{{ route('products.all', ['category' => 2]) }}" class="filter-btn">Elektronik</a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 32px; margin-bottom: 50px;">
            @foreach($products as $product)
            <div class="product-card">
                
                <div style="background-color: #F3F4F6; position: relative; padding-top: 90%; overflow: hidden;">
                    @if($product->stock <= 5 && $product->stock > 0)
                        <span class="stock-badge">🔥 Stok Menipis</span>
                    @endif
                    
                    @if($product->image)
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="prod-img" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);">
                            <div class="image-overlay"></div>
                        </a>
                    @else
                        <a href="{{ route('products.show', $product->id) }}" style="display: block; width: 100%; height: 100%;">
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #9CA3AF; gap: 10px; background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);">
                                <i class="fa-regular fa-image" style="font-size: 2rem; opacity: 0.7;"></i>
                                <span style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase;">No Image Available</span>
                            </div>
                        </a>
                    @endif
                </div>

                <div style="padding: 24px; display: flex; flex-direction: column; flex-grow: 1; background: white;">
                    <h3 style="font-size: 1.15rem; font-weight: 700; color: #111827; margin-bottom: 12px; line-height: 1.4; min-height: 44px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.2s ease;" class="product-title">
                        <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; color: inherit; display: block;">
                            {{ $product->name }}
                        </a>
                    </h3>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <span style="font-size: 1.35rem; font-weight: 800; color: #4F46E5; letter-spacing: -0.02em;">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        <span style="background-color: #F3F4F6; color: #4B5563; font-size: 0.75rem; font-weight: 700; padding: 4px 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.03);">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>

                    <p style="font-size: 0.875rem; color: #6B7280; line-height: 1.6; margin-bottom: 24px; height: 42px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        {{ $product->description ?? 'Pemilihan bahan terbaik untuk memastikan kenyamanan dan kepuasan maksimal Anda sepanjang hari.' }}
                    </p>

                    <div style="display: flex; gap: 10px; width: 100%; margin-top: auto;">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-detail-prod">
                            <i class="fa-solid fa-eye"></i> Detail
                        </a>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="flex: 1;">
                            @csrf
                            <button type="submit" class="btn-add-cart">
                                <i class="fa-solid fa-bag-shopping"></i> + Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrapper" style="display: flex; justify-content: center; margin-top: 48px;">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

<style>
    /* Tombol Filter Kategori */
    .filter-btn {
        background-color: white; 
        color: #4B5563; 
        padding: 10px 26px; 
        border-radius: 9999px; 
        font-weight: 600; 
        font-size: 0.875rem; 
        text-decoration: none; 
        border: 1px solid #E5E7EB; 
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .filter-btn:hover {
        background-color: #F9FAFB;
        color: #111827;
        border-color: #C5C5C5;
        transform: translateY(-1px);
    }
    .filter-btn.active {
        background-color: #4F46E5; 
        color: white; 
        border-color: #4F46E5;
        box-shadow: 0 4px 14 rgba(79, 70, 229, 0.3);
    }

    /* Kartu Produk Premium */
    .product-card {
        background-color: white; 
        border-radius: 24px; 
        overflow: hidden; 
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 2px 4px -1px rgba(0,0,0,0.01); 
        border: 1px solid #E5E7EB; 
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 32px -8px rgba(0, 0, 0, 0.06), 0 10px 14px -6px rgba(0, 0, 0, 0.02);
        border-color: #C7D2FE;
    }
    
    /* Animasi Gambar Zoom */
    .product-card:hover .prod-img {
        transform: scale(1.08);
    }
    .product-card:hover .product-title {
        color: #4F46E5;
    }

    /* Lapisan Overlay Halus di Atas Gambar */
    .image-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 60%, rgba(0,0,0,0.02) 100%);
        pointer-events: none;
    }

    /* Badge Stok Menipis Glamour */
    .stock-badge {
        position: absolute; 
        top: 14px; 
        left: 14px; 
        background: linear-gradient(135deg, #EF4444 0%, #F59E0B 100%); 
        color: white; 
        font-size: 0.7rem; 
        font-weight: 700; 
        padding: 5px 12px; 
        border-radius: 8px; 
        z-index: 10; 
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.25);
    }

    /* UPDATE: Style Tombol Detail Produk Premium */
    .btn-detail-prod {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-color: #F3F4F6; 
        color: #4B5563; 
        padding: 14px; 
        border-radius: 14px; 
        font-weight: 600; 
        font-size: 0.875rem; 
        text-decoration: none;
        border: 1px solid #E5E7EB;
        transition: all 0.25s ease;
    }
    .btn-detail-prod:hover {
        background-color: #E5E7EB;
        color: #111827;
        border-color: #D1D5DB;
        transform: translateY(-1px);
    }

    /* Tombol Belanja Modern */
    .btn-add-cart {
        width: 100%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-color: #111827; 
        color: white; 
        padding: 14px; 
        border-radius: 14px; 
        font-weight: 600; 
        font-size: 0.875rem; 
        text-decoration: none; 
        transition: all 0.25s ease;
    }
    .btn-add-cart i {
        transition: transform 0.2s ease;
    }
    .btn-add-cart:hover {
        background-color: #4F46E5;
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35);
        color: white;
    }
    .btn-add-cart:hover i {
        transform: scale(1.15);
    }

    /* Kustomisasi Pagination */
    .pagination-wrapper .pagination {
        gap: 6px;
    }
    .pagination-wrapper .page-item .page-link {
        border-radius: 12px !important;
        color: #4B5563;
        border: 1px solid #E5E7EB;
        padding: 12px 18px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .pagination-wrapper .page-item .page-link:hover {
        background-color: #F3F4F6;
        border-color: #D1D5DB;
        color: #111827;
    }
    .pagination-wrapper .page-item.active .page-link {
        background-color: #4F46E5 !important;
        border-color: #4F46E5 !important;
        color: white !important;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
    }
</style>
@endsection