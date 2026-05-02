@extends('layouts.app')

@section('title', 'Dashboard Resepsionis')

@section('content')

    <div class="bg-[#F2EDE4] min-h-screen px-12 py-10 font-serif text-[#243b53]">

        <div class="mb-8">
            <h1 class="text-[34px] font-bold text-[#0B2A55]">
                Selamat Datang, Revan
            </h1>

            <p class="text-[18px] text-[#47627A] mt-2">
                Kelola data kamar dan reservasi hotel dengan mudah.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-[36px] font-bold text-[#0B2A55]">24</h2>
                        <p class="text-[16px] text-[#47627A]">Kamar tersedia</p>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-[#EAF0FA] flex items-center justify-center text-[26px]">
                        🛏️
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-[36px] font-bold text-[#0B2A55]">8</h2>
                        <p class="text-[16px] text-[#47627A]">Kamar terisi</p>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-[#FFF0C7] flex items-center justify-center text-[26px]">
                        🔑
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-[36px] font-bold text-[#0B2A55]">5</h2>
                        <p class="text-[16px] text-[#47627A]">Check-out hari ini</p>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-[#FCE7E7] flex items-center justify-center text-[26px]">
                        🚪
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-[36px] font-bold text-[#0B2A55]">12</h2>
                        <p class="text-[16px] text-[#47627A]">Check-in hari ini</p>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-[#D8F3DF] flex items-center justify-center text-[26px]">
                        ✅
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md overflow-hidden">

            <div class="px-7 py-6 border-b border-[#E2E8F0]">
                <h2 class="text-[28px] font-bold text-[#0B2A55]">
                    Aktivitas Terbaru
                </h2>
                <p class="text-[16px] text-[#47627A] mt-1">
                    Ringkasan aktivitas reservasi dan kamar hari ini.
                </p>
            </div>

            <div class="p-7 space-y-5">

                <div class="flex items-start gap-4 border-b border-[#E2E8F0] pb-4">
                    <div class="w-11 h-11 rounded-full bg-[#D8F3DF] flex items-center justify-center text-[20px]">
                        ✅
                    </div>
                    <div>
                        <p class="text-[17px] font-semibold text-[#243b53]">
                            Budi baru melakukan check-in di Kamar 205
                        </p>
                        <p class="text-[15px] text-[#47627A]">
                            5 menit yang lalu
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 border-b border-[#E2E8F0] pb-4">
                    <div class="w-11 h-11 rounded-full bg-[#EAF0FA] flex items-center justify-center text-[20px]">
                        📄
                    </div>
                    <div>
                        <p class="text-[17px] font-semibold text-[#243b53]">
                            Reservasi baru dari Ahmad Wijaya untuk tanggal 20 Jan
                        </p>
                        <p class="text-[15px] text-[#47627A]">
                            5 menit yang lalu
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-full bg-[#FCE7E7] flex items-center justify-center text-[20px]">
                        🚪
                    </div>
                    <div>
                        <p class="text-[17px] font-semibold text-[#243b53]">
                            Check-out dari Kamar 102 - Budi Santoso
                        </p>
                        <p class="text-[15px] text-[#47627A]">
                            5 menit yang lalu
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
