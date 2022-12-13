<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\DroppointController;
use App\Http\Controllers\JadwalKapalController;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\MasterContainerController;
use App\Http\Controllers\MasterKapalController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PelabuhanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\ThresholdSuhuController;
use App\Models\DropPoint;
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

Route::get('/tracking', [TrackingController::class,'tracking']);

// Route::get('/', [DashboardController::class,'index'])->name('home');
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role != 'Client') {
            return redirect('/dashboard');
        }
        return redirect('/booking');
    }
    return view('LandingPage');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('container', ContainerController::class);
Route::get('/laporan/container', [ContainerController::class, 'laporan']);
Route::get('/laporan/container/excel', [ContainerController::class, 'laporanExcel']);

Route::resource('masterContainer', MasterContainerController::class);
Route::get('/laporan/masterContainer', [MasterContainerController::class, 'laporan']);
Route::get('/laporan/masterContainer/excel', [MasterContainerController::class, 'laporanExcel']);

Route::resource('masterKapal', MasterKapalController::class);
Route::get('/laporan/masterKapal', [MasterKapalController::class, 'laporan']);
Route::get('/laporan/masterKapal/excel', [MasterKapalController::class, 'laporanExcel']);

Route::resource('barang', BarangController::class);
Route::get('/laporan/barang', [BarangController::class, 'laporan']);
Route::get('/laporan/barang/excel', [BarangController::class, 'laporanExcel']);

Route::resource('JenisBarang', JenisBarangController::class);

Route::resource('transaksi', TransaksiController::class);
Route::get('/laporan/transaksi', [TransaksiController::class, 'laporan']);
Route::get('/laporan/transaksi/excel', [TransaksiController::class, 'laporanExcel']);

Route::resource('user', UserController::class);
Route::get('/laporan/user', [UserController::class, 'laporan']);
Route::get('/laporan/user/excel', [UserController::class, 'laporanExcel']);
Route::get('password/user/{id}', [UserController::class, 'EditPassword'])->name('user.edit.password');
Route::post('password/user/{id}', [UserController::class, 'UpdatePassword'])->name('user.update.password');

Route::resource('profile', ProfileController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::get('password/{id}', [PasswordController::class, 'edit'])->name('edit.password');
    Route::post('password/{id}', [PasswordController::class, 'update'])->name('update.password');
});

Auth::routes();

Route::resource('booking', BookingController::class);
Route::get('/StatusBooking', [BookingController::class, 'store']);
Route::get('/laporan/booking', [BookingController::class, 'laporan']);
Route::get('/laporan/booking/excel', [BookingController::class, 'laporanExcel']);
Route::get('/create', [BookingController::class, 'create']);
Route::get('/create2', [BookingController::class, 'create2']);

Route::resource('pelabuhan', PelabuhanController::class);
Route::get('/laporan/pelabuhan', [PelabuhanController::class, 'laporan']);
Route::get('/laporan/pelabuhan/excel', [PelabuhanController::class, 'laporanExcel']);

Route::resource('JadwalKapal', JadwalKapalController::class);
Route::resource('trip', TripController::class);
Route::get('/laporan/trip', [TripController::class, 'laporan']);
Route::get('/laporan/trip/excel', [TripController::class, 'laporanExcel']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('dashboard', DashboardController::class);
Route::get('/history', [DashboardController::class, 'history']);
Route::get('/history/{id}', [DashboardController::class, 'historyDetail'])->name('show.history');
Route::get('/controlling', [DashboardController::class, 'controlling']);
Route::resource('threshold-suhu', ThresholdSuhuController::class);

Route::group(['middleware' => 'auth'], function () {
    Route::post('booking/create-step-one', [BookingController::class,'postCreateStepOne'])->name('booking.create.step.one.post');
    Route::post('booking/create-step-two', [BookingController::class,'postCreateStepTwo'])->name('booking.create.step.two.post');
});


//Select2 dependency dropdown
Route::get('/pelabuhan1', [\App\Http\Controllers\BookingController::class, 'select'])->name('pelabuhan1.select');
Route::get('/pelabuhan2', [\App\Http\Controllers\BookingController::class, 'select2'])->name('pelabuhan2.select');
Route::get('/jadwal-kapal', [\App\Http\Controllers\BookingController::class, 'select3'])->name('jadwalkapal.select');

Route::get('/resi/{id}', [TransaksiController::class, 'resi'])->name('resi');
Route::get('/cekResi', [TransaksiController::class, 'cekResi'])->name('cekResi');

//drop point
Route::resource('droppoint', DroppointController::class);
