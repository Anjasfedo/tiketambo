@extends('layouts.landing')


@section('content')
    <section class="min-h-screen flex flex-col px-4 ">
        <div class="flex flex-col flex-1 max-w-[1400px] mx-auto w-full">
            @include('partials.header')
            <div class="lg:-mx-6 lg:flex lg:items-center">
                <img class="object-cover object-center lg:w-1/2 lg:mx-6 w-full h-96 rounded-lg lg:h-[36rem]"
                    src="https://images.unsplash.com/photo-1499470932971-a90681ce8530?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                    alt="">

                <div class="mt-8 lg:w-1/2 lg:px-6 lg:mt-0">

                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white lg:text-3xl lg:w-96">
                        {{ $acara->nama }}
                    </h1>

                    <p class="max-w-lg mt-6 text-gray-500 dark:text-gray-400 ">
                        {{ $acara->deskripsi }}
                    </p>

                    <h3 class="mt-6 text-lg font-medium text-blue-500">{{ $acara->user->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $acara->lokasi }}, {{ $acara->tanggal }},
                        {{ $acara->waktu }}</p>
                </div>
            </div>
        </div>
    </section><!--<SectionWrap>--><!--<Hero>-->

    <section class="min-h-screen flex flex-col px-4 ">
        <div class="container px-6 py-8 mx-auto">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 lg:text-3xl dark:text-gray-100">Tiket
                    </h2>
                    <p class="mt-4 text-white">Beli Tiket Acara {{ $acara->nama }} dari {{ $acara->user->name }}</p>
                </div>
            </div>
            <div class="grid gap-6 mt-16 -mx-6 sm:gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @if ($acara->tiket->isNotEmpty())
                    @foreach ($acara->tiket as $tiket)
                        <div
                            class="px-6 py-8 transition-colors duration-300 transform bg-gray-700 rounded-lg dark:bg-gray-800">
                            <p class="text-lg font-medium text-gray-100">{{ $tiket->nama }}</p>

                            <h4 class="mt-2 text-3xl font-semibold text-gray-100">{{ $tiket->harga }} Rupiah</h4>

                            <p class="mt-4 mb-8 text-gray-300">{{ $tiket->stok }} Tiket Tersisa</p>
                            <a href="{{ route('penjualan.create', $tiket->id) }}"
                                class="w-full px-4 py-2 mt-10 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                                Beli Tiket
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>No tickets available for this event.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
