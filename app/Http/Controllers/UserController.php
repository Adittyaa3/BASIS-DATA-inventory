<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatabaseService;
use PDO;

class UserController extends Controller
{
    protected $db;

    public function __construct(DatabaseService $databaseService)
    {
        $this->db = $databaseService;
    }

    // Menampilkan daftar user
    public function index()
    {
        // Mengambil data user bersama nama role-nya (JOIN)
        $users = $this->db->query(
            "SELECT * FROM view_user"
        )->fetchAll(PDO::FETCH_ASSOC);

        return view('user.index', compact('users'));
    }

    // Menampilkan form create user
    public function create()
    {
        // Mengambil semua role untuk dropdown pilihan role
        $roles = $this->db->query("SELECT * FROM role")->fetchAll(PDO::FETCH_ASSOC);
        return view('user.create', compact('roles'));
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:user,username',
            'password' => 'required|min:6',
            'id_role' => 'required|exists:role,id_role'
        ]);

        // Insert data user baru
        $this->db->query(
            "INSERT INTO user (username, password, id_role) VALUES (?, ?, ?)",
            [
                $request->username,
                password_hash($request->password, PASSWORD_BCRYPT), // Hash password untuk keamanan
                $request->id_role
            ]
        );

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        // Mengambil data user yang ingin diedit
        $user = $this->db->query(
            "SELECT * FROM user WHERE id_user = ?",
            [$id]
        )->fetch(PDO::FETCH_ASSOC);

        // Mengambil semua role untuk dropdown pilihan role
        $roles = $this->db->query("SELECT * FROM role")->fetchAll(PDO::FETCH_ASSOC);

        return view('user.edit', compact('user', 'roles'));
    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:user,username,'.$id.',id_user',
            'password' => 'nullable|min:6', // Password opsional
            'id_role' => 'required|exists:role,id_role'
        ]);

        // Hash password hanya jika diisi
        $password = $request->password ? password_hash($request->password, PASSWORD_BCRYPT) : null;

        // Update data user
        if ($password) {
            $this->db->query(
                "UPDATE user SET username = ?, password = ?, id_role = ? WHERE id_user = ?",
                [$request->username, $password, $request->id_role, $id]
            );
        } else {
            $this->db->query(
                "UPDATE user SET username = ?, id_role = ? WHERE id_user = ?",
                [$request->username, $request->id_role, $id]
            );
        }

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    // Menghapus data user
    public function delete($id)
    {
        $this->db->query("DELETE FROM user WHERE id_user = ?", [$id]);
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
