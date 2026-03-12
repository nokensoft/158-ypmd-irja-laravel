# YPMD IRJA - Website Resmi

Website resmi Yayasan Pembangunan Masyarakat Desa Irian Jaya (YPMD IRJA) — LSM pertama di Tanah Papua sejak 1984. Menampilkan informasi program pemberdayaan masyarakat adat, buletin Kabar Dari Kampung (KDK), berita Papua Today, galeri kegiatan, dan donasi.

---

## 1. Spesifikasi Teknologi

- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Tailwind CSS 4, Alpine.js 3, Vite 7
- **Database:** MySQL
- **Editor:** CKEditor 5 (WYSIWYG)
- **Icon:** Font Awesome 7
- **Font:** Lora (display), Plus Jakarta Sans (body)
- **Autentikasi:** Custom auth middleware dengan role-based access (admin_master, penulis)
- **Tracking:** Middleware pencatatan kunjungan situs otomatis

### Menjalankan Proyek

```bash
composer setup     # Install, generate key, migrate, build assets
composer dev       # Jalankan server, queue, logs, dan vite secara bersamaan
```

---

## 2. Fitur Utama — Visitor (Publik)

- **Beranda** — Statistik yayasan, berita terbaru, buletin KDK, program unggulan, galeri, mitra kerja
- **Sejarah** — Sejarah pendirian YPMD IRJA sejak 1984 (halaman dinamis CMS)
- **Profil** — Profil organisasi yayasan (halaman dinamis CMS)
- **Mitra Kerja** — Daftar mitra dan sponsor YPMD IRJA (halaman dinamis CMS)
- **Bidang Kerja** — Informasi bidang kerja yayasan (halaman dinamis CMS)
- **Tokoh** — Tokoh-tokoh pendiri dan pengurus yayasan
- **Program** — Program unggulan: Informasi, Ekonomi Kerakyatan, Clean Water, Promosi Usaha
- **KDK** — Buletin Kabar Dari Kampung — media alternatif masyarakat adat Papua sejak 1982
- **Papua Today** — Berita dan artikel dengan filter kategori, pencarian, dan detail pembaca
- **Donasi** — Form donasi untuk mendukung program pemberdayaan masyarakat
- **Galeri** — Album foto kegiatan dengan halaman detail
- **Kontak** — Informasi kontak dan media sosial YPMD IRJA
- **Peta Situs** — Halaman peta situs (HTML sitemap) untuk navigasi lengkap

---

## 3. Fitur Utama — Admin & Penulis

### Admin Master (`/admin`)

- **Dashboard** — Ringkasan data, aktivitas terbaru, info sistem
- **Halaman (CMS)** — Kelola halaman dinamis: sejarah, profil, mitra, bidang kerja
- **Pengaturan Situs** — Nama situs, deskripsi, kontak, media sosial, logo, SEO (meta keywords, description, OG image)
- **Backup Database** — Buat backup SQL (mysqldump/fallback PHP), download, hapus, dan restore dari file SQL
- **Manajemen Pengguna** — CRUD pengguna dengan soft delete dan restore
- **Aktivitas Login** — Log riwayat login seluruh pengguna
- **Statistik Pengunjung** — Grafik harian, mingguan, bulanan, tahunan
- **Dokumentasi** — Dokumentasi teknis proyek, download PDF, copy informasi

### Penulis (`/penulis`)

- **Dashboard** — Ringkasan konten
- **Artikel / Papua Today** — CRUD berita dengan status terbit/draft, soft delete & restore
- **Kategori Berita** — CRUD kategori berita dengan soft delete & restore
- **Edisi KDK** — CRUD buletin Kabar Dari Kampung dengan soft delete & restore
- **Media** — Upload dan kelola file media (gambar), mendukung AJAX upload, endpoint JSON untuk integrasi editor
- **Galeri** — CRUD album galeri dengan relasi media dan soft delete & restore
- **Program Donasi** — CRUD program donasi dengan soft delete & restore
- **Kelola Donasi** — Lihat, konfirmasi, tolak, dan hapus donasi masuk
- **Statistik Pengunjung** — Grafik kunjungan situs
- **Aktivitas Login** — Log riwayat login penulis
- **Dokumentasi** — Dokumentasi teknis proyek, download PDF, copy informasi
