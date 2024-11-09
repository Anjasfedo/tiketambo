<!-- resources/views/tikets/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Tiket untuk: {{ $acara->nama }}</h1>

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

    <form action="{{ route('tikets.update', [$acara->id, $tiket->id]) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="block text-gray-700">Nama Tiket</label>
            <input type="text" name="nama" id="nama" class="w-full p-2 border border-gray-300 rounded" value="{{ old('nama', $tiket->nama) }}" required>
            @error('nama')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="harga_tiket" class="block text-gray-700">Harga Tiket</label>
            <input type="number" name="harga_tiket" id="harga_tiket" class="w-full p-2 border border-gray-300 rounded" value="{{ old('harga_tiket', $tiket->harga_tiket) }}" required>
            @error('harga_tiket')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="stok_tiket" class="block text-gray-700">Stok Tiket</label>
            <input type="number" name="stok_tiket" id="stok_tiket" class="w-full p-2 border border-gray-300 rounded" value="{{ old('stok_tiket', $tiket->stok_tiket) }}" required>
            @error('stok_tiket')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Update Tiket
        </button>
    </form>
</div>
@endsection
