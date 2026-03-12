<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Admin\PengaturanSitusController;
use App\Http\Controllers\Admin\AktivitasLoginController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\BackupDatabaseController;
use App\Http\Controllers\Admin\HalamanController;
use App\Http\Controllers\Penulis\AktivitasLoginController as PenulisAktivitasLoginController;
use App\Http\Controllers\Penulis\DashboardController as PenulisDashboardController;
use App\Http\Controllers\Penulis\DonasiController as PenulisDonasiController;
use App\Http\Controllers\Penulis\ProgramDonasiController;
use App\Http\Controllers\Penulis\BeritaController;
use App\Http\Controllers\Penulis\KategoriBeritaController;
use App\Http\Controllers\Penulis\KdkController;
use App\Http\Controllers\Penulis\GaleriController;
use App\Http\Controllers\Penulis\MediaController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\StatistikPengunjungController;

/*
|--------------------------------------------------------------------------
| SEO Routes (robots.txt & sitemap.xml)
|--------------------------------------------------------------------------
*/
Route::get('/robots.txt', [SeoController::class, 'robots']);
Route::get('/sitemap.xml', [SeoController::class, 'sitemap']);

/*
|--------------------------------------------------------------------------
| Visitor (Public) Routes
|--------------------------------------------------------------------------
*/
Route::middleware('track.visitor')->group(function () {
    Route::get('/', [VisitorController::class, 'beranda'])->name('beranda');

    // Halaman dinamis (CMS)
    Route::get('/halaman/{slug}', [VisitorController::class, 'halaman'])->name('halaman.show');

    // Tentang YPMD IRJA (dinamis dari DB via Halaman)
    Route::get('/sejarah', [VisitorController::class, 'sejarah'])->name('sejarah');
    Route::get('/profil', [VisitorController::class, 'profil'])->name('profil');
    Route::get('/mitra', [VisitorController::class, 'mitra'])->name('mitra');
    Route::get('/bidang-kerja', [VisitorController::class, 'bidangKerja'])->name('bidang-kerja');
    Route::view('/tokoh', 'visitor.tokoh')->name('tokoh');

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

    // Peta Situs (HTML Sitemap)
    Route::get('/peta-situs', [VisitorController::class, 'petaSitus'])->name('peta-situs');
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
    Route::delete('/pengguna/{pengguna}/force-delete', [PenggunaController::class, 'forceDelete'])->name('pengguna.force-delete');

    // Halaman
    Route::resource('halaman', HalamanController::class)->except(['show']);
    Route::patch('/halaman/{halaman}/restore', [HalamanController::class, 'restore'])->name('halaman.restore');
    Route::delete('/halaman/{halaman}/force-delete', [HalamanController::class, 'forceDelete'])->name('halaman.force-delete');

    // Statistik
    Route::get('/statistik-pengunjung', [StatistikPengunjungController::class, 'index'])->name('statistik-pengunjung');

    // Profil
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

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
    Route::delete('/berita/{beritum}/force-delete', [BeritaController::class, 'forceDelete'])->name('berita.force-delete');
    Route::resource('kategori-berita', KategoriBeritaController::class)->except(['show']);
    Route::patch('/kategori-berita/{kategori_beritum}/restore', [KategoriBeritaController::class, 'restore'])->name('kategori-berita.restore');
    Route::delete('/kategori-berita/{kategori_beritum}/force-delete', [KategoriBeritaController::class, 'forceDelete'])->name('kategori-berita.force-delete');
    // KDK
    Route::resource('kdk', KdkController::class)->except(['show']);
    Route::patch('/kdk/{kdk}/restore', [KdkController::class, 'restore'])->name('kdk.restore');
    Route::delete('/kdk/{kdk}/force-delete', [KdkController::class, 'forceDelete'])->name('kdk.force-delete');

    // Media
    Route::get('/media/json', [MediaController::class, 'json'])->name('media.json');
    Route::post('/media/upload-ajax', [MediaController::class, 'uploadAjax'])->name('media.upload-ajax');
    Route::resource('media', MediaController::class)->except(['show']);
    Route::patch('/media/{medium}/restore', [MediaController::class, 'restore'])->name('media.restore');
    Route::delete('/media/{medium}/force-delete', [MediaController::class, 'forceDelete'])->name('media.force-delete');
    Route::resource('galeri', GaleriController::class)->except(['show']);
    Route::patch('/galeri/{galeri}/toggle-publik', [GaleriController::class, 'togglePublik'])->name('galeri.toggle-publik');
    Route::patch('/galeri/{galeri}/restore', [GaleriController::class, 'restore'])->name('galeri.restore');
    Route::delete('/galeri/{galeri}/force-delete', [GaleriController::class, 'forceDelete'])->name('galeri.force-delete');

    // Donasi
    Route::get('/donasi', [PenulisDonasiController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/{id}', [PenulisDonasiController::class, 'show'])->name('donasi.show');
    Route::get('/donasi/{id}/bukti-transfer', [PenulisDonasiController::class, 'buktiTransfer'])->name('donasi.bukti-transfer');
    Route::patch('/donasi/{id}/konfirmasi', [PenulisDonasiController::class, 'konfirmasi'])->name('donasi.konfirmasi');
    Route::patch('/donasi/{id}/tolak', [PenulisDonasiController::class, 'tolak'])->name('donasi.tolak');
    Route::patch('/donasi/{id}/update-pesan', [PenulisDonasiController::class, 'updatePesan'])->name('donasi.update-pesan');
    Route::patch('/donasi/{id}/toggle-publik', [PenulisDonasiController::class, 'togglePublik'])->name('donasi.toggle-publik');
    Route::patch('/donasi/{id}/toggle-anonim', [PenulisDonasiController::class, 'toggleAnonim'])->name('donasi.toggle-anonim');
    Route::delete('/donasi/{id}', [PenulisDonasiController::class, 'destroy'])->name('donasi.destroy');
    Route::patch('/donasi/{id}/restore', [PenulisDonasiController::class, 'restore'])->name('donasi.restore');
    Route::delete('/donasi/{id}/force-delete', [PenulisDonasiController::class, 'forceDelete'])->name('donasi.force-delete');

    // Program Donasi
    Route::resource('program-donasi', ProgramDonasiController::class)->except(['show']);
    Route::patch('/program-donasi/{program_donasi}/restore', [ProgramDonasiController::class, 'restore'])->name('program-donasi.restore');
    Route::delete('/program-donasi/{program_donasi}/force-delete', [ProgramDonasiController::class, 'forceDelete'])->name('program-donasi.force-delete');

    // Statistik
    Route::get('/statistik-pengunjung', [StatistikPengunjungController::class, 'index'])->name('statistik-pengunjung');

    // Aktivitas Login (hanya penulis)
    Route::get('/aktivitas-login', [PenulisAktivitasLoginController::class, 'index'])->name('aktivitas-login');

    // Profil
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    // Dokumentasi
    Route::view('/dokumentasi', 'admin.dokumentasi')->name('dokumentasi');
});
