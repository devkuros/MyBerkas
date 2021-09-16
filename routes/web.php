<?php

use App\Http\Controllers\Backend\{DashboardController,
    KategoriController,
    LoginController, SuratMasukController};
use App\Http\Controllers\Backend\Fakultas\{FakultasController,
    TeknikIndustriController};
use App\Http\Controllers\Backend\Permission\{PermissionController,
    RoleController};
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest', 'prevent.history')->prefix('sys-admin')->group(function(){
    Route::get('login', [LoginController::class, 'index'])->name('auth');
    Route::post('login/auth', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth', 'prevent.history')->group(function(){
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('have.role', 'prevent.history')->prefix('admin')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('category', KategoriController::class);

    Route::prefix('surat')->middleware('permission:create surat')->group(function(){
        Route::get('masuk', [SuratMasukController::class, 'index'])->name('masuks.index');
        Route::post('add', [SuratMasukController::class, 'store'])->name('masuks.store');
    });

    Route::resource('roles', RoleController::class)->middleware('role:super admin');

    Route::resource('permission', PermissionController::class)->middleware('role:super admin');

    Route::resource('fakultas', FakultasController::class)->middleware('permission:fti');

    Route::resource('industri', TeknikIndustriController::class)->middleware('permission:teknik industri');
});




