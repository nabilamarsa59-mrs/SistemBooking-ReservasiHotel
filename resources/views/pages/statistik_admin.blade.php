@extends('layouts.app')

@section('title', 'Statistik Admin')

@section('content')

    <div class="bg-[#F2EDE4] min-h-screen px-12 py-10 font-serif text-[#243b53]">

        <div class="mb-8">
            <h1 class="text-[36px] font-bold text-[#0B2A55]">
                Manajemen Pendapatan & Pertumbuhan
            </h1>

            <p class="text-[18px] text-[#243b53] mt-2">
                Rekap dan analisis semua sumber pendapatann hotel.
            </p>
        </div>

        <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md mb-8">
            <h2 class="text-[28px] font-semibold text-[#243b53] mb-4">
                Pendapatan Bulanan
            </h2>

            <div class="mb-4 flex items-center gap-2 text-[15px] text-[#47627A]">
                <span class="inline-block h-3 w-3 rounded bg-[#7BAFC4]"></span>
                Pendapatan (juta Rp)
            </div>

            <div class="h-[260px]">
                <canvas id="chartPendapatan"></canvas>
            </div>
        </div>

        @php
            $pendapatanBulanIni = 85000000;
            $pendapatanBulanLalu = 48000000;
            $selisihPendapatan = round((($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100, 1);
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md">
                <p class="text-[17px] text-[#47627A]">Bulan ini</p>
                <h3 class="text-[22px] font-semibold text-[#243b53] mt-1">Mei 2025</h3>
                <p class="text-[30px] font-bold text-[#0B2A55] mt-2">
                    Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                </p>

            </div>

            <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md">
                <p class="text-[17px] text-[#47627A]">Bulan lalu</p>
                <h3 class="text-[22px] font-semibold text-[#243b53] mt-1">April 2025</h3>
                <p class="text-[30px] font-bold text-[#0B2A55] mt-2">
                    Rp {{ number_format($pendapatanBulanLalu, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md mb-8">
            <h2 class="text-[28px] font-semibold text-[#243b53] mb-4">
                Kunjungan Bulanan
            </h2>

            <div class="mb-4 flex items-center gap-2 text-[15px] text-[#47627A]">
                <span class="inline-block h-3 w-3 rounded bg-[#7BAFC4]"></span>
                Jumlah tamu
            </div>

            <div class="h-[260px]">
                <canvas id="chartKunjungan"></canvas>
            </div>
        </div>

        @php
            $kunjunganBulanIni = 60;
            $kunjunganBulanLalu = 55;
            $selisihKunjungan = round((($kunjunganBulanIni - $kunjunganBulanLalu) / $kunjunganBulanLalu) * 100, 1);
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md">
                <p class="text-[17px] text-[#47627A]">Bulan ini</p>
                <h3 class="text-[22px] font-semibold text-[#243b53] mt-1">Mei 2025</h3>
                <p class="text-[30px] font-bold text-[#0B2A55] mt-2">
                    {{ $kunjunganBulanIni }} Tamu
                </p>

            </div>

            <div class="rounded-2xl border border-[#D1CCC0] bg-white p-7 shadow-md">
                <p class="text-[17px] text-[#47627A]">Bulan lalu</p>
                <h3 class="text-[22px] font-semibold text-[#243b53] mt-1">April 2025</h3>
                <p class="text-[30px] font-bold text-[#0B2A55] mt-2">
                    {{ $kunjunganBulanLalu }} Tamu
                </p>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>

    <script>
        const gridColor = 'rgba(0,0,0,0.08)';
        const tickColor = '#47627A';

        const baseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: tickColor,
                        font: {
                            size: 13
                        }
                    }
                },
                y: {
                    grid: {
                        color: gridColor
                    },
                    border: {
                        display: false
                    },
                    ticks: {
                        color: tickColor,
                        font: {
                            size: 13
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('chartPendapatan'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
                datasets: [{
                    data: [45, 58, 53, 48, 85],
                    backgroundColor: '#7BAFC4',
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: baseOptions
        });

        new Chart(document.getElementById('chartKunjungan'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
                datasets: [{
                    data: [45, 50, 42, 55, 60],
                    backgroundColor: '#7BAFC4',
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: baseOptions
        });
    </script>

@endsection
