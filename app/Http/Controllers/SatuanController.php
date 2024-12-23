<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatabaseService;
use PDO;

class SatuanController extends Controller
{
    protected $db;

    public function __construct(DatabaseService $databaseService)
    {
        $this->db = $databaseService;
    }

    // Menampilkan daftar satuan yang masih aktif (status = 1)
    public function index()
    {
        // Mengambil data satuan dengan status aktif (1)
        $satuans = $this->db->query("SELECT * FROM satuan WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return view('satuan.index', compact('satuans'));
    }

    // Menampilkan form create satuan
    public function create()
    {
        return view('satuan.create');
    }

    // Menyimpan data satuan baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_satuan' => 'required'
        ]);

        // Insert data satuan baru, status akan menggunakan default dari database (1)
        $this->db->query(
            "INSERT INTO satuan (nama_satuan) VALUES (?)",
            [
                $request->nama_satuan
            ]
        );

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil ditambahkan!');
    }

    // Menampilkan form edit satuan
    public function edit($id)
    {
        // Mengambil data satuan yang ingin diedit
        $satuan = $this->db->query(
            "SELECT * FROM satuan WHERE id_satuan = ?",
            [$id]
        )->fetch(PDO::FETCH_ASSOC);

        return view('satuan.edit', compact('satuan'));
    }

    // Memperbarui data satuan
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_satuan' => 'required'
        ]);

        // Memastikan status sesuai data terbaru atau mengambil dari input
        $status = $request->has('status') ? $request->status : $this->db->query(
            "SELECT status FROM satuan WHERE id_satuan = ?",
            [$id]
        )->fetchColumn();

        // Update data satuan
        $this->db->query(
            "UPDATE satuan SET nama_satuan = ?, status = ? WHERE id_satuan = ?",
            [
                $request->nama_satuan,
                $status,
                $id
            ]
        );

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil diperbarui!');
    }

    // Menghapus data satuan secara soft delete
    public function delete($id)
    {
        // Mengupdate status menjadi 0 untuk soft delete
        $this->db->query(
            "UPDATE satuan SET status = 0 WHERE id_satuan = ?",
            [$id]
        );

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil dihapus!');
    }
}
