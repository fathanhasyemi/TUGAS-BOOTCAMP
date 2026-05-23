<!-- HALAMAN PRODUK -->


@extends('app')

@section('content')
    <h1 style="color: #333; margin-bottom: 20px;">Daftar Produk Kami</h1>

    <div style="display: flex; gap: 20px;">
        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 5px; width: 200px;">
            <h3>Sepatu Keren</h3>
            <p style="color: #e44d26; font-weight: bold;">Rp 150.000</p>
            <button style="width: 100%; background: #007bff; color: white; border: none; padding: 5px; border-radius: 3px;">Beli</button>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 5px; width: 200px;">
            <h3>Baju Kece</h3>
            <p style="color: #e44d26; font-weight: bold;">Rp 85.000</p>
            <button style="width: 100%; background: #007bff; color: white; border: none; padding: 5px; border-radius: 3px;">Beli</button>
        </div>
    </div>
@endsection