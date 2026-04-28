@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Edit Master Teknisi" />

<div class="space-y-6">
    <form action="{{ route('technicians.update', $technician->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <x-common.component-card title="Formulir Edit Teknisi">
            <div class="p-5 sm:p-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
                
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nama Lengkap Teknisi</label>
                    <input type="text" name="nama_teknisi" required value="{{ old('nama_teknisi', $technician->nama_teknisi) }}"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">No. HP / WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $technician->no_hp) }}"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>

                <div class="xl:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Spesialisasi / Keahlian Khusus (Opsional)</label>
                    <input type="text" name="spesialisasi" value="{{ old('spesialisasi', $technician->spesialisasi) }}"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                </div>
                
            </div>

            <div class="border-t border-gray-200 p-5 sm:p-6 flex justify-end gap-3 dark:border-gray-800">
                <a href="{{ route('technicians.index') }}" class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">
                    Batal
                </a>
                <button type="submit" class="inline-flex justify-center rounded-lg bg-brand-500 px-5 py-3 text-sm font-medium text-white hover:bg-brand-600 transition">
                    Update Teknisi
                </button>
            </div>
        </x-common.component-card>

    </form>
</div>
@endsection