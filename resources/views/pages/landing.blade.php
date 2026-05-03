@extends('layouts.app')

@section('title', 'Landing')

@section('content')
    <div class="min-h-screen bg-[#ece6da] font-serif">
        <section id="beranda" class="px-6 pt-8 md:px-10">
            <div class="flex min-h-[320px] flex-col items-center justify-center border border-gray-400 px-6 text-center bg-cover bg-center"
                style="background-image:
        linear-gradient(rgba(236,230,218,0.82), rgba(236,230,218,0.82)),
        url('{{ asset('images/hotel.png') }}');">
                <h1 class="mb-8 text-[34px] font-semibold text-[#243b53]">
                    Selamat Datang di Pulas
                </h1>

                <p class="max-w-[900px] text-[22px] leading-[55px] text-[#243b53]">
                    Temukan kamar favorit Anda dan lakukan pemesanan
                    <br>
                    dengan praktis untuk menikmati kenyamanan tanpa batas
                </p>
            </div>
        </section>

        <section class="px-6 pt-5 md:px-10">
            <div class="flex flex-wrap items-center gap-3 text-[15px]">
                <form action="{{ route('landing') }}" method="GET" class="flex flex-wrap items-center gap-3">
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari berdasarkan tipe kamar..."
                        class="w-[330px] rounded-full border border-gray-500 bg-white px-5 py-2 outline-none">
                </form>

                <a href="{{ route('landing') }}"
                    class="rounded-full border border-gray-500 px-5 py-2 {{ empty($selectedCategory) ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Semua
                </a>

                <a href="{{ route('landing', ['category' => 'deluxe']) }}"
                    class="rounded-full border border-gray-500 px-5 py-2 {{ $selectedCategory == 'deluxe' ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Kamar Deluxe
                </a>

                <a href="{{ route('landing', ['category' => 'suite']) }}"
                    class="rounded-full border border-gray-500 px-5 py-2 {{ $selectedCategory == 'suite' ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Kamar Suite
                </a>

                <a href="{{ route('landing', ['category' => 'standar']) }}"
                    class="rounded-full border border-gray-500 px-5 py-2 {{ $selectedCategory == 'standar' ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Kamar Standar
                </a>

                <a href="{{ route('landing', ['category' => 'presidential']) }}"
                    class="rounded-full border border-gray-500 px-5 py-2 {{ $selectedCategory == 'presidential' ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Kamar Presidential
                </a>
            </div>
        </section>

        <section id="kamar" class="px-6 pb-10 pt-6 md:px-10">
            <div class="grid grid-cols-1 items-start gap-7 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($rooms as $room)
                    @php
                        $image = '';
                        if (strtolower($room['name']) == 'standar') {
                            $image = 'images/kamar/kamar_standard.jpeg';
                        } elseif (strtolower($room['name']) == 'suite') {
                            $image = 'images/kamar/kamar_suite.jpeg';
                        } elseif (strtolower($room['name']) == 'deluxe') {
                            $image = 'images/kamar/kamar_deluxe.jpeg';
                        } elseif (strtolower($room['name']) == 'presidential') {
                            $image = 'images/kamar/kamar_presidential.jpeg';
                        }
                    @endphp

                    <div class="flex h-full flex-col border border-gray-400 bg-[#f2eee6] p-4">
                        <div
                            class="flex h-[220px] items-center justify-center overflow-hidden border border-gray-400 bg-[#f7f4ee]">
                            @if ($image)
                                <img src="{{ asset($image) }}" alt="{{ $room['name'] }}"
                                    class="h-full w-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif
                            <div class="hidden h-full w-full items-center justify-center text-[16px] text-[#243b53]">
                                Gambar kamar
                            </div>
                        </div>

                        <div class="mt-4 flex flex-col items-start text-left text-[#243b53]">
                            <p class="mb-3 text-[22px] font-medium">
                                {{ $room['name'] }}
                            </p>
                            <div class="text-[18px] leading-9">
                                <p>{{ $room['capacity'] }}</p>
                                <p>{{ $room['bed'] }}</p>
                                <p>{{ $room['breakfast'] }}</p>
                            </div>
                        </div>

                        <div class="mt-5 text-right text-[22px] font-medium text-[#243b53]">
                            Rp {{ number_format($room['price'], 0, ',', '.') }}
                        </div>

                        <button type="button" onclick="openRoomPopup('{{ strtolower($room['name']) }}')"
                            class="mt-4 w-full rounded-full border border-gray-500 bg-white py-3 text-[17px] transition hover:bg-[#7ea1ba] hover:text-white">
                            Lihat detail
                        </button>
                    </div>
                @empty
                    <div
                        class="border border-gray-400 bg-[#f2eee6] p-8 text-center text-[18px] text-[#243b53] md:col-span-2 xl:col-span-3">
                        Kamar yang dicari tidak ditemukan.
                    </div>
                @endforelse
            </div>

            @foreach ($rooms as $i => $room)
                @php
                    $image = '';
                    if (strtolower($room['name']) == 'standar') {
                        $image = 'images/kamar/kamar_standard.jpeg';
                    } elseif (strtolower($room['name']) == 'suite') {
                        $image = 'images/kamar/kamar_suite.jpeg';
                    } elseif (strtolower($room['name']) == 'deluxe') {
                        $image = 'images/kamar/kamar_deluxe.jpeg';
                    } elseif (strtolower($room['name']) == 'presidential') {
                        $image = 'images/kamar/kamar_presidential.jpeg';
                    }
                @endphp

                <div id="popup-{{ strtolower($room['name']) }}"
                    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4"
                    onclick="this.classList.add('hidden'); this.classList.remove('flex')">
                    <div class="relative w-full max-w-lg rounded-2xl border border-gray-300 bg-[#f2eee6] shadow-2xl overflow-hidden"
                        onclick="event.stopPropagation()">

                        <div class="h-[220px] w-full overflow-hidden">
                            @if ($image)
                                <img src="{{ asset($image) }}" alt="{{ $room['name'] }}"
                                    class="h-full w-full object-cover" onerror="this.style.display='none'">
                            @endif
                        </div>

                        <button type="button" onclick="closeRoomPopup('{{ strtolower($room['name']) }}')"
                            class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full bg-white/80 text-[#243b53] shadow hover:bg-red-100 hover:text-red-500 text-xl font-bold transition">
                            &times;
                        </button>

                        <div class="p-6 text-[#243b53]">

                            <div class="mb-4 flex items-start justify-between">
                                <div>
                                    <h2 class="text-[26px] font-semibold">Kamar {{ $room['name'] }}</h2>
                                    <p class="text-[14px] text-[#7b8794]">Hotel Pulas — Kenyamanan Tanpa Batas</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[22px] font-bold text-[#243b53]">Rp
                                        {{ number_format($room['price'], 0, ',', '.') }}</p>
                                    <p class="text-[13px] text-[#7b8794]">per malam</p>
                                </div>
                            </div>

                            <p class="mb-4 text-[15px] leading-7 text-[#4a5568]">
                                @if (strtolower($room['name']) == 'standar')
                                    Kamar Standar kami dirancang untuk memberikan kenyamanan dasar dengan nuansa hangat
                                    dan bersih. Cocok untuk tamu yang membutuhkan istirahat berkualitas dengan harga
                                    terjangkau. Dilengkapi dengan tempat tidur yang nyaman dan fasilitas esensial.
                                @elseif (strtolower($room['name']) == 'suite')
                                    Kamar Suite menawarkan pengalaman menginap premium dengan ruangan yang luas dan
                                    dekorasi elegan. Nikmati pemandangan indah dari jendela besar dan fasilitas lengkap
                                    yang memanjakan setiap tamu. Ideal untuk pasangan atau tamu yang menginginkan
                                    kemewahan lebih.
                                @elseif (strtolower($room['name']) == 'deluxe')
                                    Kamar Deluxe menghadirkan perpaduan sempurna antara kenyamanan dan gaya. Dengan
                                    desain interior modern dan fasilitas lengkap, kamar ini memberikan pengalaman
                                    menginap yang tak terlupakan bagi setiap tamu.
                                @elseif (strtolower($room['name']) == 'presidential')
                                    Presidential Suite adalah puncak kemewahan di Hotel Pulas. Dengan ruang tamu
                                    terpisah, kamar mandi eksklusif, dan layanan personal, setiap detail dirancang
                                    untuk memberikan pengalaman menginap setara bintang lima.
                                @else
                                    Kamar {{ $room['name'] }} hadir dengan fasilitas lengkap dan suasana nyaman untuk
                                    menunjang istirahat Anda selama menginap di Hotel Pulas.
                                @endif
                            </p>

                            <div class="mb-5 grid grid-cols-2 gap-2 text-[14px]">
                                <div
                                    class="flex items-center gap-2 rounded-lg bg-white/60 px-3 py-2 border border-gray-200">
                                    <span>👥</span>
                                    <span>{{ $room['capacity'] }}</span>
                                </div>
                                <div
                                    class="flex items-center gap-2 rounded-lg bg-white/60 px-3 py-2 border border-gray-200">
                                    <span>🛏️</span>
                                    <span>{{ $room['bed'] }}</span>
                                </div>
                                <div
                                    class="flex items-center gap-2 rounded-lg bg-white/60 px-3 py-2 border border-gray-200">
                                    <span>🍳</span>
                                    <span>{{ $room['breakfast'] }}</span>
                                </div>
                                <div
                                    class="flex items-center gap-2 rounded-lg bg-white/60 px-3 py-2 border border-gray-200">
                                    <span>📶</span>
                                    <span>WiFi Gratis</span>
                                </div>
                            </div>

                            <a href="{{ route('login.tamu') }}"
                                class="block w-full rounded-full bg-[#243b53] py-3 text-center text-[17px] font-semibold text-white transition hover:bg-[#7ea1ba]">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </section>

        <section id="Bantuan" class="border-t border-gray-300 bg-[#ece6da] px-8 py-4">
            <div class="grid w-full grid-cols-3 gap-8 text-[#243b53]">

                <div
                    class="flex items-center justify-center gap-3 rounded-md border border-gray-400 bg-[#f2eee6] px-4 py-2">
                    <span class="text-[28px]">☎</span>
                    <div class="leading-tight">
                        <p class="text-[14px] font-semibold">WhatsApp Admin</p>
                        <p class="text-[13px] text-[#7b8794]">+62 812 1111 1111</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-center gap-3 rounded-md border border-gray-400 bg-[#f2eee6] px-4 py-2">
                    <span class="text-[28px]">✉</span>
                    <div class="leading-tight">
                        <p class="text-[14px] font-semibold">Email</p>
                        <p class="text-[13px] text-[#7b8794]">hotelpulas@gmail.com</p>
                    </div>
                </div>

                <div
                    class="flex items-center justify-center gap-3 rounded-md border border-gray-400 bg-[#f2eee6] px-4 py-2">
                    <span class="text-[28px]">☎</span>
                    <div class="leading-tight">
                        <p class="text-[14px] font-semibold">No.Telepon Hotel</p>
                        <p class="text-[13px] text-[#7b8794]">(021) 222 212</p>
                    </div>
                </div>

            </div>
        </section>

        <div id="login-modal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/30 px-4">
            <div class="relative w-full max-w-md rounded-2xl border border-gray-300 bg-[#f2eee6] p-6 shadow-lg">
                <button type="button" class="absolute right-4 top-3 text-2xl text-[#243b53] hover:text-red-500"
                    data-modal-hide="login-modal">
                    &times;
                </button>

                <div class="text-center">
                    <h2 class="mb-2 text-[24px] font-semibold text-[#243b53]">
                        Pilih Login
                    </h2>
                    <p class="mb-6 text-[16px] text-[#243b53]">
                        Masuk sebagai siapa?
                    </p>
                </div>

                <div class="flex flex-col gap-4">
                    <a href="{{ route('login') }}"
                        class="rounded-xl border border-[#7ea1ba] bg-[#c6d6e2] px-5 py-3 text-center text-[18px] font-semibold text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white">
                        Login sebagai Admin / Resepsionis
                    </a>

                    <a href="{{ route('login.tamu') }}"
                        class="rounded-xl border border-[#7ea1ba] bg-white px-5 py-3 text-center text-[18px] font-semibold text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white">
                        Login sebagai Tamu
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openRoomPopup(name) {
            const el = document.getElementById('popup-' + name);

            if (el) {
                el.classList.remove('hidden');
                el.classList.add('flex');
            }
        }

        function closeRoomPopup(name) {
            const el = document.getElementById('popup-' + name);

            if (el) {
                el.classList.add('hidden');
                el.classList.remove('flex');
            }
        }
    </script>
@endsection
