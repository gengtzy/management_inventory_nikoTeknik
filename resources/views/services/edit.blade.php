@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Update Progress Servis" />

<div class="space-y-6">
    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <x-common.component-card title="Laporan Pengerjaan Teknisi">
            <div class="p-5 sm:p-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
                
                <div class="xl:col-span-2 flex gap-4 rounded-lg bg-gray-50 p-4 border border-gray-100 dark:bg-gray-800 dark:border-gray-800">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pelanggan:</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $service->customer->nama }}</p>
                    </div>
                    <div class="border-l border-gray-300 pl-4 dark:border-gray-700">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Keluhan Awal:</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $service->keluhan }}</p>
                    </div>
                </div>

                <input type="hidden" name="tanggal_servis" value="{{ $service->tanggal_servis }}">
                <input type="hidden" name="keluhan" value="{{ $service->keluhan }}">

                <div class="xl:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Teknisi yang Mengerjakan</label>
                    <div class="relative z-20 bg-transparent">
                        <select name="technician_id" required class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="" disabled>-- Pilih Teknisi --</option>
                            @foreach($technicians as $tech)
                                <option value="{{ $tech->id }}" {{ $service->technician_id == $tech->id ? 'selected' : '' }}>
                                    {{ $tech->nama_teknisi }}
                                </option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8l5 5 5-5"/></svg></span>
                    </div>
                </div>

                <div class="xl:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tindakan / Penanganan yang Dilakukan</label>
                    <textarea name="tindakan" rows="3" placeholder="Contoh: Cuci AC, Tambah Freon R32, Ganti Kapasitor..."
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('tindakan', $service->tindakan) }}</textarea>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Status Pengerjaan</label>
                    <div class="relative z-20 bg-transparent">
                        <select name="status" required class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="proses" {{ $service->status == 'proses' ? 'selected' : '' }}>PROSES (Sedang Dikerjakan/Menunggu)</option>
                            <option value="selesai" {{ $service->status == 'selesai' ? 'selected' : '' }}>SELESAI</option>
                            <option value="batal" {{ $service->status == 'batal' ? 'selected' : '' }}>BATAL</option>
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8l5 5 5-5"/></svg></span>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Total Biaya Servis & Sparepart (Rp)</label>
                    <input type="number" name="biaya_servis" required min="0" value="{{ old('biaya_servis', $service->biaya_servis) }}"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                </div>
                
            </div>

            <div class="border-t border-gray-200 p-5 sm:p-6 flex justify-end gap-3 dark:border-gray-800">
                <a href="{{ route('services.index') }}" class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">Batal</a>
                <button type="submit" class="inline-flex justify-center rounded-lg bg-brand-500 px-5 py-3 text-sm font-medium text-white hover:bg-brand-600 transition">Simpan Progress</button>
            </div>
        </x-common.component-card>
    </form>
</div>
@endsection