@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-4">Edit Acara</h1>

        <!-- Display all validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <strong>Terjadi kesalahan pada input:</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('acaras.update', $acara->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Acara</label>
                <input type="text" name="nama" id="nama" class="form-control"
                    value="{{ old('nama', $acara->nama) }}" required>
                @error('nama')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="form-control"
                    value="{{ old('lokasi', $acara->lokasi) }}" required>
                @error('lokasi')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control"
                    value="{{ old('tanggal', $acara->tanggal) }}" required>
                @error('tanggal')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jam" class="form-label">Jam</label>
                <input type="time" name="jam" id="jam" class="form-control"
                    value="{{ old('jam', $acara->jam) }}" required>
                @error('jam')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $acara->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>

                <!-- Display the current image if it exists -->
                @if ($acara->gambar)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $acara->gambar) }}" alt="Gambar Acara" class="img-thumbnail"
                            style="width: 8rem; height: 8rem;">
                    </div>
                @endif

                <input type="file" name="gambar" id="gambar" class="form-control">
                @error('gambar')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Update Acara
            </button>
        </form>
    </div>
@endsection
