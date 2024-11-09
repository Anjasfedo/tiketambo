@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Penjualan untuk Tiket: {{ $ticket->nama }}</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>Harga Tiket:</strong> {{ number_format($ticket->harga_tiket, 2) }}</p>
        <p><strong>Stok Tersedia:</strong> {{ $ticket->stok_tiket }}</p>
    </div>

    <div class="mt-8 bg-white p-6 rounded shadow-md">
        <h2 class="text-xl font-bold mb-4">Daftar Penjualan</h2>

        @if($sales->isEmpty())
            <p>Tidak ada penjualan untuk tiket ini.</p>
        @else
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nomor Pesanan</th>
                        <th class="py-2 px-4 border-b">Jumlah Tiket</th>
                        <th class="py-2 px-4 border-b">Total Harga</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Pembayaran</th>
                        <th class="py-2 px-4 border-b">Nama Pembeli</th>
                        <th class="py-2 px-4 border-b">Email Pembeli</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        @php
                            $totalHarga = $sale->pembayaran ? $sale->pembayaran->jumlah_bayar : $sale->tiket->harga_tiket * $sale->jumlah_tiket;
                        @endphp
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $sale->nomor_pesanan }}</td>
                            <td class="py-2 px-4 border-b">{{ $sale->pembayaran->jumlah_tiket ?? $sale->jumlah_tiket }}</td>
                            <td class="py-2 px-4 border-b">{{ number_format($totalHarga, 2) }}</td>
                            <td class="py-2 px-4 border-b">{{ ucfirst($sale->status) }}</td>
                            <td class="py-2 px-4 border-b">
                                @if($sale->status === 'completed')
                                    <span class="text-green-600">Completed</span> <br>
                                    <small>{{ $sale->pembayaran->tanggal_pembayaran }}</small>
                                @else
                                    <span class="text-red-600">Pending</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">{{ $sale->user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $sale->user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
