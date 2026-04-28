<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Item;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['item', 'customer'])->orderBy('tanggal_jual', 'desc')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::orderBy('nama')->get();
        // Hanya ambil barang yang stoknya lebih dari 0
        $items = Item::where('stok', '>', 0)->orderBy('merek')->get(); 
        return view('sales.create', compact('customers', 'items'));
    }

    public function show(Sale $sale)
    {
        $sale->load(['item', 'customer']);
        return view('sales.show', compact('sale'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'customer_id' => 'required|exists:customers,id',
            'tanggal_jual' => 'required|date',
            'jumlah_set' => 'required|integer|min:1',
            'kelengkapan' => 'nullable|array', // Data dari checkbox [R, O, G]
            'masa_garansi' => 'nullable|string',
            'total_harga' => 'required|integer|min:0', // Admin bisa ubah harga (diskon)
            'metode_pembayaran' => 'required|in:cash,transfer,tempo',
        ]);

        // Cek apakah stok mencukupi
        $item = Item::findOrFail($validated['item_id']);
        if ($item->stok < $validated['jumlah_set']) {
            return back()->withInput()->with('error', 'Gagal! Stok AC tidak mencukupi. Sisa stok: ' . $item->stok . ' unit.');
        }

        // Ubah array kelengkapan menjadi string (Contoh: "R, O, G")
        $validated['kelengkapan'] = isset($request->kelengkapan) ? implode(', ', $request->kelengkapan) : null;

        DB::transaction(function () use ($validated, $item) {
            // 1. Catat penjualan
            Sale::create($validated);
            
            // 2. Kurangi stok barang
            $item->decrement('stok', $validated['jumlah_set']);
        });

        return redirect()->route('sales.index')->with('success', 'Transaksi penjualan berhasil dicatat dan stok AC telah dikurangi!');
    }

    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            // 1. Kembalikan stok (Rollback)
            $sale->item->increment('stok', $sale->jumlah_set);
            
            // 2. Hapus riwayat penjualan
            $sale->delete();
        });

        return redirect()->route('sales.index')->with('success', 'Penjualan dibatalkan, stok AC kembali ke jumlah semula.');
    }
}