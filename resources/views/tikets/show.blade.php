<!-- resources/views/tikets/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Detail Tiket untuk Acara: {{ $acara->nama }}</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>Nama Tiket:</strong> {{ $tiket->nama }}</p>
        <p><strong>Harga Tiket:</strong> {{ number_format($tiket->harga_tiket, 2) }}</p>
        <p><strong>Stok Tiket:</strong> {{ $tiket->stok_tiket }}</p>

        <a href="{{ route('acaras.show', $acara->id) }}" class="mt-4 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali ke Acara
        </a>
    </div>
</div>
@endsection
