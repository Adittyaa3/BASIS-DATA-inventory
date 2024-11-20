@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Barang</h5>
            <form action="{{ route('barang.update', $barang['id_barang']) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Jenis Barang Field --}}
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <input type="text" class="form-control" id="jenis" name="jenis" value="{{ $barang['jenis'] }}" required>
                </div>

                {{-- Nama Barang Field --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang['nama'] }}" required>
                </div>

                {{-- Satuan Dropdown --}}
                <div class="mb-3">
                    <label for="id_satuan" class="form-label">Satuan</label>
                    <select class="form-select" id="id_satuan" name="id_satuan" required>
                        @foreach($units as $unit)
                            <option value="{{ $unit['id_satuan'] }}" {{ $barang['id_satuan'] == $unit['id_satuan'] ? 'selected' : '' }}>
                                {{ $unit['nama_satuan'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga Field --}}
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $barang['harga'] }}" required>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
