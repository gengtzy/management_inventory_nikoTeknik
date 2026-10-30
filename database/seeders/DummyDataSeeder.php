<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Technician;
use App\Models\Inbound;
use App\Models\Sale;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Admin
        User::firstOrCreate(
            ['email' => 'admin@nikoteknik.com'],
            [
                'name' => 'Admin Niko Teknik',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Master Data Barang (AC)
        $itemsData = [
            [
                'kode_barang' => 'AC-DKN-001',
                'merek' => 'Daikin',
                'tipe_ac' => 'FTKQ25UVM4 Flash Inverter',
                'pk' => '1',
                'freon' => 'R32',
                'ampere' => 3.8,
                'watt' => 680,
                'stok' => 12,
                'harga_beli_satuan' => 4200000,
                'harga_jual_satuan' => 5100000,
            ],
            [
                'kode_barang' => 'AC-DKN-002',
                'merek' => 'Daikin',
                'tipe_ac' => 'FTC15NV14 Standard Thailand',
                'pk' => '0.5',
                'freon' => 'R32',
                'ampere' => 2.2,
                'watt' => 389,
                'stok' => 8,
                'harga_beli_satuan' => 3400000,
                'harga_jual_satuan' => 4150000,
            ],
            [
                'kode_barang' => 'AC-GRE-001',
                'merek' => 'Gree',
                'tipe_ac' => 'GWC-05MOO5 Standard Low Watt',
                'pk' => '0.5',
                'freon' => 'R32',
                'ampere' => 1.8,
                'watt' => 370,
                'stok' => 3, // Low stock alert (< 5)
                'harga_beli_satuan' => 2850000,
                'harga_jual_satuan' => 3450000,
            ],
            [
                'kode_barang' => 'AC-GRE-002',
                'merek' => 'Gree',
                'tipe_ac' => 'GWC-09F5S Inverter F5S Series',
                'pk' => '1',
                'freon' => 'R32',
                'ampere' => 3.5,
                'watt' => 660,
                'stok' => 7,
                'harga_beli_satuan' => 4100000,
                'harga_jual_satuan' => 4950000,
            ],
            [
                'kode_barang' => 'AC-PNS-001',
                'merek' => 'Panasonic',
                'tipe_ac' => 'CS-YN5WKJ Standard Eco Tough',
                'pk' => '0.5',
                'freon' => 'R32',
                'ampere' => 2.1,
                'watt' => 390,
                'stok' => 2, // Low stock alert (< 5)
                'harga_beli_satuan' => 3100000,
                'harga_jual_satuan' => 3750000,
            ],
            [
                'kode_barang' => 'AC-PNS-002',
                'merek' => 'Panasonic',
                'tipe_ac' => 'CS-XPU10XKJ Inverter nanoeX',
                'pk' => '1',
                'freon' => 'R32',
                'ampere' => 3.9,
                'watt' => 730,
                'stok' => 5,
                'harga_beli_satuan' => 4800000,
                'harga_jual_satuan' => 5800000,
            ],
            [
                'kode_barang' => 'AC-SHP-001',
                'merek' => 'Sharp',
                'tipe_ac' => 'AH-A5BEY New Garuda Series',
                'pk' => '0.5',
                'freon' => 'R32',
                'ampere' => 2.0,
                'watt' => 360,
                'stok' => 10,
                'harga_beli_satuan' => 2700000,
                'harga_jual_satuan' => 3300000,
            ],
            [
                'kode_barang' => 'AC-SHP-002',
                'merek' => 'Sharp',
                'tipe_ac' => 'AH-X9ZY J-Tech Inverter',
                'pk' => '1',
                'freon' => 'R32',
                'ampere' => 3.6,
                'watt' => 720,
                'stok' => 6,
                'harga_beli_satuan' => 3900000,
                'harga_jual_satuan' => 4700000,
            ],
            [
                'kode_barang' => 'AC-LG-001',
                'merek' => 'LG',
                'tipe_ac' => 'T06EV5 Dual Inverter Econo',
                'pk' => '0.5',
                'freon' => 'R32',
                'ampere' => 2.4,
                'watt' => 495,
                'stok' => 9,
                'harga_beli_satuan' => 3250000,
                'harga_jual_satuan' => 3950000,
            ],
            [
                'kode_barang' => 'AC-MIT-001',
                'merek' => 'Mitsubishi',
                'tipe_ac' => 'SRK09CTR Heavy Duty Standard',
                'pk' => '1',
                'freon' => 'R410A',
                'ampere' => 4.2,
                'watt' => 820,
                'stok' => 4, // Low stock alert (< 5)
                'harga_beli_satuan' => 3800000,
                'harga_jual_satuan' => 4600000,
            ],
        ];

        $items = [];
        foreach ($itemsData as $data) {
            $items[] = Item::updateOrCreate(['kode_barang' => $data['kode_barang']], $data);
        }

        // 3. Master Pelanggan
        $customersData = [
            [
                'nama' => 'Bpk. Hendro Wijaya',
                'alamat' => 'Jl. Manyar Kertoarjo No. 45, Mulyorejo, Surabaya',
                'no_hp' => '081234567890',
            ],
            [
                'nama' => 'Ibu Ratna Sari',
                'alamat' => 'Perum Citra Garden Blok B-12, Buduran, Sidoarjo',
                'no_hp' => '085712345678',
            ],
            [
                'nama' => 'PT. Sinar Abadi Mandiri',
                'alamat' => 'Kawasan Industri Rungkut Megah No. 8, Surabaya',
                'no_hp' => '081198765432',
            ],
            [
                'nama' => 'Bpk. Bambang Sutrisno',
                'alamat' => 'Jl. Raya Darmo Permai III No. 21, Sambikerep, Surabaya',
                'no_hp' => '082145678901',
            ],
            [
                'nama' => 'Ibu Maya Anggraini',
                'alamat' => 'Jl. Kutai No. 14, Wonokromo, Surabaya',
                'no_hp' => '087812345678',
            ],
            [
                'nama' => 'Dr. Faisal Akbar',
                'alamat' => 'Puri Surya Jaya Valencia Blok F-8, Gedangan, Sidoarjo',
                'no_hp' => '081399887766',
            ],
            [
                'nama' => 'Kafe Kopi Kenangan Manis',
                'alamat' => 'Jl. Dharmawangsa No. 88, Gubeng, Surabaya',
                'no_hp' => '085233445566',
            ],
            [
                'nama' => 'Ibu Dewi Lestari',
                'alamat' => 'Perum Graha Family Blok D-5, Surabaya Barat',
                'no_hp' => '081288990011',
            ],
        ];

        $customers = [];
        foreach ($customersData as $data) {
            $customers[] = Customer::updateOrCreate(['nama' => $data['nama']], $data);
        }

        // 4. Master Teknisi
        $techniciansData = [
            [
                'nama_teknisi' => 'Niko Prasetyo',
                'no_hp' => '081234000001',
                'spesialisasi' => 'Lead Tech / Spesialis Inverter & Troubleshooting PCB',
            ],
            [
                'nama_teknisi' => 'Rahmat Hidayat',
                'no_hp' => '081234000002',
                'spesialisasi' => 'Bongkar Pasang & Instalasi Pipa Gedung',
            ],
            [
                'nama_teknisi' => 'Agus Setiawan',
                'no_hp' => '081234000003',
                'spesialisasi' => 'Maintenance Rutin, Cuci Besar & Vakum Sistem',
            ],
            [
                'nama_teknisi' => 'Doni Kurniawan',
                'no_hp' => '081234000004',
                'spesialisasi' => 'Teknisi Junior / Penanganan Kebocoran Freon',
            ],
        ];

        $technicians = [];
        foreach ($techniciansData as $data) {
            $technicians[] = Technician::updateOrCreate(['nama_teknisi' => $data['nama_teknisi']], $data);
        }

        // 5. Barang Masuk (Inbound)
        $now = Carbon::now();
        $inboundDates = [
            $now->copy()->subDays(25),
            $now->copy()->subDays(20),
            $now->copy()->subDays(15),
            $now->copy()->subDays(8),
            $now->copy()->subDays(3),
        ];

        foreach ($inboundDates as $idx => $date) {
            $item = $items[$idx % count($items)];
            Inbound::create([
                'item_id' => $item->id,
                'jumlah_masuk' => 5 + ($idx * 2),
                'tanggal_masuk' => $date->format('Y-m-d'),
                'keterangan' => 'Restock pengiriman langsung dari distributor resmi ' . $item->merek,
            ]);
        }

        // 6. Penjualan AC (Sales)
        $salesList = [
            ['day' => 2,  'item' => 0, 'customer' => 0, 'qty' => 1, 'method' => 'transfer', 'warranty' => '1 Tahun Unit, 3 Tahun Kompresor'],
            ['day' => 4,  'item' => 1, 'customer' => 1, 'qty' => 1, 'method' => 'cash',     'warranty' => '1 Tahun Unit, 3 Tahun Kompresor'],
            ['day' => 7,  'item' => 3, 'customer' => 2, 'qty' => 3, 'method' => 'transfer', 'warranty' => '2 Tahun Unit, 5 Tahun Kompresor'],
            ['day' => 10, 'item' => 6, 'customer' => 3, 'qty' => 2, 'method' => 'cash',     'warranty' => '1 Tahun Unit, 3 Tahun Kompresor'],
            ['day' => 12, 'item' => 5, 'customer' => 4, 'qty' => 1, 'method' => 'tempo',    'warranty' => '1 Tahun Unit, 3 Tahun Kompresor'],
            ['day' => 15, 'item' => 7, 'customer' => 5, 'qty' => 1, 'method' => 'transfer', 'warranty' => '1 Tahun Unit, 3 Tahun Kompresor'],
            ['day' => 18, 'item' => 2, 'customer' => 6, 'qty' => 2, 'method' => 'transfer', 'warranty' => '1 Tahun Unit, 5 Tahun Kompresor'],
            ['day' => 21, 'item' => 4, 'customer' => 7, 'qty' => 1, 'method' => 'cash',     'warranty' => '1 Tahun Unit, 3 Tahun Kompresor'],
            ['day' => 24, 'item' => 8, 'customer' => 0, 'qty' => 1, 'method' => 'transfer', 'warranty' => '1 Tahun Unit, 3 Tahun Kompresor'],
            ['day' => 27, 'item' => 9, 'customer' => 2, 'qty' => 2, 'method' => 'tempo',    'warranty' => '1 Tahun Unit, 3 Tahun Kompresor'],
            ['day' => 29, 'item' => 0, 'customer' => 3, 'qty' => 1, 'method' => 'transfer', 'warranty' => '1 Tahun Unit, 3 Tahun Kompresor'],
        ];

        foreach ($salesList as $saleItem) {
            $itemObj = $items[$saleItem['item']];
            $customerObj = $customers[$saleItem['customer']];
            $targetDate = Carbon::create($now->year, $now->month, min($saleItem['day'], $now->daysInMonth));

            Sale::create([
                'item_id' => $itemObj->id,
                'customer_id' => $customerObj->id,
                'tanggal_jual' => $targetDate->format('Y-m-d'),
                'jumlah_set' => $saleItem['qty'],
                'kelengkapan' => 'Unit Indoor & Outdoor, Remote Asli, Pipa Tembaga 3m, Bracket, Kabel Power',
                'masa_garansi' => $saleItem['warranty'],
                'total_harga' => $itemObj->harga_jual_satuan * $saleItem['qty'],
                'metode_pembayaran' => $saleItem['method'],
            ]);
        }

        // 7. Pencatatan Servis (Services)
        $servicesList = [
            // Servis Selesai (Bulan Ini)
            [
                'customer' => 0,
                'technician' => 2,
                'day' => 3,
                'keluhan' => 'AC Panasonic di ruang tamu kurang dingin dan filter berdebu tebal',
                'tindakan' => 'Cuci steam indoor dan outdoor, pembersihan filter dan saluran drainase air',
                'biaya' => 150000,
                'status' => 'selesai',
            ],
            [
                'customer' => 1,
                'technician' => 0,
                'day' => 6,
                'keluhan' => 'AC Daikin Inverter muncul kode error E3 dan outdoor mati',
                'tindakan' => 'Pengecekan thermistor sensor dan perbaikan konektor PCB modul inverter',
                'biaya' => 450000,
                'status' => 'selesai',
            ],
            [
                'customer' => 3,
                'technician' => 1,
                'day' => 9,
                'keluhan' => 'Pipa AC bocor refrigeran dan timbul bunga es di nepel pipa outdoor',
                'tindakan' => 'Flaring ulang nepel sambungan pipa, vakum sistem, dan pengisian full freon R32',
                'biaya' => 350000,
                'status' => 'selesai',
            ],
            [
                'customer' => 6,
                'technician' => 2,
                'day' => 14,
                'keluhan' => 'Paket perawatan rutin 4 unit AC kafe bulanan',
                'tindakan' => 'Cuci overhaul 4 unit AC, ukur tekanan gas, cek ampere motor blower outdoor',
                'biaya' => 600000,
                'status' => 'selesai',
            ],
            [
                'customer' => 4,
                'technician' => 3,
                'day' => 17,
                'keluhan' => 'Air AC menetes deras dari casing indoor membasahi dinding',
                'tindakan' => 'Tembak kompresor pada selang pembuangan tersumbat lumut dan leveling kemiringan indoor',
                'biaya' => 125000,
                'status' => 'selesai',
            ],
            [
                'customer' => 5,
                'technician' => 0,
                'day' => 22,
                'keluhan' => 'Kipas outdoor Sharp berputar lambat dan kompresor cepat panas (overheat)',
                'tindakan' => 'Penggantian running capasitor outdoor 25uF + 2.5uF fan motor',
                'biaya' => 275000,
                'status' => 'selesai',
            ],
            [
                'customer' => 7,
                'technician' => 1,
                'day' => 26,
                'keluhan' => 'Bongkar pasang unit AC Daikin dari kamar lantai 1 ke lantai 2',
                'tindakan' => 'Pump down refrigeran, bongkar unit, pasang ulang instalasi pipa baru 4 meter, vakum dan testing dingin',
                'biaya' => 450000,
                'status' => 'selesai',
            ],
            [
                'customer' => 2,
                'technician' => 2,
                'day' => 28,
                'keluhan' => 'Cuci berkala 3 unit AC ruang kantor PT Sinar Abadi',
                'tindakan' => 'Cuci steam chemical indoor outdoor, sterilisasi evaporator anti-bakteri',
                'biaya' => 450000,
                'status' => 'selesai',
            ],
            // Servis Sedang Proses (Agar card "Servis Berjalan: X Tiket Proses" menyala)
            [
                'customer' => 1,
                'technician' => 0,
                'day' => min(29, $now->daysInMonth),
                'keluhan' => 'AC Daikin 1 PK mati total setelah petir, lampu indikator tidak menyala',
                'tindakan' => 'Menunggu part penggantian sekring dan varistor power board',
                'biaya' => 0,
                'status' => 'proses',
            ],
            [
                'customer' => 3,
                'technician' => 1,
                'day' => min(30, $now->daysInMonth),
                'keluhan' => 'Unit outdoor bergetar sangat keras saat malam hari',
                'tindakan' => 'Sedang dijadwalkan inspeksi bantalan karet mounting compressor',
                'biaya' => 0,
                'status' => 'proses',
            ],
            [
                'customer' => 6,
                'technician' => 2,
                'day' => min(30, $now->daysInMonth),
                'keluhan' => 'AC kasir kafe kurang dingin hanya keluar angin biasa',
                'tindakan' => 'Teknisi dalam perjalanan menuju lokasi',
                'biaya' => 0,
                'status' => 'proses',
            ],
        ];

        foreach ($servicesList as $srv) {
            $customerObj = $customers[$srv['customer']];
            $techObj = $technicians[$srv['technician']];
            $targetDate = Carbon::create($now->year, $now->month, min($srv['day'], $now->daysInMonth));

            Service::create([
                'customer_id' => $customerObj->id,
                'technician_id' => $techObj->id,
                'tanggal_servis' => $targetDate->format('Y-m-d'),
                'keluhan' => $srv['keluhan'],
                'tindakan' => $srv['tindakan'],
                'biaya_servis' => $srv['biaya'],
                'status' => $srv['status'],
            ]);
        }
    }
}

