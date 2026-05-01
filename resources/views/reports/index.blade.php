@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <div class="print:hidden">
        <x-common.page-breadcrumb pageTitle="Laporan Keuangan & Operasional" />
    </div>

    <div class="space-y-6">
        
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6 print:hidden">
            <!-- Gunakan Alpine.js (x-data) untuk deteksi Jenis Laporan secara langsung -->
            <form x-data="{ reportType: '{{ $type }}' }" action="{{ route('reports.index') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-5 gap-4 items-end">
                
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Jenis Laporan</label>
                    <div class="relative z-20 bg-transparent">
                        <select name="type" x-model="reportType" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="sales">Laporan Penjualan AC</option>
                            <option value="services">Laporan Jasa Servis</option>
                            <option value="inbounds">Laporan Barang Masuk</option>
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8l5 5 5-5"/></svg></span>
                    </div>
                </div>

                <!-- Dropdown Merek (HANYA MUNCUL SAAT REPORT TYPE == 'sales') -->
                <div x-show="reportType === 'sales'" style="display: {{ $type == 'sales' ? 'block' : 'none' }}">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Filter Merek AC</label>
                    <div class="relative z-20 bg-transparent">
                        <select name="brand" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="all">Semua Merek</option>
                            @foreach($brands as $b)
                                <option value="{{ $b }}" {{ $selectedBrand == $b ? 'selected' : '' }}>{{ $b }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8l5 5 5-5"/></svg></span>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" required
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" required
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="inline-flex flex-1 justify-center rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 transition h-11 items-center">
                        Filter
                    </button>
                    <button type="button" onclick="window.print()" class="inline-flex justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition h-11 items-center dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700" title="Cetak Laporan">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 sm:p-10 dark:border-gray-800 dark:bg-white/[0.03] print:border-0 print:p-0 print:shadow-none">
            
            <div class="hidden print:block border-b-2 border-black pb-4 mb-6">
                <h1 class="text-2xl font-bold uppercase text-black text-center">NIKO TEKNIK AC</h1>
                <p class="text-center text-sm text-black">Jl. Raya Berbek No. 12 C Waru - Sidoarjo | HP: 0877 7020 2671</p>
                <h2 class="text-xl font-bold uppercase text-black text-center mt-4">
                    @if($type == 'sales') 
                        LAPORAN PENJUALAN AC {{ $selectedBrand != 'all' ? '- MEREK ' . strtoupper($selectedBrand) : '' }}
                    @elseif($type == 'services') 
                        LAPORAN JASA SERVIS (SELESAI)
                    @else 
                        LAPORAN BARANG MASUK (RESTOK) 
                    @endif
                </h2>
                <p class="text-center text-sm text-black">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
            </div>

            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400 print:text-black">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-900/50 dark:text-gray-400 print:bg-white print:text-black print:border-b print:border-t print:border-black">
                        <tr>
                            <th class="px-6 py-4 font-medium">Tanggal</th>
                            @if($type == 'sales')
                                <th class="px-6 py-4 font-medium">Pelanggan</th>
                                <th class="px-6 py-4 font-medium">Unit AC</th>
                                <th class="px-6 py-4 font-medium text-center">Qty</th>
                                <th class="px-6 py-4 font-medium text-right">Total (Rp)</th>
                            @elseif($type == 'services')
                                <th class="px-6 py-4 font-medium">Pelanggan</th>
                                <th class="px-6 py-4 font-medium">Teknisi</th>
                                <th class="px-6 py-4 font-medium">Tindakan</th>
                                <th class="px-6 py-4 font-medium text-right">Biaya (Rp)</th>
                            @else
                                <th class="px-6 py-4 font-medium">Unit AC</th>
                                <th class="px-6 py-4 font-medium">Keterangan</th>
                                <th class="px-6 py-4 font-medium text-center">Qty Masuk</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800 print:divide-gray-300">
                        @forelse($data as $row)
                            <tr>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($row->tanggal_jual ?? $row->tanggal_servis ?? $row->tanggal_masuk)->format('d M Y') }}</td>
                                
                                @if($type == 'sales')
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white print:text-black">{{ $row->customer->nama }}</td>
                                    <td class="px-6 py-4">{{ $row->item->merek }} {{ $row->item->tipe_ac }}</td>
                                    <td class="px-6 py-4 text-center">{{ $row->jumlah_set }}</td>
                                    <td class="px-6 py-4 text-right">{{ number_format($row->total_harga, 0, ',', '.') }}</td>
                                
                                @elseif($type == 'services')
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white print:text-black">{{ $row->customer->nama }}</td>
                                    <td class="px-6 py-4">{{ $row->technician->nama_teknisi ?? '-' }}</td>
                                    <td class="px-6 py-4 truncate max-w-[200px]">{{ $row->tindakan }}</td>
                                    <td class="px-6 py-4 text-right">{{ number_format($row->biaya_servis, 0, ',', '.') }}</td>
                                
                                @else
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white print:text-black">{{ $row->item->merek }} {{ $row->item->tipe_ac }}</td>
                                    <td class="px-6 py-4 truncate max-w-[250px]">{{ $row->keterangan ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-brand-500 print:text-black">+{{ $row->jumlah_masuk }}</td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada data pada periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                    @if($data->count() > 0)
                    <tfoot class="bg-gray-50 dark:bg-gray-900/50 print:bg-white print:border-t print:border-b print:border-black">
                        <tr>
                            <td colspan="{{ $type == 'inbounds' ? '2' : '3' }}" class="px-6 py-4 text-right font-bold text-gray-900 dark:text-white print:text-black">
                                TOTAL KESELURUHAN:
                            </td>
                            @if($type == 'sales')
                                <td class="px-6 py-4 text-center font-bold text-gray-900 dark:text-white print:text-black">{{ $totalUnit }}</td>
                                <td class="px-6 py-4 text-right font-bold text-brand-500 text-lg print:text-black">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                            @elseif($type == 'services')
                                <td class="px-6 py-4 text-right font-bold text-brand-500 text-lg print:text-black" colspan="2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                            @else
                                <td class="px-6 py-4 text-center font-bold text-brand-500 text-lg print:text-black">{{ $totalUnit }} Unit</td>
                            @endif
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>

            <div class="hidden print:flex justify-end mt-16">
                <div class="text-center">
                    <p class="mb-16 text-black">Sidoarjo, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                    <p class="border-b border-black px-10 font-bold text-black uppercase">ADMINISTRATOR</p>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
@media print {
    .print\:hidden { display: none !important; }
    .print\:block { display: block !important; }
    .print\:flex { display: flex !important; }
    #sidebar, header, nav { display: none !important; }
    body { background-color: white !important; color: black !important; margin: 0; padding: 0; }
    main { padding: 0 !important; margin: 0 !important; width: 100% !important; max-width: 100% !important; }
}
</style>
@endsection