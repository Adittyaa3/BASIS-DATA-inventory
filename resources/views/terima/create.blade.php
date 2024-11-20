@extends('layout.main')

@section('content')
<div class="container">
    <h2>Penerimaan Barang untuk Pengadaan ID: {{ $pengadaan ? $pengadaan['id_pengadaan'] : 'Data tidak ditemukan' }}</h2>

    @if(!$barangItems)
        <p>Data barang tidak ditemukan atau kosong.</p>
    @else
        <form action="{{ route('penerimaan.store', $pengadaan['id_pengadaan']) }}" method="POST">
            @csrf
            @foreach ($barangItems as $index => $item)
                <div class="form-group row">
                    <div class="col">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" value="{{ $item['nama'] }}" readonly>
                        <input type="hidden" name="barang[{{ $index }}][id_barang]" value="{{ $item['id_barang'] }}">
                    </div>
                    <div class="col">
                        <label>Jumlah Dipesan</label>
                        <input type="number" class="form-control" value="{{ $item['jumlah'] }}" readonly>
                    </div>
                    <div class="col">
                        <label>Jumlah Diterima</label>
                        <input type="number" name="barang[{{ $index }}][jumlah_terima]" class="form-control" min="1" max="{{ $item['jumlah'] }}">
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Simpan Penerimaan</button>
        </form>
    @endif
</div>
@endsection
