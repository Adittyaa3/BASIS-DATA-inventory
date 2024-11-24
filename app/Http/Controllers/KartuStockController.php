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


}
