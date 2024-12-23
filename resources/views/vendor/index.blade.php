@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Daftar Vendor --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Vendor</h5>
                    <a href="{{ route('vendor.create') }}" class="btn btn-success mb-3">Tambah Vendor</a>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Vendor</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Badan Hukum</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendors as $vendor)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $vendor['id_vendor'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $vendor['nama_vendor'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $vendor['badan_hukum'] == 'Y' ? 'Ya' : 'Tidak' }}</h6></td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">
                                            <span class="badge {{ $vendor['status'] == 1 ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $vendor['status'] == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('vendor.edit', $vendor['id_vendor']) }}" class="btn btn-primary btn-sm">Edit</a>

                                        @if($vendor['status'] == 1)
                                            <form action="{{ route('vendor.delete', $vendor['id_vendor']) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        @else
                                            <form action="{{ route('vendor.restore', $vendor['id_vendor']) }}" method="POST" style="display:inline">
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
