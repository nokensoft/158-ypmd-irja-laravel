<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PengaturanSitusController;
use App\Http\Controllers\Admin\AktivitasLoginController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\BackupDatabaseController;
use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;
use App\Http\Controllers\Penulis\DashboardController as PenulisDashboardController;
use App\Http\Controllers\Penulis\BeritaController;
use App\Http\Controllers\Penulis\KategoriBeritaController;
use App\Http\Controllers\Penulis\KdkController;
use App\Http\Controllers\Penulis\GaleriController;
use App\Http\Controllers\Penulis\MediaController;
use App\Http\Controllers\StatistikPengunjungController;

/*
|--------------------------------------------------------------------------
| Visitor (Public) Routes
|--------------------------------------------------------------------------
*/
Route::middleware('track.visitor')->group(function () {
    Route::get('/', [VisitorController::class, 'beranda'])->name('beranda');

    // Tentang YPMD IRJA (static)
    Route::view('/sejarah', 'visitor.sejarah')->name('sejarah');
    Route::view('/profil', 'visitor.profil')->name('profil');
    Route::view('/tokoh', 'visitor.tokoh')->name('tokoh');
    Route::view('/mitra', 'visitor.mitra')->name('mitra');
    Route::view('/bidang-kerja', 'visitor.bidang-kerja')->name('bidang-kerja');

    // Program (static)
    Route::view('/program', 'visitor.program')->name('program');

    // KDK (dynamic)
    Route::get('/kdk', [VisitorController::class, 'kdk'])->name('kdk');

    // Donasi (dynamic GET + POST)
    Route::get('/donasi', [VisitorController::class, 'donasi'])->name('donasi');
    Route::post('/donasi', [VisitorController::class, 'donasiStore'])->name('donasi.store');

    // Berita / Papua Today (dynamic)
    Route::get('/berita', [VisitorController::class, 'berita'])->name('berita');
    Route::get('/berita/kategori/{slug}', [VisitorController::class, 'beritaKategori'])->name('berita.kategori');
    Route::get('/berita/{slug}', [VisitorController::class, 'beritaDetail'])->name('berita.detail');

    // Galeri (dynamic)
    Route::get('/galeri', [VisitorController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/{slug}', [VisitorController::class, 'galeriDetail'])->name('galeri.detail');

    // Kontak
    Route::get('/kontak', [VisitorController::class, 'kontak'])->name('kontak');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest.custom')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth.custom');

/*
|--------------------------------------------------------------------------
| Admin Master Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth.custom', 'role:admin_master'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pengaturan-situs', [PengaturanSitusController::class, 'index'])->name('pengaturan-situs');
    Route::put('/pengaturan-situs', [PengaturanSitusController::class, 'update'])->name('pengaturan-situs.update');
    Route::get('/aktivitas-login', [AktivitasLoginController::class, 'index'])->name('aktivitas-login');
    Route::get('/backup-database', [BackupDatabaseController::class, 'index'])->name('backup-database');
    Route::post('/backup-database/create', [BackupDatabaseController::class, 'create'])->name('backup-database.create');
    Route::get('/backup-database/download/{filename}', [BackupDatabaseController::class, 'download'])->name('backup-database.download');
    Route::delete('/backup-database/{filename}', [BackupDatabaseController::class, 'destroy'])->name('backup-database.destroy');
    Route::post('/backup-database/restore', [BackupDatabaseController::class, 'restore'])->name('backup-database.restore');

    // Pengguna CRUD
    Route::resource('pengguna', PenggunaController::class)->except(['show']);
    Route::patch('/pengguna/{pengguna}/restore', [PenggunaController::class, 'restore'])->name('pengguna.restore');

    // Statistik
    Route::get('/statistik-pengunjung', [StatistikPengunjungController::class, 'index'])->name('statistik-pengunjung');

    // Donasi
    Route::get('/donasi', [AdminDonasiController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/{id}', [AdminDonasiController::class, 'show'])->name('donasi.show');
    Route::patch('/donasi/{id}/konfirmasi', [AdminDonasiController::class, 'konfirmasi'])->name('donasi.konfirmasi');
    Route::patch('/donasi/{id}/tolak', [AdminDonasiController::class, 'tolak'])->name('donasi.tolak');
    Route::delete('/donasi/{id}', [AdminDonasiController::class, 'destroy'])->name('donasi.destroy');

    // Dokumentasi
    Route::view('/dokumentasi', 'admin.dokumentasi')->name('dokumentasi');
});

/*
|--------------------------------------------------------------------------
| Penulis Routes
|--------------------------------------------------------------------------
*/
Route::prefix('penulis')->name('penulis.')->middleware(['auth.custom', 'role:penulis'])->group(function () {
    Route::get('/dashboard', [PenulisDashboardController::class, 'index'])->name('dashboard');

    // Konten
    Route::resource('berita', BeritaController::class)->except(['show']);
    Route::patch('/berita/{beritum}/restore', [BeritaController::class, 'restore'])->name('berita.restore');
    Route::resource('kategori-berita', KategoriBeritaController::class)->except(['show']);
    Route::patch('/kategori-berita/{kategori_beritum}/restore', [KategoriBeritaController::class, 'restore'])->name('kategori-berita.restore');
    // KDK
    Route::resource('kdk', KdkController::class)->except(['show']);
    Route::patch('/kdk/{kdk}/restore', [KdkController::class, 'restore'])->name('kdk.restore');

    // Media
    Route::get('/media/json', [MediaController::class, 'json'])->name('media.json');
    Route::post('/media/upload-ajax', [MediaController::class, 'uploadAjax'])->name('media.upload-ajax');
    Route::resource('media', MediaController::class)->except(['show']);
    Route::patch('/media/{medium}/restore', [MediaController::class, 'restore'])->name('media.restore');
    Route::resource('galeri', GaleriController::class)->except(['show']);
    Route::patch('/galeri/{galeri}/restore', [GaleriController::class, 'restore'])->name('galeri.restore');

    // Statistik
    Route::get('/statistik-pengunjung', [StatistikPengunjungController::class, 'index'])->name('statistik-pengunjung');

    // Dokumentasi
    Route::view('/dokumentasi', 'admin.dokumentasi')->name('dokumentasi');
});
