@extends('layout.main')
@section('content')
{{-- AWAL CONTAINER --}}
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Roles --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Roles</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Role</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $role['id_role'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $role['nama_role'] }}</h6></td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('role.edit', $role['id_role']) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('role.delete', $role['id_role']) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Kolom Tambah Role --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Tambah Role</h5>
                    <form action="{{ route('role.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_role" class="form-label">Nama Role</label>
                            <input type="text" class="form-control" id="nama_role" name="nama_role" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



