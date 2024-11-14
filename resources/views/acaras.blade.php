@extends('layouts.landing')


@section('content')
    <section class="min-h-screen flex flex-col px-4 ">
        <div class="flex flex-col flex-1 max-w-[1400px] mx-auto w-full">
            @include('partials.header')
            <div class="grid grid-cols-2 gap-8 text-black">
                @foreach ($acaras as $acara)
                    <div class="col-span-1 overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <img class="object-cover w-full h-64"
                            src="https://images.unsplash.com/photo-1521903062400-b80f2cb8cb9d?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1050&q=80"
                            alt="">

                        <div class="p-6">
                            <div>
                                <span
                                    class="text-xs font-medium text-blue-600 uppercase dark:text-blue-400">{{ $acara->nama }}</span>
                                <a href="{{ route('acaras_show', $acara->id) }}"
                                    class="block mt-2 text-xl font-semibold transition-colors duration-300 transform hover:text-gray-600 hover:underline"
                                    tabindex="0" role="link">Pesan Sekarang</a>
                                <p class="mt-2 text-sm">{{ $acara->deskripsi }}</p>
                            </div>

                            <div class="mt-4">
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        <a href="#" class="mx-2 font-semibold" tabindex="0"
                                            role="link">{{ $acara->user->name }}</a>
                                    </div>
                                    <span class="mx-1 text-xs">{{ $acara->lokasi }} ,{{ $acara->tanggal }},
                                        {{ $acara->waktu }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!--<SectionWrap>--><!--<Hero>-->
@endsection
