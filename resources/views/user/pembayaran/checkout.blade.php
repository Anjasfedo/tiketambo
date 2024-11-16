@extends('layouts.landing')

@section('content')
    <section class="min-h-screen flex flex-col px-4">
        <div class="flex flex-col flex-1 max-w-[1200px] mx-auto w-full">
            @include('partials.header')
            <div class="container mx-auto py-12 px-6">
                <!-- Page Header -->
                <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">Checkout Tiket</h1>

                <!-- Checkout Details Card -->
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
                    <!-- Order Information -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Pesanan</h2>
                        <ul class="space-y-2 text-gray-700">
                            <li><strong>Nomor Pesanan:</strong> {{ $penjualan->nomor_pesanan }}</li>
                            <li><strong>Nama Tiket:</strong> {{ $penjualan->tiket->nama }}</li>
                        </ul>
                    </div>

                    <!-- Pricing Information -->
                    @php
                        $jumlah_tiket = $penjualan->pembayaran->jumlah_tiket ?? 1;
                        $total_harga =
                            $penjualan->pembayaran->jumlah_bayar ?? $penjualan->tiket->harga_tiket * $jumlah_tiket;
                        $harga_per_tiket = $total_harga / $jumlah_tiket;
                    @endphp

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Harga</h2>
                        <ul class="space-y-2 text-gray-700">
                            <li><strong>Harga per Tiket:</strong> Rp{{ number_format($harga_per_tiket, 2) }}</li>
                            <li><strong>Jumlah Tiket:</strong> {{ $jumlah_tiket }}</li>
                            <li><strong>Total Harga:</strong> Rp{{ number_format($total_harga, 2) }}</li>
                        </ul>
                    </div>

                    <!-- Payment Form -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Konfirmasi Pembayaran</h2>
                        <p class="text-gray-600 mb-6">
                            Harap pastikan semua informasi benar sebelum melanjutkan pembayaran.
                        </p>
                        <form action="{{ route('pembayaran.process', $penjualan->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full !bg-green-500 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition duration-200">
                                Konfirmasi Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
