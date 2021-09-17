<?php

use App\Http\Controllers\Backend\{DashboardController,
    KategoriController,
    LoginController, SuratMasukController};
use App\Http\Controllers\Backend\Fakultas\{FakultasController,
    TeknikIndustriController};
use App\Http\Controllers\Backend\Permission\{AssignController, PermissionController,
    RoleController, UserAssignController};
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

    Route::prefix('surat-masuk')->middleware('permission:create surat')->group(function(){
        Route::get('', [SuratMasukController::class, 'index'])->name('masuks.index');
        Route::post('add', [SuratMasukController::class, 'store'])->name('masuks.store');
    });

    Route::prefix('role-and-permission')->middleware('role:super admin')->group(function(){
        Route::resource('roles', RoleController::class);

        Route::resource('permission', PermissionController::class);

        Route::get('assignment', [AssignController::class, 'create'])->name('assignments.create');
        Route::post('assignment', [AssignController::class, 'store']);
        Route::get('assignment/{role}/edit', [AssignController::class, 'edit'])->name('assignments.sync');
        Route::put('assignment/{role}/edit', [AssignController::class, 'update']);

        Route::get('assign/role', [UserAssignController::class, 'create'])->name('assign.create');
        Route::post('assign/role', [UserAssignController::class, 'store']);
        Route::get('assign/{user}/user', [UserAssignController::class, 'edit'])->name('assign.sync');
        Route::put('assign/{user}/user', [UserAssignController::class, 'update']);
    });

    Route::resource('fakultas', FakultasController::class)->middleware('permission:fti');

    Route::resource('industri', TeknikIndustriController::class)->middleware('permission:teknik industri');
});




