@extends('components.app')

@section('content')
    <div class="jumbtron text-center bg-light p-5 rounded shadow-sm">
        <h1 class="display-4 font-weight-bold">Selamat Datang di Toko Kita</h1>
        <p class="lead mt-3">Temukan produk-produk terbaik dengan harga terjangkau dan kualitas nomor satu hanya di sini.</p>
        <hr class="my-4">
        <p>Mulai belanja sekarang dan nikmati promo gratis ongkir ke seluruh indonesia</p>
        <a class="btn btn-primary btn-lg mt-2" href="{{ url('products') }}" role="button">Mulai Belanja</a>
    </div>
@endsection