@extends('layouts.landing')


@section('content')
    <section class="min-h-screen flex flex-col px-4 ">
        <div class="flex flex-col flex-1 max-w-[1400px] mx-auto w-full">
            @include('partials.header')
            <div class="mt-8 lg:px-20 lg:mt-0">
                <div class="grid grid-cols-1 gap-8">
                    @forelse ($pendingCheckouts as $checkout)
                        @php
                            $jumlah_tiket = $checkout->pembayaran->jumlah_tiket ?? 1;
                            $total_harga =
                                $checkout->pembayaran->jumlah_bayar ?? $checkout->tiket->harga * $jumlah_tiket;
                        @endphp
                        <div class="px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <div class="flex items-center justify-between">
                                <span class="text-xl text-gray-900 font-bold">{{ $checkout->nomor_pesanan }} -
                                    {{ $checkout->tiket->nama }}</span>
                                <form action="{{ route('penjualan.cancel', $checkout->id) }}" method="POST"
                                    class="delete-alertbox">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 text-base font-bold text-gray-100 transition-colors duration-300 transform !bg-red-500 hover:bg-red-700 rounded cursor-pointer">Batal</button>
                                </form>
                            </div>

                            <div class="mt-2">
                                <p class="text-lg font-bold text-gray-700" tabindex="0">{{ $jumlah_tiket }}</->
                                <p class="mt-2 text-gray-600">{{ number_format($total_harga, 2) }}
                                </p>
                            </div>
                            <div class="mt-4 text-end">
                                <a href="{{ route('pembayaran.checkout', $checkout->id) }}"
                                    class="inline-block px-6 py-2 text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75 transition duration-200">
                                    Bayar
                                </a>
                            </div>
                        </div>
                    @empty
                    <div class="px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <p class="text-gray-700">Anda tidak memiliki pesanan yang belum dibayar.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section><!--<SectionWrap>--><!--<Hero>-->

    <section class="min-h-screen flex flex-col px-4 ">

    </section>
@endsection
