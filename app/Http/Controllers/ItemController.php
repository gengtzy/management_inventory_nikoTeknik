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
        // LOGIKA KODE OTOMATIS (AC-001, AC-002, dst)
        $lastItem = Item::orderBy('id', 'desc')->first();
        
        if (!$lastItem) {
            $nextCode = 'AC-001';
        } else {
            // Pecah kode sebelumnya (misal 'AC-005' dipecah jadi ['AC', '005'])
            $parts = explode('-', $lastItem->kode_barang);
            
            // Cek apakah format kode sebelumnya sesuai (ada tanda '-' dan angka)
            if (count($parts) == 2 && is_numeric($parts[1])) {
                $lastNumber = (int) $parts[1];
                // str_pad digunakan untuk menambahkan angka 0 di depan, misal 6 jadi 006
                $nextCode = 'AC-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                // Fallback jika format kode sebelumnya berantakan, kita pakai ID + 1
                $nextCode = 'AC-' . str_pad($lastItem->id + 1, 3, '0', STR_PAD_LEFT);
            }
        }

        return view('items.create', compact('nextCode'));
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

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
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