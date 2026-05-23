<!-- HALAMAN KERANJANG -->


@extends('app')

@section('content')
    <h1 style="color: #333;">Keranjang Belanja Anda</h1>
    <div style="background: white; padding: 20px; border-radius: 5px; border: 1px solid #ddd;">
        <p style="color: #999; text-align: center; padding: 40px 0;">
            Saat ini belum ada produk di dalam keranjang Anda.<br>
            <a href="{{ url('/produk') }}" style="color: #007bff; text-decoration: none;">Yuk mulai belanja!</a>
        </p>
    </div>
@endsection