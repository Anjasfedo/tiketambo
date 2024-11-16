@extends('layouts.landing')

@section('content')
    <section class="min-h-screen flex flex-col px-4">
        <div class="flex flex-col flex-1 max-w-[1200px] mx-auto w-full">
            @include('partials.header')
            <div class="container mx-auto py-12 px-6">
                <!-- Header -->
                <h1 class="text-3xl font-extrabold text-center text-indigo-600 mb-8">Detail Penjualan Tiket</h1>

                <!-- Sales Details Card -->
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
                    <!-- Order Information -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Informasi Pesanan</h2>
                        {{-- <ul class="space-y-2 text-gray-700">
                            <li><strong>Nomor Pesanan:</strong> {{ $penjualan->nomor_pesanan }}</li>
                            <li><strong>Nama Tiket:</strong> {{ $penjualan->tiket->nama }}</li>
                            <li><strong>Jenis Penjualan:</strong>
                                <span class="{{ $penjualan->is_resale ? 'text-yellow-600' : 'text-green-600' }}">
                                    {{ $penjualan->adalah_resale}}
                                </span>
                            </li>
                        </ul> --}}
                    </div>
                    {{-- @if ($penjualan->is_resale)
                        <p><strong>Jenis Penjualan:</strong> Resale</p>
                    @else
                        <p><strong>Jenis Penjualan:</strong> Original</p>
                    @endif --}}

                    @php
                        // Determine total price based on resale status
                        $jumlah_tiket = $penjualan->pembayaran->jumlah_tiket ?? 1;
                        // For resale, use the resale payment amount directly
                        $total_harga = $penjualan->pembayaran->jumlah_bayar;

                        // Calculate the per-ticket price
                        $harga_per_tiket = $total_harga / $jumlah_tiket;
                    @endphp

                    <!-- Pricing Information -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Detail Harga</h2>
                        <ul class="space-y-2 text-gray-700">
                            <li><strong>Harga per Tiket:</strong> Rp{{ number_format($harga_per_tiket, 2) }}</li>
                            <li><strong>Jumlah Tiket:</strong> {{ $jumlah_tiket }}</li>
                            <li><strong>Total Harga:</strong> Rp{{ number_format($total_harga, 2) }}</li>
                        </ul>
                    </div>

                    <!-- Payment and Status -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Status dan Pembayaran</h2>
                        @if ($penjualan->status === App\Models\Penjualan::STATUS_COMPLETED && $penjualan->pembayaran)
                            <ul class="space-y-2 text-gray-700">
                                <li><strong>Metode Pembayaran:</strong>
                                    {{ ucfirst($penjualan->pembayaran->metode_pembayaran) }}
                                </li>
                                <li><strong>Tanggal Pembayaran:</strong> {{ $penjualan->pembayaran->tanggal_pembayaran }}
                                </li>
                                <li class="text-green-600 font-bold">Pembayaran berhasil diselesaikan.</li>
                            </ul>
                        @elseif ($penjualan->status === App\Models\Penjualan::STATUS_PENDING)
                            <p class="text-red-600 font-semibold">Pembayaran belum dilakukan.</p>
                            <a href="{{ route('pembayaran.checkout', $penjualan->id) }}"
                                class="inline-block mt-4 bg-indigo-500 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                                Lakukan Pembayaran
                            </a>
                        @else
                            <p class="text-gray-500"><strong>Status:</strong> {{ ucfirst($penjualan->status) }}</p>
                        @endif
                    </div>
                    <!-- Additional Info -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Informasi Tambahan</h2>
                        <ul class="space-y-2 text-gray-700">
                            <li><strong>Status Pesanan:</strong> {{ ucfirst($penjualan->status) }}</li>
                            <li><strong>Tanggal Pemesanan:</strong> {{ $penjualan->tanggal_pemesanan }}</li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>


    </section>
@endsection
