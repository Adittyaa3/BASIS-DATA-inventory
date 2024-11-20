@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit User</h5>
            <form action="{{ route('user.update', $user['id_user']) }}" method="POST">
                @csrf
                {{-- Username Field --}}
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user['username'] }}" required>
                </div>

                {{-- Password Field (Optional) --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password (Opsional)</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>

                {{-- Role Dropdown --}}
                <div class="mb-3">
                    <label for="id_role" class="form-label">Role</label>
                    <select class="form-select" id="id_role" name="id_role" required>
                        @foreach($roles as $role)
                            <option value="{{ $role['id_role'] }}" {{ $user['id_role'] == $role['id_role'] ? 'selected' : '' }}>
                                {{ $role['nama_role'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
