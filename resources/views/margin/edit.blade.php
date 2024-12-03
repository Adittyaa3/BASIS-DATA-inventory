@extends('layout.main')

@section('content')
<div class="container">
    <h1 class="mt-4">Edit Margin Penjualan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('margin.update', $margin->id_margin_penjualan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="persen" class="form-label">Persen</label>
            <input type="number" class="form-control" id="persen" name="persen" value="{{ $margin->persen }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" {{ $margin->status ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ !$margin->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
