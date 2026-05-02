@php
    $role = session('role');
@endphp

<header class="w-full border-b border-gray-400 bg-[#ece6da] px-10 py-5">
    <div class="grid grid-cols-3 items-center">

        <div>
            <a href="{{ route('landing') }}">
                <img src="{{ asset('images/logo_PBL.jpeg') }}"
                     alt="Logo Pulas"
                     class="h-[75px] object-contain mix-blend-multiply">
            </a>
        </div>

        <!-- ADMIN -->
        @if($role == 'admin')

            <nav class="flex justify-center gap-12 text-[20px] font-semibold">
                <a href="{{ route('statistik.admin') }}"
                   class="{{ Route::is('statistik.admin') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba]">
                    Statistik
                </a>

                <a href="{{ route('verifikasi.admin') }}"
                   class="{{ Route::is('verifikasi.admin') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba]">
                    Verifikasi
                </a>
            </nav>

        <!-- RESEPSIONIS -->
        @elseif($role == 'resepsionis')

            <nav class="flex justify-center gap-12 text-[20px] font-semibold">
                <a href="{{ route('dashboard.resepsionis') }}"
                   class="{{ Route::is('dashboard.resepsionis') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba]">
                    Beranda
                </a>

                <a href="{{ route('data.kamar') }}"
                   class="{{ Route::is('data.kamar') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba]">
                    Data Kamar
                </a>
                
                <a href="{{ route('data.reservasi') }}"
                   class="{{ Route::is('data.reservasi') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba]">
                    Data Reservasi
                </a>
            </nav>

        <!-- TAMU -->
        @elseif($role == 'tamu')

            <nav class="flex justify-center gap-12 text-[20px] font-semibold">
                <a href="{{ route('dashboard.tamu') }}"
                   class="{{ Route::is('dashboard.tamu') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba]">
                    Beranda
                </a>

                <a href="{{ route('landing') }}#kamar"
                   class="{{ Route::is('landing') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba]">
                    Kamar
                </a>

                <a href="{{ route('pemesanan') }}"
                   class="{{ Route::is('pemesanan') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba]">
                    Pemesanan
                </a>

                <a href="{{ route('landing') }}#Bantuan"
                   class="text-[#243b53] hover:text-[#7ea1ba]">
                    Bantuan
                </a>
            </nav>

        <!-- BELUM LOGIN / LANDING -->
        @else

            <nav class="flex justify-center gap-12 text-[20px] font-semibold text-[#243b53]">
                <a href="{{ route('landing') }}#beranda" class="hover:text-[#7ea1ba]">
                    Beranda
                </a>

                <a href="{{ route('landing') }}#kamar" class="hover:text-[#7ea1ba]">
                    Kamar
                </a>

                <a href="{{ route('landing') }}#Bantuan" class="hover:text-[#7ea1ba]">
                    Bantuan
                </a>
            </nav>

        @endif

        <!-- ICON PROFILE / LOGIN -->
        <div class="flex justify-end">
            @if($role)
                <a href="{{ route('profile') }}"
                   class="{{ Route::is('profile') ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }} w-12 h-12 rounded-full border border-gray-400 flex items-center justify-center text-[22px] transition hover:bg-[#7ea1ba] hover:text-white">
                    👤
                </a>
            @else
                <button type="button"
                        data-modal-target="login-modal"
                        data-modal-toggle="login-modal"
                        class="w-12 h-12 rounded-full border border-gray-400 bg-white flex items-center justify-center text-[22px] text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white">
                    👤
                </button>
            @endif
        </div>

    </div>
</header>