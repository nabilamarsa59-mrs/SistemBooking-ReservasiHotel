@extends('layouts.app')

@section('title', 'Dashboard Tamu')

@section('content')
    <div class="min-h-screen bg-[#ece6da] font-serif text-[#243b53]">

        <section id="beranda" class="px-6 pt-8 md:px-10">
            <div class="relative flex min-h-[320px] flex-col justify-center overflow-hidden border border-gray-400 bg-cover bg-center px-8"
                style="background-image:
            linear-gradient(rgba(236,230,218,0.85), rgba(236,230,218,0.85)),
            url('{{ asset('images/hotel.png') }}');">

                <div class="max-w-[760px]">
                    <p class="mb-2 text-[17px] italic text-[#4a5f73]">
                        Kamis, 08 April 2026 - Batam, Kepulauan Riau
                    </p>
                    <h1 class="mb-5 text-[42px] font-bold leading-tight text-[#243b53]">
                        Selamat datang, Nabila!
                    </h1>
                    <p class="text-[22px] leading-10 text-[#243b53]">
                        Temukan kamar favorit Anda dan lakukan pemesanan
                        dengan praktis untuk menikmati kenyamanan tanpa batas.
                    </p>
                </div>
            </div>
        </section>

        <section id="section-reservasi" class="px-6 pt-8 md:px-10">
            <div class="border border-gray-400 bg-[#f2eee6] p-6 shadow-sm">
                <div class="mb-5 flex items-center justify-between border-b border-gray-300 pb-4">
                    <div>
                        <h2 class="text-[24px] font-bold uppercase tracking-wide">Pemesanan Aktif</h2>
                        <p class="mt-1 text-[15px] text-[#6b7280]">Detail pemesanan kamar yang sedang berjalan.</p>
                    </div>
                    <span class="rounded-full bg-[#7ea1ba] px-5 py-2 text-[14px] font-semibold text-white">Aktif</span>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-5">
                    <div class="lg:col-span-2">
                        <h3 class="text-[26px] font-bold">Suite - Room 301</h3>
                        <p class="mt-1 text-[15px] text-[#6b7280]">#RSV-011</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-center lg:col-span-3 md:grid-cols-4">
                        <div class="border border-gray-300 bg-white px-4 py-3">
                            <p class="text-[12px] font-bold uppercase text-[#6b7280]">Check-in</p>
                            <p class="mt-1 text-[17px] font-semibold">07 April 2026</p>
                        </div>
                        <div class="border border-gray-300 bg-white px-4 py-3">
                            <p class="text-[12px] font-bold uppercase text-[#6b7280]">Check-out</p>
                            <p class="mt-1 text-[17px] font-semibold">09 April 2026</p>
                        </div>
                        <div class="border border-gray-300 bg-white px-4 py-3">
                            <p class="text-[12px] font-bold uppercase text-[#6b7280]">Durasi</p>
                            <p class="mt-1 text-[17px] font-semibold">2 Malam</p>
                        </div>
                        <div class="border border-gray-300 bg-white px-4 py-3">
                            <p class="text-[12px] font-bold uppercase text-[#6b7280]">Pembayaran</p>
                            <p class="mt-1 text-[17px] font-bold">Rp 3.000.000</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end border-t border-gray-300 pt-4">
                    <button type="button" onclick="openCancelModal()"
                        class="rounded-full border border-red-400 bg-white px-6 py-2 text-[15px] font-semibold text-red-500 transition hover:bg-red-500 hover:text-white">
                        Batalkan Pemesanan
                    </button>
                </div>
            </div>
        </section>

        <div id="modal-cancel" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4"
            onclick="closeCancelModal()">
            <div class="relative w-full max-w-md overflow-hidden rounded-2xl border border-gray-300 bg-[#f2eee6] p-8 shadow-2xl"
                onclick="event.stopPropagation()">

                <div class="mb-4 flex items-center gap-3">
                    <span class="text-[32px]">⚠️</span>
                    <h2 class="text-[22px] font-bold text-[#243b53]">Batalkan Pemesanan?</h2>
                </div>
                <p class="mb-2 text-[15px] leading-7 text-[#4a5568]">Anda akan membatalkan pemesanan berikut:</p>
                <div class="mb-5 space-y-1 rounded-lg border border-gray-300 bg-white/60 p-4 text-[15px] text-[#243b53]">
                    <p><span class="font-semibold">Kamar:</span> Suite - Room 301</p>
                    <p><span class="font-semibold">Kode:</span> #RSV-011</p>
                    <p><span class="font-semibold">Check-in:</span> 07 April 2026</p>
                    <p><span class="font-semibold">Check-out:</span> 09 April 2026</p>
                </div>
                <p class="mb-6 text-[13px] text-red-500">
                    * Pembatalan tidak dapat dibatalkan. Hubungi admin jika ada pertanyaan terkait refund.
                </p>
                <div class="flex gap-3">
                    <button type="button" onclick="closeCancelModal()"
                        class="flex-1 rounded-full border border-gray-400 bg-white py-3 text-[15px] font-semibold text-[#243b53] transition hover:bg-gray-100">
                        Kembali
                    </button>
                    <button type="button" onclick="konfirmasiBatal()"
                        class="flex-1 rounded-full bg-red-500 py-3 text-[15px] font-semibold text-white transition hover:bg-red-600">
                        Ya, Batalkan
                    </button>
                </div>
            </div>
        </div>

        <div id="modal-cancel-success" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4">
            <div
                class="relative w-full max-w-sm overflow-hidden rounded-2xl border border-gray-300 bg-[#f2eee6] p-8 text-center shadow-2xl">
                <span class="text-[48px]">✅</span>
                <h2 class="mt-3 text-[22px] font-bold text-[#243b53]">Pemesanan Dibatalkan</h2>
                <p class="mt-2 text-[14px] text-[#6b7280]">
                    Pemesanan #RSV-011 berhasil dibatalkan. Tim kami akan menghubungi Anda terkait proses selanjutnya.
                </p>
                <button type="button" onclick="tutupSukses()"
                    class="mt-6 w-full rounded-full bg-[#243b53] py-3 text-[15px] font-semibold text-white transition hover:bg-[#7ea1ba]">
                    Tutup
                </button>
            </div>
        </div>

        <section class="px-6 pt-8 md:px-10">
            <div class="mb-6">
                <h2 class="text-[28px] font-bold">Pilihan Kamar Tersedia</h2>
                <p class="mt-1 text-[16px] text-[#6b7280]">Pilih kamar sesuai kebutuhan dan kenyamanan Anda.</p>
            </div>

            <div class="mb-5 border border-gray-400 bg-[#f2eee6] p-5">
                <p class="mb-3 text-[15px] font-semibold text-[#243b53]">🗓️ Cari Kamar Berdasarkan Tanggal</p>

                <div class="flex flex-wrap items-end gap-4">
                    <div class="flex flex-col gap-1">
                        <label class="text-[13px] font-semibold uppercase tracking-wide text-[#6b7280]">Check-in</label>
                        <input type="date" id="filter-checkin"
                            class="rounded-full border border-gray-400 bg-white px-5 py-2 text-[14px] outline-none focus:border-[#7ea1ba]">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[13px] font-semibold uppercase tracking-wide text-[#6b7280]">Check-out</label>
                        <input type="date" id="filter-checkout"
                            class="rounded-full border border-gray-400 bg-white px-5 py-2 text-[14px] outline-none focus:border-[#7ea1ba]">
                    </div>
                    <div class="flex gap-2">
                        <button type="button" onclick="cekKetersediaan()"
                            class="rounded-full bg-[#243b53] px-6 py-2 text-[14px] font-semibold text-white transition hover:bg-[#7ea1ba]">
                            Cek Ketersediaan
                        </button>
                        <button type="button" onclick="resetTanggal()" id="btn-reset-tanggal"
                            class="hidden rounded-full border border-gray-400 bg-white px-5 py-2 text-[14px] font-semibold text-[#243b53] transition hover:bg-gray-100">
                            Reset
                        </button>
                    </div>
                </div>

                <div id="info-tanggal"
                    class="mt-3 hidden items-center gap-2 rounded-lg bg-[#d4e8f5] px-4 py-2 text-[14px] text-[#243b53]">
                    <span>ℹ️</span><span id="info-tanggal-text"></span>
                </div>
                <div id="error-tanggal"
                    class="mt-3 hidden items-center gap-2 rounded-lg bg-red-50 px-4 py-2 text-[14px] text-red-600">
                    <span>⚠️</span><span id="error-tanggal-text"></span>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 text-[15px]">
                <form action="{{ url()->current() }}" method="GET" class="flex flex-wrap items-center gap-3">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan tipe kamar..."
                        class="w-[330px] rounded-full border border-gray-500 bg-white px-5 py-3 outline-none">
                </form>

                <a href="{{ url()->current() }}"
                    class="rounded-full border border-gray-500 px-6 py-3 transition {{ empty(request('category')) ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Semua
                </a>

                @foreach ([
            'deluxe' => 'Kamar Deluxe',
            'suite' => 'Kamar Suite',
            'standar' => 'Kamar Standar',
            'presidential' => 'Kamar Presidential',
        ] as $cat => $label)
                    <a href="{{ url()->current() . '?category=' . $cat }}{{ request('search') ? '&search=' . request('search') : '' }}"
                        class="rounded-full border border-gray-500 px-6 py-3 transition {{ request('category') == $cat ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </section>

        <section id="kamar" class="px-6 pb-12 pt-8 md:px-10">
            <div class="grid grid-cols-1 items-start gap-7 md:grid-cols-2 xl:grid-cols-3">

                @forelse ($rooms as $room)
                    @php
                        $roomSlug = strtolower($room['slug'] ?? $room['name']);
                        $imageMap = [
                            'standar' => 'images/kamar/kamar_standard.jpeg',
                            'suite' => 'images/kamar/kamar_suite.jpeg',
                            'deluxe' => 'images/kamar/kamar_deluxe.jpeg',
                            'presidential' => 'images/kamar/kamar_presidential.jpeg',
                        ];
                        $image = $imageMap[$roomSlug] ?? '';
                        $descMap = [
                            'standar' =>
                                'Kamar Standar kami dirancang untuk memberikan kenyamanan dasar dengan nuansa hangat dan bersih. Cocok untuk tamu yang membutuhkan istirahat berkualitas dengan harga terjangkau.',
                            'suite' =>
                                'Kamar Suite menawarkan pengalaman menginap premium dengan ruangan yang luas dan dekorasi elegan. Ideal untuk pasangan atau tamu yang menginginkan kemewahan lebih.',
                            'deluxe' =>
                                'Kamar Deluxe menghadirkan perpaduan sempurna antara kenyamanan dan gaya. Dengan desain interior modern dan fasilitas lengkap.',
                            'presidential' =>
                                'Presidential Suite adalah puncak kemewahan di Hotel Pulas. Dengan ruang tamu terpisah, kamar mandi eksklusif, dan layanan personal.',
                        ];
                        $desc =
                            $descMap[$roomSlug] ??
                            'Kamar ini hadir dengan fasilitas lengkap dan suasana nyaman untuk menunjang istirahat Anda.';
                    @endphp

                    <div
                        class="flex h-full flex-col border border-gray-400 bg-[#f2eee6] p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                        <div
                            class="flex h-[230px] items-center justify-center overflow-hidden border border-gray-400 bg-[#f7f4ee]">
                            @if ($image)
                                <img src="{{ asset($image) }}" alt="{{ $room['name'] }}"
                                    class="h-full w-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif
                            <div class="hidden h-full w-full items-center justify-center text-[16px] text-[#243b53]">Gambar
                                kamar</div>
                        </div>

                        <div class="mt-5 flex flex-1 flex-col">
                            <h3 class="mb-4 text-[26px] font-semibold">{{ $room['name'] }}</h3>
                            <div class="space-y-2 text-[18px] leading-8">
                                <p>{{ $room['capacity'] }}</p>
                                <p>{{ $room['bed'] }}</p>
                                <p>{{ $room['breakfast'] }}</p>
                            </div>
                            <div class="mt-6 border-t border-gray-300 pt-4 text-right">
                                <p class="text-[24px] font-bold">
                                    Rp {{ number_format($room['price'], 0, ',', '.') }}
                                    <span class="text-[14px] font-normal text-[#6b7280]">/ malam</span>
                                </p>
                                <p class="total-harga-info mt-1 hidden text-[14px] text-[#4a5568]"
                                    data-price="{{ $room['price'] }}"></p>
                            </div>
                            <button type="button" onclick="openRoomPopup('{{ $roomSlug }}')"
                                class="mt-5 w-full rounded-full border border-gray-500 bg-white py-3 text-[17px] transition hover:bg-[#7ea1ba] hover:text-white">
                                Lihat Detail
                            </button>
                        </div>
                    </div>

                    <div id="popup-{{ $roomSlug }}"
                        class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4"
                        onclick="closeRoomPopup('{{ $roomSlug }}')">
                        <div class="relative w-full max-w-lg overflow-hidden rounded-2xl border border-gray-300 bg-[#f2eee6] shadow-2xl"
                            onclick="event.stopPropagation()">

                            <div class="h-[220px] w-full overflow-hidden">
                                @if ($image)
                                    <img src="{{ asset($image) }}" alt="{{ $room['name'] }}"
                                        class="h-full w-full object-cover">
                                @endif
                            </div>

                            <button type="button" onclick="closeRoomPopup('{{ $roomSlug }}')"
                                class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full bg-white/80 text-xl font-bold text-[#243b53] shadow transition hover:bg-red-100 hover:text-red-500">
                                &times;
                            </button>

                            <div class="p-6 text-[#243b53]">
                                <div class="mb-4 flex items-start justify-between gap-4">
                                    <div>
                                        <h2 class="text-[26px] font-semibold">Kamar {{ $room['name'] }}</h2>
                                        <p class="text-[14px] text-[#7b8794]">Hotel Pulas — Kenyamanan Tanpa Batas</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[22px] font-bold">Rp
                                            {{ number_format($room['price'], 0, ',', '.') }}</p>
                                        <p class="text-[13px] text-[#7b8794]">per malam</p>
                                        <p class="popup-total-info hidden text-[13px] font-semibold text-[#243b53]"
                                            data-price="{{ $room['price'] }}"></p>
                                    </div>
                                </div>

                                <p class="mb-4 text-[15px] leading-7 text-[#4a5568]">{{ $desc }}</p>

                                <div class="mb-5 grid grid-cols-2 gap-2 text-[14px]">
                                    <div
                                        class="flex items-center gap-2 rounded-lg border border-gray-200 bg-white/60 px-3 py-2">
                                        <span>👥</span><span>{{ $room['capacity'] }}</span>
                                    </div>
                                    <div
                                        class="flex items-center gap-2 rounded-lg border border-gray-200 bg-white/60 px-3 py-2">
                                        <span>🛏️</span><span>{{ $room['bed'] }}</span>
                                    </div>
                                    <div
                                        class="flex items-center gap-2 rounded-lg border border-gray-200 bg-white/60 px-3 py-2">
                                        <span>🍳</span><span>{{ $room['breakfast'] }}</span>
                                    </div>
                                    <div
                                        class="flex items-center gap-2 rounded-lg border border-gray-200 bg-white/60 px-3 py-2">
                                        <span>📶</span><span>WiFi Gratis</span>
                                    </div>
                                </div>

                                <div id="popup-date-info-{{ $roomSlug }}"
                                    class="mb-4 hidden rounded-lg border border-[#7ea1ba] bg-[#d4e8f5]/50 px-4 py-3 text-[14px] text-[#243b53]">
                                </div>

                                <a href="{{ route('pemesanan', ['type' => $room['name']]) }}"
                                    class="block w-full rounded-full bg-[#243b53] py-3 text-center text-[17px] font-semibold text-white transition hover:bg-[#7ea1ba]">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                @empty
                    <div
                        class="border border-gray-400 bg-[#f2eee6] p-10 text-center text-[18px] md:col-span-2 xl:col-span-3">
                        Kamar yang dicari tidak ditemukan.
                    </div>
                @endforelse
            </div>
        </section>

        <footer id="Bantuan" class="border-t border-gray-300 bg-[#ece6da] px-8 py-5">
            <div class="grid w-full grid-cols-1 gap-5 md:grid-cols-3">
                <div
                    class="flex items-center justify-center gap-3 rounded-md border border-gray-400 bg-[#f2eee6] px-4 py-3">
                    <span class="text-[28px]">☎</span>
                    <div class="leading-tight">
                        <p class="text-[15px] font-semibold">WhatsApp Admin</p>
                        <p class="text-[14px] text-[#7b8794]">+62 812 1111 1111</p>
                    </div>
                </div>
                <div
                    class="flex items-center justify-center gap-3 rounded-md border border-gray-400 bg-[#f2eee6] px-4 py-3">
                    <span class="text-[28px]">✉</span>
                    <div class="leading-tight">
                        <p class="text-[15px] font-semibold">Email</p>
                        <p class="text-[14px] text-[#7b8794]">hotelpulas@gmail.com</p>
                    </div>
                </div>
                <div
                    class="flex items-center justify-center gap-3 rounded-md border border-gray-400 bg-[#f2eee6] px-4 py-3">
                    <span class="text-[28px]">☎</span>
                    <div class="leading-tight">
                        <p class="text-[15px] font-semibold">No.Telepon Hotel</p>
                        <p class="text-[14px] text-[#7b8794]">(021) 222 212</p>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <style>
        body.modal-open {
            overflow: hidden;
        }
    </style>

    <script>
        function openCancelModal() {
            document.getElementById('modal-cancel').classList.remove('hidden');
            document.getElementById('modal-cancel').classList.add('flex');
            document.body.classList.add('modal-open');
        }

        function closeCancelModal() {
            document.getElementById('modal-cancel').classList.add('hidden');
            document.getElementById('modal-cancel').classList.remove('flex');
            document.body.classList.remove('modal-open');
        }

        function konfirmasiBatal() {
            closeCancelModal();
            document.getElementById('modal-cancel-success').classList.remove('hidden');
            document.getElementById('modal-cancel-success').classList.add('flex');
            document.body.classList.add('modal-open');
        }

        function tutupSukses() {
            document.getElementById('modal-cancel-success').classList.add('hidden');
            document.getElementById('modal-cancel-success').classList.remove('flex');
            document.body.classList.remove('modal-open');
            document.getElementById('section-reservasi').style.display = 'none';
        }

        let selectedDurasi = 0;

        const inputCheckin = document.getElementById('filter-checkin');
        const inputCheckout = document.getElementById('filter-checkout');

        inputCheckin.min = new Date().toISOString().split('T')[0];
        inputCheckout.min = new Date().toISOString().split('T')[0];

        inputCheckin.addEventListener('change', function() {
            const next = new Date(this.value);
            next.setDate(next.getDate() + 1);
            const minCo = next.toISOString().split('T')[0];
            inputCheckout.min = minCo;
            if (inputCheckout.value && inputCheckout.value <= this.value) {
                inputCheckout.value = minCo;
            }
        });

        function formatTanggal(dateStr) {
            const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const d = new Date(dateStr);
            return d.getDate() + ' ' + bulan[d.getMonth()] + ' ' + d.getFullYear();
        }

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function cekKetersediaan() {
            const ci = inputCheckin.value;
            const co = inputCheckout.value;
            const errEl = document.getElementById('error-tanggal');
            const errTxt = document.getElementById('error-tanggal-text');
            const infoEl = document.getElementById('info-tanggal');
            const infoTxt = document.getElementById('info-tanggal-text');

            errEl.classList.add('hidden');
            errEl.classList.remove('flex');
            infoEl.classList.add('hidden');
            infoEl.classList.remove('flex');

            if (!ci || !co) {
                errTxt.textContent = 'Harap isi tanggal check-in dan check-out terlebih dahulu.';
                errEl.classList.remove('hidden');
                errEl.classList.add('flex');
                return;
            }
            if (co <= ci) {
                errTxt.textContent = 'Tanggal check-out harus setelah tanggal check-in.';
                errEl.classList.remove('hidden');
                errEl.classList.add('flex');
                return;
            }

            selectedDurasi = Math.round((new Date(co) - new Date(ci)) / (1000 * 60 * 60 * 24));

            infoTxt.textContent =
                `Menampilkan kamar tersedia: ${formatTanggal(ci)} – ${formatTanggal(co)} (${selectedDurasi} malam)`;
            infoEl.classList.remove('hidden');
            infoEl.classList.add('flex');
            document.getElementById('btn-reset-tanggal').classList.remove('hidden');

            document.querySelectorAll('.total-harga-info').forEach(el => {
                const price = parseInt(el.dataset.price);
                el.textContent = `Total ${selectedDurasi} malam: ${formatRupiah(price * selectedDurasi)}`;
                el.classList.remove('hidden');
            });

            document.querySelectorAll('.popup-total-info').forEach(el => {
                const price = parseInt(el.dataset.price);
                el.textContent = `Total ${selectedDurasi}m: ${formatRupiah(price * selectedDurasi)}`;
                el.classList.remove('hidden');
            });

            document.querySelectorAll('[id^="popup-date-info-"]').forEach(el => {
                el.innerHTML = `
                    <p>📅 <strong>Check-in:</strong> ${formatTanggal(ci)}</p>
                    <p>📅 <strong>Check-out:</strong> ${formatTanggal(co)}</p>
                    <p>🌙 <strong>Durasi:</strong> ${selectedDurasi} malam</p>
                `;
                el.classList.remove('hidden');
            });
        }

        function resetTanggal() {
            inputCheckin.value = '';
            inputCheckout.value = '';
            selectedDurasi = 0;

            document.getElementById('info-tanggal').classList.add('hidden');
            document.getElementById('info-tanggal').classList.remove('flex');
            document.getElementById('error-tanggal').classList.add('hidden');
            document.getElementById('error-tanggal').classList.remove('flex');
            document.getElementById('btn-reset-tanggal').classList.add('hidden');

            document.querySelectorAll('.total-harga-info').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.popup-total-info').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('[id^="popup-date-info-"]').forEach(el => el.classList.add('hidden'));
        }

        function openRoomPopup(name) {
            const el = document.getElementById('popup-' + name);
            if (el) {
                el.classList.remove('hidden');
                el.classList.add('flex');
                document.body.classList.add('modal-open');
            }
        }

        function closeRoomPopup(name) {
            const el = document.getElementById('popup-' + name);
            if (el) {
                el.classList.add('hidden');
                el.classList.remove('flex');
                document.body.classList.remove('modal-open');
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^="popup-"], #modal-cancel, #modal-cancel-success').forEach(m => {
                    m.classList.add('hidden');
                    m.classList.remove('flex');
                });
                document.body.classList.remove('modal-open');
            }
        });
    </script>
@endsection
