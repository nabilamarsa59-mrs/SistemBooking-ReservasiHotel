@extends('layouts.app')
@section('title', 'Dashboard Tamu')
@section('content')
@php

    $daftar_kamar = [
        [
            'tipe' => 'standard',
            'nama' => 'Standard Room',
            'harga' => '250.000',
            'fasilitas' => '2 Dewasa | 1 Ranjang | No Breakfast',
            'icon' => ''
        ],
        [
            'tipe' => 'deluxe',
            'nama' => 'Deluxe Room',
            'harga' => '1.100.000',
            'fasilitas' => '2 Dewasa | 1 Ranjang | Breakfast',
            'icon' => ''
        ],
        [
            'tipe' => 'suite',
            'nama' => 'Suite Room',
            'harga' => '1.500.000',
            'fasilitas' => '2 Dewasa | 1 Ranjang | Breakfast',
            'icon' => ''
        ],
        [
            'tipe' => 'presidential',
            'nama' => 'Presidential Room',
            'harga' => '1.900.000',
            'fasilitas' => '2 Dewasa | 1 Ranjang | Breakfast',
            'icon' => ''
        ],
    ];
@endphp

<<<<<<< HEAD
=======

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulas Dashboard - Guest</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">


>>>>>>> 346367225c2fcb8913f2a40941bb28991caf7085
    <main class="max-w-6xl mx-auto p-8">
        <section class="mb-8">
            <h1 class="text-3xl font-bold italic">Selamat datang, Revan!</h1>
            <p class="text-gray-500 text-sm">Senin, 20 April 2026 - Batam, Kepulauan Riau</p>
        </section>

        <!-- FILTER BUTTONS -->
        <section class="mb-10 flex flex-wrap gap-2">
            <input type="text" placeholder="Cari tipe kamar..." class="flex-1 border border-gray-300 px-4 py-2 rounded focus:border-black outline-none transition">
            <button onclick="filterKamar('all')" class="btn-primary border-black text-white px-4 py-2 rounded text-sm hover:opacity-80">Semua</button>
            <button onclick="filterKamar('standard')" class="btn-primary border-black px-4 py-2 rounded text-sm hover:bg-black hover:text-white transition">Standard</button>
            <button onclick="filterKamar('deluxe')" class="btn-primary border-black px-4 py-2 rounded text-sm hover:bg-black hover:text-white transition">Deluxe</button>
            <button onclick="filterKamar('suite')" class="btn-primary border-black px-4 py-2 rounded text-sm hover:bg-black hover:text-white transition">Suite</button>
            <button onclick="filterKamar('presidential')" class="btn-primary border-black px-4 py-2 rounded text-sm hover:bg-black hover:text-white transition">Presidential</button>
        </section>

        <div id="container-kamar" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- INI ADALAH LOGIKA LOOPING BLADE (Sangat bersih & profesional) --}}
            @foreach($daftar_kamar as $kamar)
                <div class="kamar-item {{ $kamar['tipe'] }} border border-gray-300 p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="bg-gray-100 aspect-video mb-4 flex items-center justify-center text-5xl rounded">
                        {{ $kamar['icon'] }}
                    </div>
                    <h3 class="font-bold text-lg">{{ $kamar['nama'] }}</h3>
                    <p class="text-[10px] text-gray-500 mb-4 uppercase tracking-tighter">{{ $kamar['fasilitas'] }}</p>
                    <p class="text-right font-bold text-gray-900 mb-2">Rp {{ $kamar['harga'] }}</p>
                    <a href="pemesanan" target="pemesanan" class="block text-center border-2 border-black py-2 text-[10px] font-black hover:bg-black hover:text-white transition">LIHAT DETAIL</a>
                </div>
            @endforeach
        </div>
    </main>
    <script>
        function filterKamar(tipe) {
            const items = document.querySelectorAll('.kamar-item');
            items.forEach(item => {
                if (tipe === 'all' || item.classList.contains(tipe)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>




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
           

</body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</html>
@endsection
