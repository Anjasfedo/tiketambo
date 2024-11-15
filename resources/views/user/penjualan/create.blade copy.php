@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Pesan Tiket: {{ $tiket->nama }}</h1>

    <!-- Event and Ticket Information -->
    <div class="bg-white p-6 rounded shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-2">Informasi Acara</h2>
        <p><strong>Nama Acara:</strong> {{ $tiket->acara->nama }}</p>
        <p><strong>Lokasi:</strong> {{ $tiket->acara->lokasi }}</p>
        <p><strong>Tanggal:</strong> {{ $tiket->acara->tanggal }}</p>
        <p><strong>Jam:</strong> {{ $tiket->acara->jam }}</p>

        <h2 class="text-xl font-semibold mt-4 mb-2">Informasi Tiket</h2>
        <p><strong>Harga Tiket:</strong> {{ number_format($tiket->harga_tiket, 2) }}</p>
        <p><strong>Stok Tiket Tersedia:</strong> {{ $tiket->stok_tiket }}</p>
    </div>

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

    <!-- Ticket Order Form -->
    <form action="{{ route('penjualan.store', $tiket->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf

        <!-- Ticket Quantity -->
        <div class="mb-4">
            <label for="jumlah_tiket" class="block text-gray-700">Jumlah Tiket</label>
            <input type="number" name="jumlah_tiket" id="jumlah_tiket" class="w-full p-2 border border-gray-300 rounded" value="{{ old('jumlah_tiket', 1) }}" min="1" max="{{ $tiket->stok_tiket }}" required>
            <p class="text-gray-600 mt-2">Stok tersedia: {{ $tiket->stok_tiket }}</p>
            @error('jumlah_tiket')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Payment Method Selection -->
        <div class="mb-4">
            <label for="metode_pembayaran" class="block text-gray-700">Metode Pembayaran</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="">Pilih metode pembayaran</option>
                <option value="credit_card" {{ old('metode_pembayaran') == 'credit_card' ? 'selected' : '' }}>Kartu Kredit</option>
                <option value="bank_transfer" {{ old('metode_pembayaran') == 'bank_transfer' ? 'selected' : '' }}>Transfer Bank</option>
                <option value="ewallet" {{ old('metode_pembayaran') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
            </select>
            @error('metode_pembayaran')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Pesan Tiket
        </button>
    </form>
</div>
@endsection
