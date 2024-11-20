@extends('layout.main')

@section('content')
<div class="container">
    <h2>Detail Pengadaan</h2>
    
    @if($pengadaan)
        <p><strong>Pengadaan ID:</strong> {{ $pengadaan['id_pengadaan'] }}</p>
        <p><strong>Vendor:</strong> {{ $pengadaan['vendor_id_vendor'] }}</p>
        <p><strong>Total:</strong> {{ $pengadaan['total_nilai'] }}</p>

        <h4>Detail Barang</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailPengadaan as $item)
                    <tr>
                        <td>{{ $item['nama_barang'] }}</td>
                        <td>{{ $item['harga_satuan'] }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>{{ $item['sub_total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Data pengadaan tidak ditemukan.</p>
    @endif

    <a href="{{ route('penerimaan.create', $pengadaan['id_pengadaan']) }}" class="btn btn-primary">Terima Barang</a>
</div>
@endsection
