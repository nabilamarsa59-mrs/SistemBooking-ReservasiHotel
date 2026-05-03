@extends('layouts.app')

@section('title', 'Profil Tamu')

@section('content')
    <div class="min-h-screen bg-[#F2EDE4] px-12 py-10 font-serif text-[#243b53]">

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            <div class="flex min-h-[620px] flex-col rounded-2xl border border-[#D1CCC0] bg-white p-8 text-center shadow-md">

                <h2 class="mb-8 text-[30px] font-bold text-[#0B2A55]">
                    Foto Profil
                </h2>

                <div class="relative mx-auto mb-5 h-40 w-40">
                    <div
                        class="flex h-40 w-40 items-center justify-center overflow-hidden rounded-full border border-[#D1CCC0] bg-[#F2EDE4] shadow-sm">
                        <img id="avatar-img" src="{{ asset('images/logo_PBL.jpeg') }}" alt="Foto Profil"
                            class="h-full w-full object-cover">
                    </div>

                    <input type="file" id="foto-input" accept="image/*" class="hidden">

                    <label for="foto-input"
                        class="absolute bottom-2 right-2 flex h-11 w-11 cursor-pointer items-center justify-center rounded-full bg-[#7EA1BA] text-[28px] font-bold text-white shadow-md transition hover:bg-[#668BA5]">
                        +
                    </label>
                </div>

                <p class="mb-8 text-[17px] text-[#47627A]">
                    Tambahkan Foto Profil
                </p>

                <button type="button" onclick="showPanel('panel-profil')"
                    class="mb-4 w-full rounded-xl border border-[#7EA1BA] bg-white py-3 text-[17px] font-semibold text-[#0B2A55] shadow-sm transition hover:bg-[#7EA1BA] hover:text-white">
                    Edit Profil
                </button>

                <button type="button" onclick="showPanel('panel-invoice')"
                    class="w-full rounded-xl border border-[#7EA1BA] bg-white py-3 text-[17px] font-semibold text-[#0B2A55] shadow-sm transition hover:bg-[#7EA1BA] hover:text-white">
                    Invoice
                </button>

                <div class="mt-auto">
                    <a href="{{ route('logout') }}"
                        class="block w-full rounded-xl border border-red-200 bg-red-50 py-3 text-[17px] font-semibold text-red-600 shadow-sm transition hover:bg-red-100">
                        Keluar
                    </a>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-2xl border border-[#D1CCC0] bg-white shadow-md lg:col-span-2">

                <a href="{{ route('dashboard.tamu') }}"
                    class="absolute right-5 top-5 z-20 flex h-10 w-10 items-center justify-center rounded-full border border-[#D1CCC0] bg-white text-[26px] font-bold text-[#243b53] shadow-sm transition hover:bg-red-100 hover:text-red-600">
                    &times;
                </a>

                <div id="panel-profil">
                    <div class="border-b border-[#E2E8F0] px-8 py-6 pr-20">
                        <h1 class="text-[34px] font-bold text-[#0B2A55]">
                            Informasi Profil Tamu
                        </h1>
                        <p class="mt-1 text-[16px] text-[#47627A]">
                            Kelola informasi pribadi dan data akun tamu Pulas.
                        </p>
                    </div>

                    @if (session('success'))
                        <div
                            class="mx-8 mt-6 rounded-xl border border-green-300 bg-green-50 px-5 py-3 font-semibold text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mx-8 mt-6 rounded-xl border border-red-300 bg-red-50 px-5 py-3 text-red-700">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('profil.update') }}" method="POST" id="form-profil" class="space-y-6 p-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">Nama Lengkap</label>
                            <input name="nama" value="{{ $user->name ?? 'Tamu' }}" readonly
                                class="input-field rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] outline-none md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">Email</label>
                            <input name="email" value="{{ $user->email ?? 'tamu@example.com' }}" readonly
                                class="input-field rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] outline-none md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">No Telepon</label>
                            <input name="telepon" value="{{ $user->telepon ?? '0823009810' }}" readonly
                                class="input-field rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] outline-none md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">Kata Sandi Baru</label>
                            <input name="password" type="password"
                                placeholder="Kosongkan jika tidak ingin mengubah password" readonly
                                class="input-field rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] outline-none md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">Konfirmasi Kata Sandi</label>
                            <input name="password_confirmation" type="password" placeholder="Ulangi kata sandi baru"
                                readonly
                                class="input-field rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] outline-none md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">Jenis Kelamin</label>
                            <input name="jenis_kelamin" value="{{ $user->jenis_kelamin ?? 'Laki-laki' }}" readonly
                                class="input-field rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] outline-none md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold">Alamat</label>
                            <input name="alamat" value="{{ $user->alamat ?? 'Batam' }}" readonly
                                class="input-field rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] outline-none md:col-span-2">
                        </div>

                        <div class="flex justify-end gap-4 pt-4">
                            <button type="button" id="btn-edit" onclick="toggleEdit()"
                                class="rounded-xl border border-[#7EA1BA] bg-white px-8 py-3 text-[17px] font-semibold text-[#0B2A55] shadow-sm transition hover:bg-[#7EA1BA] hover:text-white">
                                Simpan Perubahan
                            </button>

                            <button type="submit" id="btn-simpan"
                                class="hidden rounded-xl bg-[#7EA1BA] px-8 py-3 text-[17px] font-semibold text-white shadow-sm transition hover:bg-[#668BA5]">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <div id="panel-invoice" class="hidden">
                    <div class="border-b border-[#E2E8F0] px-8 py-6 pr-20">
                        <h1 class="text-[34px] font-bold text-[#0B2A55]">
                            Invoice Pemesanan
                        </h1>
                        <p class="mt-1 text-[16px] text-[#47627A]">
                            Daftar faktur pemesanan kamar Anda.
                        </p>
                    </div>

                    <div class="space-y-4 p-8">
                        <div onclick="showInvoicePopup('standar')"
                            class="flex cursor-pointer items-center justify-between rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-6 py-4 transition hover:border-[#7EA1BA] hover:bg-white">
                            <span>Faktur pemesanan kamar standar</span>
                            <span class="font-mono text-gray-500">19.43</span>
                        </div>

                        <div onclick="showInvoicePopup('suite')"
                            class="flex cursor-pointer items-center justify-between rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-6 py-4 transition hover:border-[#7EA1BA] hover:bg-white">
                            <span>Faktur pemesanan kamar suite</span>
                            <span class="font-mono text-gray-500">10.39</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-8 rounded-2xl border border-[#D1CCC0] bg-white p-8 shadow-md">
            <h2 class="mb-5 border-b border-[#E2E8F0] pb-4 text-[26px] font-bold text-[#0B2A55]">
                Riwayat Pemesanan
            </h2>

            <div class="rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] p-5 text-[15px] leading-8">
                <p><span class="inline-block w-36 text-gray-500">ID. Reservasi</span> : 00034</p>
                <p><span class="inline-block w-36 text-gray-500">Tipe kamar</span> : Standar</p>
                <p><span class="inline-block w-36 text-gray-500">Jumlah kamar</span> : 2 Kamar</p>
                <p><span class="inline-block w-36 text-gray-500">Jumlah tamu</span> : 4 Orang</p>
                <p><span class="inline-block w-36 text-gray-500">Harga</span> : Rp 500.000</p>
            </div>
        </div>

    </div>

    <div id="modal-invoice" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4">

        <div class="w-full max-w-md rounded-2xl border border-[#D1CCC0] bg-[#F2EDE4] shadow-2xl">

            <div class="flex items-center justify-between border-b border-[#D1CCC0] px-6 py-4">
                <div>
                    <h2 class="text-[22px] font-bold text-[#0B2A55]">
                        Faktur Pemesanan
                    </h2>
                    <p id="inv-subtitle" class="text-sm text-gray-500">
                        Kamar Standar
                    </p>
                </div>

                <button onclick="closeModal('modal-invoice')"
                    class="text-3xl text-gray-500 transition hover:text-red-600">
                    &times;
                </button>
            </div>

            <div class="space-y-3 px-6 py-5 text-[15px]">
                <div class="flex justify-between border-b border-dashed border-gray-300 pb-3">
                    <span class="text-gray-500">No. Faktur</span>
                    <span id="inv-no" class="font-mono font-semibold">#INV-00034</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Nama Tamu</span>
                    <span id="inv-nama">Tamu</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Tipe Kamar</span>
                    <span id="inv-tipe">Standar</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Nomor Kamar</span>
                    <span id="inv-no-kamar">101</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Check-in</span>
                    <span id="inv-checkin">07 April 2026</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Check-out</span>
                    <span id="inv-checkout">09 April 2026</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Durasi</span>
                    <span id="inv-durasi">2 Malam</span>
                </div>

                <div class="flex justify-between border-t border-gray-300 pt-4 text-[17px] font-bold text-[#0B2A55]">
                    <span>Total Pembayaran</span>
                    <span id="inv-total">Rp 500.000</span>
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

    <style>
        .input-field[readonly] {
            background: #F8FAFC;
            color: #243b53;
            cursor: default;
        }

        .input-field:not([readonly]) {
            background: white;
            color: #243b53;
            cursor: text;
        }
    </style>

    <script>
        function showPanel(id) {
            document.getElementById('panel-profil').classList.add('hidden');
            document.getElementById('panel-invoice').classList.add('hidden');
            document.getElementById(id).classList.remove('hidden');
        }

        function toggleEdit() {
            const inputs = document.querySelectorAll('#form-profil .input-field');

            inputs.forEach(input => {
                input.removeAttribute('readonly');
                input.classList.remove('bg-[#F8FAFC]');
                input.classList.add('bg-white');
            });

            document.getElementById('btn-edit').classList.add('hidden');
            document.getElementById('btn-simpan').classList.remove('hidden');
        }

        document.getElementById('foto-input').addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (!file) return;

            document.getElementById('avatar-img').src = URL.createObjectURL(file);
        });

        const invoiceData = {
            standar: {
                subtitle: 'Kamar Standar',
                no: '#INV-00034',
                nama: 'Tamu',
                tipe: 'Standar',
                noKamar: '101',
                checkin: '07 April 2026',
                checkout: '09 April 2026',
                durasi: '2 Malam',
                total: 'Rp 500.000',
            },
            suite: {
                subtitle: 'Kamar Suite',
                no: '#INV-00035',
                nama: 'Tamu',
                tipe: 'Suite',
                noKamar: '301',
                checkin: '10 April 2026',
                checkout: '12 April 2026',
                durasi: '2 Malam',
                total: 'Rp 3.000.000',
            },
        };

        function showInvoicePopup(key) {
            const d = invoiceData[key];

            document.getElementById('inv-subtitle').textContent = d.subtitle;
            document.getElementById('inv-no').textContent = d.no;
            document.getElementById('inv-nama').textContent = d.nama;
            document.getElementById('inv-tipe').textContent = d.tipe;
            document.getElementById('inv-no-kamar').textContent = d.noKamar;
            document.getElementById('inv-checkin').textContent = d.checkin;
            document.getElementById('inv-checkout').textContent = d.checkout;
            document.getElementById('inv-durasi').textContent = d.durasi;
            document.getElementById('inv-total').textContent = d.total;

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
    </script>
@endsection
