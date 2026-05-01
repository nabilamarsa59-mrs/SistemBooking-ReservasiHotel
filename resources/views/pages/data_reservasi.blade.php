@extends('layouts.app')

@section('title', 'Data Pemesanan')

@section('content')
    <!-- file: resources/views/reservasi/index.blade.php -->

    @php
        // ── DUMMY DATA ─────────────────────────────────────────────
        $reservasis = collect([
            [
                'id' => '000343',
                'nama_tamu' => 'Refandy',
                'email' => 'refandy@gmail.com',
                'telepon' => '+62 812 0000 0001',
                'kamar' => '302-Suite',
                'lantai' => 3,
                'durasi' => '1 Malam',
                'jumlah_tamu' => '2 Orang',
                'checkin' => '07 April 2026',
                'checkout' => '08 April 2026',
                'tgl_reservasi' => '01 April 2026',
                'total' => 'Rp. 750.000',
                'status' => 'dikonfirmasi',
            ],
            [
                'id' => '000345',
                'nama_tamu' => 'Nabila Marsa',
                'email' => 'nabilamarsa@gmail.com',
                'telepon' => '+62 812 3456 7890',
                'kamar' => '103-Standard',
                'lantai' => 1,
                'durasi' => '2 Malam',
                'jumlah_tamu' => '2 Orang',
                'checkin' => '09 May 2026',
                'checkout' => '11 May 2026',
                'tgl_reservasi' => '01 Mei 2026',
                'total' => 'Rp. 960.000',
                'status' => 'dikonfirmasi',
            ],
            [
                'id' => '000346',
                'nama_tamu' => 'Edo',
                'email' => 'edo@gmail.com',
                'telepon' => '+62 813 1111 2222',
                'kamar' => '201-Deluxe',
                'lantai' => 2,
                'durasi' => '2 Malam',
                'jumlah_tamu' => '2 Orang',
                'checkin' => '11 May 2026',
                'checkout' => '13 May 2026',
                'tgl_reservasi' => '01 Mei 2026',
                'total' => 'Rp. 1.040.000',
                'status' => 'dikonfirmasi',
            ],
            [
                'id' => '000347',
                'nama_tamu' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'telepon' => '+62 878 9999 0000',
                'kamar' => '405-Presidental',
                'lantai' => 4,
                'durasi' => '1 Malam',
                'jumlah_tamu' => '4 Orang',
                'checkin' => '21 May 2026',
                'checkout' => '22 May 2026',
                'tgl_reservasi' => '01 Mei 2026',
                'total' => 'Rp. 920.000',
                'status' => 'menunggu',
            ],
            [
                'id' => '000348',
                'nama_tamu' => 'Siti Rahma',
                'email' => 'sitirahma@gmail.com',
                'telepon' => '+62 856 4321 0987',
                'kamar' => '102-Standard',
                'lantai' => 1,
                'durasi' => '3 Malam',
                'jumlah_tamu' => '2 Orang',
                'checkin' => '25 May 2026',
                'checkout' => '28 May 2026',
                'tgl_reservasi' => '01 Mei 2026',
                'total' => 'Rp. 1.440.000',
                'status' => 'checkin',
            ],
        ]);

        $totalHariIni = $reservasis->count();
        $menunggu = $reservasis->where('status', 'menunggu')->count();
        $dikonfirmasi = $reservasis->where('status', 'dikonfirmasi')->count();
        $dibatalkan = $reservasis->where('status', 'dibatalkan')->count();
    @endphp

    <div class="min-h-screen bg-[#ece6da] px-10 py-6 font-serif text-[#243b53]">

        {{-- ── HEADER ── --}}
        <div class="mb-8">
            <h1 class="text-[28px] font-semibold">Menajemen reservasi</h1>
        </div>

        {{-- ── STAT CARDS ── --}}
        <div class="mb-8 grid grid-cols-4 gap-4 text-center">
            <div class="border border-gray-500 bg-white p-5">
                <h2 class="text-[15px] p-2 font-semibold leading-tight">Total Hari Ini</h2>
                <p class="my-2 text-[48px] p-2 font-semibold leading-none">{{ $totalHariIni }}</p>
                <p class="text-[13px] p-2 text-gray-500">Reservasi aktif</p>
            </div>
            <div class="border border-gray-500 bg-white p-5">
                <h2 class="text-[15px] font-semibold leading-tight">Menunggu Konfirmasi</h2>
                <p class="my-2 text-[48px] p-2 font-semibold leading-none">{{ $menunggu }}</p>
                <p class="text-[13px] p-2 text-gray-500">Aksi diperlukan</p>
            </div>
            <div class="border border-gray-500 bg-white p-5">
                <h2 class="text-[15px] p-2 font-semibold leading-tight">Dikonfirmasi</h2>
                <p class="my-2 text-[48px] p-2 font-semibold leading-none">{{ $dikonfirmasi }}</p>
                <p class="text-[13px] p-2 text-gray-500">Reservasi aktif</p>
            </div>
            <div class="border border-gray-500 bg-white p-5">
                <h2 class="text-[15px] p-2 font-semibold leading-tight">Dibatalkan</h2>
                <p class="my-2 text-[48px] p-2 font-semibold leading-none">{{ $dibatalkan }}</p>
                <p class="text-[13px] p-2 text-gray-500">Minggu ini</p>
            </div>
        </div>

        {{-- ── SEARCH & FILTER ── --}}
        <div class="mb-6 flex gap-2">
            <input id="searchInput" type="text" placeholder="Cari berdasarkan nomor atau tipe kamar..."
                class="flex-1 border border-gray-500 bg-white px-4 py-2 outline-none" oninput="applyFilter()">

            <button onclick="setFilter('semua')" id="btn-semua"
                class="filter-btn border border-gray-500 bg-[#7ea1ba] px-4 py-2 text-white transition-colors">Semua</button>
            <button onclick="setFilter('menunggu')" id="btn-menunggu"
                class="filter-btn border border-gray-500 bg-white px-4 py-2 hover:bg-[#7ea1ba] hover:text-white transition-colors">Menunggu</button>
            <button onclick="setFilter('dikonfirmasi')" id="btn-dikonfirmasi"
                class="filter-btn border border-gray-500 bg-white px-4 py-2 hover:bg-[#7ea1ba] hover:text-white transition-colors">Dikonfirmasi</button>
        </div>

        {{-- ── TABLE ── --}}
        <div class="border border-gray-500 bg-white">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-500">
                        <th class="px-4 py-4">ID.Reservasi</th>
                        <th class="px-4 py-4">Nama Tamu</th>
                        <th class="px-4 py-4">Kamar</th>
                        <th class="px-4 py-4">Check-In</th>
                        <th class="px-4 py-4">Check-Out</th>
                        <th class="px-4 py-4">Status</th>
                        <th class="px-4 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($reservasis as $r)
                        <tr class="reservasi-row border-b border-gray-300 hover:bg-gray-50 transition-colors"
                            data-id="{{ strtolower($r['id']) }}" data-nama="{{ strtolower($r['nama_tamu']) }}"
                            data-kamar="{{ strtolower($r['kamar']) }}" data-status="{{ $r['status'] }}"
                            data-detail='@json($r)'>
                            <td class="px-4 py-4">{{ $r['id'] }}</td>
                            <td class="px-4 py-4">{{ $r['nama_tamu'] }}</td>
                            <td class="px-4 py-4">{{ $r['kamar'] }}</td>
                            <td class="px-4 py-4">{{ $r['checkin'] }}</td>
                            <td class="px-4 py-4">{{ $r['checkout'] }}</td>
                            <td class="px-4 py-4">
                                <span
                                    class="font-medium
        @if ($r['status'] === 'dikonfirmasi') text-blue-700
        @elseif ($r['status'] === 'menunggu') text-yellow-600
        @else text-red-600 @endif">

                                    @if ($r['status'] === 'dikonfirmasi')
                                        Di Konfirmasi
                                    @elseif ($r['status'] === 'menunggu')
                                        Menunggu
                                    @else
                                        Dibatalkan
                                    @endif

                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <button onclick="openDetailModal(this)"
                                    class="text-[#243b53] underline underline-offset-2 hover:text-[#7ea1ba] transition-colors text-[14px]">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="flex items-center justify-between border-t border-gray-500 px-4 py-3">
                <p id="paginationInfo"></p>
                <div class="flex gap-2" id="paginationBtns"></div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════ --}}
    {{-- MODAL: Detail Reservasi                                   --}}
    {{-- ══════════════════════════════════════════════════════════ --}}
    <div id="modalDetail" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
        <div class="w-full max-w-xl bg-white shadow-xl font-serif text-[#243b53]">

            {{-- Modal Header --}}
            <div class="border-b border-gray-400 px-8 py-5">
                <h2 class="text-[22px] font-semibold">Detail Reservasi</h2>
            </div>

            {{-- Modal Body --}}
            <div class="px-8 py-6">

                {{-- Row 1: ID & Status --}}
                <div class="mb-5 grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-[12px] text-gray-500">ID Reservasi</p>
                        <p id="d_id" class="text-[20px] font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-[12px] text-gray-500">Status</p>
                        <p id="d_status" class="text-[20px] font-semibold"></p>
                    </div>
                </div>

                {{-- Row 2: Nama & Tgl Reservasi --}}
                <div class="mb-5 grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-[12px] text-gray-500">Nama Tamu</p>
                        <p id="d_nama" class="text-[16px] font-medium"></p>
                    </div>
                    <div>
                        <p class="text-[12px] text-gray-500">Tanggal Reseervasi</p>
                        <p id="d_tgl_reservasi" class="text-[16px] font-medium"></p>
                    </div>
                </div>

                {{-- Row 3: Email & Total --}}
                <div class="mb-5 grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-[12px] text-gray-500">Email</p>
                        <p id="d_email" class="text-[16px] font-medium underline"></p>
                    </div>
                    <div>
                        <p class="text-[12px] text-gray-500">Total Pembayaran</p>
                        <p id="d_total" class="text-[16px] font-medium"></p>
                    </div>
                </div>

                {{-- Row 4: Telepon --}}
                <div class="mb-5">
                    <p class="text-[12px] text-gray-500">No. Telepon</p>
                    <p id="d_telepon" class="text-[16px] font-medium"></p>
                </div>

                {{-- Row 5: Kamar info --}}
                <div class="mb-6 grid grid-cols-4 gap-4 border-t border-gray-300 pt-5">
                    <div>
                        <p class="text-[12px] text-gray-500">Kamar</p>
                        <p id="d_kamar" class="text-[16px] font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-[12px] text-gray-500">Lantai</p>
                        <p id="d_lantai" class="text-[16px] font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-[12px] text-gray-500">Durasi</p>
                        <p id="d_durasi" class="text-[16px] font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-[12px] text-gray-500">Jumlah Tamu</p>
                        <p id="d_jumlah_tamu" class="text-[16px] font-semibold"></p>
                    </div>
                </div>

                {{-- Row 6: Check-in & Check-out --}}
                <div class="mb-6 flex items-center gap-0 border border-gray-400">
                    <div class="flex flex-1 items-center gap-4 px-5 py-4">
                        <div class="flex h-9 w-9 items-center justify-center border-2 border-[#243b53] bg-white">
                            {{-- Checklist icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[12px] text-gray-500">Check-in</p>
                            <p id="d_checkin" class="text-[15px] font-semibold"></p>
                        </div>
                    </div>
                    <div class="w-px self-stretch bg-gray-400"></div>
                    <div class="flex flex-1 items-center gap-4 px-5 py-4">
                        <div class="flex h-9 w-9 items-center justify-center border-2 border-[#243b53] bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[12px] text-gray-500">Check-out</p>
                            <p id="d_checkout" class="text-[15px] font-semibold"></p>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between">
                    <button onclick="closeDetailModal()"
                        class="border border-gray-500 px-10 py-2 hover:bg-red-100 hover:text-red-600 transition-colors">
                        Batal
                    </button>
                    <button onclick="closeDetailModal()"
                        class="border border-gray-500 bg-white px-10 py-2 font-semibold hover:bg-[#7ea1ba] hover:text-white transition-colors">
                        Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════ --}}
    {{-- JAVASCRIPT                                                --}}
    {{-- ══════════════════════════════════════════════════════════ --}}
    <script>
        const PER_PAGE = 4;
        let currentFilter = 'semua';
        let currentPage = 1;

        function getFilteredRows() {
            const search = document.getElementById('searchInput').value.toLowerCase().trim();
            return Array.from(document.querySelectorAll('.reservasi-row')).filter(row => {
                const matchSearch = !search ||
                    row.dataset.id.includes(search) ||
                    row.dataset.nama.includes(search) ||
                    row.dataset.kamar.includes(search);
                const matchFilter =
                    currentFilter === 'semua' ||
                    row.dataset.status === currentFilter;
                return matchSearch && matchFilter;
            });
        }

        function render() {
            const filtered = getFilteredRows();
            const total = filtered.length;
            const lastPage = Math.max(1, Math.ceil(total / PER_PAGE));
            if (currentPage > lastPage) currentPage = lastPage;

            const start = (currentPage - 1) * PER_PAGE;
            const end = start + PER_PAGE;
            const showing = filtered.slice(start, end);

            document.querySelectorAll('.reservasi-row').forEach(r => r.classList.add('hidden'));
            showing.forEach(r => r.classList.remove('hidden'));

            document.getElementById('paginationInfo').textContent = total === 0 ?
                'Tidak ada reservasi ditemukan.' :
                `Menampilkan ${start + 1}-${start + showing.length} dari ${total} kamar`;

            const btnsEl = document.getElementById('paginationBtns');
            btnsEl.innerHTML = '';

            const mkBtn = (label, page, disabled) => {
                const b = document.createElement('button');
                b.innerHTML = label;
                const isActive = page === currentPage && typeof page === 'number';
                b.className = 'border border-gray-500 px-3 py-1 transition-colors ' +
                    (disabled ? 'text-gray-300 cursor-default ' : 'hover:bg-[#7ea1ba] hover:text-white ') +
                    (isActive ? 'bg-[#7ea1ba] text-white ' : '');
                if (!disabled) b.onclick = () => {
                    currentPage = page;
                    render();
                };
                return b;
            };

            btnsEl.appendChild(mkBtn('&lt;', currentPage - 1, currentPage === 1));
            for (let i = 1; i <= lastPage; i++) btnsEl.appendChild(mkBtn(i, i, false));
            btnsEl.appendChild(mkBtn('&gt;', currentPage + 1, currentPage === lastPage));
        }

        function setFilter(f) {
            currentFilter = f;
            currentPage = 1;
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-[#7ea1ba]', 'text-white');
                b.classList.add('bg-white');
            });
            const ab = document.getElementById('btn-' + f);
            if (ab) {
                ab.classList.add('bg-[#7ea1ba]', 'text-white');
                ab.classList.remove('bg-white');
            }
            render();
        }

        function applyFilter() {
            currentPage = 1;
            render();
        }

        // Modal Detail
        function openDetailModal(btn) {
            const row = btn.closest('tr');
            const data = JSON.parse(row.dataset.detail);

            document.getElementById('d_id').textContent = data.id;
            document.getElementById('d_nama').textContent = data.nama_tamu;
            document.getElementById('d_email').textContent = data.email;
            document.getElementById('d_telepon').textContent = data.telepon;
            document.getElementById('d_kamar').textContent = data.kamar;
            document.getElementById('d_lantai').textContent = data.lantai;
            document.getElementById('d_durasi').textContent = data.durasi;
            document.getElementById('d_jumlah_tamu').textContent = data.jumlah_tamu;
            document.getElementById('d_checkin').textContent = data.checkin;
            document.getElementById('d_checkout').textContent = data.checkout;
            document.getElementById('d_tgl_reservasi').textContent = data.tgl_reservasi;
            document.getElementById('d_total').textContent = data.total;

            // Status label & warna
            const statusMap = {
                dikonfirmasi: {
                    label: 'Di Konfirmasi',
                    cls: 'text-blue-700'
                },
                menunggu: {
                    label: 'Menunggu',
                    cls: 'text-yellow-600'
                },
                dibatalkan: {
                    label: 'Dibatalkan',
                    cls: 'text-red-600'
                },
            };
            const s = statusMap[data.status] || {
                label: data.status,
                cls: ''
            };
            const el = document.getElementById('d_status');
            el.textContent = s.label;
            el.className = 'text-[20px] font-semibold ' + s.cls;

            toggle('modalDetail', true);
        }

        function closeDetailModal() {
            toggle('modalDetail', false);
        }

        function toggle(id, show) {
            const m = document.getElementById(id);
            m.classList.toggle('hidden', !show);
            m.classList.toggle('flex', show);
        }

        // Klik backdrop tutup modal
        document.getElementById('modalDetail').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });

        // Init
        render();
    </script>
@endsection
