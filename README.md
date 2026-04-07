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
- **SEO:** Dynamic robots.txt, XML sitemap otomatis, meta tags (keywords, description, OG image)
- **Optimasi Gambar:** Konversi otomatis ke WebP, resize max 720px (GD Library)
- **Soft Delete:** Seluruh data CRUD mendukung soft delete, restore, dan force delete
- **Caching:** View Composer dengan cache 5 menit untuk pengaturan situs global

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
- **KDK** — Buletin Kabar Dari Kampung — media alternatif masyarakat adat Papua sejak 1982, detail edisi, pencarian, filter tahun, counter pembaca & unduhan, download PDF
- **Papua Today** — Berita dan artikel dengan filter kategori, pencarian, counter pembaca, dan artikel terkait
- **Donasi** — Form donasi dengan pilihan program, upload bukti transfer, opsi donatur anonim, testimoni donatur publik
- **Galeri** — Album foto kegiatan dengan filter kategori (Kegiatan, Budaya, Komunitas, Program, Lainnya), pencarian, dan halaman detail
- **Kontak** — Informasi kontak dan media sosial YPMD IRJA
- **Peta Situs** — Halaman peta situs (HTML sitemap) untuk navigasi lengkap
- **SEO** — Dynamic robots.txt dan XML sitemap otomatis untuk seluruh halaman publik

---

## 3. Fitur Utama — Admin & Penulis

### Admin Master (`/admin`)

- **Dashboard** — Ringkasan data, aktivitas terbaru, info sistem
- **Halaman (CMS)** — Kelola halaman dinamis: sejarah, profil, mitra, bidang kerja, soft delete & restore
- **Pengaturan Situs** — Nama situs, deskripsi, kontak, media sosial, logo, SEO (meta keywords, description, OG image)
- **Backup Database** — Buat backup SQL (mysqldump/fallback PHP), download, hapus, dan restore dari file SQL
- **Manajemen Pengguna** — CRUD pengguna dengan soft delete, restore, dan force delete
- **Aktivitas Login** — Log riwayat login seluruh pengguna
- **Statistik Pengunjung** — Grafik harian, mingguan, bulanan, tahunan
- **Profil** — Edit profil akun (nama, email, password, nomor HP, keterangan singkat)
- **Dokumentasi** — Dokumentasi teknis proyek, download PDF, copy informasi

---

## 4. Auto Deploy (GitHub Webhook)

Sistem auto-deploy otomatis memperbarui server production ketika ada push/merge ke branch `main` melalui GitHub Webhook. Selama proses deploy, situs otomatis masuk **maintenance mode** dan database di-**backup** terlebih dahulu.

### Alur Kerja

```
Merge PR ke main → GitHub kirim POST ke https://ypmd-irja.org/deploy.php
→ Validasi signature → Maintenance mode ON → Backup database SQL
→ git pull → composer install → migrate → cache rebuild
→ Maintenance mode OFF
```

### Komponen

- `public/deploy.php` — Standalone webhook handler (endpoint utama)
- `deploy.sh` — Shell script alternatif untuk deploy manual dari server
- `DeployController` — Controller Laravel (endpoint alternatif via `/deploy/webhook`)

### Fitur Deploy

- **Maintenance mode** otomatis selama proses deploy (bypass secret: `bypass-deploy-2026`)
- **Backup database SQL** otomatis sebelum deploy (MySQL & SQLite)
- **Rotasi backup** — hanya menyimpan 5 backup terakhir
- **Rollback otomatis** — jika git pull gagal, maintenance mode langsung dinonaktifkan
- **Log lengkap** setiap langkah deploy

### Setup di Server

1. **Generate secret key:**

   ```bash
   openssl rand -hex 32
   ```

2. **Tambahkan ke `.env` server:**

   ```env
   DEPLOY_SECRET=hasil_random_key
   ```

3. **Set permission:**

   ```bash
   chmod +x deploy.sh
   # Pastikan web server user punya akses git
   sudo chown -R www-data:www-data /path/to/project
   ```

### Setup di GitHub

1. Buka repo → **Settings** → **Webhooks** → **Add webhook**
2. Isi form:
   - **Payload URL:** `https://ypmd-irja.org/deploy.php`
   - **Content type:** `application/json`
   - **Secret:** isi dengan secret key yang sama dengan `DEPLOY_SECRET` di `.env`
   - **Events:** pilih **Just the push event**
   - **Active:** ✅
3. Klik **Add webhook**

### Log & Backup

- **Log deploy:** `storage/logs/deploy.log`
- **Backup database:** `storage/app/backups/`
- **Akses saat maintenance:** `https://ypmd-irja.org/bypass-deploy-2026`

### Penulis (`/penulis`)

- **Dashboard** — Ringkasan konten
- **Artikel / Papua Today** — CRUD berita dengan status terbit/draft, soft delete, restore & force delete
- **Kategori Berita** — CRUD kategori berita dengan soft delete, restore & force delete
- **Edisi KDK** — CRUD buletin Kabar Dari Kampung dengan cover image, file PDF, counter pembaca & unduhan, soft delete, restore & force delete
- **Media** — Upload dan kelola file media (gambar), konversi otomatis ke WebP, AJAX upload, endpoint JSON untuk integrasi editor, soft delete & restore
- **Galeri** — CRUD album galeri dengan relasi media, kategori, toggle publik, soft delete, restore & force delete
- **Program Donasi** — CRUD program donasi dengan soft delete, restore & force delete
- **Kelola Donasi** — Lihat detail, konfirmasi, tolak, edit pesan, toggle publik/anonim, lihat bukti transfer, soft delete, restore & force delete
- **Statistik Pengunjung** — Grafik kunjungan situs
- **Aktivitas Login** — Log riwayat login penulis
- **Profil** — Edit profil akun (nama, email, password, nomor HP, keterangan singkat)
- **Dokumentasi** — Dokumentasi teknis proyek, download PDF, copy informasi
