@extends('layouts.app')

@section('title', 'Verifikasi Admin')

@section('content')

<div class="bg-[#ece6da] min-h-screen px-10 py-8">

    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6 mb-6">
        <div>
            <h1 class="text-[34px] font-semibold text-[#243b53]">Verifikasi pembayaran</h1>
            <p class="text-[20px] text-[#243b53] leading-relaxed max-w-[700px]">
                Konfirmasi pembayaran dari tamu untuk menyelesaikan proses reservasi.
            </p>
        </div>

        <div class="flex justify-end">
            <form class="w-full lg:w-auto">
                <input
                    type="text"
                    placeholder="Cari ID. Pemesanan"
                    class="w-full lg:w-[300px] rounded-full border border-gray-400 bg-white px-5 py-3 text-[18px] text-[#243b53] outline-none"
                >
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="border border-gray-400 bg-white p-6">
            <p class="text-[18px] text-gray-400 mb-2">Menunggu Verifikasi</p>
            <div class="flex items-center justify-between">
                <h2 class="text-[40px] font-semibold text-[#243b53]">{{ $statistik['menunggu'] }}</h2>
                <span class="text-[28px] text-[#243b53]">🕒</span>
            </div>
        </div>

        <div class="border border-gray-400 bg-white p-6">
            <p class="text-[18px] text-gray-400 mb-2">Terverifikasi</p>
            <div class="flex items-center justify-between">
                <h2 class="text-[40px] font-semibold text-[#243b53]">{{ $statistik['terverifikasi'] }}</h2>
                <span class="text-[28px] text-[#243b53]">✔</span>
            </div>
        </div>
    </div>

    <div class="border border-gray-400 bg-white">
        <div class="border-b border-gray-400 px-6 py-4">
            <h2 class="text-[28px] font-semibold text-[#243b53]">
                Daftar Pembayaran Menunggu Verifikasi
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left text-[#243b53]">
                <thead>
                    <tr class="border-b border-gray-400">
                        <th class="px-4 py-4 text-[18px] font-semibold">ID. Pemesanan</th>
                        <th class="px-4 py-4 text-[18px] font-semibold">Nama tamu</th>
                        <th class="px-4 py-4 text-[18px] font-semibold">Metode</th>
                        <th class="px-4 py-4 text-[18px] font-semibold">Jumlah</th>
                        <th class="px-4 py-4 text-[18px] font-semibold">Tanggal pembayaran</th>
                        <th class="px-4 py-4 text-[18px] font-semibold">Status</th>
                        <th class="px-4 py-4 text-[18px] font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $item)
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-4 text-[17px]">{{ $item['id'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['nama'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['metode'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['jumlah'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['tanggal'] }}</td>
                            <td class="px-4 py-4 text-[17px] capitalize">{{ $item['status'] }}</td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-2">
                                    <button class="rounded-lg border border-gray-400 bg-white px-3 py-2 text-[16px] transition hover:bg-[#7ea1ba] hover:text-white">
                                        👁
                                    </button>
                                    <button class="rounded-lg border border-gray-400 bg-white px-3 py-2 text-[16px] transition hover:bg-green-500 hover:text-white">
                                        ✔
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection