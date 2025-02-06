<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\KatsudoController;
use App\Http\Controllers\KeaktifanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
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

Route::group(['middleware'=>['guest']], function(){
    Route::get('login', [UserController::class, 'indexLogin'])->name('login');
    Route::post('login', [UserController::class, 'login']);

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
    Route::resource('/pengurus', PengurusController::class)->except('show');
    Route::get('/daftar/{nisn}/edit', [PendaftarController::class, 'edit'])->name('daftar.edit');
    Route::resource('setting', SettingController::class)->except('update');
    Route::post('setting/update', [SettingController::class, 'update'])->name('setting.update');

    Route::get('/status/{tahun?}', [StatusController::class, 'fadmin'])->name('status.fadmin')->defaults('tahun', Setting::where('NamaSetting', 'Tahun')->first()->Value);
    Route::get('/status/ubah/{pendaftarId}/{statusId}',[StatusController::class, 'ubahstatus'])->name('status.ubahstatus');

    Route::get('/departemen/{tahun?}', [DepartemenController::class, 'fadmin'])->name('departemen.fadmin')->defaults('tahun', Setting::where('NamaSetting', 'Tahun')->first()->Value);
    Route::get('/departemen/ubah/{pendaftarId}/{departemenId}',[DepartemenController::class, 'ubahdepartemen'])->name('departemen.ubahdepartemen');
    Route::get('/departemen/koor/{pendaftarId}/{departemenId}',[DepartemenController::class, 'ubahkoor'])->name('departemen.ubahkoor');
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



