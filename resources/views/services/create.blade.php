@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Buat Tiket Servis Baru" />

<div class="space-y-6">
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        
        <x-common.component-card title="Formulir Penerimaan Servis">
            <div class="p-5 sm:p-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
                
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Pilih Pelanggan</label>
                    <div class="relative z-20 bg-transparent">
                        <select name="customer_id" required class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="" disabled selected>-- Pilih Pelanggan --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->nama }} - {{ $customer->alamat ?? 'Tanpa Alamat' }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8l5 5 5-5"/></svg></span>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Pilih Teknisi yang Bertugas</label>
                    <div class="relative z-20 bg-transparent">
                        <select name="technician_id" required class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="" disabled selected>-- Pilih Teknisi --</option>
                            @foreach($technicians as $tech)
                                <option value="{{ $tech->id }}">{{ $tech->nama_teknisi }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8l5 5 5-5"/></svg></span>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tanggal Laporan Masuk</label>
                    <x-form.date-picker id="tanggal_servis" name="tanggal_servis" defaultDate="{{ now()->format('Y-m-d') }}" />
                </div>

                <div class="xl:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Keluhan Pelanggan (Detail Kerusakan)</label>
                    <textarea name="keluhan" required rows="4" placeholder="Contoh: AC kurang dingin, air menetes di indoor..."
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                </div>
                
            </div>

            <div class="border-t border-gray-200 p-5 sm:p-6 flex justify-end gap-3 dark:border-gray-800">
                <a href="{{ route('services.index') }}" class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">Batal</a>
                <button type="submit" class="inline-flex justify-center rounded-lg bg-brand-500 px-5 py-3 text-sm font-medium text-white hover:bg-brand-600 transition">Buat Antrean Servis</button>
            </div>
        </x-common.component-card>
    </form>
</div>
@endsection