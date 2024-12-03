@extends('layout.main')

@section('content')
 {{-- Kolom Tambah Margin --}}
 <div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Margin Penjualan</h5>
                <form action="{{ route('margin.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="persen" class="form-label">Persen</label>
                        <input type="number" class="form-control" id="persen" name="persen" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
{{-- AWAL CONTAINER --}}
<div class="container-fluid">
    <div class="row">
        {{-- Kolom Margin Penjualan --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Margin Penjualan</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Persen</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">User</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Created At</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Updated At</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($margins as $margin)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $margin->id_margin_penjualan }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $margin->persen }}%</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $margin->status ? 'Active' : 'Inactive' }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $margin->id_user }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $margin->created_at }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-1">{{ $margin->updated_at }}</h6></td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('margin.edit', $margin->id_margin_penjualan) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('margin.destroy', $margin->id_margin_penjualan) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
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

@endsection
