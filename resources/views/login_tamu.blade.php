<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#d9d2c3] font-serif">

    <div class="max-w-[900px] mx-auto mt-8 border-[8px] border-[#7ea1ba] bg-[#ece6da] min-h-screen flex items-center justify-center px-6 py-10">
        <div class="w-full max-w-[760px] bg-[#f2eee6] border border-gray-400 rounded-[18px] overflow-hidden">
            <div class="text-center py-8 px-6 border-b border-gray-400">
                <div class="flex justify-center mb-2">
                    <img src="{{ asset('images/logo_PBL.jpeg') }}"class="h-[80px] object-contain mix-blend-multiply">
                </div>

                <h1 class="text-[28px] font-semibold text-[#243b53]">
                    Login Tamu
                </h1>

                <p class="text-[16px] text-[#243b53] mt-2">
                    Silahkan masuk ke akun tamu anda
                </p>
            </div>

            <div class="px-12 py-10">
                <form action="{{ route('login.tamu.post') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-[18px] font-semibold text-[#243b53] mb-2">Email</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="Masukkan Email Anda"
                            class="w-full h-[62px] px-5 rounded-lg border border-gray-400 bg-[#faf8f3] text-[16px] outline-none"
                            required
                        >
                    </div>

                    <div class="mb-10">
                        <label class="block text-[18px] font-semibold text-[#243b53] mb-2">Kata Sandi</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Masukkan Kata Sandi"
                            class="w-full h-[62px] px-5 rounded-lg border border-gray-400 bg-[#faf8f3] text-[16px] outline-none"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full h-[64px] rounded-xl bg-[#7ea1ba] text-white text-[22px] font-semibold hover:bg-[#62859f] transition">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>