@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')
<!-- file: resources/views/kamar/index.blade.php -->

@php
    // ── DUMMY DATA ─────────────────────────────────────────────
    $allKamars = collect([
        ['id'=>1, 'nomor_kamar'=>'201','jenis_kamar'=>'Deluxe',     'harga_per_malam'=>520000, 'lantai'=>2,'kapasitas'=>2,'status'=>'tersedia', 'keterangan'=>''],
        ['id'=>2, 'nomor_kamar'=>'302','jenis_kamar'=>'Suite',      'harga_per_malam'=>750000, 'lantai'=>3,'kapasitas'=>3,'status'=>'tersedia', 'keterangan'=>'Sudah Termasuk Sarapan'],
        ['id'=>3, 'nomor_kamar'=>'103','jenis_kamar'=>'Standard',   'harga_per_malam'=>480000, 'lantai'=>1,'kapasitas'=>2,'status'=>'terisi',   'keterangan'=>''],
        ['id'=>4, 'nomor_kamar'=>'405','jenis_kamar'=>'Presidental','harga_per_malam'=>920000, 'lantai'=>4,'kapasitas'=>4,'status'=>'perbaikan','keterangan'=>'AC rusak'],
        ['id'=>5, 'nomor_kamar'=>'102','jenis_kamar'=>'Standard',   'harga_per_malam'=>480000, 'lantai'=>1,'kapasitas'=>2,'status'=>'tersedia', 'keterangan'=>''],
        ['id'=>6, 'nomor_kamar'=>'203','jenis_kamar'=>'Deluxe',     'harga_per_malam'=>520000, 'lantai'=>2,'kapasitas'=>2,'status'=>'terisi',   'keterangan'=>''],
        ['id'=>7, 'nomor_kamar'=>'304','jenis_kamar'=>'Suite',      'harga_per_malam'=>750000, 'lantai'=>3,'kapasitas'=>3,'status'=>'tersedia', 'keterangan'=>''],
        ['id'=>8, 'nomor_kamar'=>'406','jenis_kamar'=>'Presidental','harga_per_malam'=>920000, 'lantai'=>4,'kapasitas'=>4,'status'=>'perbaikan','keterangan'=>'Renovasi kamar mandi'],
        ['id'=>9, 'nomor_kamar'=>'105','jenis_kamar'=>'Standard',   'harga_per_malam'=>480000, 'lantai'=>1,'kapasitas'=>2,'status'=>'tersedia', 'keterangan'=>''],
        ['id'=>10,'nomor_kamar'=>'206','jenis_kamar'=>'Deluxe',     'harga_per_malam'=>520000, 'lantai'=>2,'kapasitas'=>2,'status'=>'terisi',   'keterangan'=>''],
    ]);

    $totalKamar = $allKamars->count();
    $totalTipe  = $allKamars->pluck('jenis_kamar')->unique()->count();
    $tersedia   = $allKamars->where('status','tersedia')->count();
    $terisi     = $allKamars->where('status','terisi')->count();
    $perbaikan  = $allKamars->where('status','perbaikan')->count();
@endphp

