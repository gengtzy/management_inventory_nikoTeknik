<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Service;
use App\Models\Inbound;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Set default filter: Bulan ini & Laporan Penjualan
        $type = $request->input('type', 'sales');
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $data = collect(); // Koleksi kosong default
        $totalPendapatan = 0;
        $totalUnit = 0;

        // Tarik data berdasarkan tipe yang dipilih
        if ($type == 'sales') {
            $data = Sale::with(['customer', 'item'])
                ->whereBetween('tanggal_jual', [$startDate, $endDate])
                ->orderBy('tanggal_jual', 'desc')
                ->get();
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

        return view('reports.index', compact('data', 'type', 'startDate', 'endDate', 'totalPendapatan', 'totalUnit'));
    }
}