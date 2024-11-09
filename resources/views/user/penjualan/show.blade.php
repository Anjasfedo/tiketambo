@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Detail Penjualan Tiket</h1>

        <div class="bg-white p-6 rounded shadow-md">
            <p><strong>Nomor Pesanan:</strong> {{ $penjualan->nomor_pesanan }}</p>
            <p><strong>Nama Tiket:</strong> {{ $penjualan->tiket->nama }}</p>

            @if ($penjualan->is_resale)
                <p><strong>Jenis Penjualan:</strong> Resale</p>
            @else
                <p><strong>Jenis Penjualan:</strong> Original</p>
            @endif

            @php
                // Determine total price based on resale status
                $jumlah_tiket = $penjualan->pembayaran->jumlah_tiket ?? 1;

                // For resale, use the resale payment amount directly
                $total_harga = $penjualan->pembayaran->jumlah_bayar;

                // Calculate the per-ticket price
                $harga_per_tiket = $total_harga / $jumlah_tiket;
            @endphp

            <p><strong>Harga per Tiket:</strong> {{ number_format($harga_per_tiket, 2) }}</p>
            <p><strong>Jumlah Tiket:</strong> {{ $jumlah_tiket }}</p>
            <p><strong>Total Harga:</strong> {{ number_format($total_harga, 2) }}</p>

            @if ($penjualan->status === 'completed' && $penjualan->pembayaran)
                <!-- Completed Payment Details -->
                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($penjualan->pembayaran->metode_pembayaran) }}</p>
                <p><strong>Tanggal Pembayaran:</strong> {{ $penjualan->pembayaran->tanggal_pembayaran }}</p>
                <p class="text-green-500 font-semibold">Pembayaran berhasil diselesaikan.</p>
            @elseif($penjualan->status === 'pending')
                <!-- Pending Payment Details -->
                <p class="text-red-500"><strong>Pembayaran belum dilakukan.</strong></p>
                <a href="{{ route('pembayaran.checkout', $penjualan->id) }}"
                    class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Proceed to Payment
                </a>
            @else
                <!-- Any other status (e.g., canceled) -->
                <p class="text-gray-500"><strong>Status:</strong> {{ ucfirst($penjualan->status) }}</p>
            @endif

            <p><strong>Status:</strong> {{ ucfirst($penjualan->status) }}</p>
            <p><strong>Tanggal Pemesanan:</strong> {{ $penjualan->tanggal_pemesanan }}</p>

            <div class="mt-4">
                <a href="{{ route('dashboard') }}"
                    class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
