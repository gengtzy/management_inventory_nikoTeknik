<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Customer;
use App\Models\Technician;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Menampilkan data servis, urut dari yang paling baru
        $services = Service::with('customer')->orderBy('tanggal_servis', 'desc')->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        $customers = Customer::orderBy('nama')->get();
        $technicians = Technician::orderBy('nama_teknisi')->get(); // Ambil data teknisi
        return view('services.create', compact('customers', 'technicians'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'technician_id' => 'required|exists:technicians,id', // <-- INI YANG TERLEWAT SEBELUMNYA
            'tanggal_servis' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        $validated['status'] = 'proses';
        $validated['biaya_servis'] = 0;

        Service::create($validated);
        return redirect()->route('services.index')->with('success', 'Tiket Servis baru berhasil dibuat!');
    }

    public function edit(Service $service)
    {
        $customers = Customer::orderBy('nama')->get();
        // PASTIKAN BARIS INI ADA UNTUK MENGATASI ERROR
        $technicians = \App\Models\Technician::orderBy('nama_teknisi')->get(); 
        
        // PASTIKAN 'technicians' MASUK KE DALAM COMPACT
        return view('services.edit', compact('service', 'customers', 'technicians'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'technician_id' => 'required|exists:technicians,id', // <-- TAMBAHKAN INI JUGA
            'tanggal_servis' => 'required|date',
            'keluhan' => 'required|string',
            'tindakan' => 'nullable|string',
            'biaya_servis' => 'required|integer|min:0',
            'status' => 'required|in:proses,selesai,batal',
        ]);

        $service->update($validated);
        return redirect()->route('services.index')->with('success', 'Data Servis berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Riwayat Servis berhasil dihapus!');
    }

    public function show(Service $service)
    {
        // Pastikan relasi technician di-load
        $service->load(['customer', 'technician']); 
        return view('services.show', compact('service'));
    }
}