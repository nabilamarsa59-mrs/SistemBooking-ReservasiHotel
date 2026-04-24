@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="bg-[#ece6da] min-h-screen px-10 py-8">

    <div id="success-message" class="hidden mb-6 rounded-xl border border-[#7ea1ba] bg-white px-4 py-3 text-[#243b53]">
        Perubahan profil berhasil disimpan sementara.
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="border border-gray-400 bg-white p-6 flex flex-col items-center text-center">
            <h2 class="text-[24px] font-semibold text-[#243b53] mb-6">Foto Profil</h2>

            <div class="w-32 h-32 rounded-full border border-gray-400 flex items-center justify-center bg-[#f8f8f8] mb-4 overflow-hidden">
                <img src="{{ asset('images/logo_PBL.jpeg') }}" class="w-20" alt="Foto Profil">
            </div>

            <p class="text-[18px] text-[#243b53] mb-8">Tambahkan Foto Profil</p>

            <button
                type="button"
                onclick="enableEdit()"
                id="editBtn"
                class="w-full max-w-[220px] rounded-xl border border-gray-400 bg-white px-5 py-3 text-[18px] text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white"
            >
                Edit Profil
            </button>

            <a
                href="{{ route('login') }}"
                class="w-full max-w-[220px] mt-4 rounded-xl border border-gray-400 bg-white px-5 py-3 text-[18px] text-[#243b53] transition hover:bg-red-400 hover:text-white"
            >
                Keluar
            </a>
        </div>

        <div class="lg:col-span-2 border border-gray-400 bg-white">
            <div class="border-b border-gray-400 px-6 py-5 text-center">
                @if($profile['role'] == 'admin')
                    <h2 class="text-[28px] font-semibold text-[#243b53]">
                        Informasi Profil Admin
                    </h2>
                @else
                    <h2 class="text-[28px] font-semibold text-[#243b53]">
                        Informasi Profil Resepsionis
                    </h2>
                @endif
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="p-6 space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                    <label class="text-[18px] font-semibold text-[#243b53]">Nama Lengkap</label>
                    <input disabled name="nama" type="text" value="{{ $profile['nama'] }}" class="profile-input md:col-span-2 rounded-lg border border-gray-400 bg-[#f8f8f8] px-4 py-3">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                    <label class="text-[18px] font-semibold text-[#243b53]">Email</label>
                    <input disabled name="email" type="email" value="{{ $profile['email'] }}" class="profile-input md:col-span-2 rounded-lg border border-gray-400 bg-[#f8f8f8] px-4 py-3">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                    <label class="text-[18px] font-semibold text-[#243b53]">No Telepon</label>
                    <input disabled name="telepon" type="text" value="{{ $profile['telepon'] }}" class="profile-input md:col-span-2 rounded-lg border border-gray-400 bg-[#f8f8f8] px-4 py-3">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                    <label class="text-[18px] font-semibold text-[#243b53]">Kata Sandi</label>
                    <input disabled name="password" type="password" value="{{ $profile['password'] }}" class="profile-input md:col-span-2 rounded-lg border border-gray-400 bg-[#f8f8f8] px-4 py-3">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                    <label class="text-[18px] font-semibold text-[#243b53]">Jenis Kelamin</label>
                    <input disabled name="gender" type="text" value="{{ $profile['gender'] }}" class="profile-input md:col-span-2 rounded-lg border border-gray-400 bg-[#f8f8f8] px-4 py-3">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4">
                    <label class="text-[18px] font-semibold text-[#243b53]">Alamat</label>
                    <input disabled name="alamat" type="text" value="{{ $profile['alamat'] }}" class="profile-input md:col-span-2 rounded-lg border border-gray-400 bg-[#f8f8f8] px-4 py-3">
                </div>

                <div class="pt-4 flex justify-center">
                    <button
                        type="button"
                        onclick="saveProfile()"
                        id="saveBtn"
                        disabled
                        class="rounded-xl border border-[#7ea1ba] bg-gray-200 px-8 py-3 text-[18px] font-semibold text-gray-500 transition"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    function enableEdit() {
        document.querySelectorAll('.profile-input').forEach(input => {
            input.disabled = false;
            input.classList.remove('bg-[#f8f8f8]');
            input.classList.add('bg-white');
        });

        const saveBtn = document.getElementById('saveBtn');
        saveBtn.disabled = false;
        saveBtn.classList.remove('bg-gray-200', 'text-gray-500');
        saveBtn.classList.add('bg-[#c6d6e2]', 'text-[#243b53]', 'hover:bg-[#7ea1ba]', 'hover:text-white');
    }

    function saveProfile() {
        document.querySelectorAll('.profile-input').forEach(input => {
            input.disabled = true;
            input.classList.remove('bg-white');
            input.classList.add('bg-[#f8f8f8]');
        });

        const saveBtn = document.getElementById('saveBtn');
        saveBtn.disabled = true;
        saveBtn.classList.add('bg-gray-200', 'text-gray-500');
        saveBtn.classList.remove('bg-[#c6d6e2]', 'text-[#243b53]', 'hover:bg-[#7ea1ba]', 'hover:text-white');

        const message = document.getElementById('success-message');
        message.classList.remove('hidden');

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

@endsection