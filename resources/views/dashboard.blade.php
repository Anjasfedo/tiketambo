@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight mb-4">
        {{ __('Dashboard') }}
    </h2>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <p>{{ __("You're logged in!") }}</p>

            <h3 class="text-lg font-bold mt-6">Available Tickets</h3>

            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($tikets as $tiket)
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md">
                        <h4 class="text-xl font-semibold">{{ $tiket->nama }}</h4>
                        <p class="text-gray-600 dark:text-gray-300 mt-1"><strong>Event:</strong> {{ $tiket->acara->nama }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Location:</strong> {{ $tiket->acara->lokasi }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Date:</strong> {{ $tiket->acara->tanggal }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Time:</strong> {{ $tiket->acara->jam }}</p>
                        <p class="text-gray-600 dark:text-gray-300 mt-2"><strong>Price:</strong> {{ number_format($tiket->harga_tiket, 2) }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Available Stock:</strong> {{ $tiket->stok_tiket }}</p>

                        <a href="{{ route('penjualan.create', $tiket->id) }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Buy Ticket
                        </a>
                    </div>
                @endforeach
            </div>

            @if ($tikets->isEmpty())
                <p class="text-gray-600 dark:text-gray-400 mt-4">No tickets available at the moment.</p>
            @endif
        </div>
    </div>
</div>
@endsection
