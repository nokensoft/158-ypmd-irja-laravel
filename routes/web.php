<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PengaturanSitusController;
use App\Http\Controllers\Admin\AktivitasLoginController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\BackupDatabaseController;
use App\Http\Controllers\Penulis\DashboardController as PenulisDashboardController;
use App\Http\Controllers\Penulis\BeritaController;
use App\Http\Controllers\Penulis\KategoriBeritaController;
use App\Http\Controllers\Penulis\KegiatanController;
use App\Http\Controllers\Penulis\CabangOlahragaController;
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
    Route::get('/tentang', [VisitorController::class, 'tentang'])->name('tentang');
    Route::get('/pengurusan', [VisitorController::class, 'pengurusan'])->name('pengurusan');
    Route::get('/cabor', [VisitorController::class, 'cabor'])->name('cabor');
    Route::get('/event', [VisitorController::class, 'event'])->name('event');
    Route::get('/berita', [VisitorController::class, 'berita'])->name('berita');
    Route::get('/berita/kategori/{slug}', [VisitorController::class, 'beritaKategori'])->name('berita.kategori');
    Route::get('/berita/{slug}', [VisitorController::class, 'beritaDetail'])->name('berita.detail');
    Route::get('/galeri', [VisitorController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/{slug}', [VisitorController::class, 'galeriDetail'])->name('galeri.detail');
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
    Route::resource('kegiatan', KegiatanController::class)->except(['show']);
    Route::patch('/kegiatan/{kegiatan}/restore', [KegiatanController::class, 'restore'])->name('kegiatan.restore');

    // Olahraga
    Route::resource('cabang-olahraga', CabangOlahragaController::class)->except(['show']);
    Route::patch('/cabang-olahraga/{cabang_olahraga}/restore', [CabangOlahragaController::class, 'restore'])->name('cabang-olahraga.restore');

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
