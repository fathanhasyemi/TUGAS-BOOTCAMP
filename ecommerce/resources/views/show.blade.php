@extends('components.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div style="background-color: #F9FAFB; padding: 60px 20px; font-family: 'Inter', sans-serif; min-height: 100vh;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="margin-bottom: 32px;">
            <a href="{{ url('/products') }}" style="text-decoration: none; color: #6B7280; font-weight: 500; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 8px; transition: color 0.2s;" onmouseover="this.style.color='#4F46E5'" onmouseout="this.style.color='#6B7280'">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog
            </a>
        </div>

        <div class="detail-grid-container">
            
            <div class="detail-img-container">
                {{-- 🛠️ FIX-GAMBAR: Menyesuaikan logika pengecekan path gambar sesuai katalog utama --}}
                @if($product->image && str_contains($product->image, 'uploads/'))
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="detail-product-img">
                @elseif($product->image && (str_contains($product->image, 'gambar-') || file_exists(public_path('images/' . $product->image))))
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="detail-product-img">
                @elseif($product->image)
                    {{-- Cadangan jika nama file langsung tersimpan tanpa prefix gambar- --}}
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="detail-product-img">
                @else
                    <div style="width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #F3F4F6; color: #9CA3AF; gap: 12px;">
                        <i class="fa-regular fa-image" style="font-size: 3rem; opacity: 0.7;"></i>
                        <span style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Tidak ada foto produk</span>
                    </div>
                @endif
            </div>

            <div style="display: flex; flex-direction: column; justify-content: space-between; padding: 10px 0;">
                <div>
                    <span class="category-badge">
                        {{ $product->category->name ?? 'Umum' }}
                    </span>
                    
                    <h1 class="product-detail-title">{{ $product->name }}</h1>
                    
                    <div class="product-detail-price">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </div>
                    
                    <hr style="border: 0; border-top: 1px solid #E5E7EB; margin: 24px 0;">
                    
                    <h5 style="font-size: 1rem; font-weight: 700; color: #111827; margin-bottom: 12px;">Deskripsi Produk</h5>
                    <p class="product-detail-desc">
                        {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini. Produk berkualitas tinggi yang siap memenuhi kebutuhan gaya hidup harian Anda.' }}
                    </p>
                </div>

                <div style="margin-top: 40px;">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-add-to-cart-premium">
                            <i class="fa-solid fa-bag-shopping"></i> Tambah ke Keranjang Belanja
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Pengganti Row Grid Bootstrap agar Tampilan Sempurna & Responsif */
    .detail-grid-container {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 48px;
        background-color: white;
        border-radius: 24px;
        border: 1px solid #E5E7EB;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        padding: 40px;
    }

    /* Container Foto */
    .detail-img-container {
        width: 100%;
        height: 500px;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #E5E7EB;
        background-color: #FAFAFA;
    }
    .detail-product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .detail-img-container:hover .detail-product-img {
        transform: scale(1.04);
    }

    /* Badge Kategori */
    .category-badge {
        display: inline-block;
        padding: 6px 16px;
        background-color: #EEF2FF;
        color: #4F46E5;
        font-size: 0.75rem;
        font-weight: 700;
        border-radius: 9999px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.05);
    }

    /* Tipografi */
    .product-detail-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #111827;
        line-height: 1.2;
        margin-bottom: 18px;
        letter-spacing: -0.03em;
    }
    .product-detail-price {
        font-size: 2rem;
        font-weight: 800;
        color: #4F46E5;
        letter-spacing: -0.02em;
    }
    .product-detail-desc {
        font-size: 0.975rem;
        color: #4B5563;
        line-height: 1.7;
    }

    /* Tombol Keranjang Premium */
    .btn-add-to-cart-premium {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background-color: #111827;
        color: white;
        width: 100%;
        padding: 16px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .btn-add-to-cart-premium:hover {
        background-color: #4F46E5;
        box-shadow: 0 10px 20px -3px rgba(79, 70, 229, 0.3);
        transform: translateY(-1px);
    }

    /* Responsif Layar HP / Tablet Kecil */
    @media (max-width: 768px) {
        .detail-grid-container {
            grid-template-columns: 1fr;
            gap: 32px;
            padding: 24px;
        }
        .detail-img-container {
            height: 350px;
        }
        .product-detail-title {
            font-size: 2rem;
        }
    }
</style>
@endsection