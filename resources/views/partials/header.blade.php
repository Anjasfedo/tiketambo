<header class="flex flex-col relative z-20">
    <div class="max-w-[1400px] mx-auto w-full flex items-center justify-between p-4 py-6"><a
            href="{{ route('landing') }}">
            <h1 class="font-semibold">Tiket <span class="text-indigo-400" data-svelte-h="svelte-11m9ge5">Tiket</span></h1>
        </a> <button class="md:hidden grid place-items-center"><i class="fa-solid fa-bars"></i></button>
        <nav class="hidden md:flex items-center gap-4 lg:gap-6"><a href="{{ route('acaras') }}"
                class="duration-200 hover:text-indigo-400 cursor-pointer" data-svelte-h="svelte-1sb72ps">Acara</a>
            <a href="{{ route('login') }}" class="specialButton" data-svelte-h="svelte-141y5lp">Masuk</a>
        </nav>
    </div>
</header><!--<Header>-->
