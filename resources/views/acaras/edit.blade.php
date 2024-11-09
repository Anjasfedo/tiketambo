<!-- resources/views/acaras/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Acara</h1>

        <!-- Display all validation errors -->
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

        <form action="{{ route('acaras.update', $acara->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama" class="block text-gray-700">Nama Acara</label>
                <input type="text" name="nama" id="nama" class="w-full p-2 border border-gray-300 rounded"
                    value="{{ old('nama', $acara->nama) }}" required>
                @error('nama')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="lokasi" class="block text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="w-full p-2 border border-gray-300 rounded"
                    value="{{ old('lokasi', $acara->lokasi) }}" required>
                @error('lokasi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal" class="block text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full p-2 border border-gray-300 rounded"
                    value="{{ old('tanggal', $acara->tanggal) }}" required>
                @error('tanggal')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jam" class="block text-gray-700">Jam</label>
                <input type="time" name="jam" id="jam" class="w-full p-2 border border-gray-300 rounded"
                    value="{{ old('jam', $acara->jam) }}" required>
                @error('jam')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full p-2 border border-gray-300 rounded">{{ old('deskripsi', $acara->deskripsi) }}</textarea>
                @error('deskripsi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-gray-700">Gambar</label>

                <!-- Display the current image if it exists -->
                @if ($acara->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $acara->gambar) }}" alt="Gambar Acara" class="w-32 h-32 object-cover rounded border">
                    </div>
                @endif

                <input type="file" name="gambar" id="gambar" class="w-full p-2 border border-gray-300 rounded">
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update Acara
            </button>
        </form>
    </div>
@endsection
