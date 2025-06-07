<?php

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
    })->name('waka_kurikulum-dashboard');
});

Route::middleware(['auth', 'role:waka_humas'])->prefix('waka_humas')->group(function () {
    Route::get('/', function () {
        return view('waka_humas.dashboard');
    })->name('waka_humas-dashboard');
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
