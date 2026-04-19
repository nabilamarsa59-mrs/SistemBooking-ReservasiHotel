<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemesanan Hotel</title>
    <!-- Tailwind Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Header / Navbar -->
    <header class="bg-gray-400 border-b px-8 py-4 flex justify-between items-center">
        <img src="{{ asset('images/logo_PBL.jpeg') }}" alt="Logo Pulas" class="h-[75px] object-contain mix-blend-multiply">
        <nav class="flex gap-8 font-medium items-center">
            <a href="#" class="hover:underline">Beranda</a>
            <a href="#" class="hover:underline">Kamar</a>
            <a href="#" class="hover:underline">Pemesanan</a>
            <a href="#" class="hover:underline">Bantuan</a>
            <div class="w-10 h-10 bg-black rounded-full"></div> <!-- Profile Icon -->
        </nav>
    </header>

    <main class="max-w-6xl mx-auto p-8">
        <!-- Selamat Datang -->
        <section class="mb-8">
            <h1 class="text-3xl font-bold border-b-2 border-blue-600 inline-block">Selamat datang, Edo!</h1>
            <p class="text-sm text-gray-500 mt-1">Kamis, 08 April 2026 - Batam, Kepulauan Riau</p>
        </section>

        <!-- Search & Filter -->
        <section class="flex gap-2 mb-10">
            <input type="text" placeholder="Cari berdasarkan tipe kamar..." class="flex-grow border p-2 rounded text-sm">
            <button class="border px-4 py-2 text-xs rounded hover:bg-gray-100">Kamar deluxe</button>
            <button class="border px-4 py-2 text-xs rounded hover:bg-gray-100">kamar suite</button>
            <button class="border px-4 py-2 text-xs rounded hover:bg-gray-100">kamar standard</button>
            <button class="border px-4 py-2 text-xs rounded hover:bg-gray-100">kamar presidential</button>
        </section>

        <!-- Reservasi Aktif -->
        <section class="mb-10">
            <h2 class="text-lg font-semibold mb-4">Reservasi aktif</h2>
            <div class="border-2 border-gray-300 p-6 rounded-lg bg-white">
                <h3 class="text-xl font-bold">Suite - Room 301</h3>
                <p class="text-sm text-gray-500 mb-6">#RSV-011</p>
                
                <div class="grid grid-cols-4 text-center border-t pt-4">
                    <div>
                        <p class="text-xs text-gray-400">Check-in</p>
                        <p class="font-semibold">07 April 2026</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Check-out</p>
                        <p class="font-semibold">09 April 2026</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Durasi</p>
                        <p class="font-semibold">2 Malam</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Pembayaran</p>
                        <p class="font-semibold text-blue-600">Rp. 1.500.000</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pilihan Kamar Tersedia -->
        <section class="mb-12">
            <h2 class="text-lg font-semibold mb-4">Pilihan kamar tersedia</h2>
            <div class="grid grid-cols-3 gap-6">
                <!-- Loop card starts here -->
                @php
                    $kamar = [
                        ['nama' => 'Standar', 'harga' => '250.000', 'sarapan' => 'Tidak termasuk sarapan'],
                        ['nama' => 'presidential', 'harga' => '1.900.000', 'sarapan' => 'Termasuk Sarapan'],
                        ['nama' => 'deluxe', 'harga' => '1.100.000', 'sarapan' => 'Termasuk Sarapan'],
                    ];
                @endphp

                @foreach($kamar as $item)
                <div class="border p-4 bg-white rounded shadow-sm">
                    <div class="bg-gray-200 aspect-video mb-4 flex items-center justify-center border">
                        <span class="text-gray-400 italic text-xs">[ Gambar Kamar ]</span>
                    </div>
                    <h4 class="font-bold capitalize">{{ $item['nama'] }}</h4>
                    <ul class="text-xs text-gray-600 my-2 space-y-1">
                        <li>2 Dewasa</li>
                        <li>1 Ranjang</li>
                        <li>{{ $item['sarapan'] }}</li>
                    </ul>
                    <div class="text-right mt-4">
                        <p class="font-bold text-sm">Rp {{ $item['harga'] }}</p>
                        <button class="w-full border mt-2 py-1 text-xs hover:bg-gray-50">Lihat Detail</button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Bantuan -->
        <section class="border-t pt-8 pb-12">
            <h2 class="text-center font-bold mb-6">Bantuan</h2>
            <div class="grid grid-cols-3 gap-4">
                <div class="border p-3 rounded flex items-center gap-3">
                    <div class="w-8 h-8 bg-black rounded-full"></div>
                    <div>
                        <p class="text-xs font-bold">WhatsApp Admin</p>
                        <p class="text-xs text-gray-500">+62 812 1111 1111</p>
                    </div>
                </div>
                <div class="border p-3 rounded flex items-center gap-3">
                    <div class="w-8 h-8 bg-black rounded-full"></div>
                    <div>
                        <p class="text-xs font-bold">Email Support</p>
                        <p class="text-xs text-gray-500">support@gmail.com</p>
                    </div>
                </div>
                <div class="border p-3 rounded flex items-center gap-3">
                    <div class="w-8 h-8 bg-black rounded-full"></div>
                    <div>
                        <p class="text-xs font-bold">Hotline Hotel</p>
                        <p class="text-xs text-gray-500">(021) 222 212</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-blue-100 text-center py-4 text-xs font-medium border-t">
        2026 Politeknik Negeri Batam - Projek PBL IF Pagi 2A-09
    </footer>

</body>
</html>
