@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Available Tickets for Resale</h1>

    @if($releasedTickets->isEmpty())
        <p class="text-gray-700">There are no tickets available for resale at the moment.</p>
    @else
        <div class="bg-white p-6 rounded shadow-md">
            @foreach($releasedTickets as $ticket)
                <div class="mb-6 p-4 border rounded-lg">
                    <p><strong>Event Name:</strong> {{ $ticket->tiket->nama }}</p>
                    <p><strong>Resale Price:</strong> {{ number_format($ticket->price, 2) }}</p>
                    <p><strong>Seller:</strong> {{ $ticket->user->name }}</p>

                    <!-- Additional details -->
                    <p><strong>Event Location:</strong> {{ $ticket->tiket->acara->lokasi ?? 'N/A' }}</p>
                    <p><strong>Event Date:</strong> {{ $ticket->tiket->acara->tanggal ?? 'N/A' }}</p>

                    <!-- Form to purchase the resale ticket -->
                    <form action="{{ route('penjualan.resale', $ticket->id) }}" method="POST" class="mt-4">
                        @csrf
                        <label for="metode_pembayaran" class="block text-gray-700">Payment Method</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="w-full p-2 border border-gray-300 rounded mb-2" required>
                            <option value="credit_card">Credit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="ewallet">E-Wallet</option>
                        </select>
                        <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Purchase Ticket
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
