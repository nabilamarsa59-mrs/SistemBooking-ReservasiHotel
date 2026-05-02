@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#ece6da] font-serif text-[#243b53] p-10">
    <div class="max-w-5xl mx-auto border border-gray-400 bg-[#f2eee6] p-8 shadow-sm">
        <h1 class="text-center text-2xl font-bold mb-8 uppercase tracking-widest">Formulir Pemesanan</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- SISI KIRI: Detail Kamar -->
            <div class="border border-gray-400 p-4 bg-white">
                <div class="h-48 border border-gray-300 bg-gray-100 mb-4 overflow-hidden">
                    <img src="{{ asset($selectedRoom['image']) }}" class="w-full h-full object-cover">
                </div>
                <h3 class="font-bold border-b border-gray-300 pb-2 mb-2">{{ $type }}</h3>
                <div class="text-sm space-y-1 mb-6 text-gray-600">
                    <p>2 Dewasa</p>
                    <p>{{ $selectedRoom['desc'] }}</p>
                    <p>Tidak bisa refund</p>
                </div>
                <div class="text-right border-t border-gray-300 pt-4">
                    <p class="text-xs">Rp {{ number_format($selectedRoom['price'], 0, ',', '.') }}</p>
                    <p class="font-bold text-lg">Total {{ number_format($selectedRoom['price'], 0, ',', '.') }}</p>
                    <p class="text-[10px] text-gray-500">(tidak termasuk pajak)</p>
                    <p class="text-red-600 text-xs font-bold mt-2 italic">Sisa 2 kamar!</p>
                </div>
                <button class="none"></button>
            </div>

            <!-- SISI KANAN: Formulir -->
            <div class="md:col-span-2 grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold mb-1">Nama Lengkap</label>
                        <input type="text" class="w-full border border-gray-400 bg-white/50 px-3 py-2 outline-none" placeholder="Nama lengkap">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">No. Telepon</label>
                        <input type="text" class="w-full border border-gray-400 bg-white/50 px-3 py-2 outline-none" placeholder="No.tlp">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Check-in</label>
                        <input type="date" class="w-full border border-gray-400 bg-white/50 px-3 py-2 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Jumlah kamar</label>
                        <input type="number" class="w-full border border-gray-400 bg-white/50 px-3 py-2 outline-none" value="1">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Metode Pembayaran</label>
                        <select class="w-full border border-gray-400 bg-white/50 px-3 py-2 outline-none">
                            <option>Transfer Bank</option>
                            <option>E-Wallet</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold mb-1">NIK</label>
                        <input type="text" class="w-full border border-gray-400 bg-white/50 px-3 py-2 outline-none" placeholder="NIK">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Email</label>
                        <input type="email" class="w-full border border-gray-400 bg-white/50 px-3 py-2 outline-none" placeholder="example@gmail.com">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Check-out</label>
                        <input type="date" class="w-full border border-gray-400 bg-white/50 px-3 py-2 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Jumlah Tamu</label>
                        <input type="number" class="w-full border border-gray-400 bg-white/50 px-3 py-2 outline-none" value="2">
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Total Pembayaran</label>
                        <input type="text" readonly class="w-full border border-gray-400 bg-gray-200 px-3 py-2 outline-none font-bold" value="Rp {{ number_format($selectedRoom['price'], 0, ',', '.') }}">
                    </div>
                </div>

                <div class="col-span-2 flex justify-center mt-6">
                    <button class="w-full mt-4 border border-gray-800 py-1 font-bold hover:bg-gray-800 hover:text-white transition">Konfirmasi pesanan</button>
                </div>
            </div>
        </div>
    </div>
    

</div>
@endsection
