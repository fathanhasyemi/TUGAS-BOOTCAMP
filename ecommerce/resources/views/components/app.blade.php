<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Toko Kita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Mengubah seluruh font website menjadi lebih modern & bersih */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
            color: #111827;
        }

        /* Navbar Glassmorphism Transparan */
        .custom-navbar {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.6);
            padding: 1rem 0;
        }

        /* Brand / Logo Toko */
        .navbar-brand-modern {
            font-size: 1.3rem;
            font-weight: 800;
            background: linear-gradient(to right, #4F46E5, #06B6D4);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.03em;
        }

        /* Menu Link */
        .nav-link-modern {
            color: #4B5563 !important;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.2s ease;
            position: relative;
            text-decoration: none;
        }
        .nav-link-modern:hover, .nav-link-modern.active {
            color: #4F46E5 !important;
        }
        .nav-link-modern.active {
            font-weight: 600;
        }

        /* Badge Angka di Menu Cart */
        .cart-badge {
            background-color: #EEF2FF;
            color: #4F46E5;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 9999px;
            margin-left: 4px;
        }

        /* Tombol Utama & Sekunder */
        .btn-dark-modern {
            background-color: #111827;
            color: white;
            border: none;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 8px 20px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        .btn-dark-modern:hover {
            background-color: #4F46E5;
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .btn-light-modern {
            background-color: transparent;
            color: #4B5563;
            border: 1px solid #E5E7EB;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 8px 18px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        .btn-light-modern:hover {
            background-color: #F3F4F6;
            color: #111827;
        }

        /* Footer Modern */
        .footer-modern {
            background-color: white !important;
            border-top: 1px solid #E5E7EB !important;
            color: #6B7280;
            font-size: 0.875rem;
            padding: 24px 0 !important;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    
    <nav class="navbar navbar-expand-lg custom-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand navbar-brand-modern" href="{{ url('/') }}">TokoKita</a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav mx-auto">
                    <a class="nav-link-modern {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    <a class="nav-link-modern {{ Request::is('products') || Request::is('products/*') ? 'active' : '' }}" href="{{ url('/products') }}">Products</a>
                    <a class="nav-link-modern {{ Request::is('cart') ? 'active' : '' }}" href="{{ url('/cart') }}">
                        Cart <span class="cart-badge">0</span>
                    </a>
                </div>

                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="btn-dark-modern text-decoration-none">
                                <i class="fa-solid fa-chart-pie me-1"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-light-modern text-decoration-none">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-dark-modern text-decoration-none">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5 flex-grow-1">
        @yield('content')
    </div>

    <footer class="footer-modern text-center mt-auto">
        <p class="mb-0">&copy; 2026 E-commerce Toko Kita. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>