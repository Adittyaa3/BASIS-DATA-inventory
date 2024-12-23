@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h2>Buat Penjualan Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf

        {{-- Pilih Barang --}}
        <div class="mb-3">
            <label for="barang" class="form-label">Barang</label>
            <div id="barang-wrapper">
                <div class="barang-item">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Barang</label>
                            <select name="id_barang[]" class="form-control barang-select" onchange="updateHarga(this)">
                                <option value="">Pilih Barang</option>
                                @foreach($barang as $item)
                                    <option value="{{ $item['id_barang'] }}" data-harga="{{ $item['harga'] }}">{{ $item['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Harga Satuan</label>
                            <input type="number" name="harga_satuan[]" class="form-control harga-satuan" readonly>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah[]" class="form-control quantity" oninput="updateSubtotal(this)" min="1">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Subtotal</label>
                            <input type="number" name="subtotal[]" class="form-control subtotal" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" onclick="addBarang()">Tambah Barang</button>
        </div>

        {{-- Margin Penjualan --}}
        <div class="mb-3">
            <label for="margin" class="form-label">Margin Penjualan</label>
            <select name="margin" id="margin" class="form-control">
                @foreach($margin as $item)
                    <option value="{{ $item['id_margin_penjualan'] }}">{{ $item['persen'] }}%</option>
                @endforeach
            </select>
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    function updateHarga(select) {
        const harga = select.options[select.selectedIndex].getAttribute('data-harga');
        const parent = select.closest('.barang-item');
        parent.querySelector('.harga-satuan').value = harga;
        updateSubtotal(parent.querySelector('.quantity'));
    }

    function updateSubtotal(input) {
        const parent = input.closest('.barang-item');
        const harga = parent.querySelector('.harga-satuan').value;
        const jumlah = input.value;
        const subtotal = parent.querySelector('.subtotal');
        subtotal.value = harga * jumlah;
        updateTotal();
    }

    function updateTotal() {
        let subtotalNilai = 0;
        document.querySelectorAll('.subtotal').forEach(subtotal => {
            subtotalNilai += parseFloat(subtotal.value) || 0;
        });
        document.getElementById('subtotal_nilai').value = subtotalNilai;

        const ppn = subtotalNilai * 0.11; // PPN 10%
        document.getElementById('ppn').value = ppn;

        const totalNilai = subtotalNilai + ppn;
        document.getElementById('total_nilai').value = totalNilai;
    }

    function addBarang() {
        const barangWrapper = document.getElementById('barang-wrapper');
        const barangItems = barangWrapper.querySelectorAll('.barang-item');
        const newIndex = barangItems.length;

        const newBarangItem = document.createElement('div');
        newBarangItem.classList.add('barang-item');
        newBarangItem.innerHTML = `
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>Barang</label>
                    <select name="id_barang[${newIndex}]" class="form-control barang-select" onchange="updateHarga(this)">
                        <option value="">Pilih Barang</option>
                        @foreach($barang as $item)
                            <option value="{{ $item['id_barang'] }}" data-harga="{{ $item['harga'] }}">{{ $item['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Harga Satuan</label>
                    <input type="number" name="harga_satuan[${newIndex}]" class="form-control harga-satuan" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah[${newIndex}]" class="form-control quantity" oninput="updateSubtotal(this)" min="1">
                </div>
                <div class="col-md-2 mb-3">
                    <label>Subtotal</label>
                    <input type="number" name="subtotal[${newIndex}]" class="form-control subtotal" readonly>
                </div>
            </div>
        `;
        barangWrapper.appendChild(newBarangItem);
    }
</script>
@endsection
