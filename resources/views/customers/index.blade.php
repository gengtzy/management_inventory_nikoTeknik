@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Master Pelanggan" />

<div x-data="{ showDeleteModal: false, deleteUrl: '' }" class="space-y-6">
    
    <div class="flex justify-between items-center">
        <div>
            @if(session('success'))
                <p class="text-sm font-medium text-green-600 dark:text-green-400">{{ session('success') }}</p>
            @endif
        </div>
        <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-brand-600 transition">
            + Tambah Pelanggan
        </a>
    </div>

    <x-common.component-card title="Daftar Pelanggan">
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[800px]">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama Pelanggan</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No. HP (WA)</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Alamat Lengkap</p></th>
                            <th class="px-5 py-3 text-right sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $customer->nama }}</span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $customer->no_hp ?? '-' }}</span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block text-gray-500 text-theme-sm dark:text-gray-400 whitespace-pre-wrap">{{ $customer->alamat ?? '-' }}</span>
                            </td>
                            <td class="px-5 py-4 sm:px-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="text-gray-500 hover:text-brand-500 transition-colors dark:text-gray-400 dark:hover:text-brand-500" title="Edit">
                                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M14.9602 2.70617C15.2936 2.37284 15.8341 2.37284 16.1675 2.70617L17.2938 3.8325C17.6272 4.16583 17.6272 4.70634 17.2938 5.03967L6.85072 15.4828C6.55169 15.7818 6.16335 15.9818 5.73605 16.0531L2.83685 16.5363C2.51848 16.5893 2.22271 16.3475 2.22271 16.0249C2.22271 15.9625 2.23307 15.9006 2.25339 15.8413L3.1099 13.3424C3.2185 13.0256 3.40742 12.7416 3.65934 12.5173L14.9602 2.70617ZM13.8291 4.96863L5.03541 13.6644C4.90945 13.789 4.815 13.931 4.7607 14.0895L4.17953 15.7854L5.80165 15.515C5.93922 15.492 6.06899 15.4332 6.1791 15.3436L14.9654 6.65431L13.8291 4.96863Z" /></svg>
                                    </a>
                                    <button type="button" @click.prevent="deleteUrl = '{{ route('customers.destroy', $customer->id) }}'; showDeleteModal = true" class="text-gray-500 hover:text-red-500 transition-colors dark:text-gray-400 dark:hover:text-red-500" title="Hapus">
                                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6.66667 4.16667V3.33333C6.66667 2.41286 7.41286 1.66667 8.33333 1.66667H11.6667C12.5871 1.66667 13.3333 2.41286 13.3333 3.33333V4.16667H17.5C17.9602 4.16667 18.3333 4.53976 18.3333 5C18.3333 5.46024 17.9602 5.83333 17.5 5.83333H16.6667V16.6667C16.6667 17.5871 15.9205 18.3333 15 18.3333H5C4.07953 18.3333 3.33333 17.5871 3.33333 16.6667V5.83333H2.5C2.03976 5.83333 1.66667 5.46024 1.66667 5C1.66667 4.53976 2.03976 4.16667 2.5 4.16667H6.66667ZM8.33333 4.16667H11.6667V3.33333H8.33333V4.16667ZM5 5.83333V16.6667H15V5.83333H5ZM8.33333 8.33333C8.79357 8.33333 9.16667 8.70643 9.16667 9.16667V13.3333C9.16667 13.7936 8.79357 14.1667 8.33333 14.1666C7.8731 14.1666 7.5 13.7936 7.5 13.3333V9.16667C7.5 8.70643 7.8731 8.33333 8.33333 8.33333ZM11.6667 8.33333C12.1269 8.33333 12.5 8.70643 12.5 9.16667V13.3333C12.5 13.7936 12.1269 14.1666 11.6667 14.1666C11.2064 14.1666 10.8333 13.7936 10.8333 13.3333V9.16667C10.8333 8.70643 11.2064 8.33333 11.6667 8.33333Z" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <td colspan="4" class="px-5 py-4 sm:px-6 text-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">Belum ada data pelanggan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </x-common.component-card>

    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-[99999] flex items-center justify-center bg-black/90 px-4 py-5" x-transition.opacity>
        <div @click.outside="showDeleteModal = false" class="w-full max-w-md rounded-xl bg-white px-8 py-10 text-center shadow-lg dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
            <span class="mx-auto flex h-15 w-15 items-center justify-center rounded-full bg-red-100 dark:bg-red-500/20">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600 dark:text-red-500">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </span>
            <h3 class="mt-4 pb-2 text-xl font-bold text-gray-900 dark:text-white">Hapus Data Pelanggan?</h3>
            <p class="mb-8 text-sm text-gray-500 dark:text-gray-400">Apakah Anda yakin? Riwayat servis yang terhubung mungkin akan ikut terpengaruh.</p>
            
            <div class="flex gap-3">
                <button @click="showDeleteModal = false" type="button" class="block w-full rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Batal
                </button>
                <form :action="deleteUrl" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="block w-full rounded-lg bg-red-600 p-3 text-sm font-medium text-white transition hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection