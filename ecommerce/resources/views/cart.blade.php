@extends('components.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div style="background-color: #F9FAFB; padding: 18px 8px 32px; font-family: 'Inter', sans-serif; min-height: 100vh;">
    <div class="container max-w-7xl mx-auto px-2 px-sm-4">
        
        <div style="margin-bottom: 24px;">
            <h1 style="font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #111827; letter-spacing: -0.025em;">Keranjang Belanja</h1>
            <p style="color: #6B7280; font-size: 0.92rem; margin-top: 4px; line-height: 1.5;">Periksa kembali barang bawaanmu sebelum melakukan pembayaran.</p>
        </div>

        @if(session('success'))
            <div style="background-color: #D1FAE5; border-left: 4px solid #10B981; color: #065F46; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-size: 0.9rem; font-weight: 600;">
                <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background-color: #FEE2E2; border-left: 4px solid #EF4444; color: #991B1B; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-size: 0.9rem; font-weight: 600;">
                <i class="fa-solid fa-circle-exclamation" style="margin-right: 8px;"></i> {{ session('error') }}
            </div>
        @endif

        {{-- 💡 DISESUAIKAN: Cek berdasarkan jumlah data Collection $cartItems dari Database --}}
        @if(isset($cartItems) && $cartItems->count() > 0)
        <div class="row g-4">
            <div class="col-lg-8">
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    
                    @php $total = 0; @endphp
                    {{-- 💡 DISESUAIKAN: Looping data $cartItems hasil query database --}}
                    @foreach($cartItems as $item)
                        {{-- Ambil data produk melalui Eloquent Relation --}}
                        @php 
                            $product = $item->product; 
                            $total += $product->price * $item->quantity;
                        @endphp
                    
                    <div class="cart-card">
                        <div class="cart-img-wrapper">
                            @if($product && $product->image)
                                @php
                                    $imagePath = (strpos($product->image, 'uploads/') === 0)
                                        ? $product->image
                                        : 'images/' . $product->image;
                                @endphp
                                <img src="{{ asset($imagePath) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background-color: #F3F4F6; color: #9CA3AF;">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @endif
                        </div>

                        <div class="cart-details-wrapper">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; flex-wrap: wrap;">
                                <div>
                                    <h3 class="product-title-cart">{{ $product->name ?? 'Produk Tidak Diketahui' }}</h3>
                                    <p style="font-size: 1.1rem; font-weight: 700; color: #4F46E5; margin-top: 4px; margin-bottom: 0;">
                                        Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}
                                    </p>
                                </div>
                                
                                {{-- 💡 DISESUAIKAN: Menggunakan $product->id untuk aksi hapus --}}
                                <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-cart" title="Hapus dari keranjang">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 16px; border-top: 1px solid #F3F4F6; width: 100%; gap: 12px; flex-wrap: wrap;">
                                <span style="font-size: 0.85rem; color: #6B7280; font-weight: 500;">Kuantitas Belanja</span>
                                
                                <div style="display: flex; align-items: center; background-color: #F3F4F6; border-radius: 8px; padding: 2px; gap: 4px;">
                                    {{-- 💡 DISESUAIKAN: Menggunakan $product->id untuk tombol minus --}}
                                    <form action="{{ route('cart.update', $product->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="decrease">
                                        <button type="submit" style="background: white; border: none; border-radius: 6px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; color: #374151; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                                            -
                                        </button>
                                    </form>

                                    <span style="font-size: 0.9rem; font-weight: 700; color: #111827; min-width: 36px; text-align: center; display: inline-block;">
                                        {{ $item->quantity }}
                                    </span>

                                    {{-- 💡 DISESUAIKAN: Menggunakan $product->id untuk tombol plus --}}
                                    <form action="{{ route('cart.update', $product->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="increase">
                                        <button type="submit" style="background: white; border: none; border-radius: 6px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; color: #374151; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                                            +
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card">
                    <h2 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin-bottom: 20px; border-bottom: 1px solid #E5E7EB; padding-bottom: 12px;">Ringkasan Belanja</h2>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem; color: #4B5563;">
                        <span>Total Barang</span>
                        <span style="font-weight: 600; color: #111827;">{{ $cartItems->count() }} Macam</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 24px; font-size: 0.95rem; color: #4B5563;">
                        <span>Pengiriman (Ongkir)</span>
                        <span style="color: #10B981; font-weight: 700; background-color: #ECFDF5; padding: 2px 8px; border-radius: 6px; font-size: 0.8rem;">GRATIS</span>
                    </div>

                    <div style="border-top: 1px dashed #E5E7EB; padding-top: 16px; margin-bottom: 28px; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1rem; font-weight: 700; color: #111827;">Total Harga</span>
                        <span style="font-size: 1.5rem; font-weight: 800; color: #4F46E5; letter-spacing: -0.02em;">
                            Rp{{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <a href="{{ url('/checkout') }}" class="btn-checkout-cart">
                        Lanjutkan ke Pembayaran <i class="fa-solid fa-arrow-right" style="font-size: 0.85rem;"></i>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div style="background-color: white; border-radius: 20px; border: 1px solid #E5E7EB; padding: 40px 16px; text-align: center; max-width: 500px; margin: 24px auto;">
            <div style="width: 72px; height: 72px; background-color: #EEF2FF; color: #4F46E5; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; margin: 0 auto 20px;">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin-bottom: 8px;">Keranjangmu Masih Kosong</h3>
            <p style="color: #6B7280; font-size: 0.9rem; line-height: 1.5; margin-bottom: 24px;">Kamu belum menambahkan produk apapun ke dalam keranjang belanjaanmu.</p>
            <a href="{{ url('/products') }}" class="btn-checkout-cart" style="background-color: #4F46E5;">Lihat Katalog Produk</a>
        </div>
        @endif

    </div>
</div>

<style>
    /* Kartu List Barang Belanja */
    .cart-card {
        background-color: white;
        border-radius: 20px;
        border: 1px solid #E5E7EB;
        padding: 16px;
        display: flex;
        gap: 16px;
        transition: all 0.25s ease;
    }
    .cart-card:hover {
        border-color: #C7D2FE;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.03);
    }
    .cart-img-wrapper {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .cart-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .cart-details-wrapper {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .product-title-cart {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
        line-height: 1.3;
    }

    /* Tombol Hapus Sampah */
    .btn-delete-cart {
        background: transparent;
        border: none;
        color: #9CA3AF;
        font-size: 1.1rem;
        padding: 4px 8px;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    .btn-delete-cart:hover {
        color: #EF4444;
    }

    /* Ringkasan Belanja */
    .summary-card {
        background-color: white;
        border-radius: 20px;
        border: 1px solid #E5E7EB;
        padding: 24px;
        position: sticky;
        top: 100px;
    }

    @media (max-width: 768px) {
        .cart-card {
            flex-direction: column;
            padding: 16px;
        }

        .cart-img-wrapper {
            width: 100%;
            height: 180px;
        }

        .summary-card {
            position: static;
            margin-top: 8px;
            padding: 20px;
        }
    }

    @media (max-width: 576px) {
        .cart-details-wrapper {
            width: 100%;
        }

        .product-title-cart {
            font-size: 1rem;
        }

        .btn-checkout-cart {
            padding: 13px;
            font-size: 0.9rem;
        }
    }
    .btn-checkout-cart {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-color: #111827;
        color: white !important;
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-checkout-cart:hover {
        background-color: #4F46E5;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }
</style>
@endsection