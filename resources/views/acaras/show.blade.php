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

    <!-- Ticket Management Section -->
    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Kelola Tiket</h2>

        <a href="{{ route('tikets.create', $acara->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Tambah Tiket
        </a>

        <table class="min-w-full bg-white shadow-md rounded mt-4">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b">Nama Tiket</th>
                    <th class="px-6 py-3 border-b">Harga</th>
                    <th class="px-6 py-3 border-b">Stok</th>
                    <th class="px-6 py-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($acara->tiket as $tiket)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 border-b">{{ $tiket->nama }}</td>
                        <td class="px-6 py-4 border-b">{{ number_format($tiket->harga_tiket, 2) }}</td>
                        <td class="px-6 py-4 border-b">{{ $tiket->stok_tiket }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('tikets.edit', [$acara->id, $tiket->id]) }}" class="text-yellow-500 hover:underline">Edit</a>
                            <form action="{{ route('tikets.destroy', [$acara->id, $tiket->id]) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
