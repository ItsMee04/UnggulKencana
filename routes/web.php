<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Pegawai\PegawaiController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Produk\JenisController;
use App\Http\Controllers\Produk\NampanController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Transaksi\POSController;
use App\Http\Controllers\User\UserController;
use App\Models\Role;

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
    Route::post('nampan', [NampanController::class, 'store']);
    Route::post('nampan/{id}', [NampanController::class, 'update']);
    Route::get('delete-nampan/{id}', [NampanController::class, 'delete']);

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

    Route::get('pos', [POSController::class, 'index']);
    Route::get('pos/getItem/{id}', [POSController::class, 'getItem']);

    Route::get('logout', [AuthController::class, 'logout']);
});
