@extends('layouts.app')

@section('title', 'Dashboard Tamu')

@section('content')
    <div class="min-h-screen bg-[#ece6da] font-serif text-[#243b53]">

        <section id="beranda" class="px-6 pt-8 md:px-10">
            <div class="flex min-h-[320px] flex-col items-center justify-center border border-gray-400 bg-cover bg-center px-6 text-center"
                style="background-image:
                    linear-gradient(rgba(236,230,218,0.82), rgba(236,230,218,0.82)),
                    url('{{ asset('images/hotel.png') }}');">
                <h1 class="mb-8 text-[34px] font-semibold text-[#243b53]">
                    Selamat Datang, {{ $tamu->name ?? 'Tamu' }}!
                </h1>
                <p class="max-w-[900px] text-[22px] leading-[55px] text-[#243b53]">
                    Temukan kamar favorit Anda dan lakukan pemesanan
                    <br>
                    dengan praktis untuk menikmati kenyamanan tanpa batas
                </p>
            </div>
        </section>

        {{-- PEMESANAN AKTIF --}}
        <section id="section-reservasi" class="px-6 pt-8 md:px-10">
            @if ($reservasiAktif)
                @php
                    $ci = $reservasiAktif->check_in;
                    $co = $reservasiAktif->check_out;
                    $durasi = $ci->diffInDays($co);
                    $harga = $reservasiAktif->tipe->harga_kamar ?? 0;
                    $total = $harga * $durasi;
                @endphp
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
                            <h3 class="text-[26px] font-bold">{{ $reservasiAktif->tipe->detail_kamar ?? '-' }}</h3>
                            <p class="mt-1 text-[15px] text-[#6b7280]">
                                #RSV-{{ str_pad($reservasiAktif->id_reservasi, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-center lg:col-span-3 md:grid-cols-4">
                            <div class="border border-gray-300 bg-white px-4 py-3">
                                <p class="text-[12px] font-bold uppercase text-[#6b7280]">Check-in</p>
                                <p class="mt-1 text-[17px] font-semibold">{{ $ci->translatedFormat('d M Y') }}</p>
                            </div>
                            <div class="border border-gray-300 bg-white px-4 py-3">
                                <p class="text-[12px] font-bold uppercase text-[#6b7280]">Check-out</p>
                                <p class="mt-1 text-[17px] font-semibold">{{ $co->translatedFormat('d M Y') }}</p>
                            </div>
                            <div class="border border-gray-300 bg-white px-4 py-3">
                                <p class="text-[12px] font-bold uppercase text-[#6b7280]">Durasi</p>
                                <p class="mt-1 text-[17px] font-semibold">{{ $durasi }} Malam</p>
                            </div>
                            <div class="border border-gray-300 bg-white px-4 py-3">
                                <p class="text-[12px] font-bold uppercase text-[#6b7280]">Total</p>
                                <p class="mt-1 text-[17px] font-bold">Rp {{ number_format($total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end border-t border-gray-300 pt-4">
                        <button type="button"
                            onclick="openCancelModal(
                                '{{ $reservasiAktif->id_reservasi }}',
                                '{{ $reservasiAktif->tipe->detail_kamar ?? '-' }}',
                                '{{ $ci->translatedFormat('d M Y') }}',
                                '{{ $co->translatedFormat('d M Y') }}'
                            )"
                            class="rounded-full border border-red-400 bg-white px-6 py-2 text-[15px] font-semibold text-red-500 transition hover:bg-red-500 hover:text-white">
                            Batalkan Pemesanan
                        </button>
                    </div>
                </div>
            @else
                <div class="border border-gray-400 bg-[#f2eee6] p-6 shadow-sm">
                    <div class="flex flex-col items-center justify-center py-6 text-center">
                        <span class="text-[48px]">🛏️</span>
                        <h2 class="mt-3 text-[22px] font-bold text-[#243b53]">Belum Ada Pemesanan Aktif</h2>
                        <p class="mt-2 text-[15px] text-[#6b7280]">Pilih kamar di bawah dan mulai pemesanan Anda.</p>
                    </div>
                </div>
            @endif
        </section>

        {{-- MODAL KONFIRMASI BATAL --}}
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
                    <p><span class="font-semibold">Tipe Kamar:</span> <span id="modal-tipe-info"></span></p>
                    <p><span class="font-semibold">Kode:</span> <span id="modal-kode-info"></span></p>
                    <p><span class="font-semibold">Check-in:</span> <span id="modal-ci-info"></span></p>
                    <p><span class="font-semibold">Check-out:</span> <span id="modal-co-info"></span></p>
                </div>
                <p class="mb-6 text-[13px] text-red-500">
                    * Pembatalan tidak dapat dibatalkan. Hubungi admin jika ada pertanyaan terkait refund.
                </p>
                <div class="flex gap-3">
                    <button type="button" onclick="closeCancelModal()"
                        class="flex-1 rounded-full border border-gray-400 bg-white py-3 text-[15px] font-semibold text-[#243b53] transition hover:bg-gray-100">
                        Kembali
                    </button>
                    <form id="form-batal" action="" method="POST" class="flex-1">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="w-full rounded-full bg-red-500 py-3 text-[15px] font-semibold text-white transition hover:bg-red-600">
                            Ya, Batalkan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- PILIHAN KAMAR --}}
        <section class="px-6 pt-8 md:px-10">

            {{-- FILTER TANGGAL --}}
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

            {{-- FILTER KATEGORI --}}
            <div class="mb-5 flex flex-wrap items-center gap-3 text-[15px]">
                <a href="{{ route('dashboard.tamu') }}"
                    class="rounded-full border border-gray-500 px-5 py-2 transition {{ empty(request('category')) ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                    Semua
                </a>
                @foreach ($tipeList as $tipe)
                    <a href="{{ route('dashboard.tamu', ['category' => $tipe->detail_kamar]) }}"
                        class="rounded-full border border-gray-500 px-5 py-2 transition {{ request('category') == $tipe->detail_kamar ? 'bg-[#7ea1ba] text-white' : 'bg-white text-[#243b53]' }}">
                        Kamar {{ $tipe->detail_kamar }}
                    </a>
                @endforeach
            </div>
        </section>

        {{-- GRID KAMAR --}}
        <section id="kamar" class="px-6 pb-10 pt-4 md:px-10">
            <div class="grid grid-cols-1 items-start gap-7 md:grid-cols-2 xl:grid-cols-3">

                @forelse ($rooms as $room)
                    @php
                        $slug = strtolower($room->detail_kamar ?? '');
                        if (str_contains($slug, 'standard')) {
                            $image = 'images/kamar/kamar_standard.jpeg';
                        } elseif (str_contains($slug, 'suite')) {
                            $image = 'images/kamar/kamar_suite.jpeg';
                        } elseif (str_contains($slug, 'deluxe')) {
                            $image = 'images/kamar/kamar_deluxe.jpeg';
                        } elseif (str_contains($slug, 'presidental') || str_contains($slug, 'presidential')) {
                            $image = 'images/kamar/kamar_presidential.jpeg';
                        } else {
                            $image = '';
                        }

                        $descMap = [
                            'standard' =>
                                'Kamar Standard kami dirancang untuk memberikan kenyamanan dasar dengan nuansa hangat dan bersih. Cocok untuk tamu yang membutuhkan istirahat berkualitas dengan harga terjangkau.',
                            'suite' =>
                                'Kamar Suite menawarkan pengalaman menginap premium dengan ruangan yang luas dan dekorasi elegan. Ideal untuk pasangan atau tamu yang menginginkan kemewahan lebih.',
                            'deluxe' =>
                                'Kamar Deluxe menghadirkan perpaduan sempurna antara kenyamanan dan gaya. Dengan desain interior modern dan fasilitas lengkap untuk pengalaman menginap tak terlupakan.',
                            'presidential' =>
                                'Presidential Suite adalah puncak kemewahan di Hotel Pulas. Dengan ruang tamu terpisah, kamar mandi eksklusif, dan layanan personal setara bintang lima.',
                            'presidental' =>
                                'Presidential Suite adalah puncak kemewahan di Hotel Pulas. Dengan ruang tamu terpisah, kamar mandi eksklusif, dan layanan personal setara bintang lima.',
                        ];
                        $desc =
                            'Kamar hadir dengan fasilitas lengkap dan suasana nyaman untuk menunjang istirahat Anda.';
                        foreach ($descMap as $key => $val) {
                            if (str_contains($slug, $key)) {
                                $desc = $val;
                                break;
                            }
                        }
                    @endphp

                    <div class="flex h-full flex-col border border-gray-400 bg-[#f2eee6] p-4">
                        <div
                            class="flex h-[220px] items-center justify-center overflow-hidden border border-gray-400 bg-[#f7f4ee]">
                            @if ($image)
                                <img src="{{ asset($image) }}" alt="{{ $room->detail_kamar }}"
                                    class="h-full w-full object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif
                            <div class="hidden h-full w-full items-center justify-center text-[16px] text-[#243b53]">Gambar
                                kamar</div>
                        </div>

                        <div class="mt-4 flex flex-col items-start text-left text-[#243b53]">
                            <p class="mb-3 text-[22px] font-medium">{{ $room->detail_kamar }}</p>
                            <div class="text-[16px] leading-8 text-[#4a5568]">
                                <p>{{ $room->fasilitas }}</p>
                            </div>
                        </div>

                        <div class="mt-5 text-right text-[#243b53]">
                            <p class="text-[22px] font-medium">Rp {{ number_format($room->harga_kamar, 0, ',', '.') }}
                                <span class="text-[14px] font-normal text-[#6b7280]">/ malam</span>
                            </p>
                            <p class="total-harga-info mt-1 hidden text-[14px] text-[#4a5568]"
                                data-price="{{ $room->harga_kamar }}"></p>
                        </div>

                        <button type="button" onclick="openRoomPopup('{{ $room->id_tipe }}')"
                            class="mt-4 w-full rounded-full border border-gray-500 bg-white py-3 text-[17px] transition hover:bg-[#7ea1ba] hover:text-white">
                            Lihat detail
                        </button>
                    </div>

                    {{-- POPUP DETAIL --}}
                    <div id="popup-{{ $room->id_tipe }}"
                        class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4"
                        onclick="closeRoomPopup('{{ $room->id_tipe }}')">
                        <div class="relative w-full max-w-lg overflow-hidden rounded-2xl border border-gray-300 bg-[#f2eee6] shadow-2xl"
                            onclick="event.stopPropagation()">

                            <div class="h-[220px] w-full overflow-hidden">
                                @if ($image)
                                    <img src="{{ asset($image) }}" alt="{{ $room->detail_kamar }}"
                                        class="h-full w-full object-cover" onerror="this.style.display='none'">
                                @endif
                            </div>

                            <button type="button" onclick="closeRoomPopup('{{ $room->id_tipe }}')"
                                class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full bg-white/80 text-xl font-bold text-[#243b53] shadow transition hover:bg-red-100 hover:text-red-500">
                                &times;
                            </button>

                            <div class="p-6 text-[#243b53]">
                                <div class="mb-4 flex items-start justify-between">
                                    <div>
                                        <h2 class="text-[26px] font-semibold">{{ $room->detail_kamar }}</h2>
                                        <p class="text-[14px] text-[#7b8794]">Hotel Pulas — Kenyamanan Tanpa Batas</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[22px] font-bold">Rp
                                            {{ number_format($room->harga_kamar, 0, ',', '.') }}</p>
                                        <p class="text-[13px] text-[#7b8794]">per malam</p>
                                    </div>
                                </div>

                                <p class="mb-4 text-[15px] leading-7 text-[#4a5568]">{{ $desc }}</p>

                                <div class="mb-5 grid grid-cols-2 gap-2 text-[14px]">
                                    @foreach (explode(',', $room->fasilitas) as $fas)
                                        <div
                                            class="flex items-center gap-2 rounded-lg border border-gray-200 bg-white/60 px-3 py-2">
                                            <span>✓</span><span>{{ trim($fas) }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="popup-date-info-{{ $room->id_tipe }}"
                                    class="mb-4 hidden rounded-lg border border-[#7ea1ba] bg-[#d4e8f5]/50 px-4 py-3 text-[14px] text-[#243b53]">
                                </div>

                                <a href="{{ route('pemesanan', ['kamar_id' => $room->id_tipe]) }}"
                                    class="block w-full rounded-full bg-[#243b53] py-3 text-center text-[17px] font-semibold text-white transition hover:bg-[#7ea1ba]">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                @empty
                    <div
                        class="border border-gray-400 bg-[#f2eee6] p-8 text-center text-[18px] text-[#243b53] md:col-span-2 xl:col-span-3">
                        Belum ada kamar tersedia saat ini.
                    </div>
                @endforelse
            </div>
        </section>

        <section id="Bantuan" class="border-t border-gray-300 bg-[#ece6da] px-8 py-4">
            <div class="grid w-full grid-cols-3 gap-8 text-[#243b53]">
                <div
                    class="flex items-center justify-center gap-3 rounded-md border border-gray-400 bg-[#f2eee6] px-4 py-2">
                    <span class="text-[28px]">☎</span>
                    <div class="leading-tight">
                        <p class="text-[14px] font-semibold">WhatsApp Admin</p>
                        <p class="text-[13px] text-[#7b8794]">+62 812 1111 1111</p>
                    </div>
                </div>
                <div
                    class="flex items-center justify-center gap-3 rounded-md border border-gray-400 bg-[#f2eee6] px-4 py-2">
                    <span class="text-[28px]">✉</span>
                    <div class="leading-tight">
                        <p class="text-[14px] font-semibold">Email</p>
                        <p class="text-[13px] text-[#7b8794]">hotelpulas@gmail.com</p>
                    </div>
                </div>
                <div
                    class="flex items-center justify-center gap-3 rounded-md border border-gray-400 bg-[#f2eee6] px-4 py-2">
                    <span class="text-[28px]">☎</span>
                    <div class="leading-tight">
                        <p class="text-[14px] font-semibold">No.Telepon Hotel</p>
                        <p class="text-[13px] text-[#7b8794]">(021) 222 212</p>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <style>
        body.modal-open {
            overflow: hidden;
        }
    </style>

    <script>
        function openCancelModal(id, tipe, ci, co) {
            document.getElementById('modal-tipe-info').textContent = tipe;
            document.getElementById('modal-kode-info').textContent = '#RSV-' + String(id).padStart(3, '0');
            document.getElementById('modal-ci-info').textContent = ci;
            document.getElementById('modal-co-info').textContent = co;
            document.getElementById('form-batal').action = '/reservasi/' + id + '/batal';
            document.getElementById('modal-cancel').classList.remove('hidden');
            document.getElementById('modal-cancel').classList.add('flex');
            document.body.classList.add('modal-open');
        }

        function closeCancelModal() {
            document.getElementById('modal-cancel').classList.add('hidden');
            document.getElementById('modal-cancel').classList.remove('flex');
            document.body.classList.remove('modal-open');
        }

        // ── FILTER TANGGAL ───────────────────────────────────────────
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
            if (inputCheckout.value && inputCheckout.value <= this.value) inputCheckout.value = minCo;
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

            // Tampilkan total harga di kartu
            document.querySelectorAll('.total-harga-info').forEach(el => {
                el.textContent =
                    `Total ${selectedDurasi} malam: ${formatRupiah(parseInt(el.dataset.price) * selectedDurasi)}`;
                el.classList.remove('hidden');
            });

            // Tampilkan info tanggal di popup
            document.querySelectorAll('[id^="popup-date-info-"]').forEach(el => {
                el.innerHTML = `
                    <p>📅 <strong>Check-in:</strong> ${formatTanggal(ci)}</p>
                    <p>📅 <strong>Check-out:</strong> ${formatTanggal(co)}</p>
                    <p>🌙 <strong>Durasi:</strong> ${selectedDurasi} malam</p>`;
                el.classList.remove('hidden');
            });
        }

        function resetTanggal() {
            inputCheckin.value = '';
            inputCheckout.value = '';
            selectedDurasi = 0;
            ['info-tanggal', 'error-tanggal'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
                document.getElementById(id).classList.remove('flex');
            });
            document.getElementById('btn-reset-tanggal').classList.add('hidden');
            document.querySelectorAll('.total-harga-info').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('[id^="popup-date-info-"]').forEach(el => el.classList.add('hidden'));
        }

        // ── POPUP KAMAR ──────────────────────────────────────────────
        function openRoomPopup(id) {
            const el = document.getElementById('popup-' + id);
            if (el) {
                el.classList.remove('hidden');
                el.classList.add('flex');
                document.body.classList.add('modal-open');
            }
        }

        function closeRoomPopup(id) {
            const el = document.getElementById('popup-' + id);
            if (el) {
                el.classList.add('hidden');
                el.classList.remove('flex');
                document.body.classList.remove('modal-open');
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^="popup-"], #modal-cancel').forEach(m => {
                    m.classList.add('hidden');
                    m.classList.remove('flex');
                });
                document.body.classList.remove('modal-open');
            }
        });
    </script>
@endsection
