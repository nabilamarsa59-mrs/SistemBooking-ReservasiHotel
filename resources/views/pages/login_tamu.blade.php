@extends('layouts.app')

@section('title', 'Login Tamu')

@section('content')
<div
    class="flex min-h-screen items-center justify-center bg-cover bg-center px-6 py-10 font-serif"
    style="background-image:
    linear-gradient(rgba(236,230,218,0.88), rgba(236,230,218,0.88)),
    url('{{ asset('images/hotel.png') }}');"
>
    <div class="w-full max-w-[760px] overflow-hidden rounded-[18px] border border-gray-400 bg-[#f2eee6] shadow-lg">
        <div class="border-b border-gray-400 px-6 py-8 text-center">
            <div class="mb-2 flex justify-center">
                <img
                    src="{{ asset('images/logo_PBL.jpeg') }}"
                    class="h-[80px] object-contain mix-blend-multiply"
                    alt="Logo Pulas"
                >
            </div>

            <h1 class="text-[28px] font-semibold text-[#243b53]">
                Login Tamu
            </h1>

            <p class="mt-2 text-[16px] text-[#243b53]">
                Silahkan masuk ke akun tamu anda
            </p>
        </div>

        <div class="px-12 py-10">
            <form action="{{ route('login.tamu.post') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="mb-2 block text-[18px] font-semibold text-[#243b53]">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan Email Anda"
                        class="h-[62px] w-full rounded-lg border border-gray-400 bg-[#faf8f3] px-5 text-[16px] outline-none"
                        required
                    >
                </div>

                <div class="mb-10">
                    <label class="mb-2 block text-[18px] font-semibold text-[#243b53]">
                        Kata Sandi
                    </label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan Kata Sandi"
                        class="h-[62px] w-full rounded-lg border border-gray-400 bg-[#faf8f3] px-5 text-[16px] outline-none"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="h-[64px] w-full rounded-xl bg-[#7ea1ba] text-[22px] font-semibold text-white transition hover:bg-[#62859f]"
                >
                    Masuk
                </button>
            </form>

<div class="my-6 flex items-center">
    <div class="flex-1 border-t border-gray-300"></div>

    <span class="px-6 text-[18px] font-semibold text-[#243b53]">
        atau
    </span>

    <div class="flex-1 border-t border-gray-300"></div>
</div>

<div class="text-center text-[18px] text-[#243b53]">
    Belum punya akun?
    <a
        href="{{ route('register.tamu') }}"
        class="font-semibold hover:text-[#7ea1ba]"
    >
        Daftar sekarang
    </a>
</div>
        </div>
    </div>
</div>
@endsection