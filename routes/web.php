<?php

use App\Models\Role;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Produk\JenisController;
use App\Http\Controllers\Produk\NampanController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Transaksi\POSController;
use App\Http\Controllers\Pegawai\PegawaiController;
use App\Http\Controllers\Transaksi\DiskonController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Transaksi\KeranjangController;
use App\Http\Controllers\Transaksi\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->middleware('cekLogin');

Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('cekLogin');
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('pegawai', [PegawaiController::class, 'index']);
    Route::post('pegawai', [PegawaiController::class, 'store']);
    Route::post('pegawai/{id}', [PegawaiController::class, 'update']);
    Route::get('delete-pegawai/{id}', [PegawaiController::class, 'delete']);

    Route::get('user', [UserController::class, 'index']);
    Route::post('user/{id}', [UserController::class, 'store']);

    Route::get('jenis', [JenisController::class, 'index']);
    Route::post('jenis', [JenisController::class, 'store']);
    Route::post('jenis/{id}', [JenisController::class, 'update']);
    Route::get('delete-jenis/{id}', [JenisController::class, 'delete']);

    Route::get('nampan', [NampanController::class, 'index']);
    Route::post('produkNampan/{id}', [NampanController::class, 'storeNampan']);
    Route::post('nampan', [NampanController::class, 'store']);
    Route::get('nampan/{id}', [NampanController::class, 'show']);
    Route::post('nampan/{id}', [NampanController::class, 'update']);
    Route::get('delete-nampan/{id}', [NampanController::class, 'delete']);
    Route::get('delete-nampan-produk/{id}', [NampanController::class, 'deleteNampan']);

    Route::get('produk', [ProdukController::class, 'index']);
    Route::get('produk/{id}', [ProdukController::class, 'show']);
    Route::post('produk', [ProdukController::class, 'store']);
    Route::post('produk/{id}', [ProdukController::class, 'update']);
    Route::get('delete-produk/{id}', [ProdukController::class, 'delete']);

    Route::get('pelanggan', [PelangganController::class, 'index']);
    Route::post('pelanggan', [PelangganController::class, 'store']);
    Route::post('pelanggan/{id}', [PelangganController::class, 'update']);
    Route::get('delete-pelanggan/{id}', [PelangganController::class, 'delete']);

    Route::get('supplier', [SupplierController::class, 'index']);
    Route::post('supplier', [SupplierController::class, 'store']);
    Route::post('supplier/{id}', [SupplierController::class, 'update']);
    Route::get('delete-supplier/{id}', [SupplierController::class, 'delete']);

    Route::get('diskon', [DiskonController::class, 'index']);
    Route::post('diskon', [DiskonController::class, 'store']);
    Route::post('diskon/{id}', [DiskonController::class, 'update']);
    Route::get('delete-diskon/{id}', [DiskonController::class, 'delete']);

    Route::get('pos', [POSController::class, 'index']);
    Route::get('pos/fetchAllItem', [POSController::class, 'fetchAllItem']);
    Route::get('pos/{id}', [POSController::class, 'getItem']);
    Route::post('pos/cek/{id}', [KeranjangController::class, 'cekItem']);
    Route::post('pos/{id}', [KeranjangController::class, 'saveItem']);
    Route::get('getKeranjang', [KeranjangController::class, 'index']);
    Route::delete('delete-keranjang/{id}', [KeranjangController::class, 'deleteKeranjang']);
    Route::get('getCount', [KeranjangController::class, 'getCount']);
    Route::delete('deleteAllKeranjang', [KeranjangController::class, 'deleteAllKeranjang']);
    Route::get('totalHargaKeranjang', [KeranjangController::class, 'totalHargaKeranjang']);
    Route::get('getKodeKeranjang', [KeranjangController::class, 'getKodeKeranjang']);
    Route::post('payment', [KeranjangController::class, 'payment']);

    Route::get('order', [TransaksiController::class, 'index']);
    Route::get('order/{id}', [TransaksiController::class, 'detailOrder']);
    Route::get('confirmPayment/{id}', [TransaksiController::class, 'confirmPayment']);

    Route::get('NotaBarang/{id}', [ReportController::class, 'cetakNotaBarang']);

    Route::get('logout', [AuthController::class, 'logout']);
});
