<!-- HALAMAN KERANJANG -->
@extends('components.app')

@section('content')
    <h1>Keranjang Belanja Anda</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-bold">Sepatu Sneakers Keren</h6>
                        <small class="text-muted">Jumlah: 10 pcs</small>
                    </div>
                    <span class="fw-bold text-success">Rp 150.000</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm bg-light">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Total Belanja</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span class="fw-bold">Rp 450.000</span>
                    </div>
                    <a href="{{url('/checkout')}}" class="btn btn-warning w-100 fw-bold">Lanjutkan ke Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
@endsection