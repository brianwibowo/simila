<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\KurikulumController as AdminKurikulumController;

use App\Http\Controllers\Perusahaan\KurikulumController as PerusahaanKurikulumController;
use App\Http\Controllers\Perusahaan\ProjectController as PerusahaanProjectController;
use App\Http\Controllers\Perusahaan\GuruTamuController as PerusahaanGuruTamuController;
use App\Http\Controllers\Perusahaan\PklController as PerusahaanPklController;
use App\Http\Controllers\Perusahaan\MoocController as PerusahaanMoocController;

use App\Http\Controllers\Siswa\PklController as SiswaPklController;

use App\Http\Controllers\WakaHumas\RisetController as WakaHumasRisetController;
use App\Http\Controllers\WakaHumas\GuruTamuController as WakaHumasGuruTamuController;
use App\Http\Controllers\WakaHumas\PklController as WakaHumasPklController;
use App\Http\Controllers\Guru\ProjectController as GuruProjectController;

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

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin-users-index');
    Route::post('/users/{user}/update-role', [AdminUserController::class, 'updateRole'])->name('admin-users-update-role');    // Kurikulum Routes
    Route::get('/kurikulum', [AdminKurikulumController::class, 'index'])->name('admin-kurikulum-list-diajukan');
    Route::get('/kurikulum/validasi', [AdminKurikulumController::class, 'validasi'])->name('admin-kurikulum-list-validasi');
    Route::get('/kurikulum/monitor-waka', [AdminKurikulumController::class, 'monitorWakaKurikulum'])->name('admin-kurikulum-monitor-waka');
    Route::get('/kurikulum/create', [AdminKurikulumController::class, 'create'])->name('admin-kurikulum-create');
    Route::post('/kurikulum', [AdminKurikulumController::class, 'store'])->name('admin-kurikulum-store');
    Route::get('/kurikulum/{kurikulum}/edit', [AdminKurikulumController::class, 'edit'])->name('admin-kurikulum-edit');
    Route::put('/kurikulum/{kurikulum}', [AdminKurikulumController::class, 'update'])->name('admin-kurikulum-update');
    Route::delete('/kurikulum/{kurikulum}', [AdminKurikulumController::class, 'destroy'])->name('admin-kurikulum-destroy');
    Route::patch('/kurikulum/{kurikulum}/setuju', [AdminKurikulumController::class, 'setuju'])->name('admin-kurikulum-setuju');
    Route::patch('/kurikulum/{kurikulum}/tolak', [AdminKurikulumController::class, 'tolak'])->name('admin-kurikulum-tolak');
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

    Route::resource('guru-tamu', PerusahaanGuruTamuController::class)->names([
        'index' => 'perusahaan-guru-tamu-index',
        'create' => 'perusahaan-guru-tamu-create',
        'store' => 'perusahaan-guru-tamu-store',
        'edit' => 'perusahaan-guru-tamu-edit',
        'update' => 'perusahaan-guru-tamu-update',
        'destroy' => 'perusahaan-guru-tamu-destroy',
    ])->except('show');
    Route::get('/guru-tamu/list', [PerusahaanGuruTamuController::class, 'list'])->name('perusahaan-guru-tamu-list');

    Route::resource('pkl', PerusahaanPklController::class)->names([
        'index' => 'perusahaan-pkl-index',
        'create' => 'perusahaan-pkl-create',
        'store' => 'perusahaan-pkl-store',
        'edit' => 'perusahaan-pkl-edit',
        'update' => 'perusahaan-pkl-update',
        'destroy' => 'perusahaan-pkl-destroy',
        'show' => 'perusahaan-pkl-show',
    ]);

    Route::resource('mooc', PerusahaanMoocController::class)->names([
        'index' => 'perusahaan-mooc-index',
        'create' => 'perusahaan-mooc-create',
        'store' => 'perusahaan-mooc-store',
        'edit' => 'perusahaan-mooc-edit',
        'update' => 'perusahaan-mooc-update',
        'destroy' => 'perusahaan-mooc-destroy',
        'show' => 'perusahaan-mooc-show',
    ]);
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/', function () {
        return view('siswa.dashboard');
    })->name('siswa-dashboard');

    Route::get('/pkl', [SiswaPklController::class, 'index'])->name('siswa-pkl-index');
    Route::post('/pkl/{pkl}/register', [SiswaPklController::class, 'register'])->name('siswa-pkl-register');
    Route::get('/pkl/show', [SiswaPklController::class, 'show'])->name('siswa-pkl-show');
});

Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::get('/', function () {
        return view('guru.dashboard');
    })->name('guru-dashboard');

    Route::prefix('project')->name('guru-project-')->group(function () {
        Route::get('/', [GuruProjectController::class, 'index'])->name('index');
        Route::post('/{project}/laporan', [GuruProjectController::class, 'uploadLaporan'])
            ->name('laporan-upload');
        Route::put('/{project}/laporan', [GuruProjectController::class, 'updateLaporan'])
            ->name('laporan-update');
        Route::delete('/{project}/laporan', [GuruProjectController::class, 'deleteLaporan'])
            ->name('laporan-delete');
    });
});

