@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')
<!-- file: resources/views/kamar/index.blade.php -->

<div class="min-h-screen bg-[#ece6da] px-10 py-6 font-serif text-[#243b53]">

    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-[28px] font-semibold">Manajemen Kamar</h1>

        <button class="border border-gray-500 bg-white px-8 py-2 hover:bg-[#7ea1ba] hover:text-white">
            +Tambah kamar
        </button>
    </div>

    <div class="mb-8 grid grid-cols-4 gap-8 px-20 text-center">
        <div class="border border-gray-500 bg-white p-6">
            <h2 class="text-[24px] font-semibold">Total kamar</h2>
            <p class="text-[48px] font-semibold">10</p>
            <p>4 tipe kamar</p>
        </div>

        <div class="border border-gray-500 bg-white p-6">
            <h2 class="text-[24px] font-semibold">Tersedia</h2>
            <p class="text-[48px] font-semibold">5</p>
            <p>50% Dari total</p>
        </div>

        <div class="border border-gray-500 bg-white p-6">
            <h2 class="text-[24px] font-semibold">Terisi</h2>
            <p class="text-[48px] font-semibold">3</p>
            <p>30% Dari total</p>
        </div>

        <div class="border border-gray-500 bg-white p-6">
            <h2 class="text-[24px] font-semibold">Perbaikan</h2>
            <p class="text-[48px] font-semibold">2</p>
            <p>20% Dari total</p>
        </div>
    </div>

    <div class="mb-8 grid grid-cols-5 gap-2">
        <input
            type="text"
            placeholder="Cari berdasarkan nomor atau tipe kamar..."
            class="col-span-2 border border-gray-500 bg-white px-4 py-2 outline-none"
        >

        <button class="border border-gray-500 bg-white py-2 hover:bg-[#7ea1ba] hover:text-white">Semua</button>
        <button class="border border-gray-500 bg-white py-2 hover:bg-[#7ea1ba] hover:text-white">Tersedia</button>
        <button class="border border-gray-500 bg-white py-2 hover:bg-[#7ea1ba] hover:text-white">Penuh</button>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2 border border-gray-500 bg-white">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-500">
                        <th class="px-4 py-4">No. Kamar</th>
                        <th class="px-4 py-4">Jenis</th>
                        <th class="px-4 py-4">Harga/malam</th>
                        <th class="px-4 py-4">Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b border-gray-400">
                        <td class="px-4 py-4">201</td>
                        <td class="px-4 py-4">Deluxe</td>
                        <td class="px-4 py-4">Rp. 520.000</td>
                        <td class="px-4 py-4">Tersedia</td>
                    </tr>

                    <tr class="border-b border-gray-400">
                        <td class="px-4 py-4">302</td>
                        <td class="px-4 py-4">Suite</td>
                        <td class="px-4 py-4">Rp. 750.000</td>
                        <td class="px-4 py-4">Tersedia</td>
                    </tr>

                    <tr class="border-b border-gray-400">
                        <td class="px-4 py-4">103</td>
                        <td class="px-4 py-4">Standard</td>
                        <td class="px-4 py-4">Rp. 480.000</td>
                        <td class="px-4 py-4">Terisi</td>
                    </tr>

                    <tr>
                        <td class="px-4 py-4">405</td>
                        <td class="px-4 py-4">Presidental</td>
                        <td class="px-4 py-4">Rp. 920.000</td>
                        <td class="px-4 py-4">Perbaikan</td>
                    </tr>
                </tbody>
            </table>

            <div class="flex items-center justify-between border-t border-gray-500 px-4 py-3">
                <p>Menampilkan 1-4 dari 10 kamar</p>

                <div class="flex gap-2">
                    <button class="border border-gray-500 px-3">&lt;</button>
                    <button class="border border-gray-500 px-3">1</button>
                    <button class="border border-gray-500 px-3">2</button>
                    <button class="border border-gray-500 px-3">3</button>
                    <button class="border border-gray-500 px-3">&gt;</button>
                </div>
            </div>
        </div>

        <div class="border border-gray-500 bg-white p-5">
            <h2 class="text-[22px] font-semibold">Edit kamar</h2>
            <p class="mb-5 text-[14px]">Silakan masukkan detail kamar di bawah ini.</p>

            <label class="block text-[14px]">Masukkan nomor kamar</label>
            <input value="103" class="mb-3 w-full border border-gray-500 px-3 py-2">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[14px]">Tipe kamar</label>
                    <input value="Standard" class="w-full border border-gray-500 px-3 py-2">
                </div>

                <div>
                    <label class="block text-[14px]">Lantai</label>
                    <input value="1" class="w-full border border-gray-500 px-3 py-2">
                </div>

                <div>
                    <label class="block text-[14px]">Harga/malam</label>
                    <input value="Rp. 480.000" class="w-full border border-gray-500 px-3 py-2">
                </div>

                <div>
                    <label class="block text-[14px]">Kapasitas</label>
                    <input value="2 Orang" class="w-full border border-gray-500 px-3 py-2">
                </div>
            </div>

            <label class="mt-3 block text-[14px]">Status</label>
            <input value="Terisi" class="mb-5 w-full border border-gray-500 px-3 py-2">

            <div class="flex justify-end gap-4">
                <button class="border border-gray-500 px-6 py-2 hover:bg-red-400 hover:text-white">
                    Hapus
                </button>
                <button class="border border-gray-500 px-6 py-2 hover:bg-[#7ea1ba] hover:text-white">
                    Simpan
                </button>
            </div>
        </div>
    </div>

</div>
@endsection