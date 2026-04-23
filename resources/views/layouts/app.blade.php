<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pulas')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#ece6da] text-[#243b53] font-serif">
@if (!Route::is(['login', 'login.tamu']))
<x-navbar />
@endif

    <main>
        @yield('content')
    </main>

    <x-footer />

    <div
        id="login-modal"
        tabindex="-1"
        aria-hidden="true"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/30 px-4"
    >
        <div class="relative w-full max-w-md rounded-2xl border border-gray-300 bg-[#f2eee6] p-6 shadow-lg">
            <button
                type="button"
                class="absolute right-4 top-3 text-2xl text-[#243b53] hover:text-red-500"
                data-modal-hide="login-modal"
            >
                &times;
            </button>

            <div class="text-center">
                <h2 class="mb-2 text-[24px] font-semibold text-[#243b53]">
                    Pilih Login
                </h2>
                <p class="mb-6 text-[16px] text-[#243b53]">
                    Masuk sebagai siapa?
                </p>
            </div>

            <div class="flex flex-col gap-4">
                <a
                    href="{{ route('login') }}"
                    class="rounded-xl border border-[#7ea1ba] bg-[#c6d6e2] px-5 py-3 text-center text-[18px] font-semibold text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white"
                >
                    Login Admin / Resepsionis
                </a>

                <a
                    href="{{ route('login.tamu') }}"
                    class="rounded-xl border border-[#7ea1ba] bg-white px-5 py-3 text-center text-[18px] font-semibold text-[#243b53] transition hover:bg-[#7ea1ba] hover:text-white"
                >
                    Login Tamu
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>