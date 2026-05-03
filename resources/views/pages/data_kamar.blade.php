@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')

    @php
        $allKamars = collect([
            [
                'id' => 1,
                'nomor_kamar' => '201',
                'jenis_kamar' => 'Deluxe',
                'harga_per_malam' => 520000,
                'lantai' => 2,
                'kapasitas' => 2,
                'status' => 'tersedia',
                'keterangan' => '',
            ],
            [
                'id' => 2,
                'nomor_kamar' => '302',
                'jenis_kamar' => 'Suite',
                'harga_per_malam' => 750000,
                'lantai' => 3,
                'kapasitas' => 3,
                'status' => 'tersedia',
                'keterangan' => 'Sudah Termasuk Sarapan',
            ],
            [
                'id' => 3,
                'nomor_kamar' => '103',
                'jenis_kamar' => 'Standard',
                'harga_per_malam' => 480000,
                'lantai' => 1,
                'kapasitas' => 2,
                'status' => 'terisi',
                'keterangan' => '',
            ],
            [
                'id' => 4,
                'nomor_kamar' => '405',
                'jenis_kamar' => 'Presidental',
                'harga_per_malam' => 920000,
                'lantai' => 4,
                'kapasitas' => 4,
                'status' => 'perbaikan',
                'keterangan' => 'AC rusak',
            ],
            [
                'id' => 5,
                'nomor_kamar' => '102',
                'jenis_kamar' => 'Standard',
                'harga_per_malam' => 480000,
                'lantai' => 1,
                'kapasitas' => 2,
                'status' => 'tersedia',
                'keterangan' => '',
            ],
            [
                'id' => 6,
                'nomor_kamar' => '203',
                'jenis_kamar' => 'Deluxe',
                'harga_per_malam' => 520000,
                'lantai' => 2,
                'kapasitas' => 2,
                'status' => 'terisi',
                'keterangan' => '',
            ],
            [
                'id' => 7,
                'nomor_kamar' => '304',
                'jenis_kamar' => 'Suite',
                'harga_per_malam' => 750000,
                'lantai' => 3,
                'kapasitas' => 3,
                'status' => 'tersedia',
                'keterangan' => '',
            ],
            [
                'id' => 8,
                'nomor_kamar' => '406',
                'jenis_kamar' => 'Presidental',
                'harga_per_malam' => 920000,
                'lantai' => 4,
                'kapasitas' => 4,
                'status' => 'perbaikan',
                'keterangan' => 'Renovasi kamar mandi',
            ],
            [
                'id' => 9,
                'nomor_kamar' => '105',
                'jenis_kamar' => 'Standard',
                'harga_per_malam' => 480000,
                'lantai' => 1,
                'kapasitas' => 2,
                'status' => 'tersedia',
                'keterangan' => '',
            ],
            [
                'id' => 10,
                'nomor_kamar' => '206',
                'jenis_kamar' => 'Deluxe',
                'harga_per_malam' => 520000,
                'lantai' => 2,
                'kapasitas' => 2,
                'status' => 'terisi',
                'keterangan' => '',
            ],
        ]);

        $totalKamar = $allKamars->count();
        $totalTipe = $allKamars->pluck('jenis_kamar')->unique()->count();
        $tersedia = $allKamars->where('status', 'tersedia')->count();
        $terisi = $allKamars->where('status', 'terisi')->count();
        $perbaikan = $allKamars->where('status', 'perbaikan')->count();
    @endphp

    <div class="min-h-screen bg-[#F2EDE4] px-12 py-10 font-serif text-[#243b53]">

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <h1 class="text-[36px] font-bold text-[#0B2A55]">
                    Data Kamar
                </h1>
                <p class="text-[18px] text-[#47627A] mt-2">
                    Kelola data kamar hotel berdasarkan nomor, tipe, harga, dan status kamar.
                </p>
            </div>

            <button onclick="openTambahModal()"
                class="rounded-xl bg-[#7EA1BA] px-7 py-3 text-[17px] font-semibold text-white shadow-md hover:bg-[#668BA5] transition">
                + Tambah Kamar
            </button>
        </div>

        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[16px] text-[#47627A]">Total Kamar</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $totalKamar }}</h2>
                        <p class="text-[15px] text-[#47627A]">{{ $totalTipe }} tipe kamar</p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-[#EAF0FA] flex items-center justify-center text-[28px]">
                        🏨
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[16px] text-[#47627A]">Tersedia</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $tersedia }}</h2>
                        <p class="text-[15px] text-[#47627A]">{{ round(($tersedia / $totalKamar) * 100) }}% dari total</p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-[#D8F3DF] flex items-center justify-center text-[28px]">
                        ✅
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[16px] text-[#47627A]">Terisi</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $terisi }}</h2>
                        <p class="text-[15px] text-[#47627A]">{{ round(($terisi / $totalKamar) * 100) }}% dari total</p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-[#FFF0C7] flex items-center justify-center text-[28px]">
                        🔑
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[16px] text-[#47627A]">Perbaikan</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $perbaikan }}</h2>
                        <p class="text-[15px] text-[#47627A]">{{ round(($perbaikan / $totalKamar) * 100) }}% dari total</p>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-[#FCE7E7] flex items-center justify-center text-[28px]">
                        🛠️
                    </div>
                </div>
            </div>

        </div>

        {{-- SEARCH FILTER --}}
        <div class="mb-6 flex flex-col lg:flex-row gap-4">
            <input id="searchInput" type="text" placeholder="Cari nomor atau tipe kamar..."
                class="w-full lg:w-[420px] rounded-xl border border-[#D1CCC0] bg-white px-5 py-3 text-[16px] shadow-sm outline-none focus:border-[#7EA1BA]"
                oninput="applyFilter()">

            <div class="flex flex-wrap gap-3">
                <button onclick="setFilter('semua')" id="btn-semua"
                    class="filter-btn rounded-xl border border-[#7EA1BA] bg-[#7EA1BA] px-6 py-3 text-white shadow-sm transition">
                    Semua
                </button>

                <button onclick="setFilter('tersedia')" id="btn-tersedia"
                    class="filter-btn rounded-xl border border-[#D1CCC0] bg-white px-6 py-3 text-[#243b53] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">
                    Tersedia
                </button>

                <button onclick="setFilter('terisi')" id="btn-terisi"
                    class="filter-btn rounded-xl border border-[#D1CCC0] bg-white px-6 py-3 text-[#243b53] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">
                    Terisi
                </button>

                <button onclick="setFilter('perbaikan')" id="btn-perbaikan"
                    class="filter-btn rounded-xl border border-[#D1CCC0] bg-white px-6 py-3 text-[#243b53] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">
                    Perbaikan
                </button>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md overflow-hidden">

            <div class="px-7 py-6 border-b border-[#E2E8F0]">
                <h2 class="text-[28px] font-bold text-[#0B2A55]">
                    Daftar Kamar
                </h2>
                <p class="text-[16px] text-[#47627A] mt-1">
                    Menampilkan seluruh kamar yang tersedia di sistem.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">No. Kamar</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Jenis</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Harga/Malam</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Status</th>
                            <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A] text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                        @foreach ($allKamars as $k)
                            <tr class="kamar-row border-b border-[#E2E8F0] hover:bg-[#F8FAFC] transition"
                                data-nomor="{{ strtolower($k['nomor_kamar']) }}"
                                data-jenis="{{ strtolower($k['jenis_kamar']) }}" data-status="{{ $k['status'] }}">

                                <td class="px-5 py-5 font-semibold">{{ $k['nomor_kamar'] }}</td>
                                <td class="px-5 py-5">{{ $k['jenis_kamar'] }}</td>
                                <td class="px-5 py-5">Rp. {{ number_format($k['harga_per_malam'], 0, ',', '.') }}</td>
                                <td class="px-5 py-5">
                                    @if ($k['status'] === 'tersedia')
                                        <span
                                            class="rounded-full bg-green-100 px-4 py-1 text-[14px] font-semibold text-green-700">Tersedia</span>
                                    @elseif($k['status'] === 'terisi')
                                        <span
                                            class="rounded-full bg-blue-100 px-4 py-1 text-[14px] font-semibold text-blue-700">Terisi</span>
                                    @else
                                        <span
                                            class="rounded-full bg-red-100 px-4 py-1 text-[14px] font-semibold text-red-700">Perbaikan</span>
                                    @endif
                                </td>

                                <td class="px-5 py-5 text-center whitespace-nowrap">
                                    <button
                                        onclick="openEditModal(
                                        '{{ $k['nomor_kamar'] }}',
                                        '{{ $k['jenis_kamar'] }}',
                                        {{ $k['lantai'] }},
                                        {{ $k['harga_per_malam'] }},
                                        {{ $k['kapasitas'] }},
                                        '{{ $k['status'] }}',
                                        '{{ $k['keterangan'] }}')"
                                        class="mr-2 rounded-lg border border-[#7EA1BA] px-3 py-2 text-[#0B2A55] hover:bg-[#7EA1BA] hover:text-white transition">
                                        Edit
                                    </button>

                                    <button onclick="confirmHapus('{{ $k['nomor_kamar'] }}')"
                                        class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-red-600 hover:bg-red-100 transition">
                                        Hapus
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

    {{-- MODAL TAMBAH --}}
    <div id="modalTambah" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
        <div class="w-full max-w-lg rounded-2xl bg-white p-8 shadow-xl font-serif text-[#243b53]">
            <h2 class="mb-1 text-[26px] font-bold text-[#0B2A55]">Tambah Kamar</h2>
            <p class="mb-6 text-[15px] text-[#47627A]">Lengkapi informasi kamar yang akan ditambahkan.</p>

            <input type="text" placeholder="No. Kamar"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]">

            <select
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] bg-white px-4 py-3 outline-none focus:border-[#7EA1BA]">
                <option value="">Pilih Jenis Kamar</option>
                <option>Standard</option>
                <option>Deluxe</option>
                <option>Suite</option>
                <option>Presidental</option>
            </select>

            <input type="text" placeholder="Harga per malam"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]">

            <select
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] bg-white px-4 py-3 outline-none focus:border-[#7EA1BA]">
                <option>Tersedia</option>
                <option>Terisi</option>
                <option>Perbaikan</option>
            </select>

            <input type="text" placeholder="Keterangan"
                class="mb-6 w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]">

            <div class="flex justify-end gap-4">
                <button onclick="closeTambahModal()"
                    class="rounded-xl border border-[#D1CCC0] px-7 py-3 hover:bg-gray-100 transition">
                    Batal
                </button>
                <button onclick="closeTambahModal()"
                    class="rounded-xl bg-[#7EA1BA] px-7 py-3 font-semibold text-white hover:bg-[#668BA5] transition">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="modalEdit" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
        <div class="w-full max-w-lg rounded-2xl bg-white p-8 shadow-xl font-serif text-[#243b53]">
            <h2 class="mb-1 text-[26px] font-bold text-[#0B2A55]">Edit Kamar</h2>
            <p class="mb-6 text-[15px] text-[#47627A]">Silakan ubah detail kamar di bawah ini.</p>

            <input id="edit_nomor" type="text"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]">

            <select id="edit_jenis"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] bg-white px-4 py-3 outline-none focus:border-[#7EA1BA]">
                <option>Standard</option>
                <option>Deluxe</option>
                <option>Suite</option>
                <option>Presidental</option>
            </select>

            <input id="edit_harga" type="text"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]">

            <div class="mb-4 grid grid-cols-2 gap-4">
                <input id="edit_lantai" type="number" placeholder="Lantai"
                    class="w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]">

                <input id="edit_kapasitas" type="number" placeholder="Kapasitas"
                    class="w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]">
            </div>

            <select id="edit_status"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] bg-white px-4 py-3 outline-none focus:border-[#7EA1BA]">
                <option value="tersedia">Tersedia</option>
                <option value="terisi">Terisi</option>
                <option value="perbaikan">Perbaikan</option>
            </select>

            <input id="edit_keterangan" type="text" placeholder="Keterangan"
                class="mb-6 w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]">

            <div class="flex justify-end gap-4">
                <button onclick="closeEditModal()"
                    class="rounded-xl border border-[#D1CCC0] px-7 py-3 hover:bg-gray-100 transition">
                    Batal
                </button>
                <button onclick="closeEditModal()"
                    class="rounded-xl bg-[#7EA1BA] px-7 py-3 font-semibold text-white hover:bg-[#668BA5] transition">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <script>
        const PER_PAGE = 10;
        let currentFilter = 'semua';
        let currentPage = 1;

        function getFilteredRows() {
            const search = document.getElementById('searchInput').value.toLowerCase().trim();

            return Array.from(document.querySelectorAll('.kamar-row')).filter(row => {
                const matchSearch = !search || row.dataset.nomor.includes(search) || row.dataset.jenis.includes(
                    search);
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

            document.querySelectorAll('.kamar-row').forEach(r => r.classList.add('hidden'));
            filtered.slice(start, end).forEach(r => r.classList.remove('hidden'));

            const showing = filtered.slice(start, end).length;

            document.getElementById('paginationInfo').textContent = total === 0 ?
                'Tidak ada kamar ditemukan.' :
                `Menampilkan ${start + 1}-${start + showing} dari ${total} kamar`;

            const btnsEl = document.getElementById('paginationBtns');
            btnsEl.innerHTML = '';

            const btn = (label, page, disabled) => {
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

            btnsEl.appendChild(btn('&lt;', currentPage - 1, currentPage === 1));

            for (let i = 1; i <= lastPage; i++) {
                btnsEl.appendChild(btn(i, i, false));
            }

            btnsEl.appendChild(btn('&gt;', currentPage + 1, currentPage === lastPage));
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

        function openTambahModal() {
            toggle('modalTambah', true);
        }

        function closeTambahModal() {
            toggle('modalTambah', false);
        }

        function openEditModal(nomor, jenis, lantai, harga, kapasitas, status, keterangan) {
            document.getElementById('edit_nomor').value = nomor;
            document.getElementById('edit_jenis').value = jenis;
            document.getElementById('edit_lantai').value = lantai;
            document.getElementById('edit_harga').value = 'Rp. ' + Number(harga).toLocaleString('id-ID');
            document.getElementById('edit_kapasitas').value = kapasitas;
            document.getElementById('edit_status').value = status;
            document.getElementById('edit_keterangan').value = keterangan;

            toggle('modalEdit', true);
        }

        function closeEditModal() {
            toggle('modalEdit', false);
        }

        function toggle(id, show) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden', !show);
            modal.classList.toggle('flex', show);
        }

        function confirmHapus(nomor) {
            if (confirm('Yakin ingin menghapus kamar ' + nomor + '?')) {
                alert('Kamar ' + nomor + ' berhasil dihapus sementara.');
            }
        }

        ['modalTambah', 'modalEdit'].forEach(id => {
            document.getElementById(id).addEventListener('click', function(e) {
                if (e.target === this) toggle(id, false);
            });
        });

        render();
    </script>

@endsection
