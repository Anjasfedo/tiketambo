<!-- resources/views/acaras/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Daftar Acara</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('acaras.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Buat Acara Baru
    </a>

    <table class="min-w-full bg-white shadow-md rounded">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b">Gambar</th>
                <th class="px-6 py-3 border-b">Nama Acara</th>
                <th class="px-6 py-3 border-b">Lokasi</th>
                <th class="px-6 py-3 border-b">Tanggal</th>
                <th class="px-6 py-3 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($acaras as $acara)
                <tr class="hover:bg-gray-100">
                    <td class="px-6 py-4 border-b">
                        @if ($acara->gambar)
                            <img src="{{ asset('storage/' . $acara->gambar) }}" alt="Gambar Acara" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-500">Tidak Ada Gambar</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 border-b">{{ $acara->nama }}</td>
                    <td class="px-6 py-4 border-b">{{ $acara->lokasi }}</td>
                    <td class="px-6 py-4 border-b">{{ $acara->tanggal }}</td>
                    <td class="px-6 py-4 border-b">
                        <a href="{{ route('acaras.show', $acara->id) }}" class="text-blue-500 hover:underline">Lihat</a>
                        <a href="{{ route('acaras.edit', $acara->id) }}" class="ml-2 text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('acaras.destroy', $acara->id) }}" method="POST" class="inline-block ml-2">
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
@endsection
