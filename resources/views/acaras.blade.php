@extends('layouts.landing')


@section('content')
    <section class="min-h-screen flex flex-col px-4 ">
        <div class="flex flex-col flex-1 max-w-[1400px] mx-auto w-full">
            <header class="flex flex-col relative z-20">
                <div class="max-w-[1400px] mx-auto w-full flex items-center justify-between p-4 py-6"><a href="/">
                        <h1 class="font-semibold">Tiket <span class="text-indigo-400"
                                data-svelte-h="svelte-11m9ge5">Tiket</span></h1>
                    </a> <button class="md:hidden grid place-items-center"><i class="fa-solid fa-bars"></i></button>
                    <nav class="hidden md:flex items-center gap-4 lg:gap-6"><a href="#product"
                            class="duration-200 hover:text-indigo-400 cursor-pointer"
                            data-svelte-h="svelte-1sb72ps">Acara</a> <button class="specialButton"
                            data-svelte-h="svelte-141y5lp">Masuk</button></nav>
                </div>
            </header><!--<Header>-->
            <div class="grid grid-cols-2 gap-8 text-black">
                @foreach ($acaras as $acara)
                <div class="col-span-1 overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <img class="object-cover w-full h-64"
                        src="https://images.unsplash.com/photo-1521903062400-b80f2cb8cb9d?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1050&q=80"
                        alt="">

                    <div class="p-6">
                        <div>
                            <span class="text-xs font-medium text-blue-600 uppercase dark:text-blue-400">{{ $acara->nama }}</span>
                            <a href="#"
                                class="block mt-2 text-xl font-semibold transition-colors duration-300 transform hover:text-gray-600 hover:underline"
                                tabindex="0" role="link">Pesan Sekarang</a>
                            <p class="mt-2 text-sm">{{ $acara->deskripsi }}</p>
                        </div>

                        <div class="mt-4">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <a href="#" class="mx-2 font-semibold"
                                        tabindex="0" role="link">{{ $acara->user->name }}</a>
                                </div>
                                <span class="mx-1 text-xs">{{ $acara->lokasi }} ,{{ $acara->tanggal }}, {{ $acara->waktu }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section><!--<SectionWrap>--><!--<Hero>-->
@endsection
