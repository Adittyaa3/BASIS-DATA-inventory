<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatabaseService;
use PDO;

class BarangController extends Controller
{
    protected $db;

    public function __construct(DatabaseService $databaseService)
    {
        $this->db = $databaseService;
    }

    // Menampilkan daftar barang
    public function index()
    {
        $barangs = $this->db->query(
            "SELECT b.id_barang, b.jenis, b.nama, s.nama_satuan, b.harga
             FROM barang b
             JOIN satuan s ON b.id_satuan = s.id_satuan
             WHERE s.status = 1" // Status satuan tetap difilter jika diperlukan
        )->fetchAll(PDO::FETCH_ASSOC);

        return view('barang.index', compact('barangs'));
    }

    // Menampilkan form tambah barang
    public function create()
    {
        $units = $this->db->query("SELECT id_satuan, nama_satuan FROM satuan WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return view('barang.create', compact('units'));
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'nama' => 'required',
            'id_satuan' => 'required|exists:satuan,id_satuan',
            'harga' => 'required|integer'
        ]);

        $this->db->query(
            "INSERT INTO barang (jenis, nama, id_satuan, harga) VALUES (?, ?, ?, ?)",
            [
                $request->jenis,
                $request->nama,
                $request->id_satuan,
                $request->harga
            ]
        );

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    // Menampilkan form edit barang
    public function edit($id)
    {
        $barang = $this->db->query("SELECT * FROM barang WHERE id_barang = ?", [$id])->fetch(PDO::FETCH_ASSOC);
        $units = $this->db->query("SELECT id_satuan, nama_satuan FROM satuan WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return view('barang.edit', compact('barang', 'units'));
    }

    // Memperbarui data barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required',
            'nama' => 'required',
            'id_satuan' => 'required|exists:satuan,id_satuan',
            'harga' => 'required|integer'
        ]);

        $this->db->query(
            "UPDATE barang SET jenis = ?, nama = ?, id_satuan = ?, harga = ? WHERE id_barang = ?",
            [
                $request->jenis,
                $request->nama,
                $request->id_satuan,
                $request->harga,
                $id
            ]
        );

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    // Menghapus data barang
    public function delete($id)
    {
        $this->db->query("DELETE FROM barang WHERE id_barang = ?", [$id]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
