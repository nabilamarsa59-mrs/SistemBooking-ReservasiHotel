@if (Route::is(['dashboard.resepsionis', 'data.kamar']))

<header class="w-full border-b border-gray-400 bg-[#ece6da] px-10 py-5">
    <div class="grid grid-cols-3 items-center">
        <div>
            <img src="{{ asset('images/logo_PBL.jpeg') }}"
                 alt="Logo Pulas"
                 class="h-[75px] object-contain mix-blend-multiply">
        </div>

        <nav class="flex justify-center gap-12 text-[20px] font-semibold text-[#243b53]">
            <a href="{{ route('dashboard.resepsionis') }}" class="hover:text-[#7ea1ba]">Beranda</a>
            <a href="{{ route('data.kamar') }}" class="hover:text-[#7ea1ba]">Data Kamar</a>
            <a href="#" class="hover:text-[#7ea1ba]">Data Reservasi</a>
        </nav>

        <div class="flex justify-end">
            <a href="{{ route('profile') }}"
               class="w-12 h-12 rounded-full bg-black flex items-center justify-center text-white text-[22px] hover:bg-[#7ea1ba]">
                👤
            </a>
        </div>
    </div>
</header>

@elseif (Route::is(['verifikasi.admin', 'statistik.admin', 'profile']))

<header class="w-full border-b border-gray-400 bg-[#ece6da] px-10 py-5">
    <div class="grid grid-cols-3 items-center">
        <div>
            <img src="{{ asset('images/logo_PBL.jpeg') }}"
                 alt="Logo Pulas"
                 class="h-[75px] object-contain mix-blend-multiply">
        </div>

        <nav class="flex justify-center gap-12 text-[20px] font-semibold text-[#243b53]">
            <a href="{{ route('statistik.admin') }}" class="hover:text-[#7ea1ba]">Statistik</a>
            <a href="{{ route('verifikasi.admin') }}" class="hover:text-[#7ea1ba]">Verifikasi</a>
        </nav>

        <div class="flex justify-end">
            <a href="{{ route('profile') }}"
               class="w-12 h-12 rounded-full border border-gray-400 bg-white flex items-center justify-center text-[22px] transition hover:bg-[#7ea1ba] hover:text-white">
                👤
            </a>
        </div>
    </div>
</header>

@else

<header class="w-full border-b border-gray-400 bg-[#ece6da] px-10 py-5">
    <div class="grid grid-cols-3 items-center">
        <div>
            <img src="{{ asset('images/logo_PBL.jpeg') }}"
                 alt="Logo Pulas"
                 class="h-[75px] object-contain mix-blend-multiply">
        </div>

        <nav class="flex justify-center gap-12 text-[20px] font-semibold text-[#243b53]">
            <a href="#beranda" class="hover:text-[#7ea1ba]">Beranda</a>
            <a href="#container-kamar" class="hover:text-[#7ea1ba]">Kamar</a>
            <a href="#bantuan" class="hover:text-[#7ea1ba]">Bantuan</a>
        </nav>

        <div class="flex justify-end">
            <button type="button"
                    data-modal-target="login-modal"
                    data-modal-toggle="login-modal"
                    class="w-12 h-12 rounded-full border border-gray-400 bg-white flex items-center justify-center text-[22px] text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white">
                👤
            </button>
        </div>
    </div>
</header>

@endif