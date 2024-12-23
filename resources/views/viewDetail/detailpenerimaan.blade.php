@extends('layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Detail Penerimaan --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Detail Penerimaan</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Detail Penerimaan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Barang</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Jumlah Terima</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Harga Satuan Terima</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Sub Total Terima</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Penerimaan</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detailpenerimaan as $item)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $item['id_detail_penerimaan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['nama_barang'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['jumlah_terima'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['harga_satuan_terima'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['sub_total_terima'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['id_penerimaan'] }}</h6></td>
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
