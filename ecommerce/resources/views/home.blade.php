@extends('app')

@section('content')
<div class="container mt-4">
    <div class="jumbotron text-white rounded bg-dark p-5 mb-5 shadow-sm">
        <h1 class="display-4 font-weight-bold">Selamat Datang di Toko Keren!</h1>
        <p class="lead my-3">Temukan produk-produk terbaik dengan harga terjangkau dan kualitas nomor satu hanya di sini.</p>
        <a href="#produk-section" class="btn btn-success btn-lg mt-2 font-weight-bold">Mulai Belanja...</a>
    </div>

    <div id="produk-section" class="mt-5">
        <h3 class="mb-4 text-center font-weight-bold text-dark">Produk Terbaru Kami</h3>
        <hr class="mb-5" style="width: 100px; border-top: 3px solid #28a745;">
        
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                        <img src="https://via.placeholder.com/300x200?text=Toko+Keren" class="card-img-top" alt="{{ $product->name }}">
                        
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title font-weight-bold text-capitalize text-truncate mb-2">{{ $product->name }}</h5>
                            <p class="card-text text-muted flex-grow-1 text-sm mb-3" style="font-size: 0.9rem;">{{ $product->description }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <span class="text-danger font-weight-bold" style="font-size: 1.15rem;">
                                    Rp{{ number_format($product->harga ?? 0, 0, ',', '.') }}
                                </span>
                                <span class="badge badge-secondary px-2 py-1">Stok: {{ $product->stock }}</span>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top-0 p-4 pt-0">
                            <a href="#" class="btn btn-success btn-block font-weight-bold" style="border-radius: 8px;">
                                Tambah ke Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection