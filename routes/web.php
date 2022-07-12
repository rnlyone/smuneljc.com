<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
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

});

Route::get('/daftar', [PendaftarController::class, 'coming_soon']);
Route::resource('/daftar', PendaftarController::class)->except('index');
Route::post('kirimpesan', [FrontController::class, 'kirimpesan']);

Route::group(['middleware' => ['auth']], function(){
    Route::get('dash', [UserController::class, 'indexDash']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('/pendaftar', [PendaftarController::class, 'index']);
    Route::resource('setting', SettingController::class);
});

Route::get('/', [FrontController::class, 'welcome']);



