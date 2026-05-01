@extends('layouts.app')

@section('title', 'Verifikasi Admin')

@section('content')

<div class="bg-[#ece6da] min-h-screen px-10 py-8">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6 mb-6">
        <div>
            <h1 class="text-[34px] font-semibold text-[#243b53]">Verifikasi pembayaran</h1>
            <p class="text-[20px] text-[#243b53] leading-relaxed max-w-[700px]">
                Konfirmasi pembayaran dari tamu untuk menyelesaikan proses reservasi.
            </p>
        </div>

        <div class="flex justify-end">
            <input
                type="text"
                id="searchInput"
                placeholder="Cari ID. Pemesanan"
                oninput="filterTable()"
                class="w-full lg:w-[300px] rounded-full border border-gray-400 bg-white px-5 py-3 text-[18px] text-[#243b53] outline-none"
            >
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="border border-gray-400 bg-white p-6">
            <p class="text-[18px] text-gray-400 mb-2">Menunggu Verifikasi</p>
            <div class="flex items-center justify-between">
                <h2 class="text-[40px] font-semibold text-[#243b53]" id="statMenunggu">{{ $statistik['menunggu'] }}</h2>
                <span class="text-[28px] text-[#243b53]">🕒</span>
            </div>
        </div>

        <div class="border border-gray-400 bg-white p-6">
            <p class="text-[18px] text-gray-400 mb-2">Terverifikasi</p>
            <div class="flex items-center justify-between">
                <h2 class="text-[40px] font-semibold text-[#243b53]" id="statTerverifikasi">{{ $statistik['terverifikasi'] }}</h2>
                <span class="text-[28px] text-[#243b53]">✔</span>
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="border border-gray-400 bg-white">
        <div class="border-b border-gray-400 px-6 py-4">
            <h2 class="text-[28px] font-semibold text-[#243b53]">
                Daftar Pembayaran Menunggu Verifikasi
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left text-[#243b53]" id="paymentTable">
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
                <tbody id="tableBody">
                    @forelse($pembayaran as $item)
                        <tr class="border-b border-gray-300 table-row"
                            data-id="{{ strtolower($item['id']) }}"
                            data-nama="{{ strtolower($item['nama']) }}">
                            <td class="px-4 py-4 text-[17px]">{{ $item['id'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['nama'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['metode'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['jumlah'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['tanggal'] }}</td>
                            <td class="px-4 py-4 text-[17px] capitalize">
                                @php
                                    $statusClass = match($item['status']) {
                                        'menunggu'      => 'bg-yellow-100 text-yellow-800',
                                        'terverifikasi' => 'bg-green-100 text-green-800',
                                        'ditolak'       => 'bg-red-100 text-red-800',
                                        default         => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[14px] font-medium {{ $statusClass }}">
                                    {{ ucfirst($item['status']) }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <button
                                    onclick="openModal(
                                        '{{ $item['id'] }}',
                                        '{{ $item['nama'] }}',
                                        '{{ $item['metode'] }}',
                                        '{{ $item['jumlah'] }}',
                                        '{{ $item['tanggal'] }}',
                                        '{{ $item['status'] }}',
                                        '{{ $item['bukti'] ?? '' }}'
                                    )"
                                    class="rounded-lg border border-gray-400 bg-white px-3 py-2 text-[16px] transition hover:bg-[#7ea1ba] hover:text-white">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="7" class="px-4 py-8 text-center text-gray-400 text-[17px]">
                                Tidak ada data pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Baris muncul saat pencarian tidak menemukan hasil --}}
            <div id="noResult" class="hidden px-4 py-8 text-center text-gray-400 text-[17px]">
                Tidak ada data yang cocok dengan pencarian.
            </div>
        </div>
    </div>
</div>

{{-- ======================== MODAL DETAIL ======================== --}}
<div id="modalOverlay"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50"
     onclick="handleOverlayClick(event)">

    <div class="bg-white rounded-lg w-full max-w-xl mx-4 p-7 relative">

        {{-- Tombol tutup --}}
        <button onclick="closeModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-[22px] leading-none">
            &times;
        </button>

        <h2 class="text-[22px] font-semibold text-[#243b53] mb-5 pb-4 border-b border-gray-200">
            Detail pembayaran
        </h2>

        {{-- Baris 1: ID & Status --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-[14px] text-[#243b53] mb-1">ID. Pemesanan</label>
                <input id="mId" readonly
                       class="w-full border border-gray-300 rounded px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
            </div>
            <div>
                <label class="block text-[14px] text-[#243b53] mb-1">Status</label>
                <input id="mStatus" readonly
                       class="w-full border border-gray-300 rounded px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
            </div>
        </div>

        {{-- Baris 2: Nama tamu --}}
        <div class="mb-4">
            <label class="block text-[14px] text-[#243b53] mb-1">Nama tamu</label>
            <input id="mNama" readonly
                   class="w-full border border-gray-300 rounded px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
        </div>

        {{-- Baris 3: Bukti pembayaran --}}
        <div class="mb-4">
            <label class="block text-[14px] text-[#243b53] mb-1">Bukti Pembayaran</label>
            <div id="mBuktiWrap" class="border border-gray-300 rounded bg-gray-50 min-h-[90px] flex items-center justify-center">
                <span id="mBuktiEmpty" class="text-gray-400 text-[14px]">Tidak ada bukti diunggah</span>
                <img id="mBuktiImg" src="" alt="Bukti Pembayaran"
                     class="hidden max-h-[160px] object-contain rounded">
            </div>
        </div>

        {{-- Baris 4: Metode & Jumlah --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-[14px] text-[#243b53] mb-1">Metode pembayaran</label>
                <input id="mMetode" readonly
                       class="w-full border border-gray-300 rounded px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
            </div>
            <div>
                <label class="block text-[14px] text-[#243b53] mb-1">Jumlah</label>
                <input id="mJumlah" readonly
                       class="w-full border border-gray-300 rounded px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
            </div>
        </div>

        {{-- Baris 5: Tanggal --}}
        <div class="mb-6">
            <label class="block text-[14px] text-[#243b53] mb-1">Tanggal pembayaran</label>
            <input id="mTanggal" readonly
                   class="w-full border border-gray-300 rounded px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
        </div>

        {{-- Tombol aksi (hanya muncul jika status menunggu) --}}
        <div id="modalActions" class="flex gap-3">
            <button onclick="aksiVerifikasi()"
                    class="flex-1 py-3 border border-gray-400 rounded-lg text-[16px] text-[#243b53] bg-white hover:bg-[#7ea1ba] hover:text-white transition">
                Verifikasi pembayaran
            </button>
            <button onclick="aksiTolak()"
                    class="px-6 py-3 border border-gray-400 rounded-lg text-[16px] text-red-600 bg-white hover:bg-red-50 hover:border-red-400 transition">
                Tolak
            </button>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    {{-- ============================================================
         DATA: Ambil dari Blade lalu simpan di JS array agar
         pencarian & update status bisa dilakukan tanpa reload.
         Saat integrasi backend, ganti aksiVerifikasi/aksiTolak
         dengan fetch() ke endpoint Laravel yang sesuai.
    ============================================================ --}}
    const allRows = document.querySelectorAll('.table-row');
    const noResult = document.getElementById('noResult');

    // ── PENCARIAN ────────────────────────────────────────────────
    function filterTable() {
        const q = document.getElementById('searchInput').value.toLowerCase().trim();
        let visible = 0;

        allRows.forEach(row => {
            const id   = row.dataset.id   || '';
            const nama = row.dataset.nama || '';
            const match = !q || id.includes(q) || nama.includes(q);
            row.classList.toggle('hidden', !match);
            if (match) visible++;
        });

        noResult.classList.toggle('hidden', visible > 0);
    }

    // ── MODAL ────────────────────────────────────────────────────
    let activeRow = null;  // simpan referensi <tr> yang sedang dibuka

    function openModal(id, nama, metode, jumlah, tanggal, status, bukti) {
        document.getElementById('mId').value     = id;
        document.getElementById('mStatus').value = capitalize(status);
        document.getElementById('mNama').value   = nama;
        document.getElementById('mMetode').value = metode;
        document.getElementById('mJumlah').value = jumlah;
        document.getElementById('mTanggal').value= tanggal;

        // Bukti: tampilkan gambar jika ada, teks placeholder jika tidak
        const img   = document.getElementById('mBuktiImg');
        const empty = document.getElementById('mBuktiEmpty');
        if (bukti) {
            img.src = bukti;
            img.classList.remove('hidden');
            empty.classList.add('hidden');
        } else {
            img.src = '';
            img.classList.add('hidden');
            empty.classList.remove('hidden');
        }

        // Sembunyikan tombol aksi jika sudah bukan menunggu
        const actions = document.getElementById('modalActions');
        actions.classList.toggle('hidden', status !== 'menunggu');

        // Simpan referensi baris aktif agar bisa diupdate setelah aksi
        activeRow = [...allRows].find(r => r.dataset.id === id.toLowerCase()) || null;

        // Tampilkan modal
        const overlay = document.getElementById('modalOverlay');
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
    }

    function closeModal() {
        const overlay = document.getElementById('modalOverlay');
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        activeRow = null;
    }

    function handleOverlayClick(e) {
        if (e.target === document.getElementById('modalOverlay')) closeModal();
    }

    function aksiVerifikasi() {
        if (!activeRow) return;
        updateStatus(activeRow, 'terverifikasi', 'bg-green-100', 'text-green-800');
        closeModal();
    }

    function aksiTolak() {
        if (!activeRow) return;
        updateStatus(activeRow, 'ditolak', 'bg-red-100', 'text-red-800');
        closeModal();
    }

    function updateStatus(row, newStatus, bgClass, textClass) {
        // Update badge status di tabel
        const badge = row.querySelector('span[class*="rounded-full"]');
        if (badge) {
            badge.className = `px-3 py-1 rounded-full text-[14px] font-medium ${bgClass} ${textClass}`;
            badge.textContent = capitalize(newStatus);
        }

        // Update dataset agar filter tetap benar
        row.dataset.status = newStatus;

        // Update tombol Detail agar merefleksikan status baru
        const btn = row.querySelector('button');
        if (btn) {
            const oldOnclick = btn.getAttribute('onclick');
            // Ganti parameter status (argumen ke-6) dalam string onclick
            btn.setAttribute('onclick',
                oldOnclick.replace(/'menunggu'|'terverifikasi'|'ditolak'/, `'${newStatus}'`)
            );
        }

        // Update counter statistik
        updateStats();
    }

    function updateStats() {
        let menunggu = 0, terverifikasi = 0;
        document.querySelectorAll('.table-row').forEach(row => {
            const badge = row.querySelector('span[class*="rounded-full"]');
            if (!badge) return;
            const text = badge.textContent.trim().toLowerCase();
            if (text === 'menunggu')      menunggu++;
            if (text === 'terverifikasi') terverifikasi++;
        });
        document.getElementById('statMenunggu').textContent      = menunggu;
        document.getElementById('statTerverifikasi').textContent = terverifikasi;
    }

    // ── HELPERS ──────────────────────────────────────────────────
    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
</script>
@endpush