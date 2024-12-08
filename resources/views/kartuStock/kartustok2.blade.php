@extends('layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Daftar Barang --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Barang</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Barang</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Barang</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Total Masuk</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Total Keluar</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Total Stok</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kartuStokData as $data)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['id_barang'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['nama'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['total_masuk'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['total_keluar'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['total_stok'] }}</h6></td>
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
