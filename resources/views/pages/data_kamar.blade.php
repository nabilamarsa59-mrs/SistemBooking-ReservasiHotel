@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')
<div class="min-h-screen bg-[#F2EDE4] px-12 py-10 font-serif text-[#243b53]">

    {{-- HEADER --}}
    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-[36px] font-bold text-[#0B2A55]">Data Kamar</h1>
            <p class="text-[18px] text-[#47627A] mt-2">Kelola data kamar hotel berdasarkan nomor, tipe, harga, dan status kamar.</p>
        </div>
        <button onclick="openTambahModal()"
            class="rounded-xl bg-[#7EA1BA] px-7 py-3 text-[17px] font-semibold text-white shadow-md hover:bg-[#668BA5] transition">
            + Tambah Kamar
        </button>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-100 px-5 py-4 text-green-700 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    {{-- STAT CARDS --}}
    <div class="mb-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[16px] text-[#47627A]">Total Kamar</p>
                    <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $total }}</h2>
                    <p class="text-[15px] text-[#47627A]">{{ $tipeKamar->count() }} tipe kamar</p>
                </div>
                <div class="w-16 h-16 rounded-full bg-[#EAF0FA] flex items-center justify-center text-[28px]">🏨</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[16px] text-[#47627A]">Tersedia</p>
                    <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $tersedia }}</h2>
                    <p class="text-[15px] text-[#47627A]">{{ $total > 0 ? round(($tersedia / $total) * 100) : 0 }}% dari total</p>
                </div>
                <div class="w-16 h-16 rounded-full bg-[#D8F3DF] flex items-center justify-center text-[28px]">✅</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[16px] text-[#47627A]">Terisi</p>
                    <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $terisi }}</h2>
                    <p class="text-[15px] text-[#47627A]">{{ $total > 0 ? round(($terisi / $total) * 100) : 0 }}% dari total</p>
                </div>
                <div class="w-16 h-16 rounded-full bg-[#FFF0C7] flex items-center justify-center text-[28px]">🔑</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[16px] text-[#47627A]">Perbaikan</p>
                    <h2 class="text-[42px] font-bold text-[#0B2A55]">{{ $perbaikan }}</h2>
                    <p class="text-[15px] text-[#47627A]">{{ $total > 0 ? round(($perbaikan / $total) * 100) : 0 }}% dari total</p>
                </div>
                <div class="w-16 h-16 rounded-full bg-[#FCE7E7] flex items-center justify-center text-[28px]">🛠️</div>
            </div>
        </div>
    </div>

    {{-- SEARCH FILTER --}}
    <div class="mb-6 flex flex-col lg:flex-row gap-4">
        <input id="searchInput" type="text" placeholder="Cari nomor atau tipe kamar..."
            class="w-full lg:w-[420px] rounded-xl border border-[#D1CCC0] bg-white px-5 py-3 text-[16px] shadow-sm outline-none focus:border-[#7EA1BA]"
            oninput="applyFilter()">
        <div class="flex flex-wrap gap-3">
            <button onclick="setFilter('semua')" id="btn-semua"
                class="filter-btn rounded-xl border border-[#7EA1BA] bg-[#7EA1BA] px-6 py-3 text-white shadow-sm transition">Semua</button>
            <button onclick="setFilter('tersedia')" id="btn-tersedia"
                class="filter-btn rounded-xl border border-[#D1CCC0] bg-white px-6 py-3 text-[#243b53] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">Tersedia</button>
            <button onclick="setFilter('terisi')" id="btn-terisi"
                class="filter-btn rounded-xl border border-[#D1CCC0] bg-white px-6 py-3 text-[#243b53] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">Terisi</button>
            <button onclick="setFilter('perbaikan')" id="btn-perbaikan"
                class="filter-btn rounded-xl border border-[#D1CCC0] bg-white px-6 py-3 text-[#243b53] shadow-sm hover:bg-[#7EA1BA] hover:text-white transition">Perbaikan</button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-[#D1CCC0] shadow-md overflow-hidden">
        <div class="px-7 py-6 border-b border-[#E2E8F0]">
            <h2 class="text-[28px] font-bold text-[#0B2A55]">Daftar Kamar</h2>
            <p class="text-[16px] text-[#47627A] mt-1">Menampilkan seluruh kamar yang tersedia di sistem.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#F8FAFC] border-b border-[#E2E8F0]">
                        <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">No. Kamar</th>
                        <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Jenis</th>
                        <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Harga/Malam</th>
                        <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A]">Status</th>
                        <th class="px-5 py-4 text-[15px] font-bold uppercase text-[#47627A] text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($kamar as $k)
                        <tr class="kamar-row border-b border-[#E2E8F0] hover:bg-[#F8FAFC] transition"
                            data-nomor="{{ strtolower($k->no_kamar) }}"
                            data-jenis="{{ strtolower($k->tipe->detail_kamar ?? '') }}"
                            data-status="{{ $k->status_kamar }}">
                            <td class="px-5 py-5 font-semibold">{{ $k->no_kamar }}</td>
                            <td class="px-5 py-5">{{ $k->tipe->detail_kamar ?? '-' }}</td>
                            <td class="px-5 py-5">Rp. {{ number_format($k->tipe->harga_kamar ?? 0, 0, ',', '.') }}</td>
                            <td class="px-5 py-5">
                                @if ($k->status_kamar === 'tersedia')
                                    <span class="rounded-full bg-green-100 px-4 py-1 text-[14px] font-semibold text-green-700">Tersedia</span>
                                @elseif ($k->status_kamar === 'terisi')
                                    <span class="rounded-full bg-blue-100 px-4 py-1 text-[14px] font-semibold text-blue-700">Terisi</span>
                                @else
                                    <span class="rounded-full bg-red-100 px-4 py-1 text-[14px] font-semibold text-red-700">Perbaikan</span>
                                @endif
                            </td>
                            <td class="px-5 py-5 text-center whitespace-nowrap">
                                <button onclick="openEditModal({{ $k->id }}, '{{ $k->no_kamar }}', {{ $k->id_tipe }}, '{{ $k->status_kamar }}')"
                                    class="mr-2 rounded-lg border border-[#7EA1BA] px-3 py-2 text-[#0B2A55] hover:bg-[#7EA1BA] hover:text-white transition">
                                    Edit
                                </button>
                                <form action="{{ route('kamar.destroy', $k->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus kamar {{ $k->no_kamar }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-red-600 hover:bg-red-100 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-[#47627A]">Belum ada data kamar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between border-t border-[#E2E8F0] px-6 py-4">
            <p class="text-[15px] text-[#47627A]">{{ $kamar->firstItem() }}-{{ $kamar->lastItem() }} dari {{ $kamar->total() }} kamar</p>
            <div>{{ $kamar->links() }}</div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="modalTambah" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-lg rounded-2xl bg-white p-8 shadow-xl font-serif text-[#243b53]">
        <h2 class="mb-1 text-[26px] font-bold text-[#0B2A55]">Tambah Kamar</h2>
        <p class="mb-6 text-[15px] text-[#47627A]">Lengkapi informasi kamar yang akan ditambahkan.</p>
        <form action="{{ route('kamar.store') }}" method="POST">
            @csrf
            <input name="no_kamar" type="text" placeholder="No. Kamar"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]" required>
            <select name="id_tipe"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] bg-white px-4 py-3 outline-none focus:border-[#7EA1BA]" required>
                <option value="">Pilih Tipe Kamar</option>
                @foreach ($tipeKamar as $t)
                    <option value="{{ $t->id_tipe }}">{{ $t->detail_kamar }} - Rp. {{ number_format($t->harga_kamar, 0, ',', '.') }}</option>
                @endforeach
            </select>
            <select name="status_kamar"
                class="mb-6 w-full rounded-xl border border-[#D1CCC0] bg-white px-4 py-3 outline-none focus:border-[#7EA1BA]" required>
                <option value="tersedia">Tersedia</option>
                <option value="terisi">Terisi</option>
                <option value="perbaikan">Perbaikan</option>
            </select>
            <div class="flex justify-end gap-4">
                <button type="button" onclick="closeTambahModal()"
                    class="rounded-xl border border-[#D1CCC0] px-7 py-3 hover:bg-gray-100 transition">Batal</button>
                <button type="submit"
                    class="rounded-xl bg-[#7EA1BA] px-7 py-3 font-semibold text-white hover:bg-[#668BA5] transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="modalEdit" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-lg rounded-2xl bg-white p-8 shadow-xl font-serif text-[#243b53]">
        <h2 class="mb-1 text-[26px] font-bold text-[#0B2A55]">Edit Kamar</h2>
        <p class="mb-6 text-[15px] text-[#47627A]">Silakan ubah detail kamar di bawah ini.</p>
        <form id="formEdit" action="" method="POST">
            @csrf
            @method('PUT')
            <input id="edit_no_kamar" name="no_kamar" type="text" placeholder="No. Kamar"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] px-4 py-3 outline-none focus:border-[#7EA1BA]" required>
            <select id="edit_id_tipe" name="id_tipe"
                class="mb-4 w-full rounded-xl border border-[#D1CCC0] bg-white px-4 py-3 outline-none focus:border-[#7EA1BA]" required>
                @foreach ($tipeKamar as $t)
                    <option value="{{ $t->id_tipe }}">{{ $t->detail_kamar }} - Rp. {{ number_format($t->harga_kamar, 0, ',', '.') }}</option>
                @endforeach
            </select>
            <select id="edit_status" name="status_kamar"
                class="mb-6 w-full rounded-xl border border-[#D1CCC0] bg-white px-4 py-3 outline-none focus:border-[#7EA1BA]" required>
                <option value="tersedia">Tersedia</option>
                <option value="terisi">Terisi</option>
                <option value="perbaikan">Perbaikan</option>
            </select>
            <div class="flex justify-end gap-4">
                <button type="button" onclick="closeEditModal()"
                    class="rounded-xl border border-[#D1CCC0] px-7 py-3 hover:bg-gray-100 transition">Batal</button>
                <button type="submit"
                    class="rounded-xl bg-[#7EA1BA] px-7 py-3 font-semibold text-white hover:bg-[#668BA5] transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTambahModal() { toggle('modalTambah', true); }
    function closeTambahModal() { toggle('modalTambah', false); }
    function closeEditModal() { toggle('modalEdit', false); }

    function openEditModal(id, noKamar, idTipe, status) {
        document.getElementById('edit_no_kamar').value = noKamar;
        document.getElementById('edit_id_tipe').value = idTipe;
        document.getElementById('edit_status').value = status;
        document.getElementById('formEdit').action = '/kamar/' + id;
        toggle('modalEdit', true);
    }

    function toggle(id, show) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden', !show);
        modal.classList.toggle('flex', show);
    }

    ['modalTambah', 'modalEdit'].forEach(id => {
        document.getElementById(id).addEventListener('click', function(e) {
            if (e.target === this) toggle(id, false);
        });
    });

    let currentFilter = 'semua';

    function setFilter(f) {
        currentFilter = f;
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('bg-[#7EA1BA]', 'text-white');
            b.classList.add('bg-white', 'text-[#243b53]');
        });
        const activeBtn = document.getElementById('btn-' + f);
        if (activeBtn) {
            activeBtn.classList.add('bg-[#7EA1BA]', 'text-white');
            activeBtn.classList.remove('bg-white', 'text-[#243b53]');
        }
        applyFilter();
    }

    function applyFilter() {
        const search = document.getElementById('searchInput').value.toLowerCase().trim();
        document.querySelectorAll('.kamar-row').forEach(row => {
            const matchSearch = !search || row.dataset.nomor.includes(search) || row.dataset.jenis.includes(search);
            const matchFilter = currentFilter === 'semua' || row.dataset.status === currentFilter;
            row.classList.toggle('hidden', !(matchSearch && matchFilter));
        });
    }
</script>

@endsection
