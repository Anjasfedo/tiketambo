@extends('layouts.landing')


@section('content')
    <section class="min-h-screen flex flex-col px-4 ">
        <div class="flex flex-col flex-1 max-w-[1400px] mx-auto w-full">
            @include('partials.header')
            <div class="flex flex-col gap-10 flex-1 items-center justify-center pb-10 md:pb-14">
                <h2
                    class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl max-w-[1200px] mx-auto w-full text-center font-semibold">
                    <span class="text-indigo-400">Pesan</span> Tiket untuk<br> <span
                        class="text-slate-600 line-through">Acara</span> Anda
                    Sekarang
                </h2>
                <p class="text-xl sm:text-2xl md:text-3xl text-center max-w-[1000px] mx-auto w-full">Rasakan momen tak
                    terlupakan dengan tiket eksklusif untuk konser, teater, dan acara lainnya.</p>
                <div class="flex items-center gap-4"><button class="specialButton  ">
                        <p class="text-base sm:text-lg md:text-xl" data-svelte-h="svelte-1am8dmy">Jelajahi Acara</p>
                    </button> <button class="specialButtonDark">
                        <p class="text-base sm:text-lg md:text-xl" data-svelte-h="svelte-kg3svr">Mulai Sekarang →
                        </p>
                    </button></div><!--<Cta>-->
                <div class="flex items-center justify-center gap-2 text-base">
                    <p data-svelte-h="svelte-yh8842">4.8</p>
                    <div class="grid place-items-center relative"><i class="fa-solid fa-star opacity-0"></i>
                        <div class="absolute top-0 left-0 grid place-items-center  "><i
                                class="fa-solid fa-star text-amber-400"></i></div>
                    </div>
                    <div class="grid place-items-center relative"><i class="fa-solid fa-star opacity-0"></i>
                        <div class="absolute top-0 left-0 grid place-items-center  "><i
                                class="fa-solid fa-star text-amber-400"></i></div>
                    </div>
                    <div class="grid place-items-center relative"><i class="fa-solid fa-star opacity-0"></i>
                        <div class="absolute top-0 left-0 grid place-items-center  "><i
                                class="fa-solid fa-star text-amber-400"></i></div>
                    </div>
                    <div class="grid place-items-center relative"><i class="fa-solid fa-star opacity-0"></i>
                        <div class="absolute top-0 left-0 grid place-items-center  "><i
                                class="fa-solid fa-star text-amber-400"></i></div>
                    </div>
                    <div class="grid place-items-center relative"><i class="fa-solid fa-star opacity-0"></i>
                        <div class="absolute top-0 left-0 grid place-items-center  w-[80%] overflow-hidden"><i
                                class="fa-solid fa-star text-amber-400"></i></div>
                    </div>
                    <p data-svelte-h="svelte-1yk7s6i">5000+ Ulasan</p>
                </div><!--<Star>-->
            </div>
        </div>
    </section><!--<SectionWrap>--><!--<Hero>-->
    <section id="product" class="min-h-screen flex flex-col px-4 ">
        <div class="flex flex-col flex-1 max-w-[1400px] mx-auto w-full">
            <div class="flex flex-col gap-10 sm:gap-14 md:gap-24 flex-1 items-center justify-center pb-10 md:-bottom-1/4">
                <div class="flex flex-col gap-2">
                    <p class="opacity-60 text-base sm:text-lg md:text-xl text-center">Mulai Sekarang dengan <span
                            class="text-indigo-400" data-svelte-h="svelte-1eh2d6s">Tiket</span> Tiket</p>
                    <h3 class="text-4xl sm:text-5xl md:text-6xl max-w-[1000px] mx-auto w-full font-semibold text-center"
                        data-svelte-h="svelte-1fgvr8b">Fitur Pemesanan Praktis</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-14 md:gap-16 lg:gap-20 relative text-base">
                    <div class="flex flex-col gap-8 md:gap-10 pt-10  ">
                        <h4
                            class="text-2xl sm:text-3xl md:text-4xl max-w-[1000px] w-full font-medium pr-10 relative after:absolute after:top-full after:left-0 after:w-1/5 after:h-1.5 after:mt-1 after:bg-slate-900">
                            Pemesanan Tiket <span class="text-indigo-400" data-svelte-h="svelte-x65yem">Aman</span> & <span
                                class="text-indigo-400" data-svelte-h="svelte-x65yem">Praktis</span>
                        </h4>
                        <p>Nikmati pengalaman pemesanan tiket yang mudah dengan checkout aman, pilihan pembayaran fleksibel,
                            dan konfirmasi instan.</p>
                        <div class="flex flex-col gap-3">
                            <div class="flex gap-2 items-center">
                                <div
                                    class="grid place-items-center p-1.5 text-xs sm:text-sm aspect-square rounded-full border-[1.5px] bg-white border-solid border-green-300">
                                    <i class="fa-solid fa-bolt text-green-400"></i>
                                </div> Pembayaran Fleksibel
                            </div>
                            <div class="flex gap-2 items-center">
                                <div
                                    class="grid place-items-center p-1.5 text-xs sm:text-sm aspect-square rounded-full border-[1.5px] bg-white border-solid border-green-300">
                                    <i class="fa-solid fa-bolt text-green-400"></i>
                                </div> Konfirmasi Tiket Instan
                            </div>
                            <div class="flex gap-2 items-center">
                                <div
                                    class="grid place-items-center p-1.5 text-xs sm:text-sm aspect-square rounded-full border-[1.5px] bg-white border-solid border-green-300">
                                    <i class="fa-solid fa-bolt text-green-400"></i>
                                </div> Pengembalian Dana Mudah
                            </div>
                        </div>
                        <div class="flex items-center"><button class="specialButtonDark mr-auto font-semibold ">
                                <p data-svelte-h="svelte-jf3fm0">Mulai Pesan</p>
                            </button></div>
                    </div>
                    <div class="flex flex-col dropShadow overflow-hidden rounded-b-lg ">
                        <div class="rounded-t-xl h-8 sm:h-10 bg-white opacity-60 flex items-center gap-2">
                            <div class="rounded-full aspect-square w-2.5 sm:w-3 bg-indigo-300 ml-2"></div>
                            <div class="rounded-full aspect-square w-2.5 sm:w-3 bg-indigo-300 ml-2"></div>
                            <div class="rounded-full aspect-square w-2.5 sm:w-3 bg-indigo-300 ml-2"></div>
                        </div>
                        <div class="flex flex-col gap-4 flex-1"><img
                                src="https://raw.githubusercontent.com/jamezmca/gym-app-landingpage/main/static/assets/goal.png"
                                alt="product-img"></div>
                    </div>
                </div><!--<ProductCard>-->
            </div>
        </div>
    </section><!--<SectionWrap>--><!--<Product>-->
    <section id="faq" class="min-h-screen flex flex-col px-4 ">
        <div class="flex flex-col flex-1 max-w-[1400px] mx-auto w-full">
            <div class="flex flex-col gap-10 sm:gap-14 md:gap-24 py-20 flex-1 items-center justify-center">
                <div class="flex flex-col gap-2">
                    <p class="opacity-60 text-base sm:text-lg md:text-xl text-center" data-svelte-h="svelte-wg31t3">Untuk
                        Semua Pertanyaan Anda</p>
                    <h3 class="text-4xl sm:text-5xl md:text-6xl max-w-[1000px] mx-auto w-full font-semibold text-center"
                        data-svelte-h="svelte-1pknujz">Pertanyaan yang Sering Diajukan</h3>
                </div>
                <div class="flex flex-col gap-8 sm:gap-10 md:gap-14 w-full">
                    <div class="flex flex-col gap-2 text-left max-w-[800px] w-full mx-auto relative p-4 px-6">
                        <div class="absolute top-0 left-0 w-1/3 h-[1px] bg-slate-950 -translate-x-4"></div>
                        <div class="absolute top-0 left-0 h-2/3 w-[1px] bg-slate-950 -translate-y-4"></div>
                        <h4 class="text-lg sm:text-xl md:text-2xl">Acara apa saja yang bisa saya pesan tiketnya?</h4>
                        <p class="p-2">Kami menawarkan tiket untuk berbagai acara, termasuk konser, pertunjukan teater,
                            olahraga, dan
                            festival.</p>
                    </div>
                    <div class="flex flex-col gap-2 text-left max-w-[800px] w-full mx-auto relative p-4 px-6">
                        <div class="absolute top-0 left-0 w-1/3 h-[1px] bg-slate-950 -translate-x-4"></div>
                        <div class="absolute top-0 left-0 h-2/3 w-[1px] bg-slate-950 -translate-y-4"></div>
                        <h4 class="text-lg sm:text-xl md:text-2xl">Bagaimana cara membeli tiket?</h4>
                        <p class="p-2">Pilih acara Anda, pilih opsi tempat duduk yang diinginkan, dan lanjutkan ke
                            checkout untuk
                            pembelian yang cepat dan aman.</p>
                    </div>
                    <div class="flex flex-col gap-2 text-left max-w-[800px] w-full mx-auto relative p-4 px-6">
                        <div class="absolute top-0 left-0 w-1/3 h-[1px] bg-slate-950 -translate-x-4"></div>
                        <div class="absolute top-0 left-0 h-2/3 w-[1px] bg-slate-950 -translate-y-4"></div>
                        <h4 class="text-lg sm:text-xl md:text-2xl">Apakah saya bisa mengembalikan tiket saya?</h4>
                        <p class="p-2">Kebijakan pengembalian dana bervariasi tergantung acara. Silakan lihat detail
                            acara untuk syarat
                            dan ketentuan pengembalian dana.</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!--<SectionWrap>--><!--<Faq>-->
    <section class="py-14 md:py-20 flex flex-col gap-8 bg-[#181b34] text-white text-center items-center justify-center">
        <h4 class="text-xl sm:text-2xl md:text-3xl">Jangan Lewatkan Kesempatan!</h4>
        <p class="text-base sm:text-lg md:text-xl">Berlangganan untuk penawaran eksklusif dan notifikasi acara</p>
        <div class="flex items-center gap-4">
            <button class="specialButton">Hubungi Kami</button>
            <button class="specialButtonDark">Mulai Sekarang →</button>
        </div>
    </section><!--<Conversion>-->
@endsection
