@extends('layout.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Penerimaan Barang untuk Pengadaan ID: {{ $pengadaan['id_pengadaan'] ?? 'Data tidak ditemukan' }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('penerimaan.store', $pengadaan['id_pengadaan']) }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Dipesan</th>
                    <th>Jumlah Diterima Sebelumnya</th>
                    <th>Jumlah Diterima Sekarang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangItems as $index => $item)
                <tr>
                    <td>
                        {{ $item['nama_barang'] }}
                        <input type="hidden" name="barang[{{ $index }}][id_barang]" value="{{ $item['id_barang'] }}">
                    </td>
                    <td>
                        <input type="number" class="form-control" value="{{ $item['jumlah_dipesan'] }}" readonly>
                    </td>
                    <td>
                        <input type="number" class="form-control" value="{{ $item['jumlah_diterima'] }}" readonly>
                    </td>
                    <td>
                        <input type="number" name="barang[{{ $index }}][jumlah_terima]"
                               class="form-control"
                               min="1"
                               max="{{ $item['jumlah_dipesan'] - $item['jumlah_diterima'] }}"
                               placeholder="Masukkan jumlah"
                               required>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary mt-3">Simpan Penerimaan</button>
    </form>
</div>
@endsection
