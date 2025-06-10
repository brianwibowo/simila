<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Perusahaan\KurikulumController as PerusahaanKurikulumController;
use App\Http\Controllers\Perusahaan\ProjectController as PerusahaanProjectController;
use App\Http\Controllers\RisetController;

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
    Route::get('/', function () {
        return view('perusahaan.dashboard');
    })->name('perusahaan-dashboard');
    Route::resource('kurikulum', PerusahaanKurikulumController::class)->names([
        'index' => 'perusahaan-kurikulum-list-diajukan',
        'store' => 'perusahaan-kurikulum-store',
        'edit' => 'perusahaan-kurikulum-edit',
        'update' => 'perusahaan-kurikulum-update',
        'destroy' => 'perusahaan-kurikulum-destroy',
        'create' => 'perusahaan-kurikulum-create',
    ])->except('show');
    Route::get('/kurikulum/validasi', [PerusahaanKurikulumController::class, 'validasi'])->name('perusahaan-kurikulum-list-validasi');
    Route::put('/kurikulum/{kurikulum}/setuju', [PerusahaanKurikulumController::class, 'setuju'])->name('perusahaan-kurikulum-setuju');
    Route::put('/kurikulum/{kurikulum}/tolak', [PerusahaanKurikulumController::class, 'tolak'])->name('perusahaan-kurikulum-tolak');

    Route::resource('project', PerusahaanProjectController::class)->names([
        'index' => 'perusahaan-project-index',
        'create' => 'perusahaan-project-create',
        'store' => 'perusahaan-project-store',
        'show' => 'perusahaan-project-show',
        'edit' => 'perusahaan-project-edit',
        'update' => 'perusahaan-project-update',
        'destroy' => 'perusahaan-project-destroy',
    ]);
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
    Route::get('/', function () {
        return view('waka_humas.dashboard');
    })->name('waka-humas-dashboard');

    Route::resource('riset', RisetController::class)->names([
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
