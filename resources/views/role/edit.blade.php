@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Role</h5>
            <form action="{{ route('role.update', $role['id_role']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_role" class="form-label">Nama Role</label>
                    <input type="text" class="form-control" id="nama_role" name="nama_role" value="{{ $role['nama_role'] }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