Route::middleware(['auth', 'role:waka_kurikulum'])->prefix('waka_kurikulum')->group(function () {
    Route::get('/', function () {
        return view('waka_kurikulum.dashboard');
    })->name('waka-kurikulum-dashboard');
    
    // Kurikulum Routes
    Route::get('/kurikulum', [App\Http\Controllers\WakaKurikulum\KurikulumController::class, 'index'])->name('waka-kurikulum-list-diajukan');
    Route::get('/kurikulum/validasi', [App\Http\Controllers\WakaKurikulum\KurikulumController::class, 'validasi'])->name('waka-kurikulum-list-validasi');
    Route::get('/kurikulum/create', [App\Http\Controllers\WakaKurikulum\KurikulumController::class, 'create'])->name('waka-kurikulum-create');
    Route::post('/kurikulum', [App\Http\Controllers\WakaKurikulum\KurikulumController::class, 'store'])->name('waka-kurikulum-store');
    Route::get('/kurikulum/{kurikulum}/edit', [App\Http\Controllers\WakaKurikulum\KurikulumController::class, 'edit'])->name('waka-kurikulum-edit');
    Route::put('/kurikulum/{kurikulum}', [App\Http\Controllers\WakaKurikulum\KurikulumController::class, 'update'])->name('waka-kurikulum-update');
    Route::delete('/kurikulum/{kurikulum}', [App\Http\Controllers\WakaKurikulum\KurikulumController::class, 'destroy'])->name('waka-kurikulum-destroy');
    Route::patch('/kurikulum/{kurikulum}/setuju', [App\Http\Controllers\WakaKurikulum\KurikulumController::class, 'setuju'])->name('waka-kurikulum-setuju');
    Route::patch('/kurikulum/{kurikulum}/tolak', [App\Http\Controllers\WakaKurikulum\KurikulumController::class, 'tolak'])->name('waka-kurikulum-tolak');
});

Route::middleware(['auth', 'role:waka_humas'])->prefix('waka_humas')->group(function () {
    Route::get('/', function () {
        return view('waka_humas.dashboard');
    })->name('waka-humas-dashboard');

    Route::resource('guru-tamu', WakaHumasGuruTamuController::class)->names([
        'index' => 'waka-humas-guru-tamu-index',
        'create' => 'waka-humas-guru-tamu-create',
        'store' => 'waka-humas-guru-tamu-store',
        'show' => 'waka-humas-guru-tamu-show',
        'edit' => 'waka-humas-guru-tamu-edit',
        'update' => 'waka-humas-guru-tamu-update',
        'destroy' => 'waka-humas-guru-tamu-destroy',
    ]);
    Route::put('guru-tamu/{guru_tamu}/approve', [WakaHumasGuruTamuController::class, 'approve'])
        ->where('guru_tamu', '[0-9]+')
        ->name('waka-humas-guru-tamu-approve'); 
    Route::put('guru-tamu/{guru_tamu}/reject', [WakaHumasGuruTamuController::class, 'reject'])
        ->where('guru_tamu', '[0-9]+')
        ->name('waka-humas-guru-tamu-reject');

    Route::resource('riset', WakaHumasRisetController::class)->names([
        'index' => 'waka-humas-riset-index',
        'create' => 'waka-humas-riset-create',
        'store' => 'waka-humas-riset-store',
        'show' => 'waka-humas-riset-show',
        'edit' => 'waka-humas-riset-edit',
        'update' => 'waka-humas-riset-update',
        'destroy' => 'waka-humas-riset-destroy',
    ]);

    Route::resource('pkl', WakaHumasPklController::class)->only(['index', 'show'])->names([
        'index' => 'waka-humas-pkl-index',
        'show' => 'waka-humas-pkl-show',
    ]);
    Route::post('pkl/{pkl}/validate', [WakaHumasPklController::class, 'validateReport'])
        ->name('waka-humas-pkl-validate');
    Route::get('pkl/{pkl}/download', [WakaHumasPklController::class, 'downloadReport'])
        ->name('waka-humas-pkl-download');
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
