@extends('layouts.app')

@section('title', 'Profil Tamu')

@section('content')
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'route' => route('dashboard.tamu')],
        ['label' => 'Profil Saya']
    ]" />

    <div class="min-h-screen bg-[#F2EDE4] px-12 py-10 font-serif text-[#243b53]">

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- SIDEBAR --}}
            <div class="flex min-h-[620px] flex-col rounded-2xl border border-[#D1CCC0] bg-white p-8 text-center shadow-md">
                <h2 class="mb-8 text-[30px] font-bold text-[#0B2A55]">Foto Profil</h2>

                <div class="relative mx-auto mb-5 h-40 w-40">
                    <div class="flex h-40 w-40 items-center justify-center overflow-hidden rounded-full border border-[#D1CCC0] bg-[#F2EDE4] shadow-sm">
                        <img id="avatar-img" src="{{ asset('images/logo_PBL.jpeg') }}" alt="Foto Profil"
                            class="h-full w-full object-cover">
                    </div>
                    <input type="file" id="foto-input" accept="image/*" class="hidden">
                    <label for="foto-input"
                        class="absolute bottom-2 right-2 flex h-11 w-11 cursor-pointer items-center justify-center rounded-full bg-[#7EA1BA] text-[28px] font-bold text-white shadow-md transition hover:bg-[#668BA5]">
                        +
                    </label>
                </div>

                <p class="mb-8 text-[17px] text-[#47627A]">Tambahkan Foto Profil</p>

                <button type="button" onclick="showPanel('panel-profil')"
                    class="mb-4 w-full rounded-xl border border-[#7EA1BA] bg-white py-3 text-[17px] font-semibold text-[#0B2A55] shadow-sm transition hover:bg-[#7EA1BA] hover:text-white">
                    Profil Saya
                </button>

                <button type="button" onclick="showPanel('panel-invoice')"
                    class="w-full rounded-xl border border-[#7EA1BA] bg-white py-3 text-[17px] font-semibold text-[#0B2A55] shadow-sm transition hover:bg-[#7EA1BA] hover:text-white">
                    Invoice & Faktur
                    @if($fakturs->count() > 0)
                        <span class="ml-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-[#7EA1BA] text-[11px] font-bold text-white">
                            {{ $fakturs->count() }}
                        </span>
                    @endif
                </button>

                <div class="mt-auto">
                    <form method="POST" action="{{ route('logout.tamu') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full rounded-xl border border-red-200 bg-red-50 py-3 text-[17px] font-semibold text-red-600 shadow-sm transition hover:bg-red-100">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

            {{-- PANEL KANAN --}}
            <div class="relative overflow-hidden rounded-2xl border border-[#D1CCC0] bg-white shadow-md lg:col-span-2">

                <a href="{{ route('dashboard.tamu') }}"
                    class="absolute right-5 top-5 z-20 flex h-10 w-10 items-center justify-center rounded-full border border-[#D1CCC0] bg-white text-[26px] font-bold text-[#243b53] shadow-sm transition hover:bg-red-100 hover:text-red-600">
                    &times;
                </a>

                {{-- PANEL PROFIL (READ-ONLY, sesuai data registrasi) --}}
                <div id="panel-profil">
                    <div class="border-b border-[#E2E8F0] px-8 py-6 pr-20">
                        <h1 class="text-[34px] font-bold text-[#0B2A55]">Informasi Profil Tamu</h1>
                        <p class="mt-1 text-[16px] text-[#47627A]">Data akun tamu Pulas sesuai saat pendaftaran.</p>
                    </div>

                    <div class="space-y-6 p-8">
                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">NIK</label>
                            <div class="rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] md:col-span-2">
                                {{ $user->nik ?? '-' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">Nama Lengkap</label>
                            <div class="rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] md:col-span-2">
                                {{ $user->name }}
                            </div>
                        </div>
                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">Email</label>
                            <div class="rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] md:col-span-2">
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">No Telepon</label>
                            <div class="rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] md:col-span-2">
                                {{ $user->telepon }}
                            </div>
                        </div>

                        <p class="pt-2 text-[14px] text-[#8896A5]">
                            * Data ini diambil dari informasi saat Anda mendaftar dan tidak dapat diubah di halaman ini.
                        </p>
                    </div>
                </div>

                {{-- PANEL INVOICE --}}
                <div id="panel-invoice" class="hidden">
                    <div class="border-b border-[#E2E8F0] px-8 py-6 pr-20">
                        <h1 class="text-[34px] font-bold text-[#0B2A55]">Invoice & Faktur</h1>
                        <p class="mt-1 text-[16px] text-[#47627A]">Daftar faktur pemesanan kamar Anda.</p>
                    </div>

                    <div class="space-y-4 p-8">
                        @forelse ($fakturs as $faktur)
                            @php
                                $rsv    = $faktur->reservasi;
                                $status = $rsv->status_reservasi ?? 'pending';
                                $badgeClass = match($status) {
                                    'aktif'      => 'bg-green-100 text-green-800',
                                    'dibatalkan' => 'bg-red-100 text-red-800',
                                    default      => 'bg-yellow-100 text-yellow-800',
                                };
                                $badgeLabel = match($status) {
                                    'aktif'      => 'Aktif',
                                    'dibatalkan' => 'Dibatalkan',
                                    default      => 'Menunggu Konfirmasi',
                                };
                            @endphp
                            <div onclick="showInvoicePopup(
                                    '{{ $faktur->no_faktur }}',
                                    '{{ addslashes($faktur->nama_tamu) }}',
                                    '{{ addslashes($faktur->tipe_kamar) }}',
                                    '{{ $rsv ? $rsv->check_in->translatedFormat('d M Y') : '-' }}',
                                    '{{ $rsv ? $rsv->check_out->translatedFormat('d M Y') : '-' }}',
                                    {{ $faktur->durasi ?? 0 }},
                                    'Rp {{ number_format($faktur->total_tagihan ?? 0, 0, ',', '.') }}',
                                    '{{ $badgeLabel }}'
                                )"
                                class="flex cursor-pointer items-center justify-between rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-6 py-4 transition hover:border-[#7EA1BA] hover:bg-white">
                                <div>
                                    <p class="font-semibold text-[#0B2A55]">
                                        Faktur #{{ $faktur->no_faktur }} — {{ $faktur->tipe_kamar }}
                                    </p>
                                    <p class="text-[13px] text-gray-500">
                                        {{ $rsv ? $rsv->check_in->translatedFormat('d M Y') . ' – ' . $rsv->check_out->translatedFormat('d M Y') : '-' }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="rounded-full px-3 py-1 text-[12px] font-semibold {{ $badgeClass }}">
                                        {{ $badgeLabel }}
                                    </span>
                                    <span class="font-semibold text-[#243b53]">
                                        Rp {{ number_format($faktur->total_tagihan ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center py-12 text-center text-gray-400">
                                <span class="text-[48px]">📄</span>
                                <p class="mt-3 text-[17px]">Belum ada faktur pemesanan.</p>
                                <a href="{{ route('pemesanan') }}"
                                    class="mt-4 rounded-xl bg-[#243b53] px-6 py-2 text-[15px] font-semibold text-white transition hover:bg-[#7ea1ba]">
                                    Pesan Kamar Sekarang
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        {{-- RIWAYAT PEMESANAN --}}
        <div id="riwayat" class="mt-8 scroll-mt-24 rounded-2xl border border-[#D1CCC0] bg-white p-8 shadow-md">
            <h2 class="mb-5 border-b border-[#E2E8F0] pb-4 text-[26px] font-bold text-[#0B2A55]">
                Riwayat Pemesanan
            </h2>

            @forelse ($riwayat as $rsv)
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
                        default      => 'Menunggu Konfirmasi',
                    };
                @endphp
                <div class="mb-4 rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] p-5 text-[15px] leading-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <p><span class="inline-block w-36 text-gray-500">ID Reservasi</span> :
                                <span class="font-mono">#RSV-{{ str_pad($rsv->id_reservasi, 3, '0', STR_PAD_LEFT) }}</span>
                            </p>
                            <p><span class="inline-block w-36 text-gray-500">Tipe Kamar</span> : {{ $rsv->tipe->detail_kamar ?? '-' }}</p>
                            <p><span class="inline-block w-36 text-gray-500">Check-in</span> : {{ $rsv->check_in->translatedFormat('d M Y') }}</p>
                            <p><span class="inline-block w-36 text-gray-500">Check-out</span> : {{ $rsv->check_out->translatedFormat('d M Y') }}</p>
                            <p><span class="inline-block w-36 text-gray-500">Durasi</span> : {{ $durasi }} Malam</p>
                            <p><span class="inline-block w-36 text-gray-500">Total</span> : <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span></p>
                        </div>
                        <span class="rounded-full px-4 py-2 text-[13px] font-semibold {{ $badgeClass }}">
                            {{ $badgeLabel }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 text-[16px] py-6">Belum ada riwayat pemesanan.</p>
            @endforelse
        </div>

    </div>

    {{-- MODAL INVOICE --}}
    <div id="modal-invoice" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4">
        <div class="w-full max-w-md rounded-2xl border border-[#D1CCC0] bg-[#F2EDE4] shadow-2xl">

            <div class="flex items-center justify-between border-b border-[#D1CCC0] px-6 py-4">
                <div>
                    <h2 class="text-[22px] font-bold text-[#0B2A55]">Faktur Pemesanan</h2>
                    <p id="inv-subtitle" class="text-sm text-gray-500"></p>
                </div>
                <button onclick="closeModal('modal-invoice')"
                    class="text-3xl text-gray-500 transition hover:text-red-600">&times;</button>
            </div>

            <div class="space-y-3 px-6 py-5 text-[15px]">
                <div class="flex justify-between border-b border-dashed border-gray-300 pb-3">
                    <span class="text-gray-500">No. Faktur</span>
                    <span id="inv-no" class="font-mono font-semibold"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Nama Tamu</span>
                    <span id="inv-nama"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tipe Kamar</span>
                    <span id="inv-tipe"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Check-in</span>
                    <span id="inv-checkin"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Check-out</span>
                    <span id="inv-checkout"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Durasi</span>
                    <span id="inv-durasi"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>
                    <span id="inv-status" class="font-semibold"></span>
                </div>
                <div class="flex justify-between border-t border-gray-300 pt-4 text-[17px] font-bold text-[#0B2A55]">
                    <span>Total Pembayaran</span>
                    <span id="inv-total"></span>
                </div>
            </div>

            <div class="flex gap-3 px-6 pb-6">
                <button onclick="window.print()"
                    class="flex-1 rounded-xl border border-[#7EA1BA] bg-white py-3 text-[15px] font-semibold transition hover:bg-[#7EA1BA] hover:text-white">
                    Cetak
                </button>
                <button onclick="closeModal('modal-invoice')"
                    class="flex-1 rounded-xl bg-[#243b53] py-3 text-[15px] font-semibold text-white transition hover:bg-[#7EA1BA]">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function showPanel(id) {
            ['panel-profil', 'panel-invoice'].forEach(p =>
                document.getElementById(p).classList.add('hidden')
            );
            document.getElementById(id).classList.remove('hidden');
        }

        document.getElementById('foto-input').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;
            document.getElementById('avatar-img').src = URL.createObjectURL(file);
        });

        function showInvoicePopup(noFaktur, nama, tipe, checkin, checkout, durasi, total, status) {
            document.getElementById('inv-subtitle').textContent = 'Kamar ' + tipe;
            document.getElementById('inv-no').textContent       = '#INV-' + String(noFaktur).padStart(5, '0');
            document.getElementById('inv-nama').textContent     = nama;
            document.getElementById('inv-tipe').textContent     = tipe;
            document.getElementById('inv-checkin').textContent  = checkin;
            document.getElementById('inv-checkout').textContent = checkout;
            document.getElementById('inv-durasi').textContent   = durasi + ' Malam';
            document.getElementById('inv-total').textContent    = total;
            document.getElementById('inv-status').textContent   = status;
            openModal('modal-invoice');
        }

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }

        // Buka panel invoice langsung jika ada hash #invoice di URL
        if (window.location.hash === '#invoice') {
            showPanel('panel-invoice');
        }

        // Scroll otomatis ke riwayat pemesanan jika ada hash #riwayat di URL
        if (window.location.hash === '#riwayat') {
            document.getElementById('riwayat').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
@endsection
