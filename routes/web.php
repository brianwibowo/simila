<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KurikulumController;

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

Route::middleware(['auth'])->get('/user', function () {
    return view('user');
})->name('user');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin-dashboard');
});

Route::middleware(['auth', 'role:perusahaan'])->prefix('perusahaan')->group(function () {
    Route::get('/', function () {return view('perusahaan.dashboard');})->name('perusahaan-dashboard');
    Route::get('/kurikulum', [KurikulumController::class, 'perusahaanList'])->name('perusahaan-kurikulum-list-diajukan');
    Route::get('/kurikulum/validasi', [KurikulumController::class, 'perusahaanValidasi'])->name('perusahaan-kurikulum-list-validasi');
    Route::get('/kurikulum/ajukan', function () {return view('perusahaan.kurikulum.ajukan');})->name('perusahaan-kurikulum-ajukan');
    Route::post('/ajukan-kurikulum', [KurikulumController::class, 'perusahaanStore'])->name('perusahaan-kurikulum-store');
    Route::delete('/kurikulum/{kurikulum}/delete', [KurikulumController::class, 'perusahaanDestroy'])->name('perusahaan-kurikulum-destroy');
    Route::get('/kurikulum/{kurikulum}/edit', [KurikulumController::class, 'perusahaanEdit'])->name('perusahaan-kurikulum-edit');
    Route::put('/kurikulum/{kurikulum}/update', [KurikulumController::class, 'perusahaanUpdate'])->name('perusahaan-kurikulum-update');
    Route::put('/kurikulum/{kurikulum}/setuju', [KurikulumController::class, 'perusahaanSetuju'])->name('perusahaan-kurikulum-setuju');
    Route::put('/kurikulum/{kurikulum}/tolak', [KurikulumController::class, 'perusahaanTolak'])->name('perusahaan-kurikulum-tolak');
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/', function () {
        return view('siswa.dashboard');
    })->name('siswa-dashboard');
});

Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::get('/', function () {
        return view('guru.dashboard');
    })->name('guru-dashboard');
});

Route::middleware(['auth', 'role:waka_kurikulum'])->prefix('waka_kurikulum')->group(function () {
    Route::get('/', function () {
        return view('waka_kurikulum.dashboard');
    })->name('waka-kurikulum-dashboard');
});

Route::middleware(['auth', 'role:waka_humas'])->prefix('waka_humas')->group(function () {
    Route::get('/', function () { return view('waka_humas.dashboard'); })->name('waka-humas-dashboard');

    // Riset Inovasi Produk Routes
    Route::resource('riset', \App\Http\Controllers\RisetController::class)->names([
        'index' => 'riset.index',
        'create' => 'riset.create',
        'store' => 'riset.store',
        'show' => 'riset.show',
        'edit' => 'riset.edit',
        'update' => 'riset.update',
        'destroy' => 'riset.destroy',
    ]);
});

Route::middleware(['auth', 'role:alumni'])->prefix('alumni')->group(function () {
    Route::get('/', function () {
        return view('alumni.dashboard');
    })->name('alumni-dashboard');
});

Route::middleware(['auth', 'role:lsp'])->prefix('lsp')->group(function () {
    Route::get('/', function () {
        return view('lsp.dashboard');
    })->name('lsp-dashboard');
});

require __DIR__ . '/auth.php';
