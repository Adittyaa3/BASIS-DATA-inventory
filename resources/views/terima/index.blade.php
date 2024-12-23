@extends('layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar Penerimaan Barang</h5>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Pengadaan</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID Penerimaan</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Barang</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Jumlah Dipesan</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Jumlah Diterima Total</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Jumlah Diterima Sekarang</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Sisa Barang</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status Penerimaan</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">User Penerima</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Tanggal Penerimaan</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPenerimaan as $penerimaan)
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $penerimaan['id_pengadaan'] }}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $penerimaan['id_penerimaan'] }}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $penerimaan['nama_barang'] }}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $penerimaan['jumlah_dipesan'] }}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $penerimaan['jumlah_diterima_total'] }}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $penerimaan['jumlah_terima_sekarang'] }}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $penerimaan['jumlah_sisa'] }}</h6></td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">
                                    <span class="badge {{ $penerimaan['status_penerimaan'] == 'Semua Barang Diterima' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $penerimaan['status_penerimaan'] }}
                                    </span>
                                </h6>
                            </td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $penerimaan['user_penerima'] }}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $penerimaan['tanggal_penerimaan'] }}</h6></td>
                            <td class="border-bottom-0">
                                <a href="{{ route('retur.create', ['id_penerimaan' => $penerimaan['id_penerimaan']]) }}" class="btn btn-primary btn-sm">Retur</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
