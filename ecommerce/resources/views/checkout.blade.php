@extends('components.app')

@section('content')
<div style="background-color: #F9FAFB; padding: 40px 0; min-height: 100vh;">
    <div class="container max-w-6xl mx-auto px-4">
        <div style="margin-bottom: 24px;">
            <h1 style="font-size: 2rem; font-weight: 800; color: #111827;">Checkout</h1>
            <p style="color: #6B7280; margin-top: 6px;">Lengkapi data pengiriman untuk menyelesaikan pesanan Anda.</p>
        </div>

        @if(session('error'))
            <div style="background-color: #FEE2E2; color: #B91C1C; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div style="background: white; border-radius: 20px; padding: 24px; border: 1px solid #E5E7EB;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 16px;">Data Pembeli</h3>
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100" style="background-color: #111827; border: none; padding: 12px; border-radius: 12px; font-weight: 600;">
                            Konfirmasi Pesanan
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div style="background: white; border-radius: 20px; padding: 24px; border: 1px solid #E5E7EB;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 16px;">Ringkasan Pesanan</h3>
                    @foreach($cart as $item)
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #4B5563;">
                            <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                            <span>Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                    <div style="border-top: 1px solid #E5E7EB; padding-top: 12px; margin-top: 12px; display: flex; justify-content: space-between; font-weight: 700; font-size: 1rem;">
                        <span>Total</span>
                        <span style="color: #4F46E5;">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
