@extends('layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Detail Retur --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Detail Retur</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Detail Retur</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Barang</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Jumlah</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Alasan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Detail Penerimaan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Retur</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detailretur as $item)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $item['id_detail_retur'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['nama_barang'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['jumlah'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['alasan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['id_detail_penerimaan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['id_retur'] }}</h6></td>
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
