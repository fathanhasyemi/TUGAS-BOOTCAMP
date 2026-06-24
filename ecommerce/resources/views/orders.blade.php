@extends('components.app')

@section('content')
<div style="background-color: #F9FAFB; padding: 18px 8px 32px; min-height: 100vh;">
    <div class="container max-w-6xl mx-auto px-2 px-sm-4">
        <h1 style="font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #111827; margin-bottom: 20px;">Riwayat Pesanan</h1>

        @if(session('success'))
            <div style="background-color: #D1FAE5; color: #065F46; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px;">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div style="background: white; border-radius: 18px; padding: 24px; text-align: center; border: 1px solid #E5E7EB;">
                <p style="margin: 0; color: #6B7280;">Belum ada pesanan yang dibuat.</p>
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 16px;">
                @foreach($orders as $order)
                    <div style="background: white; border-radius: 18px; border: 1px solid #E5E7EB; padding: 16px;">
                        <div style="display: flex; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                            <div>
                                <h5 style="font-weight: 700; margin-bottom: 4px;">{{ $order->order_number }}</h5>
                                <p style="margin: 0; color: #6B7280; font-size: 0.9rem;">{{ $order->product->name ?? '-' }}</p>
                            </div>
                            <span style="background: #EEF2FF; color: #4F46E5; padding: 6px 10px; border-radius: 999px; font-size: 0.8rem; font-weight: 700;">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px; color: #4B5563; font-size: 0.9rem; gap: 12px; flex-wrap: wrap;">
                            <span>{{ $order->quantity }} item</span>
                            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                                <span>Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                                <a href="https://wa.me/085752151528?text=Halo%2C%20saya%20ingin%20mengonfirmasi%20pesanan%20{{ urlencode($order->order_number) }}" target="_blank" rel="noopener noreferrer" style="background-color: #25D366; color: white; padding: 8px 12px; border-radius: 999px; text-decoration: none; font-weight: 700; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                                    <i class="fa-brands fa-whatsapp"></i> Konfirmasi WA
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    @media (max-width: 576px) {
        .order-card-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
