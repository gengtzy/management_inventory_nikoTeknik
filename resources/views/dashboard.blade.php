@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-title-md2 font-bold text-gray-800 dark:text-white/90">Dashboard Overview</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400">Ringkasan performa Niko Teknik AC bulan ini ({{ \Carbon\Carbon::now()->translatedFormat('F Y') }}).</p>
</div>

<div class="grid grid-cols-12 gap-4 md:gap-6">
    
    <div class="col-span-12">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4 md:gap-6">
            
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800">
                    <svg class="fill-brand-500 dark:fill-brand-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM11 16H13V17H11V16ZM11 7H13V15H11V7Z"/>
                    </svg>
                </div>
                <div class="flex items-end justify-between mt-5">
                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Total Pendapatan</span>
                        <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                    </div>
                    <span class="flex items-center gap-1 rounded-full bg-success-50 py-0.5 pl-2 pr-2.5 text-theme-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                        Bulan Ini
                    </span>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800">
                    <svg class="fill-blue-500 dark:fill-blue-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 18C5.9 18 5.01 18.9 5.01 20C5.01 21.1 5.9 22 7 22C8.1 22 9 21.1 9 20C9 18.9 8.1 18 7 18ZM1 2V4H3L6.6 11.59L5.24 14.04C5.09 14.32 5 14.65 5 15C5 16.1 5.9 17 7 17H19V15H7.42C7.29 15 7.17 14.89 7.17 14.75L7.2 14.63L8.1 13H15.55C16.3 13 16.96 12.59 17.3 11.97L20.88 5.48C20.96 5.34 21 5.17 21 5C21 4.45 20.55 4 20 4H5.21L4.27 2H1ZM17 18C15.9 18 15.01 18.9 15.01 20C15.01 21.1 15.9 22 17 22C18.1 22 19 21.1 19 20C19 18.9 18.1 18 17 18Z"/>
                    </svg>
                </div>
                <div class="flex items-end justify-between mt-5">
                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">AC Terjual</span>
                        <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">{{ $totalUnitTerjual }} Set</h4>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800">
                    <svg class="fill-warning-500 dark:fill-warning-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>
                    </svg>
                </div>
                <div class="flex items-end justify-between mt-5">
                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Servis Berjalan</span>
                        <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">{{ $servisProses }} Tiket</h4>
                    </div>
                    <span class="flex items-center gap-1 rounded-full bg-warning-50 py-0.5 pl-2 pr-2.5 text-theme-xs font-medium text-warning-600 dark:bg-warning-500/15 dark:text-warning-500">
                        Proses
                    </span>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800">
                    <svg class="fill-gray-600 dark:fill-gray-300" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 16.5C21 16.88 20.79 17.21 20.47 17.38L12.5 21.82C12.19 21.99 11.81 21.99 11.5 21.82L3.53 17.38C3.21 17.21 3 16.88 3 16.5V7.5C3 7.12 3.21 6.79 3.53 6.62L11.5 2.18C11.81 2.01 12.19 2.01 12.5 2.18L20.47 6.62C20.79 6.79 21 7.12 21 7.5V16.5ZM12 4.15L5.6 7.7L12 11.25L18.4 7.7L12 4.15ZM5 15.91L11 19.25V12.58L5 9.24V15.91ZM19 15.91V9.24L13 12.58V19.25L19 15.91Z"/>
                    </svg>
                </div>
                <div class="flex items-end justify-between mt-5">
                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Total Stok Gudang</span>
                        <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">{{ $totalStok }} Unit</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12">
        <div class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
            <div class="flex flex-col gap-5 mb-6 sm:flex-row sm:justify-between">
                <div class="w-full">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Statistik Pendapatan Harian
                    </h3>
                    <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
                        Perbandingan tren pemasukan dari Penjualan AC dan Jasa Servis bulan ini.
                    </p>
                </div>
            </div>
            
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <div id="revenueChart" class="-ml-4 min-w-[700px] pl-2 xl:min-w-full"></div>
            </div>
        </div>
    </div>

    <div class="col-span-12 xl:col-span-8">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
            <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Penjualan Terakhir</h3>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('sales.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                        Lihat Semua Transaksi
                    </a>
                </div>
            </div>

            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-t border-gray-100 dark:border-gray-800">
                            <th class="py-3 text-left"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Pelanggan</p></th>
                            <th class="py-3 text-left"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Unit AC</p></th>
                            <th class="py-3 text-left"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Tanggal</p></th>
                            <th class="py-3 text-right"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Total Harga</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentSales as $sale)
                            <tr class="border-t border-gray-100 dark:border-gray-800">
                                <td class="py-3 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center h-[40px] w-[40px] overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 font-bold">
                                            {{ substr($sale->customer->nama, 0, 1) }}
                                        </div>
                                        <div><p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $sale->customer->nama }}</p></div>
                                    </div>
                                </td>
                                <td class="py-3 whitespace-nowrap">
                                    <p class="text-gray-800 text-theme-sm dark:text-white/90 font-medium">{{ $sale->item->merek }}</p>
                                    <p class="text-gray-500 text-theme-xs dark:text-gray-400">{{ $sale->jumlah_set }} Set</p>
                                </td>
                                <td class="py-3 whitespace-nowrap">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ \Carbon\Carbon::parse($sale->tanggal_jual)->format('d M Y') }}</p>
                                </td>
                                <td class="py-3 whitespace-nowrap text-right">
                                    <span class="rounded-full px-2 py-0.5 text-theme-xs font-medium bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-500">
                                        Rp {{ number_format($sale->total_harga, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada transaksi penjualan terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-span-12 xl:col-span-4">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 h-full">
            <div class="flex flex-col gap-2 mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Peringatan Stok Menipis</h3>
                <p class="text-theme-xs text-gray-500 dark:text-gray-400">Unit AC dengan stok di bawah 5.</p>
            </div>
            <div class="flex flex-col gap-3 mt-4">
                @forelse($lowStockItems as $item)
                    <div class="flex items-center justify-between rounded-lg border border-gray-100 p-3 dark:border-gray-800">
                        <div>
                            <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $item->merek }} {{ $item->tipe_ac }}</p>
                            <p class="text-gray-500 text-theme-xs dark:text-gray-400">Kode: {{ $item->kode_barang }}</p>
                        </div>
                        <span class="rounded-full px-2.5 py-0.5 text-theme-xs font-bold bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500">
                            {{ $item->stok }} Sisa
                        </span>
                    </div>
                @empty
                    <div class="flex h-full flex-col items-center justify-center py-8 text-center">
                        <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-success-50 dark:bg-success-500/15">
                            <svg class="fill-success-500" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 16.2L4.8 12L3.4 13.4L9 19L21 7L19.6 5.6L9 16.2Z"/></svg>
                        </div>
                        <p class="text-theme-sm text-gray-500 dark:text-gray-400">Kondisi stok gudang aman.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Ambil data dinamis dari Controller via Blade JSON Helper
        const dates = @json(array_values($dates));
        const salesData = @json(array_values($salesData));
        const serviceData = @json(array_values($serviceData));

        const chartOptions = {
            series: [{
                name: 'Penjualan AC',
                data: salesData
            }, {
                name: 'Jasa Servis',
                data: serviceData
            }],
            chart: {
                type: 'area',
                height: 350,
                toolbar: { show: false },
                fontFamily: 'inherit',
            },
            colors: ['#465FFF', '#F59D31'], // Warna biru (penjualan) & oren (servis)
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            xaxis: {
                categories: dates,
                labels: {
                    style: { colors: '#9CA3AF' }
                }
            },
            yaxis: {
                labels: {
                    style: { colors: '#9CA3AF' },
                    formatter: (value) => {
                        // Merubah 1000000 menjadi 1M atau 1000 menjadi 1K
                        if(value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
                        if(value >= 1000) return (value / 1000).toFixed(0) + 'K';
                        return value;
                    }
                }
            },
            grid: {
                borderColor: '#E5E7EB',
                strokeDashArray: 4,
                yaxis: { lines: { show: true } }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "Rp " + val.toLocaleString('id-ID');
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#revenueChart"), chartOptions);
        chart.render();
    });
</script>
@endsection