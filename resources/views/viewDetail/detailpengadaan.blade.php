@extends('layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Detail Pengadaan --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Detail Pengadaan</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Detail Pengadaan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Barang</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Harga Satuan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Jumlah</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Sub Total</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detailpengadaan as $item)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $item['id_detail_pengadaan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['nama_barang'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['harga_satuan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['jumlah'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $item['sub_total'] }}</h6></td>
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
