@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit satuan</h5>
            <form action="{{ route('satuan.update', $satuan['id_satuan']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_role" class="form-label">Nama satuan</label>
                    <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" value="{{ $satuan['nama_satuan'] }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
