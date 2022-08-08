<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/forgot-password', function () {
    return view('auth.forget');
});

Route::get('/', [HomeController::class,'index'])->name('home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('kategori', KategoriController::class);
Route::get('/laporan/kategori', [KategoriController::class, 'laporan']);
Route::get('/laporan/kategori/excel', [KategoriController::class, 'laporanExcel']);

Route::resource('barang', BarangController::class);
Route::get('/laporan/barang', [BarangController::class, 'laporan']);
Route::get('/laporan/barang/excel', [BarangController::class, 'laporanExcel']);

Route::resource('supplier', SupplierController::class);
Route::get('/laporan/supplier', [SupplierController::class, 'laporan']);
Route::get('/laporan/supplier/excel', [SupplierController::class, 'laporanExcel']);

Route::resource('user', UserController::class);
Route::get('/laporan/user', [UserController::class, 'laporan']);
Route::get('/laporan/user/excel', [UserController::class, 'laporanExcel']);
Route::get('password/user/{id}', [UserController::class, 'EditPassword'])->name('user.edit.password');
Route::post('password/user/{id}', [UserController::class, 'UpdatePassword'])->name('user.update.password');

Route::resource('BarangKeluar', BarangKeluarController::class);
Route::get('/laporan/BarangKeluar', [BarangKeluarController::class, 'laporan']);
Route::get('/laporan/BarangKeluar/excel', [BarangKeluarController::class, 'laporanExcel']);

Route::resource('BarangMasuk', BarangMasukController::class);
Route::get('/laporan/BarangMasuk', [BarangMasukController::class, 'laporan']);
Route::get('/laporan/BarangMasuk/excel', [BarangMasukController::class, 'laporanExcel']);

Route::resource('profile', ProfileController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::get('password/{id}', [PasswordController::class, 'edit'])->name('edit.password');
    Route::post('password/{id}', [PasswordController::class, 'update'])->name('update.password');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
