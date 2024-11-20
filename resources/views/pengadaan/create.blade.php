@extends('layout.main')
@section('content')
<div class="card">
    <div class="container-fluid">
        <div class="row">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Buat Pengadaan Baru</h5>
                
                {{-- Display Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                
                <form action="{{ route('pengadaan.store') }}" method="POST">
                    @csrf

                    {{-- Pilih Vendor --}}
                    <div class="mb-3">
                        <label for="vendor_id" class="form-label">Vendor</label>
                        <select name="vendor_id" id="vendor_id" class="form-control">
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor['id_vendor'] }}">{{ $vendor['nama_vendor'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <h5 class="fw-semibold mb-3">Barang</h5>
                    <div id="barang-wrapper">
                        <div class="row barang-item">
                            <div class="col-md-3 mb-3">
                                <label>Barang</label>
                                <select class="form-control barang-select" name="barang[0][id_barang]" onchange="updateHarga(this)">
                                    <option value="">Pilih Barang</option>
                                    @foreach($barang as $item)
                                        <option value="{{ $item['id_barang'] }}" data-harga="{{ $item['harga'] }}">{{ $item['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Harga Satuan</label>
                                <input type="number" name="barang[0][harga]" class="form-control harga-satuan" readonly>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Jumlah</label>
                                <input type="number" name="barang[0][quantity]" class="form-control quantity" oninput="updateSubtotal(this)">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Subtotal</label>
                                <input type="number" name="barang[0][subtotal]" class="form-control subtotal" readonly>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="addBarang()">Tambah Barang</button>

                    {{-- Total Subtotal Pengadaan --}}
                    <div class="mb-3 mt-3">
                        <label for="subtotal" class="form-label">Subtotal Total</label>
                        <input type="number" name="subtotal" id="subtotal" class="form-control" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Pengadaan</button>
                </form>
            </div>
        </div>

        {{-- Kolom Daftar Pengadaan --}}
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Pengadaan</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Vendor</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Total Nilai</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengadaans as $pengadaan)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $pengadaan['id_pengadaan'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $pengadaan['nama_vendor'] }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $pengadaan['total_nilai'] }}</h6></td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('penerimaan.create', $pengadaan['id_pengadaan']) }}" class="btn btn-primary btn-sm">Terima Barang</a>
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

<script>
    let barangIndex = 1;

    function addBarang() {
        const wrapper = document.getElementById('barang-wrapper');
        const newItem = document.querySelector('.barang-item').cloneNode(true);
        newItem.querySelectorAll('select, input').forEach(input => {
            input.name = input.name.replace('[0]', `[${barangIndex}]`);
            if (input.classList.contains('harga-satuan') || input.classList.contains('subtotal')) {
                input.value = '';
            }
        });
        wrapper.appendChild(newItem);
        barangIndex++;
    }

    function updateHarga(select) {
        const harga = select.selectedOptions[0].getAttribute('data-harga');
        const parent = select.closest('.barang-item');
        parent.querySelector('.harga-satuan').value = harga;
        updateSubtotal(parent.querySelector('.quantity'));
    }

    function updateSubtotal(quantityInput) {
        const parent = quantityInput.closest('.barang-item');
        const harga = parseFloat(parent.querySelector('.harga-satuan').value) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        const subtotal = harga * quantity;
        parent.querySelector('.subtotal').value = subtotal;
        updateTotalSubtotal();
    }

    function updateTotalSubtotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(subtotalInput => {
            total += parseFloat(subtotalInput.value) || 0;
        });
        document.getElementById('subtotal').value = total;
    }
</script>
@endsection