<div class="min-h-screen bg-[#ece6da] px-10 py-6 font-serif text-[#243b53]">

    {{-- ── HEADER ── --}}
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-[28px] font-semibold">Manajemen Kamar</h1>
        <button onclick="openTambahModal()"
            class="border border-gray-500 bg-white px-8 py-2 hover:bg-[#7ea1ba] hover:text-white transition-colors">
            +Tambah kamar
        </button>
    </div>

    {{-- ── STAT CARDS ── --}}
    <div class="mb-8 grid grid-cols-4 gap-8 px-20 text-center">
        <div class="border border-gray-500 bg-white p-2">
            <h2 class="text-[24px] font-semibold">Total kamar</h2>
            <p class="text-[48px] font-semibold">{{ $totalKamar }}</p>
            <p>{{ $totalTipe }} tipe kamar</p>
        </div>
        <div class="border border-gray-500 bg-white p-2">
            <h2 class="text-[24px] font-semibold">Tersedia</h2>
            <p class="text-[48px] font-semibold">{{ $tersedia }}</p>
            <p>{{ round($tersedia / $totalKamar * 100) }}% Dari total</p>
        </div>
        <div class="border border-gray-500 bg-white p-2">
            <h2 class="text-[24px] font-semibold">Terisi</h2>
            <p class="text-[48px] font-semibold">{{ $terisi }}</p>
            <p>{{ round($terisi / $totalKamar * 100) }}% Dari total</p>
        </div>
        <div class="border border-gray-500 bg-white p-2">
            <h2 class="text-[24px] font-semibold">Perbaikan</h2>
            <p class="text-[48px] font-semibold">{{ $perbaikan }}</p>
            <p>{{ round($perbaikan / $totalKamar * 100) }}% Dari total</p>
        </div>
    </div>

    {{-- ── SEARCH & FILTER ── --}}
    <div class="mb-8 grid grid-cols-5 gap-2">
        <input
            id="searchInput"
            type="text"
            placeholder="Cari berdasarkan nomor atau tipe kamar..."
            class="col-span-2 border border-gray-500 bg-white px-4 py-2 outline-none"
            oninput="applyFilter()">

        <button onclick="setFilter('semua')"    id="btn-semua"
            class="filter-btn border border-gray-500 bg-[#7ea1ba] text-white py-2 transition-colors">Semua</button>
        <button onclick="setFilter('tersedia')" id="btn-tersedia"
            class="filter-btn border border-gray-500 bg-white py-2 hover:bg-[#7ea1ba] hover:text-white transition-colors">Tersedia</button>
        <button onclick="setFilter('terisi')"    id="btn-terisi"
            class="filter-btn border border-gray-500 bg-white py-2 hover:bg-[#7ea1ba] hover:text-white transition-colors">Terisi</button>
    </div>

    {{-- ── TABLE ── --}}
    <div class="border border-gray-500 bg-white">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-gray-500">
                    <th class="px-4 py-4">No. Kamar</th>
                    <th class="px-4 py-4">Jenis</th>
                    <th class="px-4 py-4">Harga/malam</th>
                    <th class="px-4 py-4">Status</th>
                    <th class="px-4 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach($allKamars as $k)
                <tr class="kamar-row border-b border-gray-300 hover:bg-gray-50 transition-colors"
                    data-nomor="{{ strtolower($k['nomor_kamar']) }}"
                    data-jenis="{{ strtolower($k['jenis_kamar']) }}"
                    data-status="{{ $k['status'] }}">
                    <td class="px-4 py-4">{{ $k['nomor_kamar'] }}</td>
                    <td class="px-4 py-4">{{ $k['jenis_kamar'] }}</td>
                    <td class="px-4 py-4">Rp. {{ number_format($k['harga_per_malam'], 0, ',', '.') }}</td>
                    <td class="px-4 py-4">
                        <span class="font-medium
                            @if($k['status']==='tersedia') text-green-700
                            @elseif($k['status']==='terisi') text-blue-700
                            @else text-red-600 @endif">
                            {{ ucfirst($k['status']) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center whitespace-nowrap">
                        {{-- Edit --}}
                        <button onclick="openEditModal(
                                '{{ $k['nomor_kamar'] }}',
                                '{{ $k['jenis_kamar'] }}',
                                {{ $k['lantai'] }},
                                {{ $k['harga_per_malam'] }},
                                {{ $k['kapasitas'] }},
                                '{{ $k['status'] }}',
                                '{{ $k['keterangan'] }}')"
                            class="mr-2 text-gray-500 hover:text-[#7ea1ba] transition-colors" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        {{-- Hapus --}}
                        <button onclick="confirmHapus('{{ $k['nomor_kamar'] }}')"
                            class="text-gray-500 hover:text-red-500 transition-colors" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
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
{{-- MODAL: Tambah Kamar                                       --}}
{{-- ══════════════════════════════════════════════════════════ --}}
<div id="modalTambah" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="w-full max-w-lg bg-white p-8 shadow-xl font-serif text-[#243b53]">
        <h2 class="mb-1 text-[22px] font-semibold">Tambah Kamar</h2>
        <p class="mb-6 text-[14px] text-gray-500">Lengkapi informasi kamar yang akan ditambahkan.</p>

        <label class="mb-1 block text-[14px]">No. Kamar</label>
        <input type="text" placeholder="Contoh: 101"
            class="mb-4 w-full border border-gray-500 px-3 py-2 outline-none focus:border-[#7ea1ba]">

        <label class="mb-1 block text-[14px]">Jenis Kamar</label>
        <div class="relative mb-4">
            <select class="w-full appearance-none border border-gray-500 bg-white px-3 py-2 pr-8 outline-none focus:border-[#7ea1ba]">
                <option value="">-- Pilih Jenis --</option>
                <option>Standard</option>
                <option>Deluxe</option>
                <option>Suite</option>
                <option>Presidental</option>
            </select>
            <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">∨</span>
        </div>

        <label class="mb-1 block text-[14px]">Harga per Malam (Rp)</label>
        <input type="text" placeholder="Contoh: 1.900.000"
            class="mb-4 w-full border border-gray-500 px-3 py-2 outline-none focus:border-[#7ea1ba]">

        <label class="mb-1 block text-[14px]">Status</label>
        <div class="relative mb-4">
            <select class="w-full appearance-none border border-gray-500 bg-white px-3 py-2 pr-8 outline-none focus:border-[#7ea1ba]">
                <option>Tersedia</option>
                <option>Terisi</option>
                <option>Perbaikan</option>
            </select>
            <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">∨</span>
        </div>

        <label class="mb-1 block text-[14px]">Keterangan (Opsional)</label>
        <input type="text" placeholder="Contoh: Sudah Termasuk Sarapan"
            class="mb-6 w-full border border-gray-500 px-3 py-2 outline-none focus:border-[#7ea1ba]">

        <div class="flex justify-end gap-4">
            <button onclick="closeTambahModal()"
                class="border border-gray-500 px-8 py-2 hover:bg-gray-100 transition-colors">Batal</button>
            <button onclick="closeTambahModal()"
                class="border border-gray-500 bg-white px-8 py-2 hover:bg-[#7ea1ba] hover:text-white transition-colors">Simpan</button>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════ --}}
{{-- MODAL: Edit Kamar                                         --}}
{{-- ══════════════════════════════════════════════════════════ --}}
<div id="modalEdit" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="w-full max-w-lg bg-white p-8 shadow-xl font-serif text-[#243b53]">
        <h2 class="mb-1 text-[22px] font-semibold">Edit Kamar</h2>
        <p class="mb-6 text-[14px] text-gray-500">Silakan ubah detail kamar di bawah ini.</p>

        <label class="mb-1 block text-[14px]">No. Kamar</label>
        <input id="edit_nomor" type="text"
            class="mb-4 w-full border border-gray-500 px-3 py-2 outline-none focus:border-[#7ea1ba]">

        <label class="mb-1 block text-[14px]">Jenis Kamar</label>
        <div class="relative mb-4">
            <select id="edit_jenis" class="w-full appearance-none border border-gray-500 bg-white px-3 py-2 pr-8 outline-none focus:border-[#7ea1ba]">
                <option>Standard</option>
                <option>Deluxe</option>
                <option>Suite</option>
                <option>Presidental</option>
            </select>
            <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">∨</span>
        </div>

        <label class="mb-1 block text-[14px]">Harga per Malam (Rp)</label>
        <input id="edit_harga" type="text"
            class="mb-4 w-full border border-gray-500 px-3 py-2 outline-none focus:border-[#7ea1ba]">

        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-[14px]">Lantai</label>
                <input id="edit_lantai" type="number"
                    class="w-full border border-gray-500 px-3 py-2 outline-none focus:border-[#7ea1ba]">
            </div>
            <div>
                <label class="mb-1 block text-[14px]">Kapasitas (Orang)</label>
                <input id="edit_kapasitas" type="number"
                    class="w-full border border-gray-500 px-3 py-2 outline-none focus:border-[#7ea1ba]">
            </div>
        </div>

        <label class="mb-1 block text-[14px]">Status</label>
        <div class="relative mb-4">
            <select id="edit_status" class="w-full appearance-none border border-gray-500 bg-white px-3 py-2 pr-8 outline-none focus:border-[#7ea1ba]">
                <option value="tersedia">Tersedia</option>
                <option value="terisi">Terisi</option>
                <option value="perbaikan">Perbaikan</option>
            </select>
            <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">∨</span>
        </div>

        <label class="mb-1 block text-[14px]">Keterangan (Opsional)</label>
        <input id="edit_keterangan" type="text"
            class="mb-6 w-full border border-gray-500 px-3 py-2 outline-none focus:border-[#7ea1ba]">

        <div class="flex justify-end gap-4">
            <button onclick="closeEditModal()"
                class="border border-gray-500 px-8 py-2 hover:bg-gray-100 transition-colors">Batal</button>
            <button onclick="closeEditModal()"
                class="border border-gray-500 bg-white px-8 py-2 hover:bg-[#7ea1ba] hover:text-white transition-colors">Simpan</button>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════ --}}
{{-- JAVASCRIPT                                                --}}
{{-- ══════════════════════════════════════════════════════════ --}}
<script>
    const PER_PAGE    = 4;
    let currentFilter = 'semua';
    let currentPage   = 1;

    function getFilteredRows() {
        const search = document.getElementById('searchInput').value.toLowerCase().trim();
        return Array.from(document.querySelectorAll('.kamar-row')).filter(row => {
            const matchSearch = !search ||
                row.dataset.nomor.includes(search) ||
                row.dataset.jenis.includes(search);
            const matchFilter =
                currentFilter === 'semua' ||
                (currentFilter === 'tersedia' && row.dataset.status === 'tersedia') ||
                (currentFilter === 'terisi'    && row.dataset.status === 'terisi')   ||
                (currentFilter === 'perbaikan'&& row.dataset.status === 'perbaikan');
            return matchSearch && matchFilter;
        });
    }

    function render() {
        const filtered = getFilteredRows();
        const total    = filtered.length;
        const lastPage = Math.max(1, Math.ceil(total / PER_PAGE));
        if (currentPage > lastPage) currentPage = lastPage;

        const start = (currentPage - 1) * PER_PAGE;
        const end   = start + PER_PAGE;

        // Tampilkan/sembunyikan baris
        document.querySelectorAll('.kamar-row').forEach(r => r.classList.add('hidden'));
        filtered.slice(start, end).forEach(r => r.classList.remove('hidden'));

        // Info teks
        const showing = filtered.slice(start, end).length;
        document.getElementById('paginationInfo').textContent = total === 0
            ? 'Tidak ada kamar ditemukan.'
            : `Menampilkan ${start + 1}-${start + showing} dari ${total} kamar`;

        // Pagination buttons
        const btnsEl = document.getElementById('paginationBtns');
        btnsEl.innerHTML = '';

        const btn = (label, page, disabled) => {
            const b = document.createElement('button');
            b.innerHTML = label;
            const isActive = page === currentPage && typeof page === 'number';
            b.className = 'border border-gray-500 px-3 py-1 transition-colors ' +
                (disabled ? 'text-gray-300 cursor-default ' : 'hover:bg-[#7ea1ba] hover:text-white ') +
                (isActive  ? 'bg-[#7ea1ba] text-white ' : '');
            if (!disabled) b.onclick = () => { currentPage = page; render(); };
            return b;
        };

        btnsEl.appendChild(btn('&lt;', currentPage - 1, currentPage === 1));
        for (let i = 1; i <= lastPage; i++) btnsEl.appendChild(btn(i, i, false));
        btnsEl.appendChild(btn('&gt;', currentPage + 1, currentPage === lastPage));
    }

    function setFilter(f) {
        currentFilter = f;
        currentPage   = 1;
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('bg-[#7ea1ba]', 'text-white');
            b.classList.add('bg-white');
        });
        const ab = document.getElementById('btn-' + f);
        if (ab) { ab.classList.add('bg-[#7ea1ba]','text-white'); ab.classList.remove('bg-white'); }
        render();
    }

    function applyFilter() { currentPage = 1; render(); }

    // Modal Tambah
    function openTambahModal()  { toggle('modalTambah', true); }
    function closeTambahModal() { toggle('modalTambah', false); }

    // Modal Edit
    function openEditModal(nomor, jenis, lantai, harga, kapasitas, status, keterangan) {
        document.getElementById('edit_nomor').value      = nomor;
        document.getElementById('edit_jenis').value      = jenis;
        document.getElementById('edit_lantai').value     = lantai;
        document.getElementById('edit_harga').value      = 'Rp. ' + Number(harga).toLocaleString('id-ID');
        document.getElementById('edit_kapasitas').value  = kapasitas;
        document.getElementById('edit_status').value     = status;
        document.getElementById('edit_keterangan').value = keterangan;
        toggle('modalEdit', true);
    }
    function closeEditModal() { toggle('modalEdit', false); }

    function toggle(id, show) {
        const m = document.getElementById(id);
        m.classList.toggle('hidden', !show);
        m.classList.toggle('flex', show);
    }

    // Hapus dummy
    function confirmHapus(nomor) {
        if (confirm('Yakin ingin menghapus kamar ' + nomor + '?')) {
            alert('(Frontend only) Kamar ' + nomor + ' akan dihapus saat backend tersambung.');
        }
    }

    // Klik backdrop tutup modal
    ['modalTambah','modalEdit'].forEach(id => {
        document.getElementById(id).addEventListener('click', function(e) {
            if (e.target === this) toggle(id, false);
        });
    });

    // Init
    render();
</script>
@endsection