@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h2>Summary</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Penjualan</h5>
                    <p class="card-text">{{ $summaryPenjualan['total_penjualan'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Pendapatan</h5>
                    <p class="card-text">{{ $summaryPenjualan['total_pendapatan'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Profit</h5>
                    <p class="card-text">{{ $summaryPenjualan['total_profit'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Pengadaan</h5>
                    <p class="card-text">{{ $totalPengadaan['total_pengadaan'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Retur</h5>
                    <p class="card-text">{{ $totalRetur['total_retur'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Penerimaan</h5>
                    <p class="card-text">{{ $totalPenerimaan['total_penerimaan'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
