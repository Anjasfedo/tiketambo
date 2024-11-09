<!-- resources/views/user/withdrawal.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Request Withdrawal</h1>

    @if(session('success'))
        <p class="text-green-500">{{ session('success') }}</p>
    @endif

    <form action="{{ route('withdrawals.request') }}" method="POST">
        @csrf
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" required>
        <button type="submit" class="bg-blue-500 text-white">Request Withdrawal</button>
    </form>
</div>
@endsection
