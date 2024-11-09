@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Tikets for Acara: {{ $acara->nama }}</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>Lokasi:</strong> {{ $acara->lokasi }}</p>
        <p><strong>Tanggal:</strong> {{ $acara->tanggal }}</p>
    </div>

    <div class="mt-8 bg-white p-6 rounded shadow-md">
        <h2 class="text-xl font-bold mb-4">Daftar Tiket</h2>

        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nama Tiket</th>
                    <th class="py-2 px-4 border-b">Harga</th>
                    <th class="py-2 px-4 border-b">Stok Tersedia</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($acara->tiket as $tiket)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $tiket->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($tiket->harga_tiket, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ $tiket->stok_tiket }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('admin.acaras.sales', $tiket->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                Show Sales
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
