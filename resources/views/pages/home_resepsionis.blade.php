@extends('layouts.app')

@section('title', 'Dashboard Resepsionis')

@section('content')

<div class="bg-[#ece6da] min-h-screen px-10 py-8 font-serif text-[#243b53]">

    <div class="mb-6">
        <h1 class="text-[26px] font-semibold">
            Selamat Datang, Revan
        </h1>

        <p class="text-[16px] mt-1">
            Kelola data kamar dan reservasi hotel dengan mudah.
        </p>
    </div>


    <!-- Statistik -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

        <div class="border border-gray-400 bg-white px-6 py-5">
            <p class="text-[24px] font-semibold">24</p>
            <p class="text-[14px]">Kamar tersedia</p>
        </div>

        <div class="border border-gray-400 bg-white px-6 py-5">
            <p class="text-[24px] font-semibold">8</p>
            <p class="text-[14px]">Kamar terisi</p>
        </div>

        <div class="border border-gray-400 bg-white px-6 py-5">
            <p class="text-[24px] font-semibold">5</p>
            <p class="text-[14px]">Check-out hari ini</p>
        </div>

        <div class="border border-gray-400 bg-white px-6 py-5">
            <p class="text-[24px] font-semibold">12</p>
            <p class="text-[14px]">Tamu menginap</p>
        </div>

    </div>


    <!-- Aktivitas -->
    <div class="border border-gray-400 bg-white p-6">

        <h2 class="text-[22px] font-semibold mb-4">
            Aktivitas Terbaru
        </h2>

        <div class="space-y-4 text-[16px]">

            <div class="border-b pb-2">
                Budi baru melakukan check-in di Kamar 205
                <br>
                <span class="text-sm text-gray-500">
                    5 menit yang lalu
                </span>
            </div>

            <div class="border-b pb-2">
                Reservasi baru dari Ahmad Wijaya untuk tanggal 20 Jan
                <br>
                <span class="text-sm text-gray-500">
                    5 menit yang lalu
                </span>
            </div>

            <div>
                Check-out dari Kamar 102 - Budi Santoso
                <br>
                <span class="text-sm text-gray-500">
                    5 menit yang lalu
                </span>
            </div>

        </div>

    </div>

</div>

@endsection