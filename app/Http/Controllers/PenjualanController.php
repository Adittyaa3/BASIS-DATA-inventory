<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class PenjualanController extends Controller
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = DB::connection()->getPdo();
    }

    public function index()
    {
        $statement = $this->pdo->prepare('SELECT * FROM barang');
        $statement->execute();
        $barang = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement = $this->pdo->prepare('SELECT * FROM margin_penjualan WHERE status = 1');
        $statement->execute();
        $margin = $statement->fetchAll(PDO::FETCH_ASSOC);

        return view('penjualan.index', ['barang' => $barang, 'margin' => $margin]);
    }

    public function store(Request $request)
    {
        // Pastikan user sudah login dan ambil ID user dari session
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu');
        }

        $userId = $user['id_user']; // ID user yang login

        $subtotal = 0;
        $details = [];
        foreach ($request->id_barang as $index => $id_barang) {
            $details[] = [
                'id_barang' => $id_barang,
                'harga_satuan' => $request->harga_satuan[$index],
                'jumlah' => $request->jumlah[$index],
                'subtotal' => $request->subtotal[$index],
            ];
            $subtotal += $request->subtotal[$index];
        }

        $ppn = ($subtotal * 11 / 100);
        $statement = $this->pdo->prepare('SELECT get_margin_persen(:id) AS persen_margin;');
        $statement->execute([
            'id' => $request->margin
        ]);
        $margin = $statement->fetch();

        $marginValue = ($subtotal * $margin['persen_margin'] / 100);
        $total = $subtotal + $ppn + $marginValue;
        $statement = $this->pdo->prepare('CALL insert_penjualan(:subtotal_nilai, :ppn, :total_nilai, :id_user, :id_margin, :detail_penjualan)');
        $statement->execute([
            'subtotal_nilai' => $subtotal,
            'ppn' => $ppn,
            'total_nilai' => $total,
            'id_user' => $userId,
            'id_margin' => $request->margin,
            'detail_penjualan' => json_encode($details)
        ]);

        return redirect()->back()->with('success', 'Penjualan berhasil disimpan.');
    }
}
