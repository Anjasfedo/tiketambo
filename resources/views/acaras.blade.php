@extends('layouts.landing')

@section('content')
    <section class="min-h-screen flex flex-col px-4 ">
        <div class="flex flex-col flex-1 max-w-[1400px] mx-auto w-full">
            @include('partials.header')

            <!-- Search Form -->
            <div class="flex justify-between">
                <form action="{{ route('acaras') }}" method="GET" class="mb-8">
                    <div class="flex items-center gap-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none text-black"
                            placeholder="Cari acara...">
                        <button type="submit"
                            class="px-6 py-3 text-white !bg-indigo-500 hover:bg-indigo-600 rounded-lg font-semibold">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-2 gap-8 text-black">
                @forelse ($acaras as $acara)
                    <div class="col-span-1 overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <img class="object-cover w-full h-64"
                            src="https://images.unsplash.com/photo-1521903062400-b80f2cb8cb9d?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1050&q=80"
                            alt="">

                        <div class="p-6">
                            <div>
                                <span
                                    class="text-xl font-medium text-blue-600 uppercase dark:text-blue-400">{{ $acara->nama }}</span>
                                <a href="{{ route('acaras_show', $acara->id) }}"
                                    class="block mt-2 text-lg font-semibold transition-colors duration-300 transform hover:text-gray-600 underline hover:no-underline"
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
                @empty
                    <p class="text-center text-gray-600">Tidak ada acara yang sesuai dengan pencarian Anda.</p>
                @endforelse
            </div>

            <div class="flex justify-center my-8">
                {{ $acaras->links('pagination::tailwind') }}
            </div>
        </div>
    </section>
@endsection
