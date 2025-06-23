<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\KurikulumController as AdminKurikulumController;
use App\Http\Controllers\Admin\GuruTamuController as AdminGuruTamuController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController; // Added for admin project routes

// Perusahaan Controllers
use App\Http\Controllers\Perusahaan\KurikulumController as PerusahaanKurikulumController;
use App\Http\Controllers\Perusahaan\ProjectController as PerusahaanProjectController;
use App\Http\Controllers\Perusahaan\GuruTamuController as PerusahaanGuruTamuController;
use App\Http\Controllers\Perusahaan\PklController as PerusahaanPklController;
use App\Http\Controllers\Perusahaan\MoocController as PerusahaanMoocController;
use App\Http\Controllers\Perusahaan\MoocModuleController as PerusahaanMoocModuleController;
use App\Http\Controllers\Perusahaan\ScoutingController as PerusahaanScoutingController;
use App\Http\Controllers\Perusahaan\BeasiswaScoutingController as PerusahaanBeasiswaScoutingController;
use App\Http\Controllers\Perusahaan\SertifikasiController as PerusahaanSertifikasiController; // <<< ADDED THIS LINE

// Siswa Controllers
use App\Http\Controllers\Siswa\BeasiswaScoutingController as SiswaBeasiswaScoutingController;
use App\Http\Controllers\Siswa\PklController as SiswaPklController;
use App\Http\Controllers\Siswa\LogbookController as SiswaLogbookController;

// Alumni Controllers
use App\Http\Controllers\Alumni\ScoutingController as AlumniScoutingController;

// Waka Kurikulum Controllers
use App\Http\Controllers\WakaKurikulum\BeasiswaRekomendasiController as WakaKurikulumBeasiswaRekomendasiController;
use App\Http\Controllers\WakaKurikulum\KurikulumController as WakaKurikulumController; // Added for WakaKurikulum Kurikulum routes

// Waka Humas Controllers
use App\Http\Controllers\WakaHumas\RisetController as WakaHumasRisetController;
use App\Http\Controllers\WakaHumas\GuruTamuController as WakaHumasGuruTamuController;
use App\Http\Controllers\WakaHumas\PklController as WakaHumasPklController;

