<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Toko Kita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Toko Kita</a>
            
            <div class="navbar-nav">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
                <a class="nav-link" href="{{ url('/products') }}">Products</a>
                <a class="nav-link" href="{{ url('/cart') }}">Cart</a>
            </div>

            <div class="ms-auto d-flex align-items-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
            </div>
    </nav>

    <div class="container my-5">
        @yield('content')
    </div>

    <footer class="bg-light text-center py-3 mt-auto border-top">
        <p class="mb-0">&copy; 2026 E-commerce Toko Kita. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>