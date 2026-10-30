<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sale;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;
        $jumlahHari = Carbon::now()->daysInMonth; // 30 atau 31

        // ======================================
        // 1. METRIK KARTU ATAS (Top Metrics)
        // ======================================
        $totalStok = Item::sum('stok');
        $lowStockItems = Item::where('stok', '<', 5)->get();

        $penjualanBulanIni = Sale::whereMonth('tanggal_jual', $bulanIni)->whereYear('tanggal_jual', $tahunIni);
        $totalUnitTerjual = $penjualanBulanIni->sum('jumlah_set');
        $pendapatanPenjualan = $penjualanBulanIni->sum('total_harga');

        $servisBulanIni = Service::whereMonth('tanggal_servis', $bulanIni)->whereYear('tanggal_servis', $tahunIni);
        $pendapatanServis = $servisBulanIni->sum('biaya_servis');
        $servisProses = Service::where('status', 'proses')->count();

        $totalPendapatan = $pendapatanPenjualan + $pendapatanServis;
        $recentSales = Sale::with('customer', 'item')->orderBy('tanggal_jual', 'desc')->take(5)->get();

        // ======================================
        // 2. DATA UNTUK GRAFIK (Chart Data)
        // ======================================
        
        // Buat kerangka array kosong sepanjang jumlah hari bulan ini
        $dates = [];
        $salesData = [];
        $serviceData = [];
        
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $dates[] = $i . ' ' . Carbon::now()->format('M'); // Contoh: 1 Apr, 2 Apr
            $salesData[$i] = 0;
            $serviceData[$i] = 0;
        }

        // Deteksi driver database (MySQL vs SQLite vs PostgreSQL/Supabase)
        $driver = DB::connection()->getDriverName();
        if ($driver === 'sqlite') {
            $daySaleField = "CAST(strftime('%d', tanggal_jual) AS INTEGER)";
            $dayServiceField = "CAST(strftime('%d', tanggal_servis) AS INTEGER)";
        } elseif ($driver === 'pgsql') {
            $daySaleField = "EXTRACT(DAY FROM tanggal_jual)";
            $dayServiceField = "EXTRACT(DAY FROM tanggal_servis)";
        } else {
            $daySaleField = "DAY(tanggal_jual)";
            $dayServiceField = "DAY(tanggal_servis)";
        }

        // Ambil data penjualan harian
        $dailySales = Sale::select(DB::raw("{$daySaleField} as hari"), DB::raw('SUM(total_harga) as total'))
            ->whereMonth('tanggal_jual', $bulanIni)
            ->whereYear('tanggal_jual', $tahunIni)
            ->groupBy('hari')->get();
            
        foreach ($dailySales as $sale) {
            $salesData[(int) $sale->hari] = $sale->total;
        }

        // Ambil data servis harian
        $dailyServices = Service::select(DB::raw("{$dayServiceField} as hari"), DB::raw('SUM(biaya_servis) as total'))
            ->where('status', 'selesai') // Hanya hitung yang sudah selesai
            ->whereMonth('tanggal_servis', $bulanIni)
            ->whereYear('tanggal_servis', $tahunIni)
            ->groupBy('hari')->get();

        foreach ($dailyServices as $service) {
            $serviceData[(int) $service->hari] = $service->total;
        }

        return view('dashboard', compact(
            'totalStok', 'lowStockItems', 'totalUnitTerjual', 'pendapatanPenjualan', 
            'pendapatanServis', 'servisProses', 'totalPendapatan', 'recentSales',
            'dates', 'salesData', 'serviceData'
        ));
    }
}