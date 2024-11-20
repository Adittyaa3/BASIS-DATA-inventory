@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Vendor</h5>
            <form action="{{ route('vendor.store') }}" method="POST">
                @csrf
                {{-- Nama Vendor Field --}}
                <div class="mb-3">
                    <label for="nama_vendor" class="form-label">Nama Vendor</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required>
                </div>

                {{-- Badan Hukum Dropdown --}}
                <div class="mb-3">
                    <label for="badan_hukum" class="form-label">Badan Hukum</label>
                    <select class="form-select" id="badan_hukum" name="badan_hukum" required>
                        <option value="Y">Ya</option>
                        <option value="N">Tidak</option>
                    </select>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
