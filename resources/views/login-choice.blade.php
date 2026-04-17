<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#d9d2c3] font-serif flex items-center justify-center min-h-screen">

    <div class="w-full max-w-[700px] border-[8px] border-[#7ea1ba] bg-[#ece6da] p-10">
        <div class="text-center mb-8">
                <div class="flex justify-center mb-2">
                    <img src="{{ asset('images/logo_PBL.jpeg') }}"class="h-[80px] object-contain mix-blend-multiply">
                </div>

            <h1 class="text-[30px] font-semibold text-[#243b53] mt-6">
                Pilih Jenis Login
            </h1>

            <p class="text-[#243b53] mt-2">
                Silakan pilih halaman login sesuai kebutuhan Anda
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-5">
            <a href="{{ route('login') }}"
               class="block text-center border border-[#7ea1ba] bg-[#c6d6e2] text-[#243b53] py-5 text-[22px] font-semibold rounded-xl hover:bg-[#7ea1ba] hover:text-white transition">
                Login Admin / Resepsionis
            </a>

            <a href="{{ route('login.tamu') }}"
               class="block text-center border border-[#7ea1ba] bg-[#f2eee6] text-[#243b53] py-5 text-[22px] font-semibold rounded-xl hover:bg-[#7ea1ba] hover:text-white transition">
                Login Tamu
            </a>
        </div>
    </div>

</body>
</html>