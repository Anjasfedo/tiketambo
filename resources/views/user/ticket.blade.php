<!-- resources/views/user/tickets.blade.php -->
@foreach($userTickets as $ticket)
    <p>Ticket: {{ $ticket->ticket->name }}</p>
    <p>Status: {{ ucfirst($ticket->status) }}</p>

    @if($ticket->status === 'active')
        <form action="{{ route('user-tickets.resell', $ticket->id) }}" method="POST">
            @csrf
            <label for="price">Sale Price:</label>
            <input type="number" name="price" id="price" required>
            <button type="submit" class="bg-blue-500 text-white">Put Up for Sale</button>
        </form>
    @endif
@endforeach