// Guru Controllers
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
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () { // Group for authenticated users
    Route::get('/user', function () {
        return view('user');
    })->name('user');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin-dashboard');

        Route::get('/users', [AdminUserController::class, 'index'])->name('admin-users-index');
        Route::post('/users/{user}/update-role', [AdminUserController::class, 'updateRole'])->name('admin-users-update-role');

        // Project Routes for Admin
        Route::prefix('project')->name('admin-project-')->group(function () {
            Route::get('/', [AdminProjectController::class, 'index'])->name('index');
            Route::post('/{project}/laporan', [AdminProjectController::class, 'uploadLaporan'])->name('laporan-upload');
            Route::put('/{project}/laporan', [AdminProjectController::class, 'updateLaporan'])->name('laporan-update');
            Route::delete('/{project}/laporan', [AdminProjectController::class, 'deleteLaporan'])->name('laporan-delete');
        });

        // Kurikulum Routes
        Route::get('/kurikulum', [AdminKurikulumController::class, 'index'])->name('admin-kurikulum-list-diajukan');
        Route::get('/kurikulum/validasi', [AdminKurikulumController::class, 'validasi'])->name('admin-kurikulum-list-validasi');
        Route::get('/kurikulum/validasi-sekolah', [AdminKurikulumController::class, 'validasiSekolah'])->name('admin-kurikulum-list-validasi-sekolah');
        Route::get('/kurikulum/create', [AdminKurikulumController::class, 'create'])->name('admin-kurikulum-create');
        Route::get('/kurikulum/create-for-school', [AdminKurikulumController::class, 'createForSchool'])->name('admin-kurikulum-create-for-school');
        Route::get('/kurikulum/create-for-company', [AdminKurikulumController::class, 'createForCompany'])->name('admin-kurikulum-create-for-company');
        Route::post('/kurikulum', [AdminKurikulumController::class, 'store'])->name('admin-kurikulum-store');
        Route::get('/kurikulum/{kurikulum}/edit', [AdminKurikulumController::class, 'edit'])->name('admin-kurikulum-edit');
        Route::put('/kurikulum/{kurikulum}', [AdminKurikulumController::class, 'update'])->name('admin-kurikulum-update');
        Route::delete('/kurikulum/{kurikulum}', [AdminKurikulumController::class, 'destroy'])->name('admin-kurikulum-destroy');
        Route::patch('/kurikulum/{kurikulum}/setuju', [AdminKurikulumController::class, 'setuju'])->name('admin-kurikulum-setuju');
        Route::patch('/kurikulum/{kurikulum}/tolak', [AdminKurikulumController::class, 'tolak'])->name('admin-kurikulum-tolak');

        // Guru Tamu Admin Routes
        Route::resource('guru-tamu', AdminGuruTamuController::class)->names([
            'index' => 'admin-guru-tamu-index',
            'create' => 'admin-guru-tamu-create',
            'store' => 'admin-guru-tamu-store',
            'show' => 'admin-guru-tamu-show',
            'edit' => 'admin-guru-tamu-edit',
            'update' => 'admin-guru-tamu-update',
            'destroy' => 'admin-guru-tamu-destroy',
        ]);
        Route::put('guru-tamu/{guruTamu}/approve', [AdminGuruTamuController::class, 'approve'])->name('admin-guru-tamu-approve');
        Route::put('guru-tamu/{guruTamu}/reject', [AdminGuruTamuController::class, 'reject'])->name('admin-guru-tamu-reject');
    });

    // Perusahaan Routes
    Route::middleware(['role:perusahaan'])->prefix('perusahaan')->group(function () {
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
        Route::get('/pkl/siswa/{user}', [PerusahaanPklController::class, 'siswa'])->name('perusahaan-pkl-siswa');
        Route::get('/list-pendaftar', [PerusahaanPklController::class, 'list'])->name('perusahaan-pkl-list');
        Route::post('/pkl/{user}/terima', [PerusahaanPklController::class, 'terima'])->name('perusahaan-pkl-terima');
        Route::post('/pkl/{user}/tolak', [PerusahaanPklController::class, 'tolak'])->name('perusahaan-pkl-tolak');
        Route::post('/pkl/{user}/nilai', [PerusahaanPklController::class, 'nilai'])->name('perusahaan-pkl-nilai');

        Route::resource('mooc', PerusahaanMoocController::class)->names([
            'index' => 'perusahaan-mooc-index',
            'create' => 'perusahaan-mooc-create',
            'store' => 'perusahaan-mooc-store',
            'edit' => 'perusahaan-mooc-edit',
            'update' => 'perusahaan-mooc-update',
            'destroy' => 'perusahaan-mooc-destroy',
            'show' => 'perusahaan-mooc-show',
        ]);

        Route::resource('module', PerusahaanMoocModuleController::class)->names([
            'store' => 'perusahaan-module-store',
            'update' => 'perusahaan-module-update',
            'destroy' => 'perusahaan-module-destroy',
            'show' => 'perusahaan-module-show',
        ])->except(['create', 'index', 'edit']);

        Route::get('/module/{mooc}/create', [PerusahaanMoocModuleController::class, 'create'])->name('perusahaan-module-create');
        Route::get('/module/{mooc}/{module}/edit', [PerusahaanMoocModuleController::class, 'edit'])->name('perusahaan-module-edit');

        Route::resource('beasiswa', PerusahaanBeasiswaScoutingController::class)->names([
            'index'   => 'perusahaan-beasiswa-index',
            'create'  => 'perusahaan-beasiswa-create',
            'store'   => 'perusahaan-beasiswa-store',
            'edit'    => 'perusahaan-beasiswa-edit',
            'update'  => 'perusahaan-beasiswa-update',
            'destroy' => 'perusahaan-beasiswa-destroy',
            'show'    => 'perusahaan-beasiswa-show',
        ]);
        Route::get('beasiswa/{beasiswa}/siswa/{user}', [PerusahaanBeasiswaScoutingController::class, 'siswa'])->name('perusahaan-beasiswa-siswa');
        Route::post('beasiswa/{beasiswa}/siswa/{pendaftar}/seleksi', [PerusahaanBeasiswaScoutingController::class, 'seleksi'])->name('perusahaan-beasiswa-seleksi');

        Route::resource('scouting', PerusahaanScoutingController::class)->names([
            'index' => 'perusahaan-scouting-index',
            'create' => 'perusahaan-scouting-create',
            'store' => 'perusahaan-scouting-store',
            'edit' => 'perusahaan-scouting-edit',
            'update' => 'perusahaan-scouting-update',
            'destroy' => 'perusahaan-scouting-destroy',
            'show' => 'perusahaan-scouting-show',
        ]);
        Route::get('/detail-talents/{user}/{scouting}', [PerusahaanScoutingController::class, 'siswa'])->name('perusahaan-scouting-siswa');
        Route::post('/scouting/seleksi/{talent}', [PerusahaanScoutingController::class, 'seleksi'])->name('perusahaan-scouting-seleksi');

        // START: Rute Baru untuk Sertifikasi Kompetensi oleh Perusahaan
        Route::prefix('sertifikasi')->name('perusahaan-sertifikasi-')->group(function () {
            Route::get('/', [PerusahaanSertifikasiController::class, 'index'])->name('index'); // Daftar Ujian yang dibuat
            Route::get('/create', [PerusahaanSertifikasiController::class, 'create'])->name('create'); // Form buat ujian baru
            Route::post('/', [PerusahaanSertifikasiController::class, 'store'])->name('store'); // Simpan ujian baru
            Route::get('/{certificationExam}', [PerusahaanSertifikasiController::class, 'show'])->name('show'); // Detail ujian & soal
            Route::get('/{certificationExam}/edit', [PerusahaanSertifikasiController::class, 'edit'])->name('edit'); // Form edit ujian
            Route::put('/{certificationExam}', [PerusahaanSertifikasiController::class, 'update'])->name('update'); // Update ujian
            Route::delete('/{certificationExam}', [PerusahaanSertifikasiController::class, 'destroy'])->name('destroy'); // Hapus ujian

            // Rute untuk manajemen soal dalam ujian
            Route::get('/{certificationExam}/questions/create', [PerusahaanSertifikasiController::class, 'createQuestion'])->name('questions.create');
            Route::post('/{certificationExam}/questions', [PerusahaanSertifikasiController::class, 'storeQuestion'])->name('questions.store');
            Route::get('/{certificationExam}/questions/{question}/edit', [PerusahaanSertifikasiController::class, 'editQuestion'])->name('questions.edit');
            Route::put('/{certificationExam}/questions/{question}', [PerusahaanSertifikasiController::class, 'updateQuestion'])->name('questions.update');
            Route::delete('/{certificationExam}/questions/{question}', [PerusahaanSertifikasiController::class, 'destroyQuestion'])->name('questions.destroy');

            // Rute untuk melihat hasil ujian dan memberikan sertifikat
            Route::get('/results', [PerusahaanSertifikasiController::class, 'listResults'])->name('results'); // Daftar siswa yang ikut ujian
            Route::get('/results/{registration}/give-certificate', [PerusahaanSertifikasiController::class, 'giveCertificateForm'])->name('results.give_certificate_form'); // Form kasih nilai/sertifikat
            Route::post('/results/{registration}/store-certificate', [PerusahaanSertifikasiController::class, 'storeCertificate'])->name('results.store_certificate'); // Simpan nilai/sertifikat
        });
    });

    // Siswa Routes
    Route::middleware(['role:siswa'])->prefix('siswa')->group(function () {
        Route::get('/', function () {
            return view('siswa.dashboard');
        })->name('siswa-dashboard');

        Route::get('/pkl', [SiswaPklController::class, 'index'])->name('siswa-pkl-index');
        Route::post('/pkl/{pkl}/register', [SiswaPklController::class, 'register'])->name('siswa-pkl-register');
        Route::get('/pkl/show', [SiswaPklController::class, 'show'])->name('siswa-pkl-show');
        Route::delete('/pkl/batal', [SiswaPklController::class, 'batal'])->name('siswa-pkl-batal');
        Route::post('/pkl/{pkl}/upload', [SiswaPklController::class, 'uploadLaporan'])->name('siswa-pkl-uploadLaporan');

        Route::resource('pkl/logbook', SiswaLogbookController::class)->names([
            'index' => 'siswa-logbook-index',
            'create' => 'siswa-logbook-create',
            'store' => 'siswa-logbook-store',
            'edit' => 'siswa-logbook-edit',
            'update' => 'siswa-logbook-update',
            'destroy' => 'siswa-logbook-destroy',
        ])->except('show');

        Route::get('beasiswa', [SiswaBeasiswaScoutingController::class, 'index'])->name('siswa-beasiswa-index');
        Route::get('beasiswa/daftar/{beasiswa}', [SiswaBeasiswaScoutingController::class, 'register'])->name('siswa-beasiswa-register');
        Route::post('beasiswa/daftar/{beasiswa}', [SiswaBeasiswaScoutingController::class, 'apply'])->name('siswa-beasiswa-apply');
        Route::get('beasiswa/status', [SiswaBeasiswaScoutingController::class, 'status'])->name('siswa-beasiswa-status');
    });

    // Guru Routes
    Route::middleware(['role:guru'])->prefix('guru')->group(function () {
        Route::get('/', function () {
            return view('guru.dashboard');
        })->name('guru-dashboard');

        Route::prefix('project')->name('guru-project-')->group(function () {
            Route::get('/', [GuruProjectController::class, 'index'])->name('index');
            Route::post('/{project}/laporan', [GuruProjectController::class, 'uploadLaporan'])->name('laporan-upload');
            Route::put('/{project}/laporan', [GuruProjectController::class, 'updateLaporan'])->name('laporan-update');
            Route::delete('/{project}/laporan', [GuruProjectController::class, 'deleteLaporan'])->name('laporan-delete');
        });
    });

    // Waka Kurikulum Routes
    Route::middleware(['role:waka_kurikulum'])->prefix('waka_kurikulum')->group(function () {
        Route::get('/', function () {
            return view('waka_kurikulum.dashboard');
        })->name('waka-kurikulum-dashboard');

        // Kurikulum Routes
        Route::get('/kurikulum', [WakaKurikulumController::class, 'index'])->name('waka-kurikulum-list-diajukan');
        Route::get('/kurikulum/validasi', [WakaKurikulumController::class, 'validasi'])->name('waka-kurikulum-list-validasi');
        Route::get('/kurikulum/create', [WakaKurikulumController::class, 'create'])->name('waka-kurikulum-create');
        Route::post('/kurikulum', [WakaKurikulumController::class, 'store'])->name('waka-kurikulum-store');
        Route::get('/kurikulum/{kurikulum}/edit', [WakaKurikulumController::class, 'edit'])->name('waka-kurikulum-edit');
        Route::put('/kurikulum/{kurikulum}', [WakaKurikulumController::class, 'update'])->name('waka-kurikulum-update');
        Route::delete('/kurikulum/{kurikulum}', [WakaKurikulumController::class, 'destroy'])->name('waka-kurikulum-destroy');
        Route::patch('/kurikulum/{kurikulum}/setuju', [WakaKurikulumController::class, 'setuju'])->name('waka-kurikulum-setuju');
        Route::patch('/kurikulum/{kurikulum}/tolak', [WakaKurikulumController::class, 'tolak'])->name('waka-kurikulum-tolak');

        // Beasiswa Rekomendasi
        Route::get('/beasiswa', [WakaKurikulumBeasiswaRekomendasiController::class, 'index'])->name('waka_kurikulum.beasiswas.index');
        Route::get('/beasiswa/{beasiswa}', [WakaKurikulumBeasiswaRekomendasiController::class, 'show'])->name('waka_kurikulum.beasiswas.show');
        Route::put('/beasiswa/{beasiswa}', [WakaKurikulumBeasiswaRekomendasiController::class, 'rekomendasi'])->name('waka_kurikulum.beasiswas.rekomendasi');
        Route::get('/beasiswa-hasil', [WakaKurikulumBeasiswaRekomendasiController::class, 'hasil'])->name('waka_kurikulum.beasiswas.hasil');
        Route::get('/beasiswa-aktif', [WakaKurikulumBeasiswaRekomendasiController::class, 'batchAktifViewOnly'])->name('waka_kurikulum.beasiswas.batches.list');
        Route::get('/beasiswa-hasil/{batch}', [WakaKurikulumBeasiswaRekomendasiController::class, 'hasilDetail'])->name('waka_kurikulum.beasiswas.hasil.detail');
    });

    // Waka Humas Routes
    Route::middleware(['role:waka_humas'])->prefix('waka_humas')->group(function () {
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
        Route::put('guru-tamu/{guru_tamu}/approve', [WakaHumasGuruTamuController::class, 'approve'])->where('guru_tamu', '[0-9]+')->name('waka-humas-guru-tamu-approve');
        Route::put('guru-tamu/{guru_tamu}/reject', [WakaHumasGuruTamuController::class, 'reject'])->where('guru_tamu', '[0-9]+')->name('waka-humas-guru-tamu-reject');

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
        Route::post('pkl/{pkl}/validate', [WakaHumasPklController::class, 'validateReport'])->name('waka-humas-pkl-validate');
        Route::get('pkl/{pkl}/download', [WakaHumasPklController::class, 'downloadReport'])->name('waka-humas-pkl-download');
    });

    // Alumni Routes
    Route::middleware(['role:alumni'])->prefix('alumni')->group(function () {
        Route::get('/', function () {
            return view('alumni.dashboard');
        })->name('alumni-dashboard');

        Route::get('scouting/', [AlumniScoutingController::class, 'index'])->name('alumni-scouting-index');
        Route::get('scouting/{scouting}', [AlumniScoutingController::class, 'registration'])->name('alumni-scouting-register');
        Route::post('scouting/{scouting}/apply', [AlumniScoutingController::class, 'apply'])->name('alumni-scouting-apply');
        Route::get('scouting/status/riwayat', [AlumniScoutingController::class, 'status'])->name('alumni-scouting-status');
    });

    // LSP Routes
    Route::middleware(['role:lsp'])->prefix('lsp')->group(function () {
        Route::get('/', function () {
            return view('lsp.dashboard');
        })->name('lsp-dashboard');
    });
}); // End of main 'auth' middleware group

require __DIR__ . '/auth.php';