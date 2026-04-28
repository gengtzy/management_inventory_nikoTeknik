<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('created_at', 'desc')->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang',
            'merek' => 'required|string|max:255',
            'tipe_ac' => 'required|string|max:255',
            'pk' => 'required|string',
            'freon' => 'nullable|string',
            'ampere' => 'nullable|numeric',
            'watt' => 'nullable|integer',
            'stok' => 'required|integer|min:0',
            'harga_beli_satuan' => 'required|integer|min:0',
            'harga_jual_satuan' => 'required|integer|min:0',
        ]);

        Item::create($validated);
        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    // Fungsi edit, update, dan destroy menyusul jika index & create sudah jalan
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            // Pengecualian unique ID agar tidak error saat nyimpen kode yang sama untuk barang ini
            'kode_barang' => 'required|unique:items,kode_barang,' . $item->id, 
            'merek' => 'required|string|max:255',
            'tipe_ac' => 'required|string|max:255',
            'pk' => 'required|string',
            'freon' => 'nullable|string',
            'ampere' => 'nullable|numeric',
            'watt' => 'nullable|integer',
            'stok' => 'required|integer|min:0',
            'harga_beli_satuan' => 'required|integer|min:0',
            'harga_jual_satuan' => 'required|integer|min:0',
        ]);

        $item->update($validated);
        return redirect()->route('items.index')->with('success', 'Data AC berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Data AC berhasil dihapus!');
    }
}