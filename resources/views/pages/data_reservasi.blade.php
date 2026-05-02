@extends('layouts.app')

@section('title', 'Data Pemesanan')

@section('content')

    @php
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

    <div class="min-h-screen bg-[#F2EDE4] px-12 py-10 font-serif text-[#243b53]">

        <div class="mb-8">
            <h1 class="text-[36px] font-bold text-[#0B2A55]">
                Manajemen Reservasi
            </h1>
            <p class="text-[18px] text-[#47627A] mt-2">
                Kelola data reservasi tamu berdasarkan status dan detail pemesanan.
            </p>
        </div>

        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[16px] text-[#47627A]">Total Hari Ini</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $totalHariIni }}</h2>
                        <p class="text-[15px] text-[#47627A]">Reservasi aktif</p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-[#EAF0FA] flex items-center justify-center text-[28px]">
                        📋
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[16px] text-[#47627A]">Menunggu</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $menunggu }}</h2>
                        <p class="text-[15px] text-[#47627A]">Aksi diperlukan</p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-[#FFF0C7] flex items-center justify-center text-[28px]">
                        🕒
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[16px] text-[#47627A]">Dikonfirmasi</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $dikonfirmasi }}</h2>
                        <p class="text-[15px] text-[#47627A]">Reservasi aktif</p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-[#D8F3DF] flex items-center justify-center text-[28px]">
                        ✅
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[16px] text-[#47627A]">Dibatalkan</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $dibatalkan }}</h2>
                        <p class="text-[15px] text-[#47627A]">Minggu ini</p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-[#FCE7E7] flex items-center justify-center text-[28px]">
                        ✖
                    </div>
                </div>
            </div>

        </div>

        <div class="mb-6 flex flex-col lg:flex-row gap-4">
            <input id="searchInput" type="text" placeholder="Cari ID, nama tamu, atau kamar..."
                class="w-full lg:flex-1 rounded-xl border border-[#D1CCC0] bg-white px-5 py-3 text-[16px] shadow-sm outline-none focus:border-[#7EA1BA]"
                oninput="applyFilter()">

            <div class="flex flex-wrap gap-3">
                <button onclick="setFilter('semua')" id="btn-semua"
                    class="filter-btn rounded-xl border border-[#7EA1BA] bg-[#7EA1BA] px-6 py-3 text-white shadow-sm transition">
                    Semua
                </button>

                <button onclick="setFilter('menunggu')" id="btn-menunggu"
                    class="filter-btn rounded-xl border border-[#D1CCC0] bg-white px-6 py-3 text-[#243b53] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">
                    Menunggu
                </button>

                <button onclick="setFilter('dikonfirmasi')" id="btn-dikonfirmasi"
                    class="filter-btn rounded-xl border border-[#D1CCC0] bg-white px-6 py-3 text-[#243b53] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">
                    Dikonfirmasi
                </button>

                <button onclick="setFilter('dibatalkan')" id="btn-dibatalkan"
                    class="filter-btn rounded-xl border border-[#D1CCC0] bg-white px-6 py-3 text-[#243b53] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">
                    Dibatalkan
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md overflow-hidden">

            <div class="px-7 py-6 border-b border-[#E2E8F0]">
                <h2 class="text-[28px] font-bold text-[#0B2A55]">
                    Daftar Reservasi
                </h2>
                <p class="text-[16px] text-[#47627A] mt-1">
                    Menampilkan reservasi yang masuk ke sistem hotel.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">ID Reservasi</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Nama Tamu</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Kamar</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Check-In</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Check-Out</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Status</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A] text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                        @foreach ($reservasis as $r)
                            <tr class="reservasi-row border-b border-[#E2E8F0] hover:bg-[#F8FAFC] transition"
                                data-id="{{ strtolower($r['id']) }}" data-nama="{{ strtolower($r['nama_tamu']) }}"
                                data-kamar="{{ strtolower($r['kamar']) }}" data-status="{{ $r['status'] }}"
                                data-detail='@json($r)'>

                                <td class="px-5 py-5 font-semibold">#{{ $r['id'] }}</td>
                                <td class="px-5 py-5">{{ $r['nama_tamu'] }}</td>
                                <td class="px-5 py-5">{{ $r['kamar'] }}</td>
                                <td class="px-5 py-5">{{ $r['checkin'] }}</td>
                                <td class="px-5 py-5">{{ $r['checkout'] }}</td>
                                <td class="px-5 py-5">
                                    @if ($r['status'] === 'dikonfirmasi')
                                        <span
                                            class="rounded-full bg-blue-100 px-4 py-1 text-[14px] font-semibold text-blue-700">Dikonfirmasi</span>
                                    @elseif ($r['status'] === 'menunggu')
                                        <span
                                            class="rounded-full bg-yellow-100 px-4 py-1 text-[14px] font-semibold text-yellow-700">Menunggu</span>
                                    @elseif ($r['status'] === 'checkin')
                                        <span
                                            class="rounded-full bg-green-100 px-4 py-1 text-[14px] font-semibold text-green-700">Check-in</span>
                                    @else
                                        <span
                                            class="rounded-full bg-red-100 px-4 py-1 text-[14px] font-semibold text-red-700">Dibatalkan</span>
                                    @endif
                                </td>

                                <td class="px-5 py-5 text-center">
                                    <button onclick="openDetailModal(this)"
                                        class="rounded-lg border border-[#7EA1BA] px-4 py-2 text-[15px] font-semibold text-[#0B2A55] hover:bg-[#7EA1BA] hover:text-white transition">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between border-t border-[#E2E8F0] px-6 py-4">
                <p id="paginationInfo" class="text-[15px] text-[#47627A]"></p>
                <div class="flex gap-2" id="paginationBtns"></div>
            </div>
        </div>
    </div>

    <div id="modalDetail" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
        <div class="w-full max-w-2xl rounded-2xl bg-white shadow-xl font-serif text-[#243b53] overflow-hidden">

            <div class="px-8 py-6 border-b border-[#E2E8F0]">
                <h2 class="text-[28px] font-bold text-[#0B2A55]">
                    Detail Reservasi
                </h2>
                <p class="text-[15px] text-[#47627A] mt-1">
                    Informasi lengkap data reservasi tamu.
                </p>
            </div>

            <div class="p-8">

                <div class="mb-6 grid grid-cols-2 gap-6">
                    <div class="rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] p-4">
                        <p class="text-[13px] text-[#47627A]">ID Reservasi</p>
                        <p id="d_id" class="text-[22px] font-bold text-[#0B2A55]"></p>
                    </div>
                    <div class="rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] p-4">
                        <p class="text-[13px] text-[#47627A]">Status</p>
                        <p id="d_status" class="text-[22px] font-bold"></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <p class="text-[13px] text-[#47627A]">Nama Tamu</p>
                        <p id="d_nama" class="text-[17px] font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-[13px] text-[#47627A]">Tanggal Reservasi</p>
                        <p id="d_tgl_reservasi" class="text-[17px] font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-[13px] text-[#47627A]">Email</p>
                        <p id="d_email" class="text-[17px] font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-[13px] text-[#47627A]">Total Pembayaran</p>
                        <p id="d_total" class="text-[17px] font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-[13px] text-[#47627A]">No. Telepon</p>
                        <p id="d_telepon" class="text-[17px] font-semibold"></p>
                    </div>
                    <div>
                        <p class="text-[13px] text-[#47627A]">Kamar</p>
                        <p id="d_kamar" class="text-[17px] font-semibold"></p>
                    </div>
                </div>

                <div class="mb-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] p-4">
                        <p class="text-[13px] text-[#47627A]">Lantai</p>
                        <p id="d_lantai" class="text-[17px] font-bold"></p>
                    </div>
                    <div class="rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] p-4">
                        <p class="text-[13px] text-[#47627A]">Durasi</p>
                        <p id="d_durasi" class="text-[17px] font-bold"></p>
                    </div>
                    <div class="rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] p-4">
                        <p class="text-[13px] text-[#47627A]">Jumlah Tamu</p>
                        <p id="d_jumlah_tamu" class="text-[17px] font-bold"></p>
                    </div>
                    <div class="rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] p-4">
                        <p class="text-[13px] text-[#47627A]">Total</p>
                        <p id="d_total_2" class="text-[17px] font-bold"></p>
                    </div>
                </div>

                <div class="mb-7 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="rounded-xl border border-[#D1CCC0] p-5">
                        <p class="text-[13px] text-[#47627A]">Check-in</p>
                        <p id="d_checkin" class="text-[18px] font-bold text-[#0B2A55]"></p>
                    </div>
                    <div class="rounded-xl border border-[#D1CCC0] p-5">
                        <p class="text-[13px] text-[#47627A]">Check-out</p>
                        <p id="d_checkout" class="text-[18px] font-bold text-[#0B2A55]"></p>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <button onclick="closeDetailModal()"
                        class="rounded-xl border border-[#D1CCC0] px-7 py-3 hover:bg-gray-100 transition">
                        Tutup
                    </button>
                    <button onclick="closeDetailModal()"
                        class="rounded-xl bg-[#7EA1BA] px-7 py-3 font-semibold text-white hover:bg-[#668BA5] transition">
                        Konfirmasi
                    </button>
                </div>

            </div>
        </div>
    </div>

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

                const matchFilter = currentFilter === 'semua' || row.dataset.status === currentFilter;

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
                `Menampilkan ${start + 1}-${start + showing.length} dari ${total} reservasi`;

            const btnsEl = document.getElementById('paginationBtns');
            btnsEl.innerHTML = '';

            const mkBtn = (label, page, disabled) => {
                const b = document.createElement('button');
                b.innerHTML = label;

                const isActive = page === currentPage && typeof page === 'number';

                b.className =
                    'rounded-lg border border-[#D1CCC0] px-4 py-2 transition ' +
                    (disabled ? 'text-gray-300 cursor-default ' : 'hover:bg-[#7EA1BA] hover:text-white ') +
                    (isActive ? 'bg-[#7EA1BA] text-white ' : 'bg-white text-[#243b53]');

                if (!disabled) {
                    b.onclick = () => {
                        currentPage = page;
                        render();
                    };
                }

                return b;
            };

            btnsEl.appendChild(mkBtn('&lt;', currentPage - 1, currentPage === 1));

            for (let i = 1; i <= lastPage; i++) {
                btnsEl.appendChild(mkBtn(i, i, false));
            }

            btnsEl.appendChild(mkBtn('&gt;', currentPage + 1, currentPage === lastPage));
        }

        function setFilter(f) {
            currentFilter = f;
            currentPage = 1;

            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-[#7EA1BA]', 'text-white');
                b.classList.add('bg-white', 'text-[#243b53]');
            });

            const activeBtn = document.getElementById('btn-' + f);

            if (activeBtn) {
                activeBtn.classList.add('bg-[#7EA1BA]', 'text-white');
                activeBtn.classList.remove('bg-white', 'text-[#243b53]');
            }

            render();
        }

        function applyFilter() {
            currentPage = 1;
            render();
        }

        function openDetailModal(btn) {
            const row = btn.closest('tr');
            const data = JSON.parse(row.dataset.detail);

            document.getElementById('d_id').textContent = '#' + data.id;
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
            document.getElementById('d_total_2').textContent = data.total;

            const statusMap = {
                dikonfirmasi: {
                    label: 'Dikonfirmasi',
                    cls: 'text-blue-700'
                },
                menunggu: {
                    label: 'Menunggu',
                    cls: 'text-yellow-700'
                },
                checkin: {
                    label: 'Check-in',
                    cls: 'text-green-700'
                },
                dibatalkan: {
                    label: 'Dibatalkan',
                    cls: 'text-red-700'
                },
            };

            const s = statusMap[data.status] || {
                label: data.status,
                cls: 'text-[#243b53]'
            };

            const el = document.getElementById('d_status');
            el.textContent = s.label;
            el.className = 'text-[22px] font-bold ' + s.cls;

            toggle('modalDetail', true);
        }

        function closeDetailModal() {
            toggle('modalDetail', false);
        }

        function toggle(id, show) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden', !show);
            modal.classList.toggle('flex', show);
        }

        document.getElementById('modalDetail').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });

        render();
    </script>

@endsection
