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

        // Ambil data penjualan harian
        $dailySales = Sale::select(DB::raw('DAY(tanggal_jual) as hari'), DB::raw('SUM(total_harga) as total'))
            ->whereMonth('tanggal_jual', $bulanIni)
            ->whereYear('tanggal_jual', $tahunIni)
            ->groupBy('hari')->get();
            
        foreach ($dailySales as $sale) {
            $salesData[$sale->hari] = $sale->total;
        }

        // Ambil data servis harian
        $dailyServices = Service::select(DB::raw('DAY(tanggal_servis) as hari'), DB::raw('SUM(biaya_servis) as total'))
            ->where('status', 'selesai') // Hanya hitung yang sudah selesai
            ->whereMonth('tanggal_servis', $bulanIni)
            ->whereYear('tanggal_servis', $tahunIni)
            ->groupBy('hari')->get();

        foreach ($dailyServices as $service) {
            $serviceData[$service->hari] = $service->total;
        }

        return view('dashboard', compact(
            'totalStok', 'lowStockItems', 'totalUnitTerjual', 'pendapatanPenjualan', 
            'pendapatanServis', 'servisProses', 'totalPendapatan', 'recentSales',
            'dates', 'salesData', 'serviceData'
        ));
    }
}