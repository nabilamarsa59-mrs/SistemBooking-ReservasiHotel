@extends('layouts.app')

@section('title', 'Pemesanan')

@section('content')
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'route' => route('dashboard.tamu')],
        ['label' => 'Pemesanan Kamar']
    ]" />
    
    <div class="min-h-screen bg-[#ece6da] px-8 py-8 font-serif text-[#243b53]">

        <div class="relative mx-auto max-w-[1450px] border border-gray-300 bg-[#f7f3eb] px-10 py-8 shadow-sm">

            <a href="{{ route('dashboard.tamu') }}"
                class="absolute right-6 top-6 flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-2xl font-bold text-[#243b53] shadow-sm transition hover:bg-red-100 hover:text-red-600">
                &times;
            </a>

            <div class="mb-10 text-center">
                <p class="mb-2 text-[15px] italic text-[#6b7280]">Hotel Pulas — Kenyamanan Tanpa Batas</p>
                <h1 class="text-[34px] font-bold uppercase tracking-[0.22em] text-[#243b53]">Formulir Pemesanan</h1>
                <p class="mt-3 text-[16px] text-[#6b7280]">Lengkapi data berikut untuk melanjutkan proses reservasi kamar.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-300 bg-red-50 px-6 py-4 text-red-700">
                    <p class="font-semibold">⚠️ Pemesanan gagal:</p>
                    <ul class="mt-2 list-inside list-disc text-[15px]">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-300 bg-green-50 px-6 py-4 text-green-700 font-semibold">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-8 xl:grid-cols-[470px_1fr]">

                {{-- INFO KAMAR --}}
                <div class="h-fit border border-gray-300 bg-white p-5 shadow-sm">

                    <div class="h-[250px] overflow-hidden border border-gray-300 bg-[#ece6da]">
                        <img src="{{ asset($image) }}" alt="{{ $tipeKamar->detail_kamar }}"
                            class="h-full w-full object-cover"
                            onerror="this.src='{{ asset('images/hotel.png') }}'">
                    </div>

                    <div class="mt-5 border-b border-gray-300 pb-4">
                        <h2 class="text-[30px] font-bold text-[#243b53]">{{ $tipeKamar->detail_kamar }}</h2>
                        <p class="mt-1 text-[15px] text-[#6b7280]">Detail kamar pilihan Anda</p>
                    </div>

                    <div class="my-5 space-y-3 text-[15px] text-[#4b5563]">
                        @foreach (explode(',', $tipeKamar->fasilitas ?? '') as $fas)
                            <p>✓ {{ trim($fas) }}</p>
                        @endforeach
                        <p>📌 Tidak bisa refund</p>
                        <p>📶 WiFi Gratis</p>
                    </div>

                    <div class="border-t border-gray-300 pt-5">
                        <div class="flex items-center justify-between">
                            <p class="text-[15px] text-[#6b7280]">Harga per malam</p>
                            <p class="text-[18px] font-bold text-[#243b53]">
                                Rp {{ number_format($tipeKamar->harga_kamar, 0, ',', '.') }}
                            </p>
                        </div>

                        <div id="total-box" class="mt-4 rounded-md bg-[#ece6da] px-4 py-3">
                            <p class="text-[13px] text-[#6b7280]">Total Pembayaran</p>
                            <p id="total-harga" class="text-[24px] font-bold text-[#243b53]">
                                Rp {{ number_format($tipeKamar->harga_kamar, 0, ',', '.') }}
                            </p>
                            <p id="total-durasi" class="text-[13px] text-[#6b7280]"></p>
                        </div>

                        {{-- Status ketersediaan --}}
                        @if ($totalKamarTersedia > 0)
                            <p class="mt-3 text-[14px] font-semibold text-green-600">
                                ✅ {{ $totalKamarTersedia }} kamar tersedia
                            </p>
                        @else
                            <p class="mt-3 text-[14px] font-semibold text-red-600">
                                ❌ Kamar tidak tersedia
                            </p>
                        @endif
                    </div>
                </div>

                <form action="{{ route('pemesanan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_tipe" value="{{ $tipeKamar->id_tipe }}">

                    <div class="mb-6 border-b border-gray-300 pb-4">
                        <h2 class="text-[24px] font-bold text-[#243b53]">Data Pemesan</h2>
                        <p class="mt-1 text-[15px] text-[#6b7280]">Pastikan data yang diisi sudah benar.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-5 md:grid-cols-2">

                        <div>
                            <label class="mb-2 block font-bold">Nama Lengkap</label>
                            <input type="text" value="{{ $tamu->name }}" readonly
                                class="w-full rounded-md border border-gray-200 bg-gray-100 px-4 py-3 text-[#6b7280] outline-none cursor-not-allowed">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">NIK</label>
                            <input type="text" value="{{ $tamu->nik }}" readonly
                                class="w-full rounded-md border border-gray-200 bg-gray-100 px-4 py-3 text-[#6b7280] outline-none cursor-not-allowed">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">No. Telepon</label>
                            <input type="text" value="{{ $tamu->phone }}" readonly
                                class="w-full rounded-md border border-gray-200 bg-gray-100 px-4 py-3 text-[#6b7280] outline-none cursor-not-allowed">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Email</label>
                            <input type="email" value="{{ $tamu->email }}" readonly
                                class="w-full rounded-md border border-gray-200 bg-gray-100 px-4 py-3 text-[#6b7280] outline-none cursor-not-allowed">
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Check-in</label>
                            <input type="date" name="check_in" id="check_in"
                                min="{{ now()->toDateString() }}"
                                value="{{ old('check_in') }}"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba] @error('check_in') border-red-400 @enderror"
                                required>
                            @error('check_in')
                                <p class="mt-1 text-[13px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block font-bold">Check-out</label>
                            <input type="date" name="check_out" id="check_out"
                                min="{{ now()->addDay()->toDateString() }}"
                                value="{{ old('check_out') }}"
                                class="w-full rounded-md border border-gray-300 bg-[#fafafa] px-4 py-3 outline-none focus:border-[#7ea1ba] @error('check_out') border-red-400 @enderror"
                                required>
                            @error('check_out')
                                <p class="mt-1 text-[13px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div id="ringkasan" class="mt-6 hidden rounded-xl border border-[#7ea1ba] bg-[#d4e8f5]/40 px-5 py-4 text-[15px] text-[#243b53]">
                        <p class="mb-2 font-bold">📋 Ringkasan Pemesanan</p>
                        <div class="grid grid-cols-2 gap-2">
                            <p>Tipe Kamar</p><p class="font-semibold">{{ $tipeKamar->detail_kamar }}</p>
                            <p>Check-in</p><p id="ring-ci" class="font-semibold">-</p>
                            <p>Check-out</p><p id="ring-co" class="font-semibold">-</p>
                            <p>Durasi</p><p id="ring-durasi" class="font-semibold">-</p>
                            <p>Total</p><p id="ring-total" class="font-semibold text-[#243b53]">-</p>
                        </div>
                    </div>

                    <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2">
                        <a href="{{ route('dashboard.tamu') }}"
                            class="rounded-full border border-[#243b53] bg-white py-3 text-center text-[17px] font-bold text-[#243b53] transition hover:bg-red-100 hover:text-red-600">
                            Batalkan
                        </a>
                        @if ($totalKamarTersedia > 0)
                            <button type="submit"
                                class="rounded-full bg-[#243b53] py-3 text-[17px] font-bold text-white transition hover:bg-[#7ea1ba]">
                                Konfirmasi Pesanan
                            </button>
                        @else
                            <button type="button" disabled
                                class="rounded-full bg-gray-300 py-3 text-[17px] font-bold text-gray-500 cursor-not-allowed">
                                Kamar Tidak Tersedia
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const hargaPerMalam = {{ $tipeKamar->harga_kamar }};
        const inputCi  = document.getElementById('check_in');
        const inputCo  = document.getElementById('check_out');

        function formatTanggal(dateStr) {
            const bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            const d = new Date(dateStr);
            return d.getDate() + ' ' + bulan[d.getMonth()] + ' ' + d.getFullYear();
        }

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function hitungTotal() {
            const ci = inputCi.value;
            const co = inputCo.value;

            if (!ci || !co || co <= ci) {
                document.getElementById('ringkasan').classList.add('hidden');
                return;
            }

            const durasi = Math.round((new Date(co) - new Date(ci)) / (1000 * 60 * 60 * 24));
            const total  = durasi * hargaPerMalam;

            // Update panel kiri
            document.getElementById('total-harga').textContent  = formatRupiah(total);
            document.getElementById('total-durasi').textContent = durasi + ' malam × ' + formatRupiah(hargaPerMalam);

            // Update ringkasan
            document.getElementById('ring-ci').textContent     = formatTanggal(ci);
            document.getElementById('ring-co').textContent     = formatTanggal(co);
            document.getElementById('ring-durasi').textContent = durasi + ' malam';
            document.getElementById('ring-total').textContent  = formatRupiah(total);
            document.getElementById('ringkasan').classList.remove('hidden');
        }

        inputCi.addEventListener('change', function () {
            // Set minimum check_out = check_in + 1 hari
            const next = new Date(this.value);
            next.setDate(next.getDate() + 1);
            inputCo.min = next.toISOString().split('T')[0];
            if (inputCo.value && inputCo.value <= this.value) inputCo.value = '';
            hitungTotal();
        });

        inputCo.addEventListener('change', hitungTotal);

        // Jalankan saat load jika ada nilai lama (old input setelah error)
        if (inputCi.value && inputCo.value) hitungTotal();
    </script>
@endsection
