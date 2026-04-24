@if (Route::is(['dashboard.tamu', 'verifikasi.admin', 'profile']))

<header class="w-full border-b border-gray-400 bg-[#ece6da] px-10 py-5">
    <div class="grid grid-cols-3 items-center">

        <div>
            <img
                src="{{ asset('images/logo_PBL.jpeg') }}"
                alt="Logo Pulas"
                class="h-[75px] object-contain mix-blend-multiply"
            >
        </div>

        <nav class="flex justify-center gap-12 text-[20px] font-semibold text-[#243b53]">
            <a href="{{ url('/dashboard_tamu') }}" class="hover:text-[#7ea1ba]">Beranda</a>
            <a href="{{ route('verifikasi.admin') }}" class="hover:text-[#7ea1ba]">Verifikasi</a>
        </nav>

        <div class="flex justify-end">
            <a
                href="{{ route('profile') }}"
                class="w-12 h-12 rounded-full border border-gray-400 bg-white flex items-center justify-center text-[22px] transition hover:bg-[#7ea1ba] hover:text-white"
            >
                👤
            </a>
        </div>

    </div>
</header>

@else

<header class="w-full border-b border-gray-400 bg-[#ece6da] px-10 py-5">
    <div class="grid grid-cols-3 items-center">

        <div>
            <img
                src="{{ asset('images/logo_PBL.jpeg') }}"
                alt="Logo Pulas"
                class="h-[75px] object-contain mix-blend-multiply"
            >
        </div>

        <nav class="flex justify-center gap-12 text-[20px] font-semibold text-[#243b53]">
            <a href="{{ url('/landing') }}" class="hover:text-[#7ea1ba]">Beranda</a>
            <a href="{{ url('/room') }}" class="hover:text-[#7ea1ba]">Kamar</a>
            <a href="{{ url('/bantuan') }}" class="hover:text-[#7ea1ba]">bantuan</a>
        </nav>

        <div class="flex justify-end">
            <button
                type="button"
                data-modal-target="login-modal"
                data-modal-toggle="login-modal"
                class="w-12 h-12 rounded-full border border-gray-400 bg-white flex items-center justify-center text-[22px] text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white"
            >
                👤
            </button>
        </div>

    </div>
</header>

@endif