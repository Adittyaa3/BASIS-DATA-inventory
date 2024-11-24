<?php

namespace App\Http\Controllers;
use PDO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{

    public function index()
{
    $pdo = DB::connection()->getPdo();

    $stmt = $pdo->prepare("
        SELECT r.id_retur, b.nama AS nama_barang, dr.jumlah, dr.alasan, r.created_at, r.id_penerimaan, u.username
        FROM retur r
        JOIN detail_retur dr ON r.id_retur = dr.id_retur
        JOIN barang b ON r.id_barang = b.id_barang
        JOIN user u ON r.id_user = u.id_user
        ORDER BY r.created_at DESC
    ");
    $stmt->execute();
    $returs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return view('retur.index', compact('returs'));
}

    // Menampilkan form retur barang berdasarkan ID penerimaan
    public function create($id_penerimaan)
    {
        $pdo = DB::connection()->getPdo();

        $query = "
            SELECT
                dp.id_detail_penerimaan,
                dp.barang_id_barang,
                b.nama AS nama_barang,
                dp.jumlah_terima,
                COALESCE(SUM(dr.jumlah), 0) AS jumlah_retur_sebelumnya
            FROM detail_penerimaan dp
            JOIN barang b ON dp.barang_id_barang = b.id_barang
            LEFT JOIN detail_retur dr ON dr.id_detail_penerimaan = dp.id_detail_penerimaan
            WHERE dp.id_penerimaan = ?
            GROUP BY dp.id_detail_penerimaan, dp.barang_id_barang, b.nama, dp.jumlah_terima
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$id_penerimaan]);
        $barangItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return view('retur.create', compact('id_penerimaan', 'barangItems'));
    }


    // Menyimpan retur barang
    public function store(Request $request, $id_penerimaan)
    {
        $pdo = DB::connection()->getPdo();

        // Pastikan user sudah login
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        $userId = $user['id_user']; // ID user yang login

        // Validasi input
        $request->validate([
            'barang.*.jumlah_retur' => 'required|integer|min:1',
            'barang.*.alasan' => 'required|string|max:200',
        ]);

        try {
            // Proses setiap barang dalam retur
            foreach ($request->barang as $item) {
                $id_barang = $item['id_barang'];
                $jumlah_retur = $item['jumlah_retur'];
                $alasan = $item['alasan'];

                // Panggil prosedur StoreRetur
                $stmt = $pdo->prepare("CALL StoreRetur(?, ?, ?, ?, ?)");
                $stmt->execute([$id_penerimaan, $id_barang, $jumlah_retur, $alasan, $userId]);
            }

            return redirect()->route('penerimaan.index')->with('success', 'Retur berhasil diproses.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memproses retur: ' . $e->getMessage()]);
        }
    }
}
