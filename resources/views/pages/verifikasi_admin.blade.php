@extends('layouts.app')

@section('title', 'Verifikasi Admin')

@section('content')

<x-breadcrumb :items="[
    ['label' => 'Dashboard Admin', 'route' => route('statistik.admin')],
    ['label' => 'Verifikasi Pemesanan']
]" />

<div class="bg-[#F2EDE4] min-h-screen px-12 py-10">

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-300 bg-green-50 px-5 py-3 text-[15px] text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 rounded-xl border border-red-300 bg-red-50 px-5 py-3 text-[15px] text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">
        <div>
            <h1 class="text-[36px] font-bold text-[#0B2A55]">Verifikasi Pemesanan</h1>
            <p class="text-[18px] text-[#243b53] mt-2">
                Konfirmasi atau tolak pemesanan tamu sebelum reservasi menjadi aktif.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-end w-full lg:w-auto">
            <input type="text" id="searchInput" placeholder="Cari ID / Nama Tamu..."
                oninput="filterTable()"
                class="w-full sm:w-[330px] rounded-xl border border-[#D1CCC0] bg-white px-5 py-3 text-[16px] text-[#243b53] shadow-sm outline-none focus:border-[#7EA1BA]">

            <select id="statusFilter" onchange="filterTable()"
                class="w-full sm:w-[200px] rounded-xl border border-[#D1CCC0] bg-white px-5 py-3 text-[16px] text-[#243b53] shadow-sm outline-none focus:border-[#7EA1BA]">
                <option value="semua">Semua Status</option>
                <option value="pending">Menunggu</option>
                <option value="aktif">Aktif</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-full bg-[#FFF0C7] flex items-center justify-center text-[34px]">🕒</div>
                <div>
                    <p class="text-[17px] text-[#243b53]">Menunggu Konfirmasi</p>
                    <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $statistik['menunggu'] }}</h2>
                    <p class="text-[15px] text-[#47627A]">Pemesanan belum dikonfirmasi</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-full bg-[#D8F3DF] flex items-center justify-center text-[34px]">✔</div>
                <div>
                    <p class="text-[17px] text-[#243b53]">Aktif</p>
                    <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $statistik['aktif'] }}</h2>
                    <p class="text-[15px] text-[#47627A]">Pemesanan telah dikonfirmasi</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-full bg-[#FFE4E4] flex items-center justify-center text-[34px]">✕</div>
                <div>
                    <p class="text-[17px] text-[#243b53]">Dibatalkan</p>
                    <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $statistik['dibatalkan'] }}</h2>
                    <p class="text-[15px] text-[#47627A]">Pemesanan ditolak/dibatalkan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="rounded-2xl border border-[#D1CCC0] bg-white shadow-md overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-[28px] font-semibold text-[#243b53]">Daftar Pemesanan</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left text-[#243b53] text-[15px]">
                <thead>
                    <tr class="bg-[#F8FAFC] border-y border-[#E2E8F0]">
                        <th class="px-4 py-4 text-[16px] font-semibold">ID Pemesanan</th>
                        <th class="px-4 py-4 text-[16px] font-semibold">Nama Tamu</th>
                        <th class="px-4 py-4 text-[16px] font-semibold">Tipe Kamar</th>
                        <th class="px-4 py-4 text-[16px] font-semibold">Check-in</th>
                        <th class="px-4 py-4 text-[16px] font-semibold">Check-out</th>
                        <th class="px-4 py-4 text-[16px] font-semibold">Total</th>
                        <th class="px-4 py-4 text-[16px] font-semibold">Status</th>
                        <th class="px-4 py-4 text-[16px] font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($reservasiList as $rsv)
                        @php
                            $durasi = $rsv->check_in->diffInDays($rsv->check_out);
                            $total  = ($rsv->tipe->harga_kamar ?? 0) * $durasi;
                            $status = $rsv->status_reservasi ?? 'pending';

                            $badgeClass = match($status) {
                                'aktif'      => 'bg-green-100 text-green-800',
                                'dibatalkan' => 'bg-red-100 text-red-800',
                                default      => 'bg-yellow-100 text-yellow-800',
                            };
                            $badgeLabel = match($status) {
                                'aktif'      => 'Aktif',
                                'dibatalkan' => 'Dibatalkan',
                                default      => 'Menunggu',
                            };

                            $idLabel = '#RSV-' . str_pad($rsv->id_reservasi, 3, '0', STR_PAD_LEFT);
                        @endphp
                        <tr class="border-b border-gray-200 table-row"
                            data-id="{{ strtolower($idLabel) }}"
                            data-nama="{{ strtolower($rsv->tamu->name ?? '') }}"
                            data-status="{{ $status }}">

                            <td class="px-4 py-4 font-mono text-[15px]">{{ $idLabel }}</td>
                            <td class="px-4 py-4">{{ $rsv->tamu->name ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $rsv->tipe->detail_kamar ?? '-' }}</td>
                            <td class="px-4 py-4">{{ $rsv->check_in->translatedFormat('d M Y') }}</td>
                            <td class="px-4 py-4">{{ $rsv->check_out->translatedFormat('d M Y') }}</td>
                            <td class="px-4 py-4 font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                            <td class="px-4 py-4">
                                <span class="px-3 py-1 rounded-full text-[13px] font-semibold {{ $badgeClass }}">
                                    {{ $badgeLabel }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <button onclick="openModal(
                                        {{ $rsv->id_reservasi }},
                                        '{{ addslashes($idLabel) }}',
                                        '{{ addslashes($rsv->tamu->name ?? '-') }}',
                                        '{{ addslashes($rsv->tipe->detail_kamar ?? '-') }}',
                                        '{{ $rsv->check_in->translatedFormat('d M Y') }}',
                                        '{{ $rsv->check_out->translatedFormat('d M Y') }}',
                                        {{ $durasi }},
                                        'Rp {{ number_format($total, 0, ',', '.') }}',
                                        '{{ $status }}'
                                    )"
                                    class="rounded-lg border border-gray-400 bg-white px-4 py-2 text-[15px] transition hover:bg-[#7ea1ba] hover:text-white">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-400 text-[17px]">
                                Belum ada pemesanan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="noResult" class="hidden px-4 py-8 text-center text-gray-400 text-[17px]">
            Tidak ada data yang cocok dengan pencarian.
        </div>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="modalOverlay" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50"
    onclick="handleOverlayClick(event)">
    <div class="bg-white rounded-2xl w-full max-w-lg p-7 relative shadow-xl"
        onclick="event.stopPropagation()">

        <button onclick="closeModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-[24px] leading-none">
            &times;
        </button>

        <h2 class="text-[22px] font-semibold text-[#243b53] mb-5 pb-4 border-b border-gray-200">
            Detail Pemesanan
        </h2>

        <div class="space-y-3 mb-6">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[13px] text-gray-500 mb-1">ID Pemesanan</label>
                    <div id="mId" class="border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-[15px] font-mono"></div>
                </div>
                <div>
                    <label class="block text-[13px] text-gray-500 mb-1">Status</label>
                    <div id="mStatus" class="border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-[15px]"></div>
                </div>
            </div>
            <div>
                <label class="block text-[13px] text-gray-500 mb-1">Nama Tamu</label>
                <div id="mNama" class="border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-[15px]"></div>
            </div>
            <div>
                <label class="block text-[13px] text-gray-500 mb-1">Tipe Kamar</label>
                <div id="mTipe" class="border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-[15px]"></div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[13px] text-gray-500 mb-1">Check-in</label>
                    <div id="mCi" class="border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-[15px]"></div>
                </div>
                <div>
                    <label class="block text-[13px] text-gray-500 mb-1">Check-out</label>
                    <div id="mCo" class="border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-[15px]"></div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[13px] text-gray-500 mb-1">Durasi</label>
                    <div id="mDurasi" class="border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-[15px]"></div>
                </div>
                <div>
                    <label class="block text-[13px] text-gray-500 mb-1">Total Tagihan</label>
                    <div id="mTotal" class="border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-[15px] font-semibold"></div>
                </div>
            </div>
        </div>

        {{-- Tombol aksi: hanya muncul kalau status pending --}}
        <div id="modalActions" class="flex gap-3">
            <form id="approveForm" method="POST" action="" class="flex-1">
                @csrf
                <button type="submit"
                    class="w-full py-3 rounded-lg bg-[#243b53] text-white text-[15px] font-semibold transition hover:bg-[#7ea1ba]">
                    ✔ Konfirmasi Pemesanan
                </button>
            </form>
            <form id="tolakForm" method="POST" action="">
                @csrf
                <button type="submit"
                    class="px-5 py-3 rounded-lg border border-red-400 text-red-600 bg-white text-[15px] font-semibold transition hover:bg-red-50">
                    ✕ Tolak
                </button>
            </form>
        </div>

        {{-- Info kalau sudah diproses --}}
        <div id="modalInfo" class="hidden rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-[14px] text-gray-500 text-center">
            Pemesanan ini sudah diproses dan tidak dapat diubah lagi.
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function filterTable() {
        const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
        const status  = document.getElementById('statusFilter').value.toLowerCase();
        const rows    = document.querySelectorAll('.table-row');
        let visible   = 0;

        rows.forEach(row => {
            const cocokSearch = row.dataset.id.includes(keyword) || row.dataset.nama.includes(keyword);
            const cocokStatus = status === 'semua' || row.dataset.status === status;
            if (cocokSearch && cocokStatus) { row.style.display = ''; visible++; }
            else row.style.display = 'none';
        });

        document.getElementById('noResult').classList.toggle('hidden', visible > 0);
    }

    function openModal(idRsv, idLabel, nama, tipe, ci, co, durasi, total, status) {
        document.getElementById('mId').textContent     = idLabel;
        document.getElementById('mNama').textContent   = nama;
        document.getElementById('mTipe').textContent   = tipe;
        document.getElementById('mCi').textContent     = ci;
        document.getElementById('mCo').textContent     = co;
        document.getElementById('mDurasi').textContent = durasi + ' malam';
        document.getElementById('mTotal').textContent  = total;

        const badgeMap = {
            pending:    'Menunggu Konfirmasi',
            aktif:      'Aktif',
            dibatalkan: 'Dibatalkan',
        };
        document.getElementById('mStatus').textContent = badgeMap[status] ?? status;

        document.getElementById('approveForm').action = '/verifikasi/' + idRsv;
        document.getElementById('tolakForm').action   = '/verifikasi/' + idRsv + '/tolak';

        const isPending = status === 'pending';
        document.getElementById('modalActions').classList.toggle('hidden', !isPending);
        document.getElementById('modalInfo').classList.toggle('hidden', isPending);

        document.getElementById('modalOverlay').classList.remove('hidden');
        document.getElementById('modalOverlay').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modalOverlay').classList.add('hidden');
        document.getElementById('modalOverlay').classList.remove('flex');
    }

    function handleOverlayClick(e) {
        if (e.target === document.getElementById('modalOverlay')) closeModal();
    }
</script>
@endpush