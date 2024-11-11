@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Withdraw Funds</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Withdrawal Form -->
        <div class="bg-white p-6 rounded shadow-md mb-8">
            {{ Auth::user()->money }}
            <h2 class="text-xl font-semibold mb-4">Request Withdrawal</h2>
            <form action="{{ route('withdrawal.request') }}" method="POST">
                @csrf
                <label for="amount" class="block text-gray-700">Withdrawal Amount</label>
                <input type="number" name="amount" id="amount" min="1" max="{{ Auth::user()->money }}" required
                    class="w-full p-2 border border-gray-300 rounded mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Request Withdrawal
                </button>
            </form>
        </div>

        <!-- Withdrawal History -->
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Withdrawal History</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="border-b py-2 text-left">Date</th>
                        <th class="border-b py-2 text-left">Amount</th>
                        <th class="border-b py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($withdrawals as $withdrawal)
                        <tr>
                            <td class="py-2">{{ $withdrawal->created_at->format('Y-m-d') }}</td>
                            <td class="py-2">{{ number_format($withdrawal->amount, 2) }}</td>
                            <td class="py-2">{{ ucfirst($withdrawal->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
