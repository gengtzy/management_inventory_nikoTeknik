@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Detail Nota Penjualan" />

<div class="space-y-6">
    <div class="flex justify-end gap-3 print:hidden">
        <a href="{{ route('sales.index') }}" class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">
            Kembali
        </a>
        <button onclick="window.print()" class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 transition">
            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Nota
        </button>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white p-6 sm:p-10 dark:border-gray-800 dark:bg-white/[0.03] print:border-0 print:bg-white print:p-0">
        
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between border-b border-gray-200 pb-8 dark:border-gray-800 print:border-gray-300">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white uppercase print:text-black">NIKO TEKNIK AC</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">Terima Jual Beli AC, Service, dan Bongkar Pasang</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">Jl. Raya Berbek No. 12 C Waru - Sidoarjo</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">HP: 0877 7020 2671 / 0896 1317 8020</p>
            </div>
            <div class="text-left sm:text-right">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white uppercase print:text-black">NOTA PENJUALAN</h2>
                <p class="font-medium text-gray-800 dark:text-white/90 print:text-black mt-2">No. INV-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">Tanggal: {{ \Carbon\Carbon::parse($sale->tanggal_jual)->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 py-8 sm:grid-cols-2">
            <div>
                <h4 class="mb-2 text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 print:text-gray-500">Diterima Oleh:</h4>
                <p class="text-lg font-bold text-gray-800 dark:text-white/90 print:text-black">{{ $sale->customer->nama }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">{{ $sale->customer->alamat ?? 'Alamat tidak diisi' }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">{{ $sale->customer->no_hp ?? '-' }}</p>
            </div>
            <div class="text-left sm:text-right">
                <h4 class="mb-2 text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 print:text-gray-500">Info Pembayaran:</h4>
                <p class="text-lg font-bold uppercase text-brand-500 print:text-black">{{ $sale->metode_pembayaran }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700 mt-1">Garansi: {{ $sale->masa_garansi ?? 'Tidak ada garansi' }}</p>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-800 print:border-gray-300">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400 print:text-gray-800">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-900/50 dark:text-gray-400 print:bg-gray-100 print:text-black">
                    <tr>
                        <th class="px-6 py-4 font-medium">Deskripsi AC</th>
                        <th class="px-6 py-4 font-medium text-center">Spesifikasi</th>
                        <th class="px-6 py-4 font-medium text-center">Qty</th>
                        <th class="px-6 py-4 font-medium text-right">Total (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800 print:divide-gray-300">
                    <tr>
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 dark:text-white/90 print:text-black">{{ $sale->item->merek }} {{ $sale->item->tipe_ac }}</p>
                            <p class="text-xs text-gray-500 mt-1">Kelengkapan: {{ $sale->kelengkapan ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $sale->item->pk }} PK | {{ $sale->item->freon }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $sale->jumlah_set }} Set
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-gray-900 dark:text-white print:text-black">
                            {{ number_format($sale->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-12 flex justify-between px-6">
            <div class="text-center">
                <p class="mb-16 text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">Tanda Terima,</p>
                <p class="border-b border-gray-400 px-8 text-sm font-bold text-gray-800 uppercase dark:border-gray-600 dark:text-white/90 print:border-gray-400 print:text-black">{{ $sale->customer->nama }}</p>
            </div>
            <div class="text-center">
                <p class="mb-16 text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">Hormat Kami,</p>
                <p class="border-b border-gray-400 px-8 text-sm font-bold text-gray-800 uppercase dark:border-gray-600 dark:text-white/90 print:border-gray-400 print:text-black">ADMIN NIKO TEKNIK</p>
            </div>
        </div>

    </div>
</div>

<style>
@media print {
    .print\:hidden { display: none !important; }
    #sidebar, header, nav { display: none !important; }
    body { background-color: white !important; color: black !important; margin: 0; padding: 0; }
    main { padding: 0 !important; margin: 0 !important; width: 100% !important; max-width: 100% !important; }
}
</style>
@endsection