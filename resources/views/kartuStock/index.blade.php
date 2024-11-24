@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h2>Daftar Kartu Stok</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Kartu Stok</th>
                <th>Jenis Transaksi</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Stok</th>
                <th>Masuk pada Tanggal</th>
                <th>ID Transaksi</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Nama Vendor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kartuStokData as $data)
            <tr>
                <td>{{ $data['id_kartu_stok'] }}</td>
                <td>{{ $data['jenis_transaksi'] }}</td>
                <td>{{ $data['masuk'] }}</td>
                <td>{{ $data['keluar'] }}</td>
                <td>{{ $data['stock'] }}</td>
                <td>{{ $data['masuk pada tanggal'] }}</td>
                <td>{{ $data['id_transaksi'] }}</td>
                <td>{{ $data['id_barang'] }}</td>
                <td>{{ $data['nama_barang'] }}</td>
                <td>{{ $data['nama_vendor'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
