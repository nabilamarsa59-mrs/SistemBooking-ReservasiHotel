@extends('layouts.app')

@section('title', 'Statistik Admin')

@section('content')
<div class="min-h-screen bg-[#ece6da] px-10 py-8 font-serif text-[#243b53]">

    <div class="mb-8">
        <h1 class="text-[28px] font-semibold">
            Manajemen Pendapatan dan Pertumbuhan
        </h1>
        <p class="mt-1 text-[16px]">
            Rekap dan analisis semua sumber pendapatan dan pertumbuhan hotel.
        </p>
    </div>

    <!-- Pendapatan -->
    <section class="mb-8 border border-gray-400 bg-[#f2eee6] p-6">
        <h2 class="mb-6 text-[22px] font-semibold">
            Pendapatan bulanan
        </h2>

        <div class="flex h-[300px] items-end justify-around border-b border-l border-gray-400 px-8">
            @php
                $pendapatan = [
                    ['bulan' => 'Jan', 'tinggi' => '45%', 'nilai' => 'Rp 45.000.000'],
                    ['bulan' => 'Feb', 'tinggi' => '58%', 'nilai' => 'Rp 58.000.000'],
                    ['bulan' => 'Mar', 'tinggi' => '53%', 'nilai' => 'Rp 53.000.000'],
                    ['bulan' => 'Apr', 'tinggi' => '48%', 'nilai' => 'Rp 48.000.000'],
                    ['bulan' => 'Mei', 'tinggi' => '70%', 'nilai' => 'Rp 85.000.000'],
                ];
            @endphp

            @foreach ($pendapatan as $item)
                <div class="flex flex-col items-center gap-3">
                    <div class="w-12 bg-[#243b53]" style="height: {{ $item['tinggi'] }}"></div>
                    <p class="text-[16px] font-semibold">{{ $item['bulan'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2">
        <div class="border border-gray-400 bg-[#f2eee6] p-5">
            <p class="text-[15px]">Total pendapatan bulan ini</p>
            <h3 class="mt-2 text-[20px] font-semibold">Mei</h3>
            <p class="mt-2 text-[22px] font-semibold">Rp. 85.000.000</p>
        </div>

        <div class="border border-gray-400 bg-[#f2eee6] p-5">
            <p class="text-[15px]">Total pendapatan sebelum bulan ini</p>
            <h3 class="mt-2 text-[20px] font-semibold">April</h3>
            <p class="mt-2 text-[22px] font-semibold">Rp. 63.000.000</p>
        </div>
    </div>

    <!-- Kunjungan -->
    <section class="mb-8 border border-gray-400 bg-[#f2eee6] p-6">
        <h2 class="mb-6 text-[22px] font-semibold">
            Kunjungan bulanan
        </h2>

        <div class="flex h-[300px] items-end justify-around border-b border-l border-gray-400 px-8">
            @php
                $kunjungan = [
                    ['bulan' => 'Jan', 'tinggi' => '42%', 'nilai' => '45 Tamu'],
                    ['bulan' => 'Feb', 'tinggi' => '48%', 'nilai' => '50 Tamu'],
                    ['bulan' => 'Mar', 'tinggi' => '38%', 'nilai' => '42 Tamu'],
                    ['bulan' => 'Apr', 'tinggi' => '52%', 'nilai' => '55 Tamu'],
                    ['bulan' => 'Mei', 'tinggi' => '62%', 'nilai' => '60 Tamu'],
                ];
            @endphp

            @foreach ($kunjungan as $item)
                <div class="flex flex-col items-center gap-3">
                    <div class="w-12 bg-[#243b53]" style="height: {{ $item['tinggi'] }}"></div>
                    <p class="text-[16px] font-semibold">{{ $item['bulan'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div class="border border-gray-400 bg-[#f2eee6] p-5">
            <p class="text-[15px]">Total kunjungan bulan ini</p>
            <h3 class="mt-2 text-[20px] font-semibold">Mei</h3>
            <p class="mt-2 text-[22px] font-semibold">60 Tamu</p>
        </div>

        <div class="border border-gray-400 bg-[#f2eee6] p-5">
            <p class="text-[15px]">Total kunjungan sebelum bulan ini</p>
            <h3 class="mt-2 text-[20px] font-semibold">April</h3>
            <p class="mt-2 text-[22px] font-semibold">55 Tamu</p>
        </div>
    </div>

</div>
@endsection