@extends('layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Daftar Penjualan --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Penjualan</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Penjualan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Tanggal Penjualan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Barang</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Total Harga Penjualan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Margin Persen</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualan as $data)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['id_penjualan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['tanggal_penjualan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['barang'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['total_harga_penjualan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data['margin_persen'] }}%</h6></td>
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
