@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    @php
        $role = session('role');

        if ($role == 'admin') {
            $judulProfil = 'Informasi Profil Admin';
            $deskripsiProfil = 'Kelola informasi akun admin Pulas.';
            $nama = 'Admin Pulas';
            $email = 'admin@gmail.com';
            $telepon = '081234567890';
            $jenisKelamin = 'Perempuan';
            $alamat = 'Batam';
        } elseif ($role == 'resepsionis') {
            $judulProfil = 'Informasi Profil Resepsionis';
            $deskripsiProfil = 'Kelola informasi akun resepsionis Pulas.';
            $nama = 'Revan';
            $email = 'resepsionis@gmail.com';
            $telepon = '082344556677';
            $jenisKelamin = 'Laki-laki';
            $alamat = 'Batam';
        } else {
            header('Location: ' . route('dashboard.tamu'));
            exit();
        }

        $fotoProfil = session('foto_profile')
            ? asset('storage/' . session('foto_profile'))
            : asset('images/logo_PBL.jpeg');
    @endphp

    <div class="min-h-screen bg-[#F2EDE4] px-12 py-10">

        <div id="success-message"
            class="hidden mb-6 rounded-xl border border-[#7EA1BA] bg-white px-5 py-4 text-[#243b53] shadow-sm">
            Perubahan profil berhasil disimpan sementara.
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                <div
                    class="flex min-h-[560px] flex-col rounded-2xl border border-[#D1CCC0] bg-white p-8 text-center shadow-md">
                    <h2 class="mb-8 text-[30px] font-bold text-[#0B2A55]">
                        Foto Profil
                    </h2>

                    <div class="relative mx-auto mb-5 h-40 w-40">
                        <div
                            class="flex h-40 w-40 items-center justify-center overflow-hidden rounded-full border border-[#D1CCC0] bg-[#F2EDE4] shadow-sm">
                            <img id="fotoPreview" src="{{ $fotoProfil }}" class="h-full w-full object-cover">
                        </div>

                        <input type="file" name="foto" id="fotoInput" accept="image/*" class="hidden"
                            onchange="previewFoto(event)">

                        <label for="fotoInput"
                            class="absolute bottom-2 right-2 flex h-11 w-11 cursor-pointer items-center justify-center rounded-full bg-[#7EA1BA] text-[28px] font-bold text-white shadow-md transition hover:bg-[#668BA5]">
                            +
                        </label>
                    </div>

                    <p class="mb-8 text-[17px] text-[#47627A]">
                        Tambahkan Foto Profil
                    </p>

                    <button type="button" onclick="enableEdit()"
                        class="w-full rounded-xl border border-[#7EA1BA] bg-white py-3 text-[17px] font-semibold text-[#0B2A55] shadow-sm transition hover:bg-[#7EA1BA] hover:text-white">
                        Edit Profil
                    </button>

                    <div class="mt-auto">
                        <a href="{{ route('logout') }}"
                            class="block w-full rounded-xl border border-red-200 bg-red-50 py-3 text-[17px] font-semibold text-red-600 shadow-sm transition hover:bg-red-100">
                            Keluar
                        </a>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-[#D1CCC0] bg-white shadow-md lg:col-span-2">

                    <div class="relative border-b border-[#E2E8F0] px-8 py-6">
                        <button type="button" onclick="window.history.back()"
                            class="absolute right-6 top-6 text-[26px] text-gray-400 transition hover:text-gray-700">
                            &times;
                        </button>

                        <h1 class="text-[34px] font-bold text-[#0B2A55]">
                            {{ $judulProfil }}
                        </h1>

                        <p class="mt-1 text-[16px] text-[#47627A]">
                            {{ $deskripsiProfil }}
                        </p>
                    </div>

                    <div class="space-y-6 p-8">

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold text-[#243b53]">Nama Lengkap</label>
                            <input name="nama" value="{{ $nama }}" disabled
                                class="profile-input rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA] md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold text-[#243b53]">Email</label>
                            <input name="email" value="{{ $email }}" disabled
                                class="profile-input rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA] md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold text-[#243b53]">No Telepon</label>
                            <input name="telepon" value="{{ $telepon }}" disabled
                                class="profile-input rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA] md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold text-[#243b53]">Kata Sandi</label>

                            <div class="relative md:col-span-2">
                                <input id="passwordField" name="password" type="password" value="resepsionis123" disabled
                                    class="profile-input w-full rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 pr-12 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA]">

                                <button type="button" onclick="togglePassword()"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-[18px] text-gray-400 hover:text-gray-700">
                                    👁
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold text-[#243b53]">Jenis Kelamin</label>
                            <input name="jenis_kelamin" value="{{ $jenisKelamin }}" disabled
                                class="profile-input rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA] md:col-span-2">
                        </div>

                        <div class="grid grid-cols-1 items-center gap-4 md:grid-cols-3">
                            <label class="text-[18px] font-semibold text-[#243b53]">Alamat</label>
                            <input name="alamat" value="{{ $alamat }}" disabled
                                class="profile-input rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA] md:col-span-2">
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="button" id="saveBtn" onclick="saveProfile()" disabled
                                class="rounded-xl bg-gray-200 px-8 py-3 text-[17px] font-semibold text-gray-500 shadow-sm transition">
                                Simpan Perubahan
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        function previewFoto(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('fotoPreview');

            if (file) {
                preview.src = URL.createObjectURL(file);

                const saveBtn = document.getElementById('saveBtn');
                saveBtn.disabled = false;
                saveBtn.classList.remove('bg-gray-200', 'text-gray-500');
                saveBtn.classList.add('bg-[#7EA1BA]', 'text-white', 'hover:bg-[#668BA5]');
            }
        }

        function enableEdit() {
            document.querySelectorAll('.profile-input').forEach(input => {
                input.disabled = false;
                input.classList.remove('bg-[#F8FAFC]');
                input.classList.add('bg-white');
            });

            const saveBtn = document.getElementById('saveBtn');
            saveBtn.disabled = false;
            saveBtn.classList.remove('bg-gray-200', 'text-gray-500');
            saveBtn.classList.add('bg-[#7EA1BA]', 'text-white', 'hover:bg-[#668BA5]');
        }

        function saveProfile() {
            document.querySelectorAll('.profile-input').forEach(input => {
                input.disabled = true;
                input.classList.remove('bg-white');
                input.classList.add('bg-[#F8FAFC]');
            });

            const saveBtn = document.getElementById('saveBtn');
            saveBtn.disabled = true;
            saveBtn.classList.remove('bg-[#7EA1BA]', 'text-white', 'hover:bg-[#668BA5]');
            saveBtn.classList.add('bg-gray-200', 'text-gray-500');

            document.getElementById('success-message').classList.remove('hidden');

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function togglePassword() {
            const field = document.getElementById('passwordField');

            if (field.type === 'password') {
                field.type = 'text';
            } else {
                field.type = 'password';
            }
        }
    </script>
@endpush
