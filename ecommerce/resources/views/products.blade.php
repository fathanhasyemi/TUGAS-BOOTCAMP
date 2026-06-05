@extends('components.app')

@section('content')
<div class="container py-4">
    
    <div class="mb-4 text-center">
        <h2 class="fw-bold">Daftar Produk Kami</h2>
        <p class="text-muted">Pilih dan bawa pulang produk favoritmu hari ini.</p>
    </div>
    
    <div class="mb-5 text-center">
        <a href="{{ route('products.all') }}" class="btn btn-outline-primary me-2 px-4">Semua</a>
        <a href="{{ route('products.all', ['category' => 1]) }}" class="btn btn-outline-primary me-2 px-4">Fashion</a>
        <a href="{{ route('products.all', ['category' => 2]) }}" class="btn btn-outline-primary px-4">Elektronik</a>
    </div>
    
    <div class="row">
        @foreach($products as $item)
            <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="card w-100 shadow-sm border-0 rounded-3 d-flex flex-column">
                    
                    @if($item->image)
                        <img src="{{ asset('images/' . $item->image) }}" class="img-fluid rounded-top" alt="{{ $item->name }}" style="height: 220px; width: 100%; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/500x300?text=No+Image" class="img-fluid rounded-top" alt="No Image" style="height: 220px; width: 100%; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold text-dark mb-1">{{ $item->name }}</h5>
                        
                        <p class="text-success fw-bold fs-5 mb-2">Rp {{ number_format($item->stock * 15000, 0, ',', '.') }}</p> 
                        
                        <p class="card-text text-muted small">
                            {{ Str::limit($item->description, 90, '...') }}
                        </p>
                        
                        <div class="mb-3">
                            <span class="badge bg-light text-danger border border-danger-subtle">Stok: {{ $item->stock }} pcs</span>
                        </div>
                        
                        <a href="{{ url('/cart') }}" class="btn btn-dark w-100 py-2 mt-auto rounded-2">
                            <i class="bi bi-cart-plus me-2"></i>Tambah ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-5 mb-4">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection