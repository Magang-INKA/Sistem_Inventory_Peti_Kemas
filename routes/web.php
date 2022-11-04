<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\MasterContainerController;
use App\Http\Controllers\MasterKapalController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PelabuhanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TransaksiController;
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

Route::get('/tracking', [TrackingController::class,'tracking']);

Route::get('/', [DashboardController::class,'index'])->name('home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

Route::resource('transaksi', TransaksiController::class);
Route::get('/laporan/transaksi', [TransaksiController::class, 'laporan']);
Route::get('/laporan/transaksi/excel', [TransaksiController::class, 'laporanExcel']);

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

Route::resource('booking', BookingController::class);
Route::get('/StatusBooking', [BookingController::class, 'store']);
Route::get('/laporan/booking', [BookingController::class, 'laporan']);
Route::get('/laporan/booking/excel', [BookingController::class, 'laporanExcel']);
Route::get('/create', [BookingController::class, 'create']);
Route::get('/create2', [BookingController::class, 'create2']);

Route::resource('kapal', KapalController::class);

Route::resource('pelabuhan', PelabuhanController::class);
Route::get('/laporan/pelabuhan', [PelabuhanController::class, 'laporan']);
Route::get('/laporan/pelabuhan/excel', [PelabuhanController::class, 'laporanExcel']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('dashboard', DashboardController::class);
Route::get('/history', [DashboardController::class, 'history']);
Route::get('/history/{id}', [DashboardController::class, 'historyDetail'])->name('show.history');
Route::get('/controlling', [DashboardController::class, 'controlling']);


Route::group(['middleware' => 'auth'], function () {
    Route::post('booking/create-step-one', [BookingController::class,'postCreateStepOne'])->name('booking.create.step.one.post');
    Route::post('booking/create-step-two', [BookingController::class,'postCreateStepTwo'])->name('booking.create.step.two.post');
});
// Route::get('booking/create-step-one',[BookingController::class,'create'])->name('booking.create.step.one');
// Route::post('booking/create-step-one', 'FormBookingController@postCreateStepOne')->name('booking.create.step.one.post');

// Route::get('/create-step-two', 'FormBookingController@createStepTwo')->name('formBooking.create.step.two');
// Route::post('/create-step-two', 'FormBookingController@postCreateStepTwo')->name('booking.create.step.two.post');

// Route::get('/create-step-three', 'FormBookingController@createStepThree')->name('booking.create.step.three');
// Route::post('/create-step-three', 'FormBookingController@postCreateStepThree')->name('booking.create.step.three.post');
