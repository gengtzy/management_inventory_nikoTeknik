@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Detail Nota Servis" />

<div class="space-y-6">
    <div class="flex justify-end gap-3 print:hidden">
        <a href="{{ route('services.index') }}" class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">
            Kembali
        </a>
        <button onclick="window.print()" class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 transition">
            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Nota
        </button>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white p-6 sm:p-10 dark:border-gray-800 dark:bg-white/[0.03] print:border-0 print:bg-white print:p-0">
        
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between border-b-2 border-dashed border-gray-200 pb-8 dark:border-gray-800 print:border-gray-300">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white print:text-black">NIKO TEKNIK AC</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">Layanan Perbaikan, Cuci AC & Perawatan</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700 mt-1">WA: 0877 7020 2671 / 0896 1317 8020</p>
            </div>
            <div class="text-left sm:text-right">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white uppercase print:text-black">NOTA SERVIS</h2>
                <p class="font-medium text-gray-800 dark:text-white/90 print:text-black mt-2">No. SRV-{{ str_pad($service->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">Tanggal: {{ \Carbon\Carbon::parse($service->tanggal_servis)->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 py-8 sm:grid-cols-2">
            <div>
                <h4 class="mb-2 text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 print:text-gray-500">Data Pelanggan:</h4>
                <p class="text-lg font-bold text-gray-800 dark:text-white/90 print:text-black">{{ $service->customer->nama }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">{{ $service->customer->alamat ?? 'Alamat tidak diisi' }}</p>
            </div>
            <div class="text-left sm:text-right">
                <h4 class="mb-2 text-xs font-semibold uppercase text-gray-500 dark:text-gray-400 print:text-gray-500">Teknisi Bertugas:</h4>
                <p class="text-lg font-bold text-gray-800 dark:text-white/90 print:text-black">{{ $service->technician->nama_teknisi ?? 'Bukan Teknisi Tetap' }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 print:text-gray-700">Status: {{ strtoupper($service->status) }}</p>
            </div>
        </div>

        <div class="mb-8 rounded-lg bg-gray-50 p-6 border border-gray-100 dark:bg-gray-900/50 dark:border-gray-800 print:bg-gray-50 print:border-gray-300">
            <div class="mb-5">
                <h4 class="font-bold text-gray-900 dark:text-white mb-2 print:text-black">Keluhan / Laporan Awal:</h4>
                <p class="text-sm text-gray-700 dark:text-gray-300 italic print:text-gray-800">{{ $service->keluhan }}</p>
            </div>
            <hr class="border-gray-200 dark:border-gray-800 mb-5 print:border-gray-300">
            <div>
                <h4 class="font-bold text-gray-900 dark:text-white mb-2 print:text-black">Tindakan Teknisi & Sparepart:</h4>
                <p class="text-sm text-gray-700 dark:text-gray-300 print:text-gray-800 whitespace-pre-wrap">{{ $service->tindakan ?? 'Belum ada catatan tindakan dari teknisi.' }}</p>
            </div>
        </div>

        <div class="flex justify-end mt-8">
            <div class="w-full max-w-[350px]">
                <div class="flex justify-between border-b border-gray-300 py-3 dark:border-gray-700 print:border-gray-400">
                    <span class="font-medium text-gray-600 dark:text-gray-400 print:text-gray-800">Total Biaya Servis:</span>
                    <span class="text-xl font-bold text-gray-900 dark:text-white print:text-black">Rp {{ number_format($service->biaya_servis, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <p class="mt-16 text-center text-xs italic text-gray-500 dark:text-gray-400 print:text-gray-600">
            "Terima kasih telah mempercayakan kenyamanan udara Anda kepada Niko Teknik AC"
        </p>
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