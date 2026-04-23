@extends('layouts.app')
@section('title', 'Nama Halaman')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kamar - Pulas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="max-w-6xl mx-auto bg-white shadow-lg border p-6" x-data="{ 
    filter: 'Semua',
    search: '',
    get filteredRooms() {
        return this.rooms.filter(room => {
            const matchesFilter = this.filter === 'Semua' || room.status === this.filter;
            const matchesSearch = room.number.toString().includes(this.search) || 
                                  room.type.toLowerCase().includes(this.search.toLowerCase());
            return matchesFilter && matchesSearch;
        });
    }
}"></div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manajemen Kamar</h1>
        <button class="border px-4 py-1 text-sm">+Tambah kamar</button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-4 mb-8 text-center">
        <div class="border p-4">
            <p class="text-sm">Total kamar</p>
            <p class="text-4xl font-bold"></p>
            <p class="text-xs text-gray-500">4 tipe kamar</p>
        </div>
        <div class="border p-4">
            <p class="text-sm">Tersedia</p>
            <p class="text-4xl font-bold"></p>
            <p class="text-xs text-gray-500">% Dari total</p>
        </div>
        <div class="border p-4">
            <p class="text-sm text-red-600">Terisi</p>
            <p class="text-4xl font-bold"></p>
            <p class="text-xs text-gray-500">% Dari total</p>
        </div>
        <div class="border p-4">
            <p class="text-sm">Perbaikan</p>
            <p class="text-4xl font-bold"></p>
            <p class="text-xs text-gray-500">% Dari total</p>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="flex gap-2 mb-4">
        <input type="text" x-model="search" placeholder="Cari berdasarkan nomor atau tipe kamar..." class="border p-2 flex-grow">
        <button @click="filter = 'Semua'" :class="filter === 'Semua' ? 'bg-gray-200' : ''" class="border px-6 py-2">Semua</button>
        <button @click="filter = 'Tersedia'" :class="filter === 'Tersedia' ? 'bg-gray-200' : ''" class="border px-6 py-2">Tersedia</button>
        <button @click="filter = 'Terisi'" :class="filter === 'Terisi' ? 'bg-gray-200' : ''" class="border px-6 py-2 text-red-500">Penuh</button>
        <button @click="filter = 'Perbaikan'" :class="filter === 'Perbaikan' ? 'bg-gray-200' : ''" class="border px-6 py-2">Perbaikan</button>
    </div>

    <div class="grid grid-cols-3 gap-8">
        <!-- Table -->
        <div class="col-span-2">
            <table class="w-full border text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-2 border-r">No. Kamar</th>
                        <th class="p-2 border-r">Jenis</th>
                        <th class="p-2 border-r">Harga/malam</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="room in filteredRooms" :key="room.id">
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2 border-r" x-text="room.number"></td>
                            <td class="p-2 border-r" x-text="room.type"></td>
                            <td class="p-2 border-r" x-text="'Rp. ' + room.price.toLocaleString('id-ID')"></td>
                            <td class="p-2" x-text="room.status"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <!-- Pagination Mockup -->
            <div class="mt-4 flex justify-between items-center text-sm">
                <span>Menampilkan 1-4 dari <span x-text="filteredRooms.length"></span> kamar</span>
                <div class="flex gap-1">
                    <button class="border px-2">&lt;</button>
                    <button class="border px-3 bg-gray-200">1</button>
                    <button class="border px-3">2</button>
                    <button class="border px-3">3</button>
                    <button class="border px-2">&gt;</button>
                </div>
            </div>
        </div>

        <!-- Form Edit -->
        <div class="border p-4 bg-white">
            <h3 class="font-bold mb-1">Edit kamar</h3>
            <p class="text-xs text-gray-500 mb-4">Silakan masukkan detail kamar di bawah ini.</p>
            
            <div class="space-y-3 text-sm">
                <div>
                    <label class="block text-xs">Masukkan nomor kamar</label>
                    <input type="text" value="103" class="w-full border p-1">
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs">Tipe kamar</label>
                        <select class="w-full border p-1 text-xs">
                            <option>Standard</option>
                            <option>Deluxe</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs">Lantai</label>
                        <input type="number" value="1" class="w-full border p-1">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs">Harga/malam</label>
                        <input type="text" value="Rp. 480.000" class="w-full border p-1">
                    </div>
                    <div>
                        <label class="block text-xs">Kapasitas</label>
                        <input type="text" value="2 Orang" class="w-full border p-1">
                    </div>
                </div>
                <div>
                    <label class="block text-xs">Status</label>
                    <select class="w-full border p-1 text-xs">
                        <option>Terisi</option>
                        <option>Tersedia</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button class="border px-4 py-1 text-red-600">Hapus</button>
                    <button class="border px-4 py-1 bg-gray-50">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Tag -->
    <div class="mt-8 text-center text-xs text-gray-500 border-t pt-4">
        2026 Politeknik Negeri Batam - Projek PBL IFPagi 2A-09
    </div>
</div>

</body>
</html>
@endsection