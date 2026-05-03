@extends('layouts.app')

@section('title', 'Login Admin / Resepsionis')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-cover bg-center px-6 py-10 font-serif"
        style="background-image:
    linear-gradient(rgba(236,230,218,0.88), rgba(236,230,218,0.88)),
    url('{{ asset('images/hotel.png') }}');">
        <div
            class="relative w-full max-w-[760px] overflow-hidden rounded-[18px] border border-gray-400 bg-[#f2eee6] shadow-lg">

            <a href="{{ route('landing') }}"
                class="absolute right-5 top-5 text-[22px] font-bold text-gray-500 hover:text-red-500">
                ✕
            </a>
            <div class="border-b border-gray-400 px-6 py-8 text-center">
                <div class="mb-2 flex justify-center">
                    <img src="{{ asset('images/logo_PBL.jpeg') }}" class="h-[80px] object-contain mix-blend-multiply"
                        alt="Logo Pulas">
                </div>

                <h1 class="text-[28px] font-semibold text-[#243b53]">
                    Selamat Datang di Pulas
                </h1>

                <p class="mt-2 text-[16px] text-[#243b53]">
                    Silahkan masuk ke akun anda
                </p>
            </div>

            <div class="px-12 py-10">
                @if (session('error'))
                    <div class="mb-5 rounded-md border border-red-300 bg-red-100 p-3 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-10 flex justify-center">
                        <div class="flex overflow-hidden rounded-xl border border-gray-400">
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="admin" class="peer hidden" checked>
                                <span
                                    class="block bg-[#ece6da] px-10 py-4 font-semibold text-[#243b53] peer-checked:bg-[#7ea1ba] peer-checked:text-white">
                                    Admin
                                </span>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="resepsionis" class="peer hidden">
                                <span
                                    class="block bg-[#ece6da] px-10 py-4 font-semibold text-[#243b53] peer-checked:bg-[#7ea1ba] peer-checked:text-white">
                                    Resepsionis
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-[18px] font-semibold text-[#243b53]">Email</label>
                        <input type="email" name="email" placeholder="Masukkan Email Anda"
                            class="h-[62px] w-full rounded-lg border border-gray-400 bg-[#faf8f3] px-5 text-[16px] outline-none"
                            required>
                    </div>

                    <div class="mb-10 relative">
                        <label class="mb-2 block text-[18px] font-semibold text-[#243b53]">
                            Kata Sandi
                        </label>

                        <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi"
                            class="h-[62px] w-full rounded-lg border border-gray-400 bg-[#faf8f3] px-5 pr-14 text-[16px] outline-none"
                            required>

                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-[52px] text-gray-500 hover:text-[#243b53]">

                            👁
                        </button>
                    </div>

                    <button type="submit"
                        class="h-[64px] w-full rounded-xl bg-[#7ea1ba] text-[22px] font-semibold text-white transition hover:bg-[#62859f]">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
@endsection
