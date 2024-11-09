<!-- resources/views/acaras/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">{{ $acara->nama }}</h1>

    <div class="bg-white p-6 rounded shadow-md">
        @if ($acara->gambar)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $acara->gambar) }}" alt="Gambar Acara" class="w-64 h-64 object-cover rounded border">
            </div>
        @endif

        <p><strong>Lokasi:</strong> {{ $acara->lokasi }}</p>
        <p><strong>Tanggal:</strong> {{ $acara->tanggal }}</p>
        <p><strong>Jam:</strong> {{ $acara->jam }}</p>
        <p><strong>Deskripsi:</strong> {{ $acara->deskripsi }}</p>

        <a href="{{ route('acaras.index') }}" class="mt-4 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali ke Daftar Acara
        </a>
    </div>
</div>
@endsection
