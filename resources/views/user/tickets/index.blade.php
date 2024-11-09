@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">My Tickets</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-xl font-semibold mb-4">Active Tickets</h2>
        @foreach($userTickets->where('status', 'active') as $ticket)
            <div class="mb-6 p-4 border rounded-lg">
                <p><strong>Ticket Name:</strong> {{ $ticket->tiket->nama }}</p>
                <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                <p><strong>Price:</strong> {{ number_format($ticket->tiket->harga_tiket, 2) }}</p>
                <form action="{{ route('user.tickets.resell', $ticket->id) }}" method="POST" class="mt-4">
                    @csrf
                    <label for="price" class="block text-gray-700">Resale Price</label>
                    <input type="number" name="price" id="price" class="w-full p-2 border border-gray-300 rounded" required>
                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Put Up for Sale
                    </button>
                </form>
            </div>
        @endforeach

        <h2 class="text-xl font-semibold mt-8 mb-4">Tickets for Sale</h2>
        @foreach($userTickets->where('status', 'for_sale') as $ticket)
            <div class="mb-6 p-4 border rounded-lg">
                <p><strong>Ticket Name:</strong> {{ $ticket->tiket->nama }}</p>
                <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                <p><strong>Resale Price:</strong> {{ number_format($ticket->price, 2) }}</p>
            </div>
        @endforeach

        <h2 class="text-xl font-semibold mt-8 mb-4">Sold Tickets</h2>
        @foreach($userTickets->where('status', 'sold') as $ticket)
            <div class="mb-6 p-4 border rounded-lg">
                <p><strong>Ticket Name:</strong> {{ $ticket->tiket->nama }}</p>
                <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                <p><strong>Sale Price:</strong> {{ number_format($ticket->price, 2) }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
