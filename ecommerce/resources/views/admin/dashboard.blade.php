<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="py-6 sm:py-12 px-3 sm:px-0" style="background-color: #F9FAFB; min-height: 100vh; font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            
            <div style="margin-bottom: 24px;">
                <h1 style="font-size: clamp(1.5rem, 3vw, 2.25rem); font-weight: 800; color: #111827; letter-spacing: -0.03em; margin: 0 0 8px 0;">Dashboard Admin</h1>
                <p style="font-size: 0.92rem; color: #6B7280; margin: 0; line-height: 1.6;">Selamat datang kembali! Berikut adalah ringkasan performa dan data statistik Toko Kita hari ini.</p>
            </div>

            <div class="stats-grid">
                
                <div class="stat-card">
                    <div class="stat-icon-wrapper" style="background-color: #EEF2FF; color: #4F46E5;">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Produk</div>
                        <div class="stat-value">{{ $totalProducts }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper" style="background-color: #F5F3FF; color: #7C3AED;">
                        <i class="fa-solid fa-mouse-pointer"></i>
                    </div>
                    <div>
                        <div class="stat-label">Jumlah Klik</div>
                        <div class="stat-value">{{ $totalClicks }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper" style="background-color: #ECFDF5; color: #10B981;">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Kategori</div>
                        <div class="stat-value">{{ $totalCategories }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper" style="background-color: #FFF7ED; color: #F97316;">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Pengguna</div>
                        <div class="stat-value">{{ $totalUsers }}</div>
                    </div>
                </div>

            </div>

            <div class="quick-panel" style="margin-top: 36px; background-color: white; border-radius: 20px; border: 1px solid #E5E7EB; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: #111827; margin: 0 0 16px 0;">Akses Cepat Manajemen</h3>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <a href="{{ route('products.all') }}" class="action-link">
                        <i class="fa-solid fa-store"></i> Lihat Katalog Toko
                    </a>
                    <a href="{{ url('/dashboard/products') }}" class="action-link" style="background-color: #111827; color: white; border-color: #111827;">
                        <i class="fa-solid fa-sliders"></i> Kelola Tabel Produk
                    </a>
                </div>
            </div>

        </div>
    </div>

    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
        }
        .stat-card {
            background-color: white;
            border: 1px solid #E5E7EB;
            border-radius: 20px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.01), 0 2px 4px -1px rgba(0,0,0,0.01);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.05);
        }
        .stat-icon-wrapper {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }
        .stat-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #6B7280;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #111827;
            line-height: 1;
        }
        .action-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #4B5563;
            font-weight: 600;
            font-size: 0.925rem;
            padding: 12px 24px;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            background-color: white;
            transition: all 0.2s ease;
        }
        .action-link:hover {
            background-color: #F9FAFB;
            border-color: #D1D5DB;
            color: #111827;
            transform: translateY(-1px);
        }
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 768px) {
            .stat-card {
                padding: 18px;
            }
            .quick-panel {
                padding: 20px;
            }
            .action-link {
                width: 100%;
                justify-content: center;
            }
        }
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }
            .stat-card {
                align-items: flex-start;
            }
            .stat-icon-wrapper {
                width: 46px;
                height: 46px;
                font-size: 1.15rem;
            }
            .stat-value {
                font-size: 1.45rem;
            }
        }
    </style>
</x-app-layout>