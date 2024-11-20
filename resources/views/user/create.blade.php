@extends('layout.main')
@section('content')
{{-- AWAL CONTAINER --}}
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Tambah User --}}
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Tambah User</h5>
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_role" class="form-label">Role</label>
                            <select class="form-select" id="id_role" name="id_role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role['id_role'] }}">{{ $role['nama_role'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- AKHIR CONTAINER --}}
@endsection
