@php

    if (Auth::check()) {
        $role = Auth::user()->role;
        $userName = Auth::user()->name;
    } elseif (Auth::guard('tamu')->check()) {
        $role = 'tamu';
        $userName = Auth::guard('tamu')->user()->nama_lengkap ?? 'Tamu';
    } else {
        $role = session('role');
        $userName = null;
    }

    $isLanding = Route::is('home') || Route::is('landing');
@endphp

<header class="w-full border-b border-gray-400 bg-[#ece6da] px-10 py-5">
    <div class="grid grid-cols-3 items-center">

        <div>
            <a href="{{ route('landing') }}">
                <img src="{{ asset('images/logo_PBL.jpeg') }}" alt="Logo Pulas"
                    class="h-[75px] object-contain mix-blend-multiply">
            </a>
        </div>

        @if ($isLanding)
            <nav class="flex justify-center gap-12 text-[20px] font-semibold text-[#243b53]">
                <a href="{{ route('landing') }}#beranda" class="hover:text-[#7ea1ba]">Beranda</a>
                <a href="{{ route('landing') }}#kamar" class="hover:text-[#7ea1ba]">Kamar</a>
                <a href="{{ route('landing') }}#Bantuan" class="hover:text-[#7ea1ba]">Bantuan</a>
            </nav>

        @elseif($role == 'admin')
            <nav class="flex justify-center gap-8 text-[18px] font-semibold">
                <a href="{{ route('statistik.admin') }}"
                    class="{{ Route::is('statistik.admin') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba] transition">
                    Statistik
                </a>
                <a href="{{ route('verifikasi.admin') }}"
                    class="{{ Route::is('verifikasi.admin') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba] transition">
                    Verifikasi Reservasi
                </a>
            </nav>

        @elseif($role == 'resepsionis')
            <nav class="flex justify-center gap-8 text-[18px] font-semibold">
                <a href="{{ route('home.resepsionis') }}"
                    class="{{ Route::is('home.resepsionis') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba] transition">
                    Beranda
                </a>
                <a href="{{ route('data.kamar') }}"
                    class="{{ Route::is('data.kamar') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba] transition">
                    Data Kamar
                </a>
                <a href="{{ route('data.reservasi') }}"
                    class="{{ Route::is('data.reservasi') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba] transition">
                    Data Pemesanan
                </a>
            </nav>

        @elseif($role == 'tamu')
            <nav class="flex justify-center gap-8 text-[18px] font-semibold">
                <a href="{{ route('dashboard.tamu') }}"
                    class="{{ Route::is('dashboard.tamu') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba] transition">
                    Beranda
                </a>
                <a href="{{ route('pemesanan') }}"
                    class="{{ Route::is('pemesanan') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba] transition">
                    Pemesanan
                </a>
                <a href="{{ route('profil') }}"
                    class="{{ Route::is('profil') ? 'text-[#7ea1ba]' : 'text-[#243b53]' }} hover:text-[#7ea1ba] transition">
                    Faktur & Pembayaran
                </a>
            </nav>
           
        @else
            <nav class="flex justify-center gap-12 text-[20px] font-semibold text-[#243b53]">
                <a href="{{ route('landing') }}#beranda" class="hover:text-[#7ea1ba]">Beranda</a>
                <a href="{{ route('landing') }}#kamar" class="hover:text-[#7ea1ba]">Kamar</a>
                <a href="{{ route('landing') }}#Bantuan" class="hover:text-[#7ea1ba]">Bantuan</a>
            </nav>
        @endif

        <div class="flex justify-end">
            @if ($isLanding)
                <button type="button" data-modal-target="login-modal" data-modal-toggle="login-modal"
                    class="w-12 h-12 rounded-full border border-gray-400 bg-white flex items-center justify-center text-[22px] text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white">
                    👤
                </button>
            @elseif($role == 'admin' || $role == 'resepsionis' || $role == 'tamu')
                <div class="relative group">
                    <button type="button" 
                        class="{{ Route::is('profile', 'profil') ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }} w-12 h-12 rounded-full border border-gray-400 flex items-center justify-center text-[22px] transition hover:bg-[#7ea1ba] hover:text-white">
                        👤
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden group-hover:block group-hover:z-50">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="text-sm font-semibold text-[#243b53]">{{ $userName }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ $role }}</p>
                        </div>
                        
                        @if($role == 'admin' || $role == 'resepsionis')
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-[#243b53] hover:bg-[#f0ebe3] text-sm">
                                ⚙️ Pengaturan Profil
                            </a>
                        @elseif($role == 'tamu')
                            <a href="{{ route('profil') }}" class="block px-4 py-2 text-[#243b53] hover:bg-[#f0ebe3] text-sm">
                                ⚙️ Profil Saya
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ $role == 'tamu' ? route('logout.tamu') : route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-[#f0ebe3] text-sm">
                                🚪 Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <button type="button" data-modal-target="login-modal" data-modal-toggle="login-modal"
                    class="w-12 h-12 rounded-full border border-gray-400 bg-white flex items-center justify-center text-[22px] text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white">
                    👤
                </button>
            @endif
        </div>

    </div>
</header>

<style>
    .group:hover .group-hover\:block {
        display: block;
    }
    
    .group:hover .group-hover\:z-50 {
        z-index: 50;
    }
</style>
