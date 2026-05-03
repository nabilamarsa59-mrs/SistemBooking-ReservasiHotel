@extends('layouts.guest')

@section('title', 'Register Tamu')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-cover bg-center px-6 py-10 font-serif"
        style="background-image:
    linear-gradient(rgba(236,230,218,0.90), rgba(236,230,218,0.90)),
    url('{{ asset('images/hotel.png') }}');">

        <div class="w-full max-w-[760px] overflow-hidden rounded-[18px] border border-gray-400 bg-[#f2eee6] shadow-lg">

            <div class="border-b border-gray-400 px-6 py-8 text-center">
                <div class="mb-2 flex justify-center">
                    <img src="{{ asset('images/logo_PBL.jpeg') }}" class="h-[80px] object-contain mix-blend-multiply"
                        alt="Logo Pulas">
                </div>

                <h1 class="text-[28px] font-semibold text-[#243b53]">
                    Selamat Datang di Pulas
                </h1>

                <p class="mt-2 text-[16px] text-[#243b53]">
                    Silahkan daftar menggunakan data diri anda
                </p>
            </div>

            <div class="px-12 py-10">
                <form action="{{ route('register.tamu.post') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="mb-2 block text-[18px] font-semibold text-[#243b53]">
                            NIK
                        </label>

                        <input type="text" name="nik" placeholder="Masukkan NIK Anda"
                            class="h-[62px] w-full rounded-lg border border-gray-400 bg-[#faf8f3] px-5 text-[16px] outline-none"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-[18px] font-semibold text-[#243b53]">
                            Nama
                        </label>

                        <input type="text" name="name" placeholder="Masukkan Nama Anda"
                            class="h-[62px] w-full rounded-lg border border-gray-400 bg-[#faf8f3] px-5 text-[16px] outline-none"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-[18px] font-semibold text-[#243b53]">
                            Email
                        </label>

                        <input type="email" name="email" placeholder="Masukkan Email Anda"
                            class="h-[62px] w-full rounded-lg border border-gray-400 bg-[#faf8f3] px-5 text-[16px] outline-none"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-[18px] font-semibold text-[#243b53]">
                            No. Tlp
                        </label>

                        <input type="text" name="phone" placeholder="Masukkan No.Tlpn Anda"
                            class="h-[62px] w-full rounded-lg border border-gray-400 bg-[#faf8f3] px-5 text-[16px] outline-none"
                            required>
                    </div>

                    <div class="relative mb-10">
                        <label class="mb-2 block text-[18px] font-semibold text-[#243b53]">
                            Kata Sandi
                        </label>

                        <input type="password" id="passwordRegister" name="password" placeholder="Masukkan Kata Sandi"
                            class="h-[62px] w-full rounded-lg border border-gray-400 bg-[#faf8f3] px-5 pr-14 text-[16px] outline-none"
                            required>

                        <button type="button" onclick="togglePasswordRegister()"
                            class="absolute right-4 top-[52px] text-[20px] text-gray-500 hover:text-[#243b53]">
                            👁
                        </button>
                    </div>

                    <button type="submit"
                        class="h-[64px] w-full rounded-xl bg-[#7ea1ba] text-[22px] font-semibold text-white transition hover:bg-[#62859f]">
                        Daftar
                    </button>

                    <div class="my-8 flex items-center gap-4">
                        <div class="h-[1px] flex-1 bg-gray-400"></div>

                        <span class="text-[16px] text-[#243b53]">
                            atau
                        </span>

                        <div class="h-[1px] flex-1 bg-gray-400"></div>
                    </div>

                    <div class="text-center text-[18px] text-[#243b53]">
                        Sudah punya akun?

                        <a href="{{ route('login.tamu') }}" class="font-semibold hover:underline">
                            Login sekarang
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        function togglePasswordRegister() {
            const passwordInput = document.getElementById("passwordRegister");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
@endsection
