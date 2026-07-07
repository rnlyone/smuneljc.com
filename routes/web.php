<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InovasiController;
use App\Http\Controllers\KatsudoController;
use App\Http\Controllers\KeaktifanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Models\Pendaftar;
use App\Models\Setting;
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

// Admin login — hanya cek guard 'web'
Route::group(['middleware' => ['guest:web']], function () {
    Route::get('login', [UserController::class, 'indexLogin'])->name('login');
    Route::post('login', [UserController::class, 'login']);
});

// Katsudo (pendaftar) login — hanya cek guard 'pendaftar'
Route::group(['middleware' => ['guest:pendaftar']], function () {
    Route::get('/ktd/login', [PendaftarController::class, 'flogin'])->name('flogin');
    Route::post('/ktd/login', [PendaftarController::class, 'login'])->name('klogin');
});

Route::get('/daftar', [PendaftarController::class, 'indexForm'])->name('daftar.form');
Route::resource('/daftar', PendaftarController::class)->except('index', 'destroy', 'update', 'edit', 'show');
Route::get('/daftar/{nisn}/destroy', [PendaftarController::class, 'destroy'])->name('daftar.destroy');
Route::post('/daftar/{nisn}/pinauth', [PendaftarController::class, 'pinauth'])->name('daftar.pinauth');
Route::post('/daftar/{nisn}/update', [PendaftarController::class, 'update'])->name('daftar.update');
Route::post('kirimpesan', [FrontController::class, 'kirimpesan']);

Route::group(['middleware' => ['auth']], function(){
    Route::get('dash', [UserController::class, 'indexDash']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('/pendaftar', [PendaftarController::class, 'index'])->name('daftar.index');
    Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
    Route::post('/galeri', [GalleryController::class, 'store'])->name('galeri.store');
    Route::post('/galeri/{id}/update', [GalleryController::class, 'update'])->name('galeri.update');
    Route::get('/galeri/{id}/destroy', [GalleryController::class, 'destroy'])->name('galeri.destroy');
    Route::resource('/pengurus', PengurusController::class)->except('show');
    Route::get('/daftar/{nisn}/edit', [PendaftarController::class, 'edit'])->name('daftar.edit');
    Route::resource('setting', SettingController::class)->except('update');
    Route::post('setting/update', [SettingController::class, 'update'])->name('setting.update');

    Route::get('/status/{tahun?}', [StatusController::class, 'fadmin'])->name('status.fadmin')->defaults('tahun', Setting::where('NamaSetting', 'Tahun')->first()->Value);
    Route::get('/status/ubah/{pendaftarId}/{statusId}',[StatusController::class, 'ubahstatus'])->name('status.ubahstatus');
    Route::post('/status/bulk', [StatusController::class, 'bulkUbahStatus'])->name('status.bulk');

    Route::get('/departemen/{tahun?}', [DepartemenController::class, 'fadmin'])->name('departemen.fadmin')->defaults('tahun', Setting::where('NamaSetting', 'Tahun')->first()->Value);
    Route::get('/departemen/ubah/{pendaftarId}/{departemenId}',[DepartemenController::class, 'ubahdepartemen'])->name('departemen.ubahdepartemen');
    Route::get('/departemen/koor/{pendaftarId}/{departemenId}',[DepartemenController::class, 'ubahkoor'])->name('departemen.ubahkoor');
    Route::post('/departemen/bulk', [DepartemenController::class, 'bulkUbahdepartemenBulk'])->name('departemen.bulk');

    // Welcome Setting
    Route::get('/welcome-setting', [FrontController::class, 'welcomeSetting'])->name('welcome.setting');
    Route::post('/welcome-setting/inovasi', [InovasiController::class, 'store'])->name('inovasi.store');
    Route::post('/welcome-setting/inovasi/{id}/update', [InovasiController::class, 'update'])->name('inovasi.update');
    Route::get('/welcome-setting/inovasi/{id}/destroy', [InovasiController::class, 'destroy'])->name('inovasi.destroy');
    Route::post('/welcome-setting/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::post('/welcome-setting/testimonial/{id}/update', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::get('/welcome-setting/testimonial/{id}/destroy', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');

    // Katsudo Setting
    Route::get('/katsudo-setting', [PeriodeController::class, 'index'])->name('katsudo.setting');
    Route::post('/katsudo-setting/periode', [PeriodeController::class, 'store'])->name('periode.store');
    Route::post('/katsudo-setting/status', [StatusController::class, 'store'])->name('status.list.store');
    Route::post('/katsudo-setting/status/{id}/update', [StatusController::class, 'updateAdmin'])->name('status.list.update');
    Route::get('/katsudo-setting/status/{id}/destroy', [StatusController::class, 'destroyAdmin'])->name('status.list.destroy');
    Route::post('/katsudo-setting/departemen', [DepartemenController::class, 'storeAdmin'])->name('departemen.list.store');
    Route::post('/katsudo-setting/departemen/{id}/update', [DepartemenController::class, 'updateAdmin'])->name('departemen.list.update');
    Route::get('/katsudo-setting/departemen/{id}/destroy', [DepartemenController::class, 'destroyAdmin'])->name('departemen.list.destroy');
});

Route::group(['middleware' => ['auth:pendaftar']], function(){

    Route::resource('/ktd/katsudo', KatsudoController::class);
    Route::resource('/ktd/activity', ActivityController::class);
    Route::resource('/ktd/keaktifan', KeaktifanController::class);
    Route::resource('/ktd/kehadiran', KehadiranController::class);

    Route::get('/ktd', [FrontController::class, 'katsudohome'])->name('katsudo.home');

    Route::get('/ktd/departemen', [DepartemenController::class, 'dpt'])->name('fdpt');
    Route::get('/ktd/departemen/{dpt}', [DepartemenController::class, 'detail'])->name('dpt.detail');
    Route::get('/ktd/departemen/{dpt}/dash', [DepartemenController::class, 'dashboard'])->name('dpt.dash');
    Route::get('/ktd/logout', [PendaftarController::class, 'logout'])->name('klogout');


    Route::get('/ktd/scan', [KehadiranController::class, 'fscan'])->name('fscan');
    Route::post('/ktd/scan', [KehadiranController::class, 'scan'])->name('scan');
});

Route::get('/offline', function () {return view('laravelpwa::offline');})->name('menufooter');

Route::get('/', [FrontController::class, 'welcome']);



