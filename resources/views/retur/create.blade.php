@extends('layout.main')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Form Retur Barang untuk Penerimaan ID: {{ $id_penerimaan }}</h4>

        {{-- Cek jika semua barang sudah di retur --}}
        @php
            $semuaBarangSudahRetur = true;
        @endphp

        @foreach ($barangItems as $item)
            @if (($item['jumlah_retur_sebelumnya'] ?? 0) < $item['jumlah_terima'])
                @php
                    $semuaBarangSudahRetur = false;
                @endphp
                @break
            @endif
        @endforeach

        @if ($semuaBarangSudahRetur)
            <div class="alert alert-success">
                Semua barang sudah di retur.
            </div>
        @else
            {{-- Display Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('retur.store', $id_penerimaan) }}" method="POST">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah Diterima</th>
                            <th>Jumlah Retur Sebelumnya</th>
                            <th>Jumlah Retur Baru</th>
                            <th>Alasan Retur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangItems as $item)
                            <tr>
                                <td>{{ $item['nama_barang'] }}</td>
                                <td>{{ $item['jumlah_terima'] }}</td>
                                <td>{{ $item['jumlah_retur_sebelumnya'] ?? 0 }}</td> {{-- Menampilkan jumlah retur sebelumnya --}}
                                <td>
                                    <input type="number"
                                           name="barang[{{ $item['id_detail_penerimaan'] }}][jumlah_retur]"
                                           class="form-control"
                                           min="1"
                                           max="{{ $item['jumlah_terima'] - ($item['jumlah_retur_sebelumnya'] ?? 0) }}"
                                           placeholder="Jumlah retur">
                                </td>
                                <td>
                                    <input type="text"
                                           name="barang[{{ $item['id_detail_penerimaan'] }}][alasan]"
                                           class="form-control"
                                           placeholder="Masukkan alasan retur">
                                </td>
                            </tr>
                            <input type="hidden" name="barang[{{ $item['id_detail_penerimaan'] }}][id_barang]" value="{{ $item['barang_id_barang'] }}">
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Simpan Retur</button>
            </form>
        @endif
    </div>
</div>
@endsection
