<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatabaseService;
use PDO;

class VendorController extends Controller
{
    protected $db;

    public function __construct(DatabaseService $databaseService)
    {
        $this->db = $databaseService;
    }

    // Menampilkan daftar vendor yang masih aktif (status = 1)
    public function index()
    {
        // Mengambil data vendor dengan status aktif (1)
        $vendors = $this->db->query("SELECT * FROM vendor WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return view('vendor.index', compact('vendors'));
    }

    // Menampilkan form create vendor
    public function create()
    {
        return view('vendor.create');
    }

    // Menyimpan data vendor baru
   public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_vendor' => 'required',
        'badan_hukum' => 'required|in:Y,N' // Y untuk Ya, N untuk Tidak
    ]);

    // Insert data vendor baru, status akan menggunakan default dari database (1)
    $this->db->query(
        "INSERT INTO vendor (nama_vendor, badan_hukum) VALUES (?, ?)",
        [
            $request->nama_vendor,
            $request->badan_hukum
        ]
    );

    return redirect()->route('vendor.index')->with('success', 'Vendor berhasil ditambahkan!');
}


    // Menampilkan form edit vendor
    public function edit($id)
    {
        // Mengambil data vendor yang ingin diedit (termasuk yang soft deleted untuk bisa di-restore)
        $vendor = $this->db->query(
            "SELECT * FROM vendor WHERE id_vendor = ?",
            [$id]
        )->fetch(PDO::FETCH_ASSOC);

        return view('vendor.edit', compact('vendor'));
    }

    // Memperbarui data vendor
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_vendor' => 'required',
            'badan_hukum' => 'required|in:Y,N'
        ]);
    
        // Ambil status dari request jika ada, jika tidak, gunakan nilai saat ini dari database
        $status = $request->has('status') ? $request->status : $this->db->query(
            "SELECT status FROM vendor WHERE id_vendor = ?", 
            [$id]
        )->fetchColumn();
    
        // Update data vendor
        $this->db->query(
            "UPDATE vendor SET nama_vendor = ?, badan_hukum = ?, status = ? WHERE id_vendor = ?",
            [
                $request->nama_vendor,
                $request->badan_hukum,
                $status,
                $id
            ]
        );
    
        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil diperbarui!');
    }
    

    // Menghapus data vendor secara soft delete
    public function delete($id)
    {
        // Mengupdate status menjadi 0 untuk soft delete
        $this->db->query(
            "UPDATE vendor SET status = 0 WHERE id_vendor = ?",
            [$id]
        );

        return redirect()->route('vendor.index')->with('success', 'Vendor berhasil dihapus!');
    }
}
