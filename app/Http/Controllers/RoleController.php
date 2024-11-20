<?php

namespace App\Http\Controllers;

use App\Services\DatabaseService;
use Illuminate\Http\Request;
use PDO;

class RoleController extends Controller
{
    protected $db;

    public function __construct(DatabaseService $databaseService)
    {
        $this->db = $databaseService;
    }

    // Create Role
    public function create(Request $request)
    {
        $this->db->query("INSERT INTO role (nama_role) VALUES (?)", [$request->nama_role]);
        return redirect()->route('role.index');
    }

    // Read Roles
    public function index()
    {
        $roles = $this->db->query("SELECT * FROM role")->fetchAll(PDO::FETCH_ASSOC);
        return view('role.index', compact('roles'));
    }

    // Update Role
    public function edit($id)
    {
        $role = $this->db->query("SELECT * FROM role WHERE id_role = ?", [$id])->fetch(PDO::FETCH_ASSOC);
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $this->db->query("UPDATE role SET nama_role = ? WHERE id_role = ?", [$request->nama_role, $id]);
        return redirect()->route('role.index');
    }

    // Delete Role
    public function delete($id)
    {
        $this->db->query("DELETE FROM role WHERE id_role = ?", [$id]);
        return redirect()->route('role.index');
    }
}
