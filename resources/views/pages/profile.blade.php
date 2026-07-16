@extends('layouts.app')

@section('title', 'Profil ' . ucfirst($user->role ?? 'Pengguna'))

@section('content')
    <div class="min-h-screen bg-[#F2EDE4] px-6 py-6 font-serif text-[#243b53]">

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">

            {{-- SIDEBAR --}}
            <div class="flex min-h-[440px] flex-col rounded-2xl border border-[#D1CCC0] bg-white p-5 text-center shadow-md">
                <span class="mx-auto mb-5 inline-block w-fit rounded-full bg-[#7ea1ba]/20 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-[#0B2A55]">
                    {{ $user->role }}
                </span>

                <div class="mt-auto pt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full rounded-lg border border-red-200 bg-red-50 py-2 text-[14px] font-semibold text-red-600 shadow-sm transition hover:bg-red-100">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

            {{-- PANEL KANAN --}}
            <div class="relative overflow-hidden rounded-2xl border border-[#D1CCC0] bg-white shadow-md lg:col-span-2">

                <div class="relative border-b border-[#E2E8F0] px-5 py-4">
                    <button type="button" onclick="history.back()"
                        class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-[18px] font-bold text-[#8896A5] transition hover:bg-[#F2EDE4] hover:text-[#243b53]"
                        title="Kembali">
                        &times;
                    </button>
                    <h1 class="text-[20px] font-bold text-[#0B2A55]">Informasi Profil {{ ucfirst($user->role) }}</h1>
                    <p class="mt-0.5 text-[13px] text-[#47627A]">Nama dan jenis kelamin dapat diubah. Data lain hanya bisa dilihat.</p>
                </div>

                @if (session('success'))
                    <div class="mx-5 mt-4 rounded-lg border border-green-300 bg-green-50 px-4 py-2 text-[13px] font-semibold text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mx-5 mt-4 rounded-lg border border-red-300 bg-red-50 px-4 py-2 text-[13px] text-red-700">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-3 p-5">
                    @csrf
                    @method('PUT')

                    {{-- NAMA — bisa diedit --}}
                    <div class="grid grid-cols-1 items-center gap-2 md:grid-cols-3">
                        <label class="text-[13px] font-semibold">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $user->nama) }}"
                            class="rounded-lg border border-[#D1CCC0] bg-white px-3 py-2 text-[13px] text-[#243b53] outline-none focus:border-[#7EA1BA] md:col-span-2">
                    </div>

                    {{-- EMAIL — hanya tampil --}}
                    <div class="grid grid-cols-1 items-center gap-2 md:grid-cols-3">
                        <label class="text-[13px] font-semibold">Email</label>
                        <p class="rounded-lg bg-[#F2EDE4] px-3 py-2 text-[13px] text-[#47627A] md:col-span-2">{{ $user->email }}</p>
                    </div>

                    {{-- NO TELEPON — hanya tampil --}}
                    <div class="grid grid-cols-1 items-center gap-2 md:grid-cols-3">
                        <label class="text-[13px] font-semibold">No Telepon</label>
                        <p class="rounded-lg bg-[#F2EDE4] px-3 py-2 text-[13px] text-[#47627A] md:col-span-2">{{ $user->no_telepon }}</p>
                    </div>

                    {{-- JENIS KELAMIN — bisa diedit --}}
                    <div class="grid grid-cols-1 items-center gap-2 md:grid-cols-3">
                        <label class="text-[13px] font-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                            class="rounded-lg border border-[#D1CCC0] bg-white px-3 py-2 text-[13px] text-[#243b53] outline-none focus:border-[#7EA1BA] md:col-span-2">
                            <option value="L" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- ALAMAT — hanya tampil --}}
                    <div class="grid grid-cols-1 items-center gap-2 md:grid-cols-3">
                        <label class="text-[13px] font-semibold">Alamat</label>
                        <p class="rounded-lg bg-[#F2EDE4] px-3 py-2 text-[13px] text-[#47627A] md:col-span-2">{{ $user->alamat }}</p>
                    </div>

                    <div class="flex justify-end gap-3 pt-3">
                        <button type="submit"
                            class="rounded-lg bg-[#7EA1BA] px-6 py-2 text-[13px] font-semibold text-white shadow-sm transition hover:bg-[#668BA5]">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
