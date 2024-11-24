@extends('layout.main')

@section('content')
<div class="card">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Daftar Barang yang Sudah Diretur</h5>

                {{-- Tampilkan pesan sukses jika ada --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tampilkan tabel daftar retur --}}
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>ID Retur</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Retur</th>
                                <th>Alasan Retur</th>
                                <th>Tanggal Retur</th>
                                <th>Penerimaan ID</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($returs as $retur)
                                <tr>
                                    <td>{{ $retur['id_retur'] }}</td>
                                    <td>{{ $retur['nama_barang'] }}</td>
                                    <td>{{ $retur['jumlah'] }}</td>
                                    <td>{{ $retur['alasan'] }}</td>
                                    <td>{{ $retur['created_at'] }}</td>
                                    <td>{{ $retur['id_penerimaan'] }}</td>
                                    <td>{{ $retur['username'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
