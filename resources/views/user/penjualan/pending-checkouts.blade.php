@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Daftar Checkout yang Belum Dibayar</h1>

    @if($pendingCheckouts->isEmpty())
        <p class="text-gray-700">Anda tidak memiliki pesanan yang belum dibayar.</p>
    @else
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded shadow-md">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nomor Pesanan</th>
                        <th class="py-2 px-4 border-b">Nama Tiket</th>
                        <th class="py-2 px-4 border-b">Jumlah Tiket</th>
                        <th class="py-2 px-4 border-b">Total Harga</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingCheckouts as $checkout)
                        @php
                            $totalHarga = $checkout->tiket->harga_tiket * $checkout->pembayaran->jumlah_tiket;
                        @endphp
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $checkout->nomor_pesanan }}</td>
                            <td class="py-2 px-4 border-b">{{ $checkout->tiket->nama }}</td>
                            <td class="py-2 px-4 border-b">{{ $checkout->pembayaran->jumlah_tiket }}</td>
                            <td class="py-2 px-4 border-b">{{ number_format($totalHarga, 2) }}</td>
                            <td class="py-2 px-4 border-b flex space-x-2">
                                <!-- Checkout Button -->
                                <a href="{{ route('pembayaran.checkout', $checkout->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                    Checkout
                                </a>

                                <!-- Cancel Button -->
                                <form action="{{ route('penjualan.cancel', $checkout->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                        Cancel
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
