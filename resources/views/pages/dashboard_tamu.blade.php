@extends('layouts.app')

@section('title', 'Dashboard Tamu')

@section('content')
<div class="min-h-screen bg-[#ece6da] font-serif text-[#243b53]">
    
    <!-- HEADER: Selamat Datang -->
    <section id="beranda" class="px-6 pt-8 md:px-10">
        <div class="mb-6">
            <h1 class="text-[34px] font-semibold">Selamat datang, Refandy!</h1>
            <p class="text-sm text-gray-600 italic">Kamis, 08 April 2026 - Batam, Kepulauan Riau</p>
        </div>

        <!-- FILTER & SEARCH (Mekanisme diperbaiki agar tetap di halaman ini) -->
        <div class="flex flex-wrap items-center gap-3 text-[15px] mb-8">
            <form action="{{ url()->current() }}" method="GET" class="flex flex-wrap items-center gap-3">
                {{-- Agar kategori tetap terpilih saat search --}}
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari berdasarkan tipe kamar..."
                    class="w-[330px] rounded-sm border border-gray-500 bg-white px-5 py-1 outline-none">
            </form>

            <div class="flex flex-wrap gap-2">
                {{-- Tombol Semua --}}
                <a href="{{ url()->current() }}" 
                   class="border border-gray-500 px-5 py-1 transition {{ empty(request('category')) ? 'bg-[#7ea1ba] text-white' : 'bg-white' }}">
                    Semua
                </a>
                {{-- Looping Kategori --}}
                @foreach(['deluxe', 'suite', 'standar', 'presidential'] as $cat)
                    <a href="{{ url()->current() . '?category=' . $cat }}{{ request('search') ? '&search=' . request('search') : '' }}"
                       class="border border-gray-500 px-5 py-1 transition {{ request('category') == $cat ? 'bg-[#7ea1ba] text-white' : 'bg-white' }}">
                       Kamar {{ ucfirst($cat) }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- RESERVASI AKTIF -->
    <section class="px-6 md:px-10 mb-10">
        <div class="border border-gray-400 p-6 bg-[#f2eee6] shadow-sm">
            <h3 class="text-lg font-bold mb-4 border-b border-gray-300 pb-2 uppercase tracking-wide">Reservasi aktif</h3>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h4 class="text-[22px] font-bold">Suite - Room 301</h4>
                    <p class="text-sm text-gray-500 font-mono">#RSV-011</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center w-full md:w-auto">
                    <div>
                        <p class="text-[10px] uppercase text-gray-500 font-bold">Check-in</p>
                        <p class="font-semibold text-[15px]">07 April 2026</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-gray-500 font-bold">Check-out</p>
                        <p class="font-semibold text-[15px]">09 April 2026</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-gray-500 font-bold">Durasi</p>
                        <p class="font-semibold text-[15px]">2 Malam</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-gray-500 font-bold">Pembayaran</p>
                        <p class="font-bold text-[17px] text-[#243b53]">Rp 1.500.000</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DAFTAR KAMAR -->
    <section id="kamar" class="px-6 pb-10 md:px-10">
        <h3 class="text-[20px] font-bold mb-6">Pilihan kamar tersedia</h3>
        <div class="grid grid-cols-1 items-start gap-7 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($rooms as $room)
                @php
                    $roomSlug = strtolower($room['name']);
                    $imageMap = [
                        'standar' => 'images/kamar/kamar_standard.jpeg',
                        'suite' => 'images/kamar/kamar_suite.jpeg',
                        'deluxe' => 'images/kamar/kamar_deluxe.jpeg',
                        'presidential' => 'images/kamar/kamar_presidential.jpeg',
                    ];
                    $image = $imageMap[$roomSlug] ?? null;
                @endphp

                <div class="flex flex-col border border-gray-400 bg-[#f2eee6] p-4 shadow-sm hover:shadow-md transition">
                    {{-- Container Gambar --}}
                    <div class="h-[220px] border border-gray-400 bg-white mb-4 overflow-hidden flex items-center justify-center">
                        @if($image)
                            <img src="{{ asset($image) }}" class="w-full h-full object-cover" alt="{{ $room['name'] }}">
                        @else
                            <div class="text-gray-400 italic">Gambar Kamar</div>
                        @endif
                    </div>

                    {{-- Info Kamar --}}
                    <h4 class="text-[22px] font-medium mb-3">{{ $room['name'] }}</h4>
                    <div class="text-[16px] space-y-1 mb-5 text-[#243b53] leading-relaxed">
                        <p>{{ $room['capacity'] }}</p>
                        <p>{{ $room['bed'] }}</p>
                        <p>{{ $room['breakfast'] }}</p>
                    </div>

                    <div class="text-right font-bold text-[20px] mb-4 border-t border-gray-300 pt-3">
                        Rp {{ number_format($room['price'], 0, ',', '.') }}
                    </div>

                    <!-- Button Pemesanan -->
                     <a href="{{ route('pemesanan', ['type' => $room['name']]) }}"
                      class="w-full block text-center border border-gray-500 bg-white py-3 text-[17px] hover:bg-[#7ea1ba] hover:text-white transition">
                      Pesan Sekarang
                     </a>



                    <!-- MODAL POPUP -->
                    <div id="popup-{{ $loop->index }}" class="fixed inset-0 z-[9999] hidden flex items-center justify-center bg-black/40 px-4">
                        <div class="w-full max-w-md rounded-lg border border-gray-400 bg-[#f2eee6] p-6 shadow-xl">
                            <div class="mb-4 flex items-center justify-between">
                                <h2 class="text-[24px] font-semibold">{{ $room['name'] }}</h2>
                                <button onclick="document.getElementById('popup-{{ $loop->index }}').classList.add('hidden')" class="text-3xl hover:text-red-600">&times;</button>
                            </div>
                            <div class="space-y-2 mb-6">
                                <p class="text-gray-700 italic mb-4">Kamar {{ $room['name'] }} memiliki fasilitas nyaman untuk tamu hotel.</p>
                                <p><strong>Kapasitas:</strong> {{ $room['capacity'] }}</p>
                                <p><strong>Tempat tidur:</strong> {{ $room['bed'] }}</p>
                                <p><strong>Sarapan:</strong> {{ $room['breakfast'] }}</p>
                                <p class="text-lg font-bold mt-4">Harga: Rp {{ number_format($room['price'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 py-16 text-center border border-dashed border-gray-400 bg-[#f2eee6]/50">
                    <p class="text-lg italic text-gray-500">Kamar yang Anda cari tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </section>
    
    <!-- FOOTER: Bantuan -->
    <footer id="Bantuan" class="border-t border-gray-400 bg-[#ece6da] px-10 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="flex items-center justify-center gap-4 border border-gray-400 bg-[#f2eee6] p-4">
                <span class="text-2xl text-[#243b53]">☎</span>
                <div class="leading-tight text-sm">
                    <p class="font-bold">WhatsApp Admin</p>
                    <p class="text-gray-500">+62 812 1111 1111</p>
                </div>
            </div>
            <div class="flex items-center justify-center gap-4 border border-gray-400 bg-[#f2eee6] p-4">
                <span class="text-2xl text-[#243b53]">✉</span>
                <div class="leading-tight text-sm">
                    <p class="font-bold">Email Support</p>
                    <p class="text-gray-500">support@gmail.com</p>
                </div>
            </div>
            <div class="flex items-center justify-center gap-4 border border-gray-400 bg-[#f2eee6] p-4">
                <span class="text-2xl text-[#243b53]">📞</span>
                <div class="leading-tight text-sm">
                    <p class="font-bold">Hotline Hotel</p>
                    <p class="text-gray-500">(021) 222 212</p>
                </div>
            </div>
        </div>
        
@endsection
