<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MarginController extends Controller
{
    // Menampilkan semua margin penjualan yang aktif
    public function index()
    {
        $margins = DB::select('SELECT * FROM view_margin_penjualan');
        return view('margin.index', compact('margins'));
    }

    // Menampilkan form untuk membuat margin penjualan baru
    public function create()
    {
        return view('margin.create');
    }

    // Menyimpan margin penjualan baru
    public function store(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu');
        }

        $userId = $user['id_user']; // ID user yang login

        $request->validate([
            'persen' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        DB::insert(
            'INSERT INTO margin_penjualan (persen, status, id_user, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())',
            [
                $request->input('persen'),
                $request->input('status') === 'active' ? 1 : 0,
                $userId,
            ]
        );

        return redirect()->route('margin.index')->with('success', 'Margin Penjualan berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit margin penjualan
    public function edit($id)
    {
        $margin = DB::selectOne('SELECT * FROM margin_penjualan WHERE id_margin_penjualan = ? AND status = 1', [$id]);
        return view('margin.edit', compact('margin'));
    }

    // Memperbarui margin penjualan
    public function update(Request $request, $id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu');
        }

        $userId = $user['id_user']; // ID user yang login

        $request->validate([
            'persen' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $updated = DB::update(
            'UPDATE margin_penjualan SET persen = ?, status = ?, id_user = ?, updated_at = NOW() WHERE id_margin_penjualan = ? AND status = 1',
            [
                $request->input('persen'),
                $request->input('status') === 'active' ? 1 : 0,
                $userId,
                $id,
            ]
        );

        if ($updated) {
            return redirect()->route('margin.index')->with('success', 'Margin Penjualan berhasil diperbarui.');
        }

        return redirect()->route('margin.index')->withErrors('Gagal memperbarui margin penjualan.');
    }

    // Menghapus margin penjualan (soft delete)
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu');
        }

        $deleted = DB::update('UPDATE margin_penjualan SET status = 0 WHERE id_margin_penjualan = ?', [$id]);

        if ($deleted) {
            return redirect()->route('margin.index')->with('success', 'Margin Penjualan berhasil dihapus.');
        }

        return redirect()->route('margin.index')->withErrors('Gagal menghapus margin penjualan.');
    }

    // Mengambil semua margin penjualan yang aktif
    public function getMargins()
    {
        $margins = DB::select('SELECT * FROM margin_penjualan WHERE status = 1');
        return response()->json(['margins' => $margins]);
    }
}
