
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajemen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/dashboard.js'])
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white shadow-lg p-6 rounded-md">
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <div>
                <h1 class="text-xl font-bold">Manajemen Pendapatan dan Pertumbuhan</h1>
                <p class="text-xs text-gray-500 italic">Rekap dan analisis semua sumber pendapatan dan pertumbuhan hotel.</p>
            </div>
            <div class="flex items-center gap-4 text-sm font-medium">
                <a href="#">Beranda</a>
                <a href="#">Verifikasi</a>
                <div class="w-8 h-8 bg-black rounded-full text-white flex items-center justify-center">👤</div>
            </div>
        </div>

        <!-- Section Pendapatan -->
        <div class="mb-10">
            <h2 class="font-semibold mb-4 text-md">Pendapatan bulanan</h2>
            <div class="h-64 mb-6">
                <!-- Kita simpan data di sini untuk dibaca JS -->
                <canvas id="revenueChart" 
                    data-labels="{{ $stats->pluck('month') }}" 
                    data-values="{{ $stats->pluck('revenue') }}">
                </canvas>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="border p-4">
                    <p class="text-xs text-gray-400">Total pendapatan bulan ini</p>
                    <p class="font-bold">{{ $current->month ?? 'belum ada data' }}</p>
                    <p class="text-lg">Rp. {{ number_format($current->revenue ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="border p-4">
                    <p class="text-xs text-gray-400">Total pendapatan sebelum bulan ini</p>
                    <p class="font-bold">{{ $previous->month ?? 'belum ada data' }}</p>
                    <p class="text-lg">Rp. {{ number_format($previous->revenue ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Section Kunjungan -->
        <div>
            <h2 class="font-semibold mb-4 text-md">Kunjungan bulanan</h2>
            <div class="h-64 mb-6">
                <canvas id="visitorChart" 
                    data-labels="{{ $stats->pluck('month') }}" 
                    data-values="{{ $stats->pluck('visitors') }}">
                </canvas>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="border p-4">
                    <p class="text-xs text-gray-400">Total kunjungan bulan ini</p>
                    <p class="font-bold">{{ $current->month ?? 'belum ada data' }}</p>
                    <p class="text-lg">{{ $current->visitors ?? 'belum ada data' }} Tamu</p>
                </div>
                <div class="border p-4">
                    <p class="text-xs text-gray-400">Total kunjungan sebelum bulan ini</p>
                    <p class="font-bold">{{ $previous->month ?? 'belum ada data'}}</p>
                    <p class="text-lg">{{ $previous->visitors ?? 'belum ada data' }} Tamu</p>
                </div>
            </div>
        </div>
        
        <footer class="mt-10 text-center text-[10px] text-gray-400 border-t pt-4">
            2024 Politeknik Negeri Batam - Projek PBL IFPagi 24-09
        </footer>
    </div>

</body>
</html>
