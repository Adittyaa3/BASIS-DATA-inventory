<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengadaanPenerimaanController extends Controller
{
    // Menampilkan form pengadaan
    public function createPengadaan()
    {
        $pdo = DB::connection()->getPdo();
        
        // Ambil data vendor dan barang dari database
        $vendors = $pdo->query("SELECT * FROM vendor WHERE status = 1")->fetchAll();
        $barang = $pdo->query("SELECT * FROM barang WHERE status = 1")->fetchAll();
        $pengadaans = $pdo->query("SELECT p.*, v.nama_vendor FROM pengadaan p JOIN vendor v ON p.vendor_id_vendor = v.id_vendor")->fetchAll();

        return view('pengadaan.create', compact('vendors', 'barang','pengadaans'));
    }

    // Menyimpan data pengadaan beserta detailnya
    public function storePengadaan(Request $request)
    {
        $pdo = DB::connection()->getPdo();

        // Pastikan user sudah login dan ambil ID user dari session
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu');
        }

        $userId = $user['id_user']; // ID user yang login

        $request->validate([
            'vendor_id' => 'required|integer',
            'barang.*.id_barang' => 'required|integer',
            'barang.*.harga' => 'required|numeric',
            'barang.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            $pdo->beginTransaction();

            $subtotal = $request->input('subtotal');
            $ppn = $subtotal * 0.11;
            $total = $subtotal + $ppn;

            // Simpan data pengadaan dengan user ID dari session
            $stmt = $pdo->prepare("INSERT INTO pengadaan (timestamp, user_id_user, vendor_id_vendor, subtotal_nilai, ppn, total_nilai, status) VALUES (NOW(), ?, ?, ?, ?, ?, 'A')");
            $stmt->execute([$userId, $request->vendor_id, $subtotal, $ppn, $total]);
            $pengadaanId = $pdo->lastInsertId();

            foreach ($request->barang as $item) {
                $stmt = $pdo->prepare("INSERT INTO detail_pengadaan (id_pengadaan, id_barang, harga_satuan, jumlah, sub_total) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$pengadaanId, $item['id_barang'], $item['harga'], $item['quantity'], $item['harga'] * $item['quantity']]);
            }

            $pdo->commit();
            return redirect()->route('pengadaan.create')->with('success', 'Pengadaan berhasil disimpan');
        } catch (\Exception $e) {
            $pdo->rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan pengadaan: ' . $e->getMessage()]);
        }
    }

    // // Menampilkan daftar pengadaan
     public function indexPengadaan()
     {
         $pdo = DB::connection()->getPdo();
         $pengadaans = $pdo->query("SELECT p.*, v.nama_vendor FROM pengadaan p JOIN vendor v ON p.vendor_id_vendor = v.id_vendor")->fetchAll();
       
         return view('pengadaan.index', compact('pengadaans'));
    }

    // Menampilkan detail pengadaan berdasarkan ID
    public function detailPengadaan($id_pengadaan)
    {
        $pdo = DB::connection()->getPdo();

        $pengadaan = $pdo->prepare("SELECT * FROM pengadaan WHERE id_pengadaan = ?");
        $pengadaan->execute([$id_pengadaan]);
        $pengadaan = $pengadaan->fetch();

        $detailPengadaan = $pdo->prepare("SELECT dp.*, b.nama AS nama_barang FROM detail_pengadaan dp JOIN barang b ON dp.id_barang = b.id_barang WHERE dp.id_pengadaan = ?");
        $detailPengadaan->execute([$id_pengadaan]);
        $detailPengadaan = $detailPengadaan->fetchAll();

        return view('pengadaan.detail', compact('pengadaan', 'detailPengadaan'));
    }

    // Menampilkan form penerimaan barang berdasarkan ID pengadaan
    public function createPenerimaan($id_pengadaan)
    {
        $pdo = DB::connection()->getPdo();

        $pengadaan = $pdo->prepare("SELECT * FROM pengadaan WHERE id_pengadaan = ?");
        $pengadaan->execute([$id_pengadaan]);
        $pengadaan = $pengadaan->fetch();

        $barangItems = $pdo->prepare("SELECT dp.*, b.nama FROM detail_pengadaan dp JOIN barang b ON dp.id_barang = b.id_barang WHERE dp.id_pengadaan = ?");
        $barangItems->execute([$id_pengadaan]);
        $barangItems = $barangItems->fetchAll();

        return view('terima.create', compact('pengadaan', 'barangItems'));
    }

    // Menyimpan data penerimaan barang beserta detailnya
    public function storePenerimaan(Request $request, $id_pengadaan)
    {
        $pdo = DB::connection()->getPdo();

        $request->validate([
            'barang.*.id_barang' => 'required|integer',
            'barang.*.jumlah_terima' => 'required|integer|min:1',
        ]);

        try {
            $pdo->beginTransaction();

            // Simpan data penerimaan
            $stmt = $pdo->prepare("INSERT INTO penerimaan (created_at, id_pengadaan, status, id_user) VALUES (NOW(), ?, 'A', ?)");
            $stmt->execute([$id_pengadaan, Auth::id()]);
            $idPenerimaan = $pdo->lastInsertId();

            // Simpan detail penerimaan dan update stok
            foreach ($request->barang as $item) {
                $barang = $pdo->prepare("SELECT harga FROM barang WHERE id_barang = ?");
                $barang->execute([$item['id_barang']]);
                $hargaSatuan = $barang->fetchColumn();
                $subTotal = $hargaSatuan * $item['jumlah_terima'];

                // Simpan ke detail penerimaan
                $stmt = $pdo->prepare("INSERT INTO detail_penerimaan (id_penerimaan, id_barang, jumlah_terima, harga_satuan_terima, sub_total_terima) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$idPenerimaan, $item['id_barang'], $item['jumlah_terima'], $hargaSatuan, $subTotal]);

                // Update stok di kartu_stok
                $currentStock = $pdo->prepare("SELECT stock FROM kartu_stok WHERE id_barang = ? ORDER BY created_at DESC LIMIT 1");
                $currentStock->execute([$item['id_barang']]);
                $currentStock = $currentStock->fetchColumn() ?? 0;
                $newStock = $currentStock + $item['jumlah_terima'];

                $stmt = $pdo->prepare("INSERT INTO kartu_stok (id_barang, jenis_transaksi, masuk, keluar, stock, created_at, id_transaksi) VALUES (?, 'M', ?, 0, ?, NOW(), ?)");
                $stmt->execute([$item['id_barang'], $item['jumlah_terima'], $newStock, $id_pengadaan]);
            }

            $pdo->commit();
            return redirect()->route('pengadaan.index')->with('success', 'Penerimaan berhasil disimpan dan stok diperbarui');
        } catch (\Exception $e) {
            $pdo->rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan penerimaan: ' . $e->getMessage()]);
        }
    }
}
