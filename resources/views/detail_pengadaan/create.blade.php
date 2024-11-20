@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Detail Pengadaan</h5>
            <form action="{{ route('detail_pengadaan.store', $id_pengadaan) }}" method="POST">
                @csrf
                
                {{-- Barang Dropdown --}}
                <div class="mb-3">
                    <label for="id_barang" class="form-label">Barang</label>
                    <select class="form-select" id="id_barang" name="id_barang" required>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang['id_barang'] }}">{{ $barang['nama'] }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga Satuan Field --}}
                <div class="mb-3">
                    <label for="harga_satuan" class="form-label">Harga Satuan</label>
                    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required>
                </div>

                {{-- Jumlah Field --}}
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
