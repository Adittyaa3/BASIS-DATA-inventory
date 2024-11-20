@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Daftar Barang --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Barang</h5>
                    <a href="{{ route('barang.create') }}" class="btn btn-success mb-3">Tambah Barang</a>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Jenis</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Satuan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Harga</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangs as $barang)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $barang['id_barang'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $barang['jenis'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $barang['nama'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $barang['nama_satuan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $barang['harga'] }}</h6></td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('barang.edit', $barang['id_barang']) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('barang.delete', $barang['id_barang']) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
