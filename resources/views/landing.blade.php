<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulas Landing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#d9d2c3] font-serif m-0 p-0">

    <div class="w-full min-h-screen bg-[#ece6da]">
        
        <!-- Navbar -->
        <nav class="w-full border-b border-gray-400 px-10 py-5 flex items-center justify-between">
            <div class="flex items-center">
                <img src="{{ asset('images/logo_PBL.jpeg') }}" alt="Logo Pulas" class="h-[75px] object-contain mix-blend-multiply">
            </div>

            <div class="flex items-center gap-14 text-[#243b53] text-[18px]">
                <a href="{{ route('landing') }}#beranda" class="hover:text-[#527792] transition">Beranda</a>
                <a href="{{ route('landing') }}#kategori" class="hover:text-[#527792] transition">Kategori</a>
                <a href="{{ route('landing') }}#bantuan" class="hover:text-[#527792] transition">Bantuan</a>
            </div>

            <a href="{{ route('login.choice') }}"
               class="border border-[#7ea1ba] rounded-full px-6 py-3 bg-[#ece6da] text-[#243b53] text-[16px] hover:bg-[#7ea1ba] hover:text-white transition">
                Daftar/Masuk
            </a>
        </nav>

        <!-- Hero -->
        <section id="beranda" class="px-10 pt-8">
            <div class="border border-gray-400 bg-[#f2eee6] h-[320px] flex flex-col items-center justify-center text-center">
                <h1 class="text-[34px] font-semibold text-[#243b53] mb-10">
                    Selamat Datang di Pulas
                </h1>

                <p class="text-[22px] leading-[55px] text-[#243b53] max-w-[900px]">
                    Temukan kamar favorit Anda dan lakukan pemesanan
                    <br>
                    dengan praktis untuk menikmati kenyamanan tanpa batas
                </p>
            </div>
        </section>

        <!-- Search dan kategori -->
        <section id="kategori" class="px-10 pt-5">
            <div class="flex flex-wrap items-center gap-3 text-[15px]">

                <form action="{{ route('landing') }}" method="GET" class="flex items-center gap-3 flex-wrap">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari berdasarkan tipe kamar..."
                        class="border border-gray-500 rounded-full px-5 py-2 w-[330px] bg-white outline-none"
                    >

                    <button type="submit" class="border border-gray-500 rounded-full px-5 py-2 bg-white hover:bg-[#c6d6e2] transition">
                        Cari
                    </button>
                </form>

                <a href="{{ route('landing') }}"
                   class="border border-gray-500 rounded-full px-5 py-2 {{ empty($selectedCategory) ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Semua
                </a>

                <a href="{{ route('landing', ['category' => 'deluxe']) }}"
                   class="border border-gray-500 rounded-full px-5 py-2 {{ $selectedCategory == 'deluxe' ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Kamar Deluxe
                </a>

                <a href="{{ route('landing', ['category' => 'suite']) }}"
                   class="border border-gray-500 rounded-full px-5 py-2 {{ $selectedCategory == 'suite' ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Kamar Suite
                </a>

                <a href="{{ route('landing', ['category' => 'standar']) }}"
                   class="border border-gray-500 rounded-full px-5 py-2 {{ $selectedCategory == 'standar' ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Kamar Standar
                </a>

                <a href="{{ route('landing', ['category' => 'presidential']) }}"
                   class="border border-gray-500 rounded-full px-5 py-2 {{ $selectedCategory == 'presidential' ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Kamar Presidential
                </a>
            </div>
        </section>

        <!-- Card kamar -->
        <section class="px-10 pt-6 pb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7">

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

                    <div class="border border-gray-400 bg-[#f2eee6] p-4">
                        <div class="border border-gray-400 h-[220px] bg-[#f7f4ee] overflow-hidden flex items-center justify-center">
                            @if($image)
                                <img src="{{ asset($image) }}"
                                     alt="{{ $room['name'] }}"
                                     class="w-full h-full object-cover"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif

                            <div class="w-full h-full items-center justify-center text-[#243b53] text-[16px] hidden">
                                Gambar kamar
                            </div>
                        </div>

                        <div class="mt-4 text-[22px] text-[#243b53]">
                            <p class="mb-3 font-medium">{{ $room['name'] }}</p>
                        </div>

                        <div class="text-[18px] leading-9 text-[#243b53]">
                            <p>{{ $room['capacity'] }}</p>
                            <p>{{ $room['bed'] }}</p>
                            <p>{{ $room['breakfast'] }}</p>
                        </div>

                        <div class="text-right mt-5 text-[22px] text-[#243b53] font-medium">
                            Rp {{ number_format($room['price'], 0, ',', '.') }}
                        </div>

                        <button class="w-full mt-4 border border-gray-500 rounded-full py-3 text-[17px] bg-white hover:bg-[#7ea1ba] hover:text-white transition">
                            Lihat detail
                        </button>
                    </div>
                @empty
                    <div class="md:col-span-2 xl:col-span-3 border border-gray-400 bg-[#f2eee6] p-8 text-center text-[#243b53] text-[18px]">
                        Kamar yang dicari tidak ditemukan.
                    </div>
                @endforelse

            </div>
        </section>

        <!-- Footer -->
        <footer id="bantuan" class="px-10 pb-6">
            <div class="border-t border-gray-400 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div class="border border-gray-400 rounded-md px-4 py-4 bg-[#f2eee6] flex items-center gap-3">
                        <div class="text-2xl"></div>
                        <div>
                            <p class="text-[17px] text-[#243b53]">WhatsApp Admin</p>
                            <p class="text-[14px] text-gray-500">+62 812 2233 4455</p>
                        </div>
                    </div>

                    <div class="border border-gray-400 rounded-md px-4 py-4 bg-[#f2eee6] flex items-center gap-3">
                        <div class="text-2xl"></div>
                        <div>
                            <p class="text-[17px] text-[#243b53]">Email Support</p>
                            <p class="text-[14px] text-gray-500">pulas@gmail.com</p>
                        </div>
                    </div>

                    <div class="border border-gray-400 rounded-md px-4 py-4 bg-[#f2eee6] flex items-center gap-3">
                        <div class="text-2xl"></div>
                        <div>
                            <p class="text-[17px] text-[#243b53]">Hotline Hotel</p>
                            <p class="text-[14px] text-gray-500">(021) 222 212</p>
                        </div>
                    </div>

                </div>

                <p class="text-center text-[15px] mt-5 text-[#243b53]">
                    2026 Politeknik Negeri Batam - Projek PBL IFPagi 2A-09
                </p>
            </div>
        </footer>

    </div>

</body>
</html>