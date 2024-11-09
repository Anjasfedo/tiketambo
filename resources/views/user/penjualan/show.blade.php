@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Detail Penjualan Tiket</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>Nomor Pesanan:</strong> {{ $penjualan->nomor_pesanan }}</p>
        <p><strong>Nama Tiket:</strong> {{ $penjualan->tiket->nama }}</p>
        <p><strong>Harga Tiket:</strong> {{ number_format($penjualan->tiket->harga_tiket, 2) }}</p>

        <!-- Display jumlah_tiket from Pembayaran -->
        @if($penjualan->pembayaran)
            <p><strong>Jumlah Tiket:</strong> {{ $penjualan->pembayaran->jumlah_tiket }}</p>
            <p><strong>Total Harga:</strong> {{ number_format($penjualan->pembayaran->jumlah_bayar, 2) }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($penjualan->pembayaran->metode_pembayaran) }}</p>
            <p><strong>Tanggal Pembayaran:</strong> {{ $penjualan->pembayaran->tanggal_pembayaran }}</p>
        @else
            <p class="text-red-500"><strong>Pembayaran belum tersedia.</strong></p>
        @endif

        <p><strong>Status:</strong> {{ ucfirst($penjualan->status) }}</p>
        <p><strong>Tanggal Pemesanan:</strong> {{ $penjualan->tanggal_pemesanan }}</p>

        <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali ke Dashboard
            </a>

            <a href="{{ route('penjualan.create', $penjualan->tiket->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                Beli Lagi
            </a>
        </div>
    </div>
</div>
@endsection
