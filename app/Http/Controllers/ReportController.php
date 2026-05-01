<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Service;
use App\Models\Inbound;
use App\Models\Item; // Wajib ditambahkan agar bisa narik data Merek
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Set default filter: Bulan ini, Laporan Penjualan, & Semua Merek
        $type = $request->input('type', 'sales');
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $selectedBrand = $request->input('brand', 'all'); // Tangkap request merek

        // Ambil semua daftar Merek AC unik yang ada di Master Barang untuk Dropdown
        $brands = Item::select('merek')->distinct()->orderBy('merek', 'asc')->pluck('merek');

        $data = collect(); // Koleksi kosong default
        $totalPendapatan = 0;
        $totalUnit = 0;

        // Tarik data berdasarkan tipe yang dipilih
        if ($type == 'sales') {
            $query = Sale::with(['customer', 'item'])
                ->whereBetween('tanggal_jual', [$startDate, $endDate]);

            // Jika filter merek BUKAN 'all', jalankan filter relasi ini
            if ($selectedBrand !== 'all') {
                $query->whereHas('item', function ($q) use ($selectedBrand) {
                    $q->where('merek', $selectedBrand);
                });
            }

            $data = $query->orderBy('tanggal_jual', 'desc')->get();
            $totalPendapatan = $data->sum('total_harga');
            $totalUnit = $data->sum('jumlah_set');
            
        } elseif ($type == 'services') {
            $data = Service::with(['customer', 'technician'])
                ->whereBetween('tanggal_servis', [$startDate, $endDate])
                ->where('status', 'selesai') // Hanya hitung yang selesai
                ->orderBy('tanggal_servis', 'desc')
                ->get();
            $totalPendapatan = $data->sum('biaya_servis');
            $totalUnit = $data->count(); // Total tiket selesai
            
        } elseif ($type == 'inbounds') {
            $data = Inbound::with('item')
                ->whereBetween('tanggal_masuk', [$startDate, $endDate])
                ->orderBy('tanggal_masuk', 'desc')
                ->get();
            $totalUnit = $data->sum('jumlah_masuk'); // Total unit masuk
        }

        return view('reports.index', compact('data', 'type', 'startDate', 'endDate', 'totalPendapatan', 'totalUnit', 'brands', 'selectedBrand'));
    }
}