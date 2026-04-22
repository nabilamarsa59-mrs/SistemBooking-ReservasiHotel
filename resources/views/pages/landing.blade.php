@extends('layouts.app')
@section('title', 'Nama Halaman')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulas Landing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#d9d2c3] font-serif m-0 p-0">

    <div class="w-full min-h-screen bg-[#ece6da]">
        
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

                
            </div>
        </footer>

    </div>


<!-- Modal toggle -->
<button data-modal-target="default-modal" data-modal-toggle="default-modal" class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none" type="button">
  Toggle modal
</button>

<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
            <!-- Modal header -->
            <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-heading">
                    Terms of Service
                </h3>
                <button type="button" class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-4 md:space-y-6 py-4 md:py-6">
                <p class="leading-relaxed text-body">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="leading-relaxed text-body">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center border-t border-default space-x-4 pt-4 md:pt-5">
                <button data-modal-hide="default-modal" type="button" class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">I accept</button>
                <button data-modal-hide="default-modal" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Decline</button>
            </div>
        </div>
    </div>
</div>

</body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</html>
@endsection