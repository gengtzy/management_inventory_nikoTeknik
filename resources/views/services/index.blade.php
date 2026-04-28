@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Data Servis AC" />

<div x-data="{ showDeleteModal: false, deleteUrl: '' }" class="space-y-6">
    
    <div class="flex justify-between items-center">
        <div>
            @if(session('success'))
                <p class="text-sm font-medium text-green-600 dark:text-green-400">{{ session('success') }}</p>
            @endif
        </div>
        <a href="{{ route('services.create') }}" class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-brand-600 transition">
            + Buat Tiket Servis
        </a>
    </div>

    <x-common.component-card title="Riwayat & Antrean Servis">
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[900px]">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Tanggal & Pelanggan</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Keluhan</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Total Biaya</p></th>
                            <th class="px-5 py-3 text-right sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block text-gray-500 text-theme-xs dark:text-gray-400 mb-1">
                                    {{ \Carbon\Carbon::parse($service->tanggal_servis)->format('d M Y') }}
                                </span>
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $service->customer->nama }}</span>
                                <span class="block text-gray-500 text-theme-xs dark:text-gray-400">{{ $service->customer->alamat ?? '-' }}</span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90 whitespace-pre-wrap">{{ $service->keluhan }}</span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                @php
                                    $statusColors = [
                                        'proses' => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-500',
                                        'selesai' => 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-500',
                                        'batal' => 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-500',
                                    ];
                                @endphp
                                <p class="text-theme-xs inline-block rounded-full px-2 py-0.5 font-medium uppercase {{ $statusColors[$service->status] }}">
                                    {{ $service->status }}
                                </p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                @if($service->status == 'proses')
                                    <span class="text-gray-400 text-sm italic">Belum diinput</span>
                                @else
                                    <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">Rp {{ number_format($service->biaya_servis, 0, ',', '.') }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-4 sm:px-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('services.edit', $service->id) }}" class="text-brand-500 hover:text-brand-600 transition-colors dark:text-brand-400 font-medium text-sm" title="Update Progress">
                                        Update Progress
                                    </a>
                                    <a href="{{ route('services.show', $service->id) }}" class="text-gray-500 hover:text-brand-500 transition-colors dark:text-gray-400 dark:hover:text-brand-500" title="Lihat Nota">
                                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 4.5C6 4.5 2.73 7.11 1.5 10c1.23 2.89 4.5 5.5 8.5 5.5s7.27-2.61 8.5-5.5C17.27 7.11 14 4.5 10 4.5zM10 13c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm0-4.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z" />
                                        </svg>
                                    </a>
                                    <button type="button" @click.prevent="deleteUrl = '{{ route('services.destroy', $service->id) }}'; showDeleteModal = true" class="text-gray-500 hover:text-red-500 transition-colors dark:text-gray-400 dark:hover:text-red-500" title="Hapus">
                                        <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6.66667 4.16667V3.33333C6.66667 2.41286 7.41286 1.66667 8.33333 1.66667H11.6667C12.5871 1.66667 13.3333 2.41286 13.3333 3.33333V4.16667H17.5C17.9602 4.16667 18.3333 4.53976 18.3333 5C18.3333 5.46024 17.9602 5.83333 17.5 5.83333H16.6667V16.6667C16.6667 17.5871 15.9205 18.3333 15 18.3333H5C4.07953 18.3333 3.33333 17.5871 3.33333 16.6667V5.83333H2.5C2.03976 5.83333 1.66667 5.46024 1.66667 5C1.66667 4.53976 2.03976 4.16667 2.5 4.16667H6.66667ZM8.33333 4.16667H11.6667V3.33333H8.33333V4.16667ZM5 5.83333V16.6667H15V5.83333H5ZM8.33333 8.33333C8.79357 8.33333 9.16667 8.70643 9.16667 9.16667V13.3333C9.16667 13.7936 8.79357 14.1667 8.33333 14.1666C7.8731 14.1666 7.5 13.7936 7.5 13.3333V9.16667C7.5 8.70643 7.8731 8.33333 8.33333 8.33333ZM11.6667 8.33333C12.1269 8.33333 12.5 8.70643 12.5 9.16667V13.3333C12.5 13.7936 12.1269 14.1666 11.6667 14.1666C11.2064 14.1666 10.8333 13.7936 10.8333 13.3333V9.16667C10.8333 8.70643 11.2064 8.33333 11.6667 8.33333Z" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <td colspan="5" class="px-5 py-4 sm:px-6 text-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">Belum ada riwayat servis.</p>
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
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-600 dark:text-red-500"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
            </span>
            <h3 class="mt-4 pb-2 text-xl font-bold text-gray-900 dark:text-white">Hapus Data Servis?</h3>
            <p class="mb-8 text-sm text-gray-500 dark:text-gray-400">Tindakan ini akan menghapus riwayat komplain pelanggan dan laporan pendapatan dari servis ini.</p>
            <div class="flex gap-3">
                <button @click="showDeleteModal = false" type="button" class="block w-full rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">Batal</button>
                <form :action="deleteUrl" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="block w-full rounded-lg bg-red-600 p-3 text-sm font-medium text-white transition hover:bg-red-700">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection