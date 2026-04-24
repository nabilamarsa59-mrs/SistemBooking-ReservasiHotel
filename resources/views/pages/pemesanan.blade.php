
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulas - Formulir Pemesanan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com"></script>
    <style>
        /* Menghilangkan panah pada input number agar lebih bersih */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    </style>
</head>
<body class="bg-[#F4F4F4] font-sans antialiased text-black">

    <div class="max-w-6xl mx-auto px-6 py-4" x-data="{ 
        hargaSatuan: 250000, 
        jumlahKamar: 2,
        get totalHarga() { return this.hargaSatuan * this.jumlahKamar }
    }">
        

        <!-- Main Form Container -->
        <main class="bg-white border-2 border-black p-8 md:p-12">
            <h1 class="text-3xl font-black uppercase text-center mb-12 tracking-tight">Formulir Pemesanan</h1>

            <form action="/proses-pemesanan" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-10">
                @csrf
                
                <!-- Left: Room Summary Card -->
                <div class="md:col-span-4 space-y-6">
                    <div class="border-2 border-black p-5">
                        <div class="aspect-square bg-gray-200 border border-black flex items-center justify-center mb-5 group overflow-hidden">
                            <!-- Placeholder Image / Icon -->
                            <svg class="w-24 h-24 text-gray-400 group-hover:scale-110 transition duration-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                        </div>
                        <div class="space-y-2 text-sm border-t-2 border-black pt-4">
                            <h3 class="font-black text-lg uppercase tracking-tight text-black">Standard Room</h3>
                            <ul class="space-y-1 font-medium text-gray-600 italic">
                                <li>• 2 Dewasa</li>
                                <li>• 1 Ranjang</li>
                                <li>• Tanpa Sarapan</li>
                                <li class="text-black font-bold">• Non-Refundable</li>
                            </ul>
                        </div>
                        <div class="mt-6 text-right border-t border-gray-200 pt-4">
                            <p class="text-2xl font-black">Rp 250.000</p>
                            <p class="text-xs text-red-600 font-black uppercase mt-1 animate-pulse">Hanya Sisa 2 Kamar!</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Form Inputs -->
                <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                    
                    @php 
                        $fields = [
                            ['label' => 'Nama Lengkap', 'name' => 'nama', 'type' => 'text', 'placeholder' => 'Nama lengkap'],
                            ['label' => 'NIK', 'name' => 'nik', 'type' => 'text', 'placeholder' => 'NIK'],
                            ['label' => 'No. Telepon', 'name' => 'telp', 'type' => 'tel', 'placeholder' => 'No.tlp'],
                            ['label' => 'Email', 'name' => 'email', 'type' => 'email', 'placeholder' => 'email'],
                            ['label' => 'Check-in', 'name' => 'check_in', 'type' => 'date', 'placeholder' => ''],
                            ['label' => 'Check-out', 'name' => 'check_out', 'type' => 'date', 'placeholder' => ''],
                        ];
                    @endphp

                    @foreach($fields as $field)
                    <div class="flex flex-col">
                        <label class="font-black uppercase text-xs mb-1">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" 
                               placeholder="{{ $field['placeholder'] }}"
                               class="border-2 border-black p-3 focus:bg-yellow-50 outline-none transition font-medium">
                    </div>
                    @endforeach

                    <!-- Jumlah Kamar (Interaktif) -->
                    <div class="flex flex-col">
                        <label class="font-black uppercase text-xs mb-1">Jumlah Kamar</label>
                        <input type="number" x-model="jumlahKamar" name="jumlah_kamar"
                               class="border-2 border-black p-3 focus:bg-yellow-50 outline-none transition font-medium">
                    </div>

                    <!-- Jumlah Tamu -->
                    <div class="flex flex-col">
                        <label class="font-black uppercase text-xs mb-1">Jumlah Tamu</label>
                        <input type="number" name="jumlah_tamu" value="2"
                               class="border-2 border-black p-3 focus:bg-yellow-50 outline-none transition font-medium">
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="flex flex-col">
                        <label class="font-black uppercase text-xs mb-1">Metode Pembayaran</label>
                        <select name="metode" class="border-2 border-black p-3 bg-white font-medium outline-none">
                            <option>Transfer Bank</option>
                            <option>E-Wallet (OVO/Dana)</option>
                            <option>Kartu Kredit</option>
                        </select>
                    </div>

                    <!-- Total Pembayaran -->
                    <div class="flex flex-col">
                        <label class="font-black uppercase text-xs mb-1">Total Pembayaran</label>
                        <div class="border-2 border-black p-3 bg-gray-100 font-black text-xl">
                            Rp <span x-text="totalHarga.toLocaleString('id-ID')"></span>
                        </div>
                        <input type="hidden" name="total" :value="totalHarga">
                    </div>

                    <!-- Submit Button -->
                    <div class="sm:col-span-2 mt-6">
                        <button type="submit" 
                                class="w-full bg-white text-black p-4 font-black uppercase text-lg tracking-widest hover:bg-blue-400 border-2 border-black transition-all rounded-full">
                            Konfirmasi Pesanan
                        </button>
                    </div>

                </div>
            </form>
        </main>

        <!-- Footer -->
        <footer class="mt-12 text-center text-sm font-bold uppercase tracking-widest text-gray-500">
            &copy; 2026 Politeknik Negeri Batam - Projek PBL IFPagi 2A-09
        </footer>
    </div>

</body>
</html>
