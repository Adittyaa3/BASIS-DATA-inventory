@extends('layout.main')

@section('content')
<div class="container">
    <h2>Daftar Pengadaan</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Vendor</th>
            <th>Total Nilai</th>
            <th>Aksi</th>
        </tr>
        @foreach($pengadaans as $pengadaan)
            <tr>
                <td>{{ $pengadaan['id_pengadaan'] }}</td>
                <td>{{ $pengadaan['nama_vendor'] }}</td>
                <td>{{ $pengadaan['total_nilai'] }}</td>
                <td>
                    <a href="{{ route('penerimaan.create', $pengadaan['id_pengadaan']) }}">Terima Barang</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
