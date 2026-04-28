<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Inbound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InboundController extends Controller
{
    public function index()
    {
        // Tarik data inbound beserta relasi item-nya
        $inbounds = Inbound::with('item')->orderBy('tanggal_masuk', 'desc')->get();
        return view('inbounds.index', compact('inbounds'));
    }

    public function create()
    {
        // Ambil semua data AC untuk ditampilkan di dropdown
        $items = Item::orderBy('merek')->get();
        return view('inbounds.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Gunakan Transaction agar jika salah satu gagal, semua dibatalkan
        DB::transaction(function () use ($validated) {
            // 1. Simpan riwayat barang masuk
            Inbound::create($validated);
            
            // 2. Tambah stok di master barang
            Item::where('id', $validated['item_id'])->increment('stok', $validated['jumlah_masuk']);
        });

        return redirect()->route('inbounds.index')->with('success', 'Barang masuk berhasil dicatat dan stok AC bertambah!');
    }

    // Catatan: Untuk Inbound, biasanya fitur EDIT dinonaktifkan untuk menjaga integritas stok. 
    // Jika salah, praktik terbaiknya adalah menghapus data lama dan membuat input baru.

    public function destroy(Inbound $inbound)
    {
        DB::transaction(function () use ($inbound) {
            // 1. Kurangi kembali stok di master barang (rollback)
            $inbound->item->decrement('stok', $inbound->jumlah_masuk);
            
            // 2. Hapus riwayat
            $inbound->delete();
        });

        return redirect()->route('inbounds.index')->with('success', 'Riwayat barang masuk dihapus dan stok telah disesuaikan kembali!');
    }
}