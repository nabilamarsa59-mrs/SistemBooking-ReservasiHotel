@extends('layouts.app')

@section('title', 'Pemesanan')

@section('content')
    <div class="min-h-screen bg-[#ece6da] px-8 py-8 font-serif text-[#243b53]">

        <div class="relative mx-auto max-w-[1450px] border border-gray-300 bg-[#f7f3eb] px-10 py-8 shadow-sm">

            {{-- TOMBOL CLOSE --}}
            <a href="{{ route('dashboard.tamu') }}"
                class="absolute right-6 top-6 flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-2xl font-bold text-[#243b53] shadow-sm transition hover:bg-red-100 hover:text-red-600">
                &times;
            </a>

            {{-- HEADER --}}
            <div class="mb-10 text-center">
                <p class="mb-2 text-[15px] italic text-[#6b7280]">
                    Hotel Pulas — Kenyamanan Tanpa Batas
                </p>

                <h1 class="text-[34px] font-bold uppercase tracking-[0.22em] text-[#243b53]">
                    Formulir Pemesanan
                </h1>

                <p class="mt-3 text-[16px] text-[#6b7280]">
                    Lengkapi data berikut untuk melanjutkan proses reservasi kamar.
                </p>
            </div>

            {{-- CONTENT --}}
            <div class="grid grid-cols-1 gap-8 xl:grid-cols-[470px_1fr]">

                {{-- DETAIL KAMAR --}}
                <div class="h-fit border border-gray-300 bg-white p-5 shadow-sm">

                    <div class="h-[250px] overflow-hidden border border-gray-300 bg-[#ece6da]">
                        <img src="{{ asset($selectedRoom['image']) }}" alt="{{ $type }}"
                            class="h-full w-full object-cover">
                    </div>

                    <div class="mt-5 border-b border-gray-300 pb-4">
                        <h2 class="text-[30px] font-bold text-[#243b53]">
                            {{ $type }}
                        </h2>

                        <p class="mt-1 text-[15px] text-[#6b7280]">
                            Detail kamar pilihan Anda
                        </p>
                    </div>

                    <div class="my-5 space-y-4 text-[16px] text-[#4b5563]">
                        <p>👥 2 Dewasa</p>
                        <p>🛏 {{ $selectedRoom['desc'] }}</p>
                        <p>📌 Tidak bisa refund</p>
                        <p>📶 WiFi Gratis</p>
                    </div>

                    <div class="border-t border-gray-300 pt-5">
                        <div class="flex items-center justify-between">
                            <p class="text-[15px] text-[#6b7280]">
                                Harga kamar
                            </p>

                            <p class="text-[18px] font-bold text-[#243b53]">
                                Rp {{ number_format($selectedRoom['price'], 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="mt-4 rounded-md bg-[#ece6da] px-4 py-3">
                            <p class="text-[13px] text-[#6b7280]">
                                Total Pembayaran
                            </p>

                            <p class="text-[24px] font-bold text-[#243b53]">
                                Rp {{ number_format($selectedRoom['price'], 0, ',', '.') }}
                            </p>
                        </div>

                        <p class="mt-3 text-[14px] font-semibold italic text-red-600">
                            Sisa 2 kamar!
                        </p>
                    </div>
                </div>

                {{-- FORM --}}
                <form action="{{ route('pemesanan.store') }}" method="POST">
                    @csrf

                    <div class="mb-6 border-b border-gray-300 pb-4">
                        <h2 class="text-[24px] font-bold text-[#243b53]">
                            Data Pemesan
                        </h2>
                        <p class="mt-1 text-[15px] text-[#6b7280]">
                            Pastikan data yang diisi sudah benar.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 md:grid-cols-2">

                        <div>
                            <label class="mb-2 block font-bold">Nama Lengkap</label>
                            <input type="text" placeholder="Nama lengkap"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba]">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">NIK</label>
                            <input type="text" placeholder="NIK"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba]">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">No. Telepon</label>
                            <input type="text" placeholder="No. Telepon"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba]">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Email</label>
                            <input type="email" placeholder="example@gmail.com"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba]">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Check-in</label>
                            <input type="date"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba]">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Check-out</label>
                            <input type="date"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba]">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Jumlah Kamar</label>
                            <input type="number" value="1" min="1"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba]">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Jumlah Tamu</label>
                            <input type="number" value="2" min="1"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba]">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Metode Pembayaran</label>
                            <select
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba]">
                                <option>Transfer Bank</option>
                                <option>E-Wallet</option>
                                <option>Bayar di Hotel</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Total Pembayaran</label>
                            <input type="text" readonly
                                value="Rp {{ number_format($selectedRoom['price'], 0, ',', '.') }}"
                                class="w-full rounded-md border border-gray-300 bg-[#ece6da] px-4 py-3 font-bold text-[#243b53] outline-none">
                        </div>
                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2">
                        <a href="{{ route('dashboard.tamu') }}"
                            class="rounded-full border border-[#243b53] bg-white py-3 text-center text-[17px] font-bold text-[#243b53] transition hover:bg-red-100 hover:text-red-600">
                            Batalkan
                        </a>

                        <button type="submit"
                            class="rounded-full bg-[#243b53] py-3 text-[17px] font-bold text-white transition hover:bg-[#7ea1ba]">
                            Konfirmasi Pesanan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
