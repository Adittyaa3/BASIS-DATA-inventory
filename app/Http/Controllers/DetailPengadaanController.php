<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatabaseService;
use PDO;

class DetailPengadaanController extends Controller
{
    protected $db;

    public function __construct(DatabaseService $databaseService)
    {
        $this->db = $databaseService;
    }

    // Menampilkan daftar detail pengadaan untuk pengadaan tertentu
    public function index($id_pengadaan)
    {
        $details = $this->db->query(
            "SELECT d.id_detail_pengadaan, b.nama as nama_barang, d.harga_satuan, d.jumlah, d.sub_total
            FROM detail_pengadaan d
            JOIN barang b ON d.id_barang = b.id_barang
            WHERE d.id_pengadaan = ?",
            [$id_pengadaan]
        )->fetchAll(PDO::FETCH_ASSOC);

        return view('detail_pengadaan.index', compact('details', 'id_pengadaan'));
    }
}
