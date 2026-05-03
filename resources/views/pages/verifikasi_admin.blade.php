@extends('layouts.app')

@section('title', 'Verifikasi Admin')

@section('content')

    <div class="bg-[#F2EDE4] min-h-screen px-12 py-10">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">
            <div>
                <h1 class="text-[36px] font-bold text-[#0B2A55]">
                    Verifikasi Pembayaran
                </h1>
                <p class="text-[18px] text-[#243b53] mt-2">
                    Konfirmasi pembayaran dari tamu untuk menyelesaikan proses pemesanan.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-end w-full lg:w-auto">

                <input type="text" id="searchInput" placeholder="Cari ID / Nama Tamu..." oninput="filterTable()"
                    class="w-full sm:w-[330px] rounded-xl border border-[#D1CCC0] bg-white px-5 py-3 text-[16px] text-[#243b53] shadow-sm outline-none focus:border-[#7EA1BA]">

                <div class="w-full sm:w-[200px]">
                    <select id="statusFilter" onchange="filterTable()"
                        class="w-full rounded-xl border border-[#D1CCC0] bg-white px-5 py-3 pr-10 text-[16px] text-[#243b53] shadow-sm outline-none focus:border-[#7EA1BA]">

                        <option value="semua">Semua Status</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="terverifikasi">Terverifikasi</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-full bg-[#FFF0C7] flex items-center justify-center text-[34px]">
                        🕒
                    </div>

                    <div>
                        <p class="text-[17px] text-[#243b53]">Menunggu Verifikasi</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]" id="statMenunggu">
                            {{ $statistik['menunggu'] }}
                        </h2>
                        <p class="text-[15px] text-[#47627A]">
                            Pembayaran menunggu konfirmasi
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md">
                <div class="flex items-center gap-6">
                    <div
                        class="w-20 h-20 rounded-full bg-[#D8F3DF] flex items-center justify-center text-[34px] text-green-600">
                        ✔
                    </div>

                    <div>
                        <p class="text-[17px] text-[#243b53]">Terverifikasi</p>
                        <h2 class="text-[42px] font-bold text-[#0B2A55]" id="statTerverifikasi">
                            {{ $statistik['terverifikasi'] }}
                        </h2>
                        <p class="text-[15px] text-[#47627A]">
                            Pembayaran telah dikonfirmasi
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-[#D1CCC0] bg-white shadow-md overflow-hidden">
            <div class="border-b border-gray-400 px-6 py-4">
                <h2 class="text-[28px] font-semibold text-[#243b53]">
                    Daftar Pembayaran Menunggu Verifikasi
                </h2>
            </div>

            <table class="w-full border-collapse text-left text-[#243b53] text-[15px]" id="paymentTable">
                <thead>
                    <tr class="bg-[#F8FAFC] border-y border-[#E2E8F0]">
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
                        <tr class="border-b border-gray-300 table-row" data-id="{{ strtolower($item['id']) }}"
                            data-nama="{{ strtolower($item['nama']) }}" data-status="{{ strtolower($item['status']) }}"
                            data-bukti="{{ $item['bukti'] ?? '' }}">

                            <td class="px-4 py-4 text-[17px]">{{ $item['id'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['nama'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['metode'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['jumlah'] }}</td>
                            <td class="px-4 py-4 text-[17px]">{{ $item['tanggal'] }}</td>

                            <td class="px-4 py-4 text-[17px] capitalize">
                                @php
                                    $statusClass = match ($item['status']) {
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'terverifikasi' => 'bg-green-100 text-green-800',
                                        'ditolak' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
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
                                    this.closest('tr').dataset.bukti
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

            <div id="noResult" class="hidden px-4 py-8 text-center text-gray-400 text-[17px]">
                Tidak ada data yang cocok dengan pencarian.
            </div>
        </div>
    </div>

    <div id="modalOverlay" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50"
        onclick="handleOverlayClick(event)">

        <div class="bg-white rounded-2xl w-full max-w-xl mx-4 p-7 relative shadow-xl">

            <button onclick="closeModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-[24px] leading-none">
                &times;
            </button>

            <h2 class="text-[24px] font-semibold text-[#243b53] mb-5 pb-4 border-b border-gray-200">
                Detail pembayaran
            </h2>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-[14px] text-[#243b53] mb-1">ID. Pemesanan</label>
                    <input id="mId" readonly
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
                </div>

                <div>
                    <label class="block text-[14px] text-[#243b53] mb-1">Status</label>
                    <input id="mStatus" readonly
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-[14px] text-[#243b53] mb-1">Nama tamu</label>
                <input id="mNama" readonly
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-[14px] text-[#243b53] mb-1">
                    Bukti Pembayaran
                </label>

                <div id="mBuktiWrap"
                    class="border border-gray-300 rounded-xl bg-gray-50 min-h-[170px] flex flex-col items-center justify-center overflow-hidden p-3">

                    <span id="mBuktiEmpty" class="text-gray-400 text-[14px]">
                        Tidak ada bukti diunggah
                    </span>

                    <img id="mBuktiImg" src="" alt="Bukti Pembayaran"
                        class="hidden max-h-[190px] w-full object-contain rounded-lg">
                </div>

                <label for="uploadBukti"
                    class="mt-3 inline-block cursor-pointer rounded-lg border border-[#7ea1ba] bg-white px-4 py-2 text-[14px] font-semibold text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white">
                    + Tambah Foto Bukti
                </label>

                <input type="file" id="uploadBukti" accept="image/*" class="hidden" onchange="previewBukti(event)">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-[14px] text-[#243b53] mb-1">Metode pembayaran</label>
                    <input id="mMetode" readonly
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
                </div>

                <div>
                    <label class="block text-[14px] text-[#243b53] mb-1">Jumlah</label>
                    <input id="mJumlah" readonly
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-[14px] text-[#243b53] mb-1">Tanggal pembayaran</label>
                <input id="mTanggal" readonly
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[15px] text-[#243b53] bg-gray-50 outline-none">
            </div>

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
        const allRows = document.querySelectorAll('.table-row');
        const noResult = document.getElementById('noResult');

        let activeRow = null;

        function filterTable() {
            const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
            const status = document.getElementById('statusFilter').value.toLowerCase();

            const rows = document.querySelectorAll('.table-row');
            let visible = 0;

            rows.forEach(row => {
                const id = row.dataset.id;
                const nama = row.dataset.nama;
                const rowStatus = row.dataset.status;

                const cocokSearch = id.includes(keyword) || nama.includes(keyword);
                const cocokStatus = status === 'semua' || rowStatus === status;

                if (cocokSearch && cocokStatus) {
                    row.style.display = '';
                    visible++;
                } else {
                    row.style.display = 'none';
                }
            });

            noResult.classList.toggle('hidden', visible > 0);
        }

        function openModal(id, nama, metode, jumlah, tanggal, status, bukti) {
            document.getElementById('mId').value = id;
            document.getElementById('mStatus').value = capitalize(status);
            document.getElementById('mNama').value = nama;
            document.getElementById('mMetode').value = metode;
            document.getElementById('mJumlah').value = jumlah;
            document.getElementById('mTanggal').value = tanggal;

            activeRow = [...allRows].find(row => row.dataset.id === id.toLowerCase()) || null;

            const img = document.getElementById('mBuktiImg');
            const empty = document.getElementById('mBuktiEmpty');
            const upload = document.getElementById('uploadBukti');

            upload.value = '';

            if (bukti && bukti.trim() !== '') {
                img.src = bukti;
                img.classList.remove('hidden');
                empty.classList.add('hidden');
            } else {
                img.src = '';
                img.classList.add('hidden');
                empty.classList.remove('hidden');
            }

            const actions = document.getElementById('modalActions');
            actions.classList.toggle('hidden', status !== 'menunggu');

            const overlay = document.getElementById('modalOverlay');
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        }

        function previewBukti(event) {
            const file = event.target.files[0];

            if (!file) return;

            const imageUrl = URL.createObjectURL(file);

            const img = document.getElementById('mBuktiImg');
            const empty = document.getElementById('mBuktiEmpty');

            img.src = imageUrl;
            img.classList.remove('hidden');
            empty.classList.add('hidden');

            if (activeRow) {
                activeRow.dataset.bukti = imageUrl;
            }
        }

        function closeModal() {
            const overlay = document.getElementById('modalOverlay');
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');

            activeRow = null;
        }

        function handleOverlayClick(e) {
            if (e.target === document.getElementById('modalOverlay')) {
                closeModal();
            }
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
            const badge = row.querySelector('span[class*="rounded-full"]');

            if (badge) {
                badge.className = `px-3 py-1 rounded-full text-[14px] font-medium ${bgClass} ${textClass}`;
                badge.textContent = capitalize(newStatus);
            }

            row.dataset.status = newStatus;

            const btn = row.querySelector('button');

            if (btn) {
                const cells = row.querySelectorAll('td');

                const id = cells[0].textContent.trim();
                const nama = cells[1].textContent.trim();
                const metode = cells[2].textContent.trim();
                const jumlah = cells[3].textContent.trim();
                const tanggal = cells[4].textContent.trim();

                btn.setAttribute(
                    'onclick',
                    `openModal('${id}', '${nama}', '${metode}', '${jumlah}', '${tanggal}', '${newStatus}', this.closest('tr').dataset.bukti)`
                );
            }

            updateStats();
            filterTable();
        }

        function updateStats() {
            let menunggu = 0;
            let terverifikasi = 0;

            document.querySelectorAll('.table-row').forEach(row => {
                const status = row.dataset.status;

                if (status === 'menunggu') menunggu++;
                if (status === 'terverifikasi') terverifikasi++;
            });

            document.getElementById('statMenunggu').textContent = menunggu;
            document.getElementById('statTerverifikasi').textContent = terverifikasi;
        }

        function capitalize(str) {
            if (!str) return '';
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    </script>
@endpush
