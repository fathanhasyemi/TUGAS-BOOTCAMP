@extends('components.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div style="background-color: #F9FAFB; padding: 24px 10px 40px; font-family: 'Inter', sans-serif;">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        
        <div style="background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%); border-radius: 24px; padding: 48px 20px; text-align: center; box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.08); border: 1px solid rgba(255, 255, 255, 0.6); position: relative; overflow: hidden; margin-bottom: 40px;">
            
            <div style="position: absolute; top: -20%; left: -10%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, rgba(255,255,255,0) 70%); pointer-events: none;"></div>
            <div style="position: absolute; bottom: -20%; right: -10%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(16,185,129,0.1) 0%, rgba(255,255,255,0) 70%); pointer-events: none;"></div>

            <div style="display: inline-flex; align-items: center; gap: 6px; background-color: #D1FAE5; color: #065F46; padding: 6px 16px; border-radius: 9999px; font-size: 0.813rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 24px; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.05);">
                🚚 Promo Gratis Ongkir Se-Indonesia
            </div>

            <h1 style="font-size: clamp(1.8rem, 4vw, 3.2rem); font-weight: 800; color: #111827; letter-spacing: -0.03em; line-height: 1.15; max-width: 800px; margin: 0 auto;">
                Selamat Datang di <span style="background: linear-gradient(to right, #4F46E5, #06B6D4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Toko Kita</span>
            </h1>

            <p style="font-size: 0.98rem; color: #4B5563; line-height: 1.75; margin-top: 16px; margin-bottom: 28px; max-width: 600px; margin-left: auto; margin-right: auto; font-weight: 400;">
                Temukan koleksi produk terbaik pilihan kami dengan jaminan kualitas nomor satu dan penawaran harga yang paling bersahabat.
            </p>

            <div style="display: flex; gap: 12px; justify-content: center; align-items: center; flex-wrap: wrap;">
                <a href="{{ url('products') }}" class="btn-primary-hero">
                    Mulai Belanja <i class="fa-solid fa-arrow-right" style="font-size: 0.85rem;"></i>
                </a>
                <a href="#kategori" class="btn-secondary-hero">
                    Lihat Kategori
                </a>
            </div>
        </div>


        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 48px;">
            
            <div class="feature-card">
                <div class="icon-box" style="background-color: #EEF2FF; color: #4F46E5;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3 style="font-size: 1.1rem; font-weight: 700; color: #111827; margin-bottom: 8px;">Garansi Kualitas</h3>
                <p style="font-size: 0.875rem; color: #6B7280; line-height: 1.5; margin: 0;">Semua produk dijamin 100% original dan lolos pengecekan kualitas ketat.</p>
            </div>

            <div class="feature-card">
                <div class="icon-box" style="background-color: #ECFDF5; color: #10B981;">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h3 style="font-size: 1.1rem; font-weight: 700; color: #111827; margin-bottom: 8px;">Proses Kilat</h3>
                <p style="font-size: 0.875rem; color: #6B7280; line-height: 1.5; margin: 0;">Pesanan dikemas rapi dan dikirim di hari yang sama sebelum jam 4 sore.</p>
            </div>

            <div class="feature-card">
                <div class="icon-box" style="background-color: #FFFBEB; color: #F59E0B;">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 style="font-size: 1.1rem; font-weight: 700; color: #111827; margin-bottom: 8px;">Layanan 24/7</h3>
                <p style="font-size: 0.875rem; color: #6B7280; line-height: 1.5; margin: 0;">Customer service ramah kami siap melayani pertanyaanmu kapan saja.</p>
            </div>

        </div>


        <div id="kategori" style="margin-bottom: 40px;">
            <div style="text-align: center; margin-bottom: 24px;">
                <h2 style="font-size: clamp(1.4rem, 2.8vw, 2rem); font-weight: 800; color: #111827; letter-spacing: -0.02em; margin-bottom: 8px;">Jelajahi Kategori</h2>
                <p style="font-size: 0.92rem; color: #6B7280;">Cari kebutuhan spesifikmu melalui kategori produk pilihan kami.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px;">
                
                <a href="{{ url('products') }}" class="category-card">
                    <div class="cat-icon-wrapper" style="background-color: #EFF6FF; color: #3B82F6;">
                        <i class="fa-solid fa-shirt"></i>
                    </div>
                    <span style="font-size: 1rem; font-weight: 600; color: #111827;">Fashion & Pakaian</span>
                </a>

                <a href="{{ url('products') }}" class="category-card">
                    <div class="cat-icon-wrapper" style="background-color: #FDF2F8; color: #EC4899;">
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                    <span style="font-size: 1rem; font-weight: 600; color: #111827;">Gadget & Elektronik</span>
                </a>

                <a href="{{ url('products') }}" class="category-card">
                    <div class="cat-icon-wrapper" style="background-color: #F0FDF4; color: #22C55E;">
                        <i class="fa-solid fa-couch"></i>
                    </div>
                    <span style="font-size: 1rem; font-weight: 600; color: #111827;">Perlengkapan Rumah</span>
                </a>

            </div>
        </div>

    </div>
</div>

<style>
    /* Tombol Utama Hero */
    .btn-primary-hero {
        background-color: #4F46E5; 
        color: white; 
        padding: 14px 36px; 
        border-radius: 12px; 
        font-weight: 600; 
        font-size: 1rem; 
        text-decoration: none; 
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25); 
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-primary-hero:hover {
        background-color: #4338CA;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
        color: white;
    }

    /* Tombol Sekunder Hero */
    .btn-secondary-hero {
        background-color: white; 
        color: #374151; 
        padding: 14px 36px; 
        border-radius: 12px; 
        font-weight: 600; 
        font-size: 1rem; 
        text-decoration: none; 
        border: 1px solid #E5E7EB; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.02); 
        transition: all 0.25s ease;
    }
    .btn-secondary-hero:hover {
        background-color: #F9FAFB;
        border-color: #D1D5DB;
        transform: translateY(-2px);
        color: #111827;
    }

    /* Kartu Fitur Toko */
    .feature-card {
        background-color: white;
        border-radius: 20px;
        padding: 28px;
        border: 1px solid #E5E7EB;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
    }
    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -5px rgba(0,0,0,0.05);
        border-color: #E0E7FF;
    }
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 20px;
    }

    /* Kartu Kategori */
    .category-card {
        background-color: white;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #E5E7EB;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        text-decoration: none !important;
        gap: 16px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .category-card:hover {
        transform: scale(1.03);
        border-color: #4F46E5;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04);
    }
    .cat-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    @media (max-width: 768px) {
        .feature-card,
        .category-card {
            padding: 20px;
        }

        .btn-primary-hero,
        .btn-secondary-hero {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .feature-card,
        .category-card {
            padding: 18px;
        }

        .icon-box,
        .cat-icon-wrapper {
            width: 46px;
            height: 46px;
            font-size: 1.1rem;
        }
    }
</style>
@endsection