@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Catat Barang Masuk (Restok)" />

<div class="space-y-6">
    <form action="{{ route('inbounds.store') }}" method="POST">
        @csrf
        
        <x-common.component-card title="Formulir Penerimaan Barang">
            <div class="p-5 sm:p-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
                
                <div class="xl:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Pilih Unit AC</label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select name="item_id" required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                            :class="isOptionSelected && 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = true">
                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400" disabled selected>
                                -- Pilih Barang --
                            </option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    {{ $item->kode_barang }} - {{ $item->merek }} {{ $item->tipe_ac }} ({{ $item->pk }} PK) | Sisa Stok: {{ $item->stok }}
                                </option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Jumlah Masuk (Unit)</label>
                    <input type="number" name="jumlah_masuk" required min="1" placeholder="Contoh: 10"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tanggal Masuk</label>
                    <x-form.date-picker 
                        id="tanggal_masuk" 
                        name="tanggal_masuk"
                        placeholder="Pilih Tanggal Masuk" 
                        defaultDate="{{ now()->format('Y-m-d') }}" 
                    />
                </div>

                <div class="xl:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Keterangan / Supplier (Opsional)</label>
                    <textarea name="keterangan" rows="3" placeholder="Contoh: Pembelian dari PT LG Indonesia (Nota #123)"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                </div>
                
            </div>

            <div class="border-t border-gray-200 p-5 sm:p-6 flex justify-end gap-3 dark:border-gray-800">
                <a href="{{ route('inbounds.index') }}" class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">
                    Batal
                </a>
                <button type="submit" class="inline-flex justify-center rounded-lg bg-brand-500 px-5 py-3 text-sm font-medium text-white hover:bg-brand-600 transition">
                    Simpan Barang Masuk
                </button>
            </div>
        </x-common.component-card>

    </form>
</div>
@endsection