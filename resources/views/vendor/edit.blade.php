@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Vendor</h5>
            <form action="{{ route('vendor.update', $vendor['id_vendor']) }}" method="POST">
                @csrf
                {{-- Nama Vendor Field --}}
                <div class="mb-3">
                    <label for="nama_vendor" class="form-label">Nama Vendor</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="{{ $vendor['nama_vendor'] }}" required>
                </div>

                {{-- Badan Hukum Dropdown --}}
                <div class="mb-3">
                    <label for="badan_hukum" class="form-label">Badan Hukum</label>
                    <select class="form-select" id="badan_hukum" name="badan_hukum" required>
                        <option value="Y" {{ $vendor['badan_hukum'] == 'Y' ? 'selected' : '' }}>Ya</option>
                        <option value="N" {{ $vendor['badan_hukum'] == 'N' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
