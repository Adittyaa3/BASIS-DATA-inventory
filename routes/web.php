<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PengadaanPenerimaanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailPengadaanController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\KartuStockController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\MarginController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('layout.main');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang hanya bisa diakses jika user sudah login
Route::middleware(['auth.user'])->group(function () {
//role
Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('/role/create', [RoleController::class, 'create']);
Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
Route::post('/role/{id}/update', [RoleController::class, 'update'])->name('role.update');
Route::post('/role/{id}/delete', [RoleController::class, 'delete'])->name('role.delete');
//user
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::post('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
// vendor
Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendor/store', [VendorController::class, 'store'])->name('vendor.store');
Route::get('/vendor/{id}/edit', [VendorController::class, 'edit'])->name('vendor.edit');
Route::post('/vendor/{id}/update', [VendorController::class, 'update'])->name('vendor.update');
Route::post('/vendor/{id}/delete', [VendorController::class, 'delete'])->name('vendor.delete');

//barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}/update', [BarangController::class, 'update'])->name('barang.update');
Route::post('/barang/{id}/delete', [BarangController::class, 'delete'])->name('barang.delete');
// satuan
Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
Route::get('/satuan/create', [SatuanController::class, 'create'])->name('satuan.create');
Route::post('/satuan/store', [SatuanController::class, 'store'])->name('satuan.store');
Route::get('/satuan/{id}/edit', [SatuanController::class, 'edit'])->name('satuan.edit');
Route::post('/satuan/{id}/update', [SatuanController::class, 'update'])->name('satuan.update');
Route::post('/satuan/{id}/delete', [SatuanController::class, 'delete'])->name('satuan.delete');

// Route untuk menampilkan form pengadaan
Route::get('/pengadaan/create', [PengadaanPenerimaanController::class, 'createPengadaan'])->name('pengadaan.create');
Route::post('/pengadaan', [PengadaanPenerimaanController::class, 'storePengadaan'])->name('pengadaan.store');
Route::get('/pengadaan', [PengadaanPenerimaanController::class, 'indexPengadaan'])->name('pengadaan.index');
Route::get('/pengadaan/{id}/detail', [PengadaanPenerimaanController::class, 'detailPengadaan'])->name('pengadaan.detail');
Route::get('/pengadaan/{id}/terima', [PengadaanPenerimaanController::class, 'createPenerimaan'])->name('penerimaan.create');
Route::post('/pengadaan/{id}/terima', [PengadaanPenerimaanController::class, 'storePenerimaan'])->name('penerimaan.store');

Route::get('/pengadaan/detail2', [PengadaanPenerimaanController::class, 'listdetailPengadaan'])->name('pengadaan.detailall');
Route::get('/penerimaan/detail2', [PengadaanPenerimaanController::class, 'listdetailPenerimaanView'])->name('penerimaan.detailall');

Route::get('view/penerimaan', [PengadaanPenerimaanController::class, 'indexPenerimaan'])->name('penerimaan.index');


// retur

// Route::get('/retur/create/{id_penerimaan}', [ReturController::class, 'create'])->name('retur.create');

// // Route untuk menampilkan form retur
// // Route::get('/retur/create/{id_penerimaan}', [ReturController::class, 'create'])->name('retur.create');

// // Route untuk menyimpan data retur
// Route::post('/retur/store/{id_penerimaan}', [ReturController::class, 'store'])->name('retur.store');

// // Route untuk menampilkan daftar retur
Route::get('/retur', [ReturController::class, 'index'])->name('retur.index');


Route::get('retur/create/{id_penerimaan}', [ReturController::class, 'create'])->name('retur.create');
Route::post('retur/store/{id_penerimaan}', [ReturController::class, 'store'])->name('retur.store');
Route::get('detail/retur', [ReturController::class, 'detailReturView'])->name('retur.detail');

// kartu stock
Route::get('/kartu-stok', [KartuStockController::class, 'indexKartuStok'])->name('kartuStok.index');
Route::get('/kartu-stok2', [KartuStockController::class, 'indexKartuStok2'])->name('kartuStok2.index');
Route::get('/daftar/penjualan', [KartuStockController::class, 'daftarpenjualan'])->name('penjualan.index');
Route::get('/daftar/summary', [KartuStockController::class, 'indexSummary'])->name('summary.index');


Route::get('penjualan/create', [PenjualanController::class, 'index'])->name('penjualan.create');
Route::post('penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');





Route::resource('margin', MarginController::class);
});

