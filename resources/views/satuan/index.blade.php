@extends('layout.main')
@section('content')
<div class="card">
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah satuan</h5>
            <form action="{{ route('satuan.store') }}" method="POST">
                @csrf
                {{-- Nama Barang Field --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama satuan</label>
                    <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" required>
                </div>

                {{-- Status Dropdown --}}

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
        </div>

        {{-- Kolom Daftar Satuan --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Satuan</h5>
                    <a href="{{ route('satuan.create') }}" class="btn btn-success mb-3">Tambah Satuan</a>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Satuan</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($satuans as $satuan)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $satuan['id_satuan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $satuan['nama_satuan'] }}</h6></td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">
                                            <span class="badge {{ $satuan['status'] == 1 ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $satuan['status'] == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('satuan.edit', $satuan['id_satuan']) }}" class="btn btn-primary btn-sm">Edit</a>
                                        
                                        @if($satuan['status'] == 1)
                                            <form action="{{ route('satuan.delete', $satuan['id_satuan']) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        @else
                                            <form action="{{ route('satuan.restore', $satuan['id_satuan']) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">Restore</button>
                                            </form>
                                        @endif
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
