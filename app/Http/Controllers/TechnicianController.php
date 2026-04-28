<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = Technician::orderBy('created_at', 'desc')->get();
        return view('technicians.index', compact('technicians'));
    }

    public function create()
    {
        return view('technicians.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_teknisi' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'spesialisasi' => 'nullable|string|max:255', // Contoh: Spesialis Cuci, Inverter, dll
        ]);

        Technician::create($validated);
        return redirect()->route('technicians.index')->with('success', 'Data Teknisi berhasil ditambahkan!');
    }

    public function edit(Technician $technician)
    {
        return view('technicians.edit', compact('technician'));
    }

    public function update(Request $request, Technician $technician)
    {
        $validated = $request->validate([
            'nama_teknisi' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'spesialisasi' => 'nullable|string|max:255',
        ]);

        $technician->update($validated);
        return redirect()->route('technicians.index')->with('success', 'Data Teknisi berhasil diperbarui!');
    }

    public function destroy(Technician $technician)
    {
        // Pastikan route delete dipanggil melalui form (bukan href link) seperti di menu lain
        $technician->delete();
        return redirect()->route('technicians.index')->with('success', 'Data Teknisi berhasil dihapus!');
    }
}