@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h2>Total Baris Penjualan</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Total Baris Penjualan</h5>
            <p class="card-text">Total baris untuk penjualan ini adalah: {{ $totalBaris }}</p>
        </div>
    </div>
</div>
@endsection
