@extends('layouts.landing')

@section('content')
    <section class="min-h-screen flex flex-col px-4">
        <div class="flex flex-col flex-1 max-w-[1200px] mx-auto w-full">
            @include('partials.header')

            <div class="py-8">
                <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Pesan Tiket: {{ $tiket->nama }}</h1>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                    <!-- Event and Ticket Information -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Informasi Acara</h2>
                        <ul class="text-gray-700 space-y-2">
                            <li><strong>Nama Acara:</strong> {{ $tiket->acara->nama }}</li>
                            <li><strong>Lokasi:</strong> {{ $tiket->acara->lokasi }}</li>
                            <li><strong>Tanggal:</strong> {{ $tiket->acara->tanggal }}</li>
                            <li><strong>Jam:</strong> {{ $tiket->acara->waktu }}</li>
                        </ul>

                        <h2 class="text-2xl font-semibold mt-6 mb-4 text-gray-800">Informasi Tiket</h2>
                        <ul class="text-gray-700 space-y-2">
                            <li><strong>Harga Tiket:</strong> Rp{{ number_format($tiket->harga, 2) }}</li>
                            <li><strong>Stok Tersedia:</strong> {{ $tiket->stok }}</li>
                        </ul>
                    </div>

                    <!-- Ticket Order Form -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Pesan Tiket</h2>

                        @if ($errors->any())
                            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                                <strong>Terjadi kesalahan pada input:</strong>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('penjualan.store', $tiket->id) }}" method="POST">
                            @csrf

                            <!-- Ticket Quantity -->
                            <div class="mb-4">
                                <label for="jumlah_tiket" class="block text-gray-700 font-medium">Jumlah Tiket</label>
                                <input type="number" name="jumlah_tiket" id="jumlah_tiket"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none text-black"
                                    value="{{ old('jumlah_tiket', 1) }}" min="1" max="{{ $tiket->stok }}"
                                    required>
                                <p class="text-sm text-gray-600 mt-1">Stok tersedia: {{ $tiket->stok }}</p>
                                @error('jumlah_tiket')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Payment Method Selection -->
                            <div class="mb-4">
                                <label for="metode_pembayaran" class="block text-gray-700 font-medium">Metode
                                    Pembayaran</label>
                                <select name="metode_pembayaran" id="metode_pembayaran"
                                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none text-black"
                                    required>
                                    <option value="">Pilih metode pembayaran</option>
                                    <option value="{{ App\Models\Pembayaran::METODE_CREDIT_CARD }}"
                                        {{ old('metode_pembayaran') == App\Models\Pembayaran::METODE_CREDIT_CARD ? 'selected' : '' }}>
                                        Kartu Kredit</option>
                                    <option value="{{ App\Models\Pembayaran::METODE_BANK_TRANSFER }}"
                                        {{ old('metode_pembayaran') == App\Models\Pembayaran::METODE_BANK_TRANSFER ? 'selected' : '' }}>
                                        Transfer Bank</option>
                                </select>
                                @error('metode_pembayaran')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full !bg-indigo-500 text-white hover:bg-indigo-600 font-bold py-3 rounded-lg transition duration-200">
                                Pesan Tiket
                            </button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
