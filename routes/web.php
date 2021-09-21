<?php

use App\Http\Controllers\Backend\{DashboardController,
    KategoriController,
    LoginController,
    SuratKeluarController,
    SuratMasukController};

use App\Http\Controllers\Backend\Fakultas\{FakultasController,
    TeknikIndustriController};

use App\Http\Controllers\Backend\Layanan\{TemplateSuratController,
    CetakSuratController, PengaturanSuratController};

use App\Http\Controllers\Backend\Permission\{AssignController,
    PermissionController,
    RoleController,
    UserAssignController};

use Illuminate\Support\Facades\Route;

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

Route::middleware('have.role')->prefix('admin')->group(function(){
    Route::get('home', [DashboardController::class, 'index'])->name('dashboard')->middleware('prevent.history');

    Route::resource('category', KategoriController::class);

    Route::prefix('surat-masuk')->middleware('permission:create surat')->group(function(){
        Route::get('', [SuratMasukController::class, 'index'])->name('masuks.index');
        Route::post('add', [SuratMasukController::class, 'store'])->name('masuks.store');
    });

    Route::prefix('surat-keluar')->middleware('permission:create surat')->group(function(){
        Route::get('', [SuratKeluarController::class, 'index'])->name('keluars.index');
        Route::post('add', [SuratKeluarController::class, 'store'])->name('keluars.store');
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

    Route::prefix('layanan-surat')->middleware('permission:layanan surat')->group(function(){
        Route::get('template', [TemplateSuratController::class, 'index'])->name('template.index');
        Route::post('template/add', [TemplateSuratController::class, 'store'])->name('template.store');
        Route::get('pengaturan', [PengaturanSuratController::class, 'index'])->name('pengaturan.index');
        Route::post('pengaturan/add', [PengaturanSuratController::class, 'store'])->name('pengaturan.store');
        Route::delete('pengaturan/delete/{id}', [PengaturanSuratController::class, 'destroy'])->name('pengaturan.destroy');
        Route::get('create', [CetakSuratController::class, 'index'])->name('cetak.index');
        Route::get('form/{id}', [CetakSuratController::class, 'form']);
        Route::post('form/exportword/{id}', [CetakSuratController::class, 'exword'])->name('form.word');
    });

    Route::resource('fakultas', FakultasController::class)->middleware('permission:fti');

    Route::resource('industri', TeknikIndustriController::class)->middleware('permission:teknik industri');
});




