@extends('components.app')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">Daftar Produk Kami</h2>
        <p class="text-muted">Pilih dan bawa pulang produk favoritmu hari ini.</p>
    </div>
    
    <div class="row">
        @foreach($products as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        @if($item->image)
                            <img src="{{ asset('images/' . $item->image) }}" class="img-fluid rounded mb-3" alt="{{ $item->name }}" style="height: 200px; width: 100%; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/500x300?text=No+Image" class="img-fluid rounded mb-3" alt="No Image">
                        @endif

                        <h5 class="card-title fw-bold">{{ $item->name }}</h5>
                        
                        <p class="text-success fw-bold">Rp {{ number_format($item->stock * 15000, 0, ',', '.') }}</p> 
                        
                        <p class="card-text text-muted">{{ $item->description }}</p>
                        
                        <small class="text-danger d-block mb-3">Sisa Stok: {{ $item->stock }} pcs</small>
                        
                        <a href="{{ url('/cart') }}" class="btn btn-dark w-100">Tambah ke Keranjang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4 mb-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection