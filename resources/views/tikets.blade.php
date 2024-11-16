@extends('layouts.landing')

@section('content')
    <section class="min-h-screen flex flex-col px-4 ">
        <div class="flex flex-col flex-1 max-w-[1400px] mx-auto w-full">
            @include('partials.header')

            <!-- Search Form -->
            <div class="flex justify-between">
                <form action="{{ route('tikets') }}" method="GET" class="mb-8">
                    <div class="flex items-center gap-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none text-black"
                            placeholder="Cari tiket...">
                        <button type="submit"
                            class="px-6 py-3 text-white !bg-indigo-500 hover:bg-indigo-600 rounded-lg font-semibold">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-4 gap-8 text-black">
                @forelse ($tikets as $tiket)
                    <div class="w-full max-w-sm px-4 py-3 bg-white rounded-md shadow-md dark:bg-gray-800">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-extrabold text-gray-800">{{ $tiket->tiket->nama }}</span>
                            <span
                                class="px-3 py-1 text-xs text-gray-700 font-bold bg-green-200 rounded-full">{{ number_format($tiket->harga_jual, 2) }}
                                Rupiah</span>
                        </div>

                        <div>
                            <h1 class="mt-2 text-lg font-semibold text-indigo-700">{{ $tiket->tiket->acara->nama }}</h1>
                            <h2 class="mt-2 text-base text-gray-700">{{ $tiket->user->name }}</h1>
                            <p class="mt-2 text-sm text-gray-600">{{ $tiket->tiket->acara->deskripsi }}</p>
                        </div>

                        <div class="flex justify-between flex-col">
                            <div class="flex items-center mt-2 text-gray-700 text-sm">
                                <span>{{ $tiket->tiket->acara->tanggal }}</span>
                                <p class="mx-2 text-blue-600">{{ $tiket->tiket->acara->waktu }}</p>
                                <span>Di</span>
                                <p class="mx-2 text-blue-600">{{ $tiket->tiket->acara->lokasi }}</p>
                            </div>

                            <div class="flex items-center justify-center mt-4">
                                <a href="{{ route('penjualan.resaleShow', $tiket->id) }}"
                                    class="px-6 py-3 text-white !bg-indigo-500 hover:bg-indigo-600 rounded-lg font-semibold">Pesan
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-600">Tidak ada tiket yang sesuai dengan pencarian Anda.</p>
                @endforelse
            </div>

            <div class="flex justify-center my-8">
                {{ $tikets->links('pagination::tailwind') }}
            </div>
        </div>
    </section>
@endsection
