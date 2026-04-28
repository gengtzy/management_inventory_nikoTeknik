@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Buat Nota Penjualan" />

<div x-data="{ 
        itemsData: {{ Js::from($items) }}, 
        selectedItemId: '', 
        jumlahSet: 1, 
        
        get selectedItem() { 
            return this.itemsData.find(item => item.id == this.selectedItemId) || null; 
        },
        
        get calculatedTotal() { 
            if(this.selectedItem) {
                return this.selectedItem.harga_jual_satuan * this.jumlahSet;
            }
            return 0;
        }
    }" 
    class="space-y-6">

    @if(session('error'))
        <div class="rounded-lg border-l-4 border-red-500 bg-red-50 p-4 dark:bg-red-500/10">
            <p class="text-sm font-medium text-red-800 dark:text-red-500">{{ session('error') }}</p>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf
        
        <x-common.component-card title="Formulir Transaksi Penjualan">
            <div class="p-5 sm:p-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
                
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Pilih Pelanggan</label>
                    <div class="relative z-20 bg-transparent">
                        <select name="customer_id" required class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="" disabled selected>-- Pilih Pelanggan --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->nama }} ({{ $customer->no_hp ?? 'Tanpa No. HP' }})</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8l5 5 5-5"/></svg></span>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Pelanggan belum ada? <a href="{{ route('customers.create') }}" class="text-brand-500 hover:underline">Tambah disini</a>.</p>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tanggal Jual</label>
                    <x-form.date-picker id="tanggal_jual" name="tanggal_jual" placeholder="Pilih Tanggal Jual" defaultDate="{{ now()->format('Y-m-d') }}" />
                </div>

                <div class="xl:col-span-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Pilih Unit AC</label>
                    <div class="relative z-20 bg-transparent">
                        <select name="item_id" required x-model="selectedItemId" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="" disabled selected>-- Pilih AC yang Tersedia --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->kode_barang }} - {{ $item->merek }} {{ $item->tipe_ac }} | Rp {{ number_format($item->harga_jual_satuan, 0, ',', '.') }} | Sisa Stok: {{ $item->stok }}
                                </option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8l5 5 5-5"/></svg></span>
                    </div>

                    <div x-show="selectedItem" x-cloak class="mt-4 rounded-lg border border-brand-200 bg-brand-50 p-4 dark:border-brand-800 dark:bg-brand-500/10 flex gap-4 text-sm text-brand-800 dark:text-brand-400">
                        <p><b>PK:</b> <span x-text="selectedItem?.pk"></span></p>
                        <p><b>Freon:</b> <span x-text="selectedItem?.freon || '-'"></span></p>
                        <p><b>Daya:</b> <span x-text="selectedItem?.watt ? selectedItem.watt + 'W' : '-'"></span></p>
                        <p><b>Sisa Stok:</b> <span class="font-bold text-red-500" x-text="selectedItem?.stok"></span> Unit</p>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Jumlah Pembelian (Set)</label>
                    <input type="number" name="jumlah_set" x-model.number="jumlahSet" required min="1" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kelengkapan Form Manual (Ceklis)</label>
                    <div class="flex h-11 items-center gap-6">
                        <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700 dark:text-gray-300">
                            <input type="checkbox" name="kelengkapan[]" value="R" class="rounded border-gray-300 text-brand-500 focus:ring-brand-500 h-4 w-4 dark:border-gray-700 dark:bg-gray-900" checked>
                            R (Remote)
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700 dark:text-gray-300">
                            <input type="checkbox" name="kelengkapan[]" value="O" class="rounded border-gray-300 text-brand-500 focus:ring-brand-500 h-4 w-4 dark:border-gray-700 dark:bg-gray-900" checked>
                            O (Outdoor)
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-700 dark:text-gray-300">
                            <input type="checkbox" name="kelengkapan[]" value="G" class="rounded border-gray-300 text-brand-500 focus:ring-brand-500 h-4 w-4 dark:border-gray-700 dark:bg-gray-900" checked>
                            G (Garansi)
                        </label>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Masa Garansi</label>
                    <input type="text" name="masa_garansi" placeholder="Contoh: 1 Tahun Kompresor" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Metode Pembayaran</label>
                    <div class="relative z-20 bg-transparent">
                        <select name="metode_pembayaran" required class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="cash">CASH (Tunai)</option>
                            <option value="transfer">TF (Transfer Bank)</option>
                            <option value="tempo">TEMPO (Cicilan/Hutang)</option>
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 8l5 5 5-5"/></svg></span>
                    </div>
                </div>

                <div class="xl:col-span-2 rounded-xl bg-gray-50 p-5 dark:bg-gray-800">
                    <label class="mb-1.5 block text-sm font-bold text-gray-900 dark:text-white">Total Harga Penjualan (Rp)</label>
                    <p class="text-xs text-gray-500 mb-3">Sistem otomatis menghitung harga berdasarkan kuantitas. Anda dapat mengedit harga ini jika memberikan diskon khusus kepada pelanggan.</p>
                    
                    <input type="number" name="total_harga" required min="0" x-model="calculatedTotal"
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-14 w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-xl font-bold text-gray-900 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:text-white dark:bg-gray-900" />
                </div>
                
            </div>

            <div class="border-t border-gray-200 p-5 sm:p-6 flex justify-end gap-3 dark:border-gray-800">
                <a href="{{ route('sales.index') }}" class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition dark:border-gray-700 dark:text-white dark:hover:bg-gray-800">Batal</a>
                <button type="submit" class="inline-flex justify-center rounded-lg bg-brand-500 px-5 py-3 text-sm font-medium text-white hover:bg-brand-600 transition">Proses Penjualan & Potong Stok</button>
            </div>
        </x-common.component-card>
    </form>
</div>
@endsection