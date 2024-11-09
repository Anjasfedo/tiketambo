@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Checkout Tiket</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>Nomor Pesanan:</strong> {{ $penjualan->nomor_pesanan }}</p>
        <p><strong>Nama Tiket:</strong> {{ $penjualan->tiket->nama }}</p>
        <p><strong>Harga Tiket:</strong> {{ number_format($penjualan->tiket->harga_tiket, 2) }}</p>

        @php
            $jumlah_tiket = $penjualan->pembayaran ? $penjualan->pembayaran->jumlah_tiket : $penjualan->jumlah_tiket;
            $total_harga = $penjualan->tiket->harga_tiket * $jumlah_tiket;
        @endphp

        <p><strong>Jumlah Tiket:</strong> {{ $jumlah_tiket }}</p>
        <p><strong>Total Harga:</strong> {{ number_format($total_harga, 2) }}</p>

        <form action="{{ route('pembayaran.process', $penjualan->id) }}" method="POST" class="mt-6">
            @csrf

            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Konfirmasi Pembayaran
            </button>
        </form>
    </div>
</div>
@endsection
