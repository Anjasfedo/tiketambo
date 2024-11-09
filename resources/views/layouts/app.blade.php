<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles and Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <div class="flex justify-end items-center p-4 bg-gray-800">
            <!-- Fetch and display pending checkouts count -->
            @php
                $pendingCheckoutCount = \App\Models\Penjualan::where('user_id', Auth::id())
                    ->where('status', 'pending')
                    ->count();
            @endphp
            <a href="{{ route('penjualan.pending-checkouts') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                Checkout ({{ $pendingCheckoutCount }})
            </a>
        </div>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
