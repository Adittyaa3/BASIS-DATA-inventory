@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Pengadaan</h5>
            <form action="{{ route('procurement.update', $procurement['id_pengadaan']) }}" method="POST">
                @csrf
                
                {{-- User Dropdown --}}
                <div class="mb-3">
                    <label for="user_id_user" class="form-label">User</label>
                    <select class="form-select" id="user_id_user" name="user_id_user" required>
                        @foreach($users as $user)
                            <option value="{{ $user['id_user'] }}" {{ $procurement['user_id_user'] == $user['id_user'] ? 'selected' : '' }}>
                                {{ $user['username'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Vendor Dropdown --}}
                <div class="mb-3">
                    <label for="vendor_id_vendor" class="form-label">Vendor</label>
                    <select class="form-select" id="vendor_id_vendor" name="vendor_id_vendor" required>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor['id_vendor'] }}" {{ $procurement['vendor_id_vendor'] == $vendor['id_vendor'] ? 'selected' : '' }}>
                                {{ $vendor['nama_vendor'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Subtotal Field --}}
                <div class="mb-3">
                    <label for="subtotal_nilai" class="form-label">Subtotal</label>
                    <input type="number" class="form-control" id="subtotal_nilai" name="subtotal_nilai" value="{{ $procurement['subtotal_nilai'] }}" required>
                </div>

                {{-- PPN Field --}}
                <div class="mb-3">
                    <label for="ppn" class="form-label">PPN</label>
                    <input type="number" class="form-control" id="ppn" name="ppn" value="{{ $procurement['ppn'] }}" required>
                </div>

                {{-- Total Field --}}
                <div class="mb-3">
                    <label for="total_nilai" class="form-label">Total</label>
                    <input type="number" class="form-control" id="total_nilai" name="total_nilai" value="{{ $procurement['total_nilai'] }}" required>
                </div>

                {{-- Status Dropdown --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Y" {{ $procurement['status'] == 'Y' ? 'selected' : '' }}>Aktif</option>
                        <option value="N" {{ $procurement['status'] == 'N' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
