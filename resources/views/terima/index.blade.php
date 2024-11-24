@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h2>Daftar Penerimaan Barang</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Pengadaan</th>
                <th>ID Penerimaan</th>
                <th>Nama Barang</th>
                <th>Jumlah Dipesan</th>
                <th>Jumlah Diterima Total</th>
                <th>Jumlah Diterima Sekarang</th>
                <th>Sisa Barang</th>
                <th>Status Penerimaan</th>
                <th>User Penerima</th>
                <th>Tanggal Penerimaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPenerimaan as $penerimaan)
            <tr>
                <td>{{ $penerimaan['id_pengadaan'] }}</td>
                <td>{{ $penerimaan['id_penerimaan'] }}</td>
                <td>{{ $penerimaan['nama_barang'] }}</td>
                <td>{{ $penerimaan['jumlah_dipesan'] }}</td>
                <td>{{ $penerimaan['jumlah_diterima_total'] }}</td>
                <td>{{ $penerimaan['jumlah_terima_sekarang'] }}</td>
                <td>{{ $penerimaan['jumlah_sisa'] }}</td>
                <td>
                    @if ($penerimaan['status_penerimaan'] == 'Semua Barang Diterima')
                        <span class="badge bg-success">Semua Barang Diterima</span>
                    @else
                        <span class="badge bg-warning">Sebagian Barang Diterima</span>
                    @endif
                </td>
                <td>{{ $penerimaan['user_penerima'] }}</td>
                <td>{{ $penerimaan['tanggal_penerimaan'] }}</td>
                <td>
                    <a href="{{ route('retur.create', ['id_penerimaan' => $penerimaan['id_penerimaan']]) }}" class="btn btn-primary btn-sm">Retur</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
