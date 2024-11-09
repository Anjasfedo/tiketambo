@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Daftar Semua Acara</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nama Acara</th>
                    <th class="py-2 px-4 border-b">Lokasi</th>
                    <th class="py-2 px-4 border-b">Tanggal</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($acaras as $acara)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $acara->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $acara->lokasi }}</td>
                        <td class="py-2 px-4 border-b">{{ $acara->tanggal }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('admin.acaras.tikets', $acara->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                Show Tickets
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
