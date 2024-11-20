@extends('layout.main')
@section('content')

{{-- AWAL CONTAINER --}}
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Daftar User --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar User</h5>
                    <a href="{{ route('user.create') }}" class="btn btn-success mb-3">Tambah User</a>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Username</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Role</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $user['id_user'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $user['username'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $user['nama_role'] }}</h6></td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('user.edit', $user['id_user']) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('user.delete', $user['id_user']) }}" method="POST" style="display:inline">
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
    </div>
</div>
{{-- AKHIR CONTAINER --}}
@endsection
