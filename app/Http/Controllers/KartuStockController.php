<?php

namespace App\Http\Controllers;
use PDO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KartuStockController extends Controller
{
    public function indexKartuStok()
    {
        $pdo = DB::connection()->getPdo();

        // Ambil data dari view kartu_stok_view
        $kartuStokData = $pdo->query("SELECT * FROM kartu_stok_view")->fetchAll(PDO::FETCH_ASSOC);

        // Kirim data ke blade
        return view('kartuStock.index', compact('kartuStokData'));
    }

    public function indexKartuStok2()
    {
        $pdo = DB::connection()->getPdo();

        // Ambil data dari view kartu_stok_view
        $kartuStokData = $pdo->query("SELECT * FROM view_masuk_keluar_stok")->fetchAll(PDO::FETCH_ASSOC);

        // Kirim data ke blade
        return view('kartuStock.kartustok2', compact('kartuStokData'));
    }

    public function daftarpenjualan()
    {
        $pdo = DB::connection()->getPdo();

        // Ambil data dari view kartu_stok_view
        $penjualan = $pdo->query("SELECT * FROM view_penjualan_barang")->fetchAll(PDO::FETCH_ASSOC);

        // Kirim data ke blade
        return view('kartuStock.penjualan', compact('penjualan'));
    }


    public function indexSummary()
    {
        $pdo = DB::connection()->getPdo();

        // Ambil data dari view view_summary_penjualan
        $summaryPenjualan = $pdo->query("SELECT * FROM view_summary_penjualan")->fetch(PDO::FETCH_ASSOC);

        // Ambil data dari view view_total_pengadaan_barang
        $totalPengadaan = $pdo->query("SELECT * FROM view_total_pengadaan_barang")->fetch(PDO::FETCH_ASSOC);

        // Ambil data dari view view_total_retur
        $totalRetur = $pdo->query("SELECT * FROM view_total_retur")->fetch(PDO::FETCH_ASSOC);

        // Ambil data dari view view_total_penerimaan
        $totalPenerimaan = $pdo->query("SELECT * FROM view_total_penerimaan")->fetch(PDO::FETCH_ASSOC);

        // Kirim data ke blade
        return view('summary.index', compact('summaryPenjualan', 'totalPengadaan', 'totalRetur', 'totalPenerimaan'));
    }


}
