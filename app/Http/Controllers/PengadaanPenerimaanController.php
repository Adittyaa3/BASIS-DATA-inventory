<?php

namespace App\Http\Controllers;
use PDO;
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
        $vendors = $pdo->query("SELECT * FROM vendor WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
        $barang = $pdo->query("SELECT * FROM barang WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
        $pengadaans = $pdo->query("
            SELECT p.*, v.nama_vendor
            FROM pengadaan p
            JOIN vendor v ON p.vendor_id_vendor = v.id_vendor
        ")->fetchAll(PDO::FETCH_ASSOC);

        // Tambahkan status penerimaan pada setiap pengadaan
        foreach ($pengadaans as &$pengadaan) {
            // Total jumlah barang dipesan
            $totalPesananQuery = $pdo->prepare("SELECT SUM(jumlah) FROM detail_pengadaan WHERE id_pengadaan = ?");
            $totalPesananQuery->execute([$pengadaan['id_pengadaan']]);
            $totalPesanan = $totalPesananQuery->fetchColumn();

            // Total jumlah barang diterima
            $totalDiterimaQuery = $pdo->prepare("
                SELECT SUM(jumlah_terima) FROM detail_penerimaan
                WHERE id_penerimaan IN (
                    SELECT id_penerimaan FROM penerimaan WHERE id_pengadaan = ?
                )
            ");
            $totalDiterimaQuery->execute([$pengadaan['id_pengadaan']]);
            $totalDiterima = $totalDiterimaQuery->fetchColumn() ?? 0;

            // Tentukan status penerimaan
            $pengadaan['status_penerimaan'] = ($totalPesanan == $totalDiterima) ? 'Selesai' : 'Belum Selesai';
        }

        return view('pengadaan.create', compact('vendors', 'barang', 'pengadaans'));
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

        // Ambil data pengadaan
        $pengadaans = $pdo->query("
            SELECT p.*, v.nama_vendor
            FROM pengadaan p
            JOIN vendor v ON p.vendor_id_vendor = v.id_vendor
        ")->fetchAll(PDO::FETCH_ASSOC);

        foreach ($pengadaans as &$pengadaan) {
            // Hitung total jumlah barang yang dipesan
            $totalPesananQuery = $pdo->prepare("
                SELECT SUM(jumlah) FROM detail_pengadaan WHERE id_pengadaan = ?
            ");
            $totalPesananQuery->execute([$pengadaan['id_pengadaan']]);
            $totalPesanan = $totalPesananQuery->fetchColumn();

            // Hitung total jumlah barang yang sudah diterima
            $totalDiterimaQuery = $pdo->prepare("
                SELECT SUM(jumlah_terima) FROM detail_penerimaan
                WHERE id_penerimaan IN (
                    SELECT id_penerimaan FROM penerimaan WHERE id_pengadaan = ?
                )
            ");
            $totalDiterimaQuery->execute([$pengadaan['id_pengadaan']]);
            $totalDiterima = $totalDiterimaQuery->fetchColumn() ?? 0;

            // Tambahkan status penerimaan
            $pengadaan['status_penerimaan'] = ($totalPesanan == $totalDiterima) ? 'Selesai' : 'Belum Selesai';
        }

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

    // Ambil data pengadaan
    $pengadaanQuery = $pdo->prepare("SELECT * FROM pengadaan WHERE id_pengadaan = ?");
    $pengadaanQuery->execute([$id_pengadaan]);
    $pengadaan = $pengadaanQuery->fetch(PDO::FETCH_ASSOC);

    // Ambil barang terkait pengadaan
    $barangItemsQuery = $pdo->prepare("
        SELECT
            dp.id_barang,
            b.nama AS nama_barang,
            dp.jumlah AS jumlah_dipesan,
            COALESCE(SUM(dp_terima.jumlah_terima), 0) AS jumlah_diterima
        FROM detail_pengadaan dp
        JOIN barang b ON dp.id_barang = b.id_barang
        LEFT JOIN detail_penerimaan dp_terima ON dp.id_barang = dp_terima.barang_id_barang
            AND dp_terima.id_penerimaan IN (
                SELECT id_penerimaan FROM penerimaan WHERE id_pengadaan = ?
            )
        WHERE dp.id_pengadaan = ?
        GROUP BY dp.id_barang, dp.jumlah, b.nama
    ");
    $barangItemsQuery->execute([$id_pengadaan, $id_pengadaan]);
    $barangItems = $barangItemsQuery->fetchAll(PDO::FETCH_ASSOC);

    return view('terima.create', compact('pengadaan', 'barangItems'));
}

public function storePenerimaan(Request $request, $id_pengadaan)
{
    $pdo = DB::connection()->getPdo();

    // Pastikan user sudah login
    $user = session('user');
    if (!$user) {
        return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu');
    }

    $userId = $user['id_user'];

    try {
        $pdo->beginTransaction();

        foreach ($request->barang as $item) {
            // Panggil stored procedure
            $stmt = $pdo->prepare("CALL sp_store_penerimaan(?, ?, ?, ?)");
            $stmt->execute([$id_pengadaan, $item['id_barang'], $item['jumlah_terima'], $userId]);
        }

        $pdo->commit();
        return redirect()->route('penerimaan.index')->with('success', 'Penerimaan berhasil disimpan.');
    } catch (\Exception $e) {
        $pdo->rollBack();
        return back()->withErrors(['error' => 'Gagal menyimpan penerimaan: ' . $e->getMessage()]);
    }
}

public function indexPenerimaan()
{
    $pdo = DB::connection()->getPdo();

    // Query data dari view_penerimaan_barang
    $dataPenerimaan = $pdo->query("SELECT * FROM view_penerimaan_barang")->fetchAll(PDO::FETCH_ASSOC);

    return view('terima.index', compact('dataPenerimaan'));
}






}
