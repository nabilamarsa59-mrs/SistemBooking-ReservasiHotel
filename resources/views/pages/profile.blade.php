@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    @php
        $role = session('role');

        if ($role == 'admin') {
            $judulProfil = 'Informasi Profil Admin';
            $deskripsiProfil = 'Kelola informasi akun admin Pulas.';
        } elseif ($role == 'resepsionis') {
            $judulProfil = 'Informasi Profil Resepsionis';
            $deskripsiProfil = 'Kelola informasi akun resepsionis Pulas.';
        } else {
            $judulProfil = 'Informasi Profil Tamu';
            $deskripsiProfil = 'Kelola informasi akun tamu Pulas.';
        }

        $fotoProfil = session('foto_profile')
            ? asset('storage/' . session('foto_profile'))
            : asset('images/logo_PBL.jpeg');
    @endphp

    <div class="bg-[#F2EDE4] min-h-screen px-12 py-10">

        <div id="success-message"
            class="hidden mb-6 rounded-xl border border-[#7EA1BA] bg-white px-5 py-4 text-[#243b53] shadow-sm">
            Perubahan profil berhasil disimpan sementara.
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <div
                    class="lg:col-span-1 bg-white rounded-2xl shadow-md border border-[#D1CCC0] p-8 text-center min-h-[560px] flex flex-col">

                    <h2 class="text-[30px] font-bold text-[#0B2A55] mb-8">
                        Foto Profil
                    </h2>

                    <div class="relative w-40 h-40 mx-auto mb-5">
                        <div
                            class="w-40 h-40 rounded-full bg-[#F2EDE4] border border-[#D1CCC0] flex items-center justify-center shadow-sm overflow-hidden">
                            <img id="fotoPreview" src="{{ $fotoProfil }}" class="w-full h-full object-cover">
                        </div>

                        <input type="file" name="foto" id="fotoInput" accept="image/*" class="hidden"
                            onchange="previewFoto(event)">

                        <label for="fotoInput"
                            class="absolute bottom-2 right-2 w-11 h-11 rounded-full bg-[#7EA1BA] text-white flex items-center justify-center text-[28px] font-bold shadow-md cursor-pointer hover:bg-[#668BA5] transition">
                            +
                        </label>
                    </div>

                    <p class="text-[17px] text-[#47627A] mb-8">
                        Tambahkan Foto Profil
                    </p>

                    <button type="button" onclick="enableEdit()"
                        class="w-full rounded-xl border border-[#7EA1BA] bg-white py-3 text-[17px] font-semibold text-[#0B2A55] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">
                        Edit Profil
                    </button>

                    <div class="mt-auto">
                        <a href="{{ route('logout') }}"
                            class="block w-full rounded-xl border border-red-200 bg-red-50 py-3 text-[17px] font-semibold text-red-600 shadow-sm hover:bg-red-100 transition">
                            Keluar
                        </a>
                    </div>

                </div>

                <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border border-[#D1CCC0] overflow-hidden">

                    <div class="px-8 py-6 border-b border-[#E2E8F0]">
                        <h1 class="text-[34px] font-bold text-[#0B2A55]">
                            {{ $judulProfil }}
                        </h1>
                        <p class="text-[16px] text-[#47627A] mt-1">
                            {{ $deskripsiProfil }}
                        </p>
                    </div>

                    <div class="p-8 space-y-6">

                        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                            <label class="text-[18px] font-semibold text-[#243b53]">Nama Lengkap</label>
                            <input name="nama" value="Nabila Marsa" disabled
                                class="profile-input md:col-span-2 rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA]">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                            <label class="text-[18px] font-semibold text-[#243b53]">Email</label>
                            <input name="email" value="nabilamarsa@gmail.com" disabled
                                class="profile-input md:col-span-2 rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA]">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                            <label class="text-[18px] font-semibold text-[#243b53]">No Telepon</label>
                            <input name="telepon" value="082344556677" disabled
                                class="profile-input md:col-span-2 rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA]">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                            <label class="text-[18px] font-semibold text-[#243b53]">Kata Sandi</label>
                            <input name="password" type="password" value="password" disabled
                                class="profile-input md:col-span-2 rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA]">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                            <label class="text-[18px] font-semibold text-[#243b53]">Jenis Kelamin</label>
                            <input name="jenis_kelamin" value="Perempuan" disabled
                                class="profile-input md:col-span-2 rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA]">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                            <label class="text-[18px] font-semibold text-[#243b53]">Alamat</label>
                            <input name="alamat" value="Bengkong Kodim" disabled
                                class="profile-input md:col-span-2 rounded-xl border border-[#D1CCC0] bg-[#F8FAFC] px-5 py-3 text-[16px] text-[#243b53] outline-none focus:border-[#7EA1BA]">
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
    </script>
@endpush
