<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatabaseService;
use PDO;

class AuthController extends Controller
{
    protected $db;

    public function __construct(DatabaseService $databaseService)
    {
        $this->db = $databaseService;
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register'); // Tidak perlu mengirimkan role ke form register
    }

    // Register User Baru
    public function register(Request $request)
    {
        // Validasi input, username harus unik dan password minimal 6 karakter
        $request->validate([
            'username' => 'required|unique:user,username',
            'password' => 'required|min:6',
        ]);

        // Tetapkan id_role ke 1 sebagai default untuk semua user yang mendaftar
        $id_role = 1;

        // Insert data user baru dengan id_role default
        $this->db->query(
            "INSERT INTO user (username, password, id_role) VALUES (?, ?, ?)",
            [
                $request->username,
                password_hash($request->password, PASSWORD_BCRYPT), // Hash password untuk keamanan
                $id_role
            ]
        );

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil user berdasarkan username
        $user = $this->db->query(
            "SELECT * FROM user WHERE username = ?",
            [$request->username]
        )->fetch(PDO::FETCH_ASSOC);

        // Jika user ditemukan dan password cocok
        if ($user && password_verify($request->password, $user['password'])) {
            // Simpan user di session
            session(['user' => $user]);
            return redirect()->route('role.index');
        }

        return redirect()->route('login')->withErrors(['loginError' => 'Username atau password salah!']);
    }

    // Logout
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }
}
