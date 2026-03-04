# KONI Papua Pegunungan - Website Resmi

Website resmi Komite Olahraga Nasional Indonesia (KONI) Kabupaten Papua Pegunungan. Menampilkan informasi cabang olahraga, berita, kegiatan/event, galeri, dan profil kepengurusan.

---

## 1. Spesifikasi Teknologi

- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Tailwind CSS 4, Alpine.js 3, Vite 7
- **Database:** MySQL
- **Icon:** Font Awesome 7
- **Autentikasi:** Custom auth middleware dengan role-based access (admin_master, penulis)
- **Tracking:** Middleware pencatatan kunjungan situs otomatis

### Menjalankan Proyek

```bash
composer setup     # Install, generate key, migrate, build assets
composer dev       # Jalankan server, queue, logs, dan vite secara bersamaan
```

---

## 2. Fitur Utama — Visitor (Publik)

- **Beranda** — Statistik ringkasan (cabang olahraga, atlet binaan, medali, event), daftar cabor, berita terbaru, kegiatan mendatang, galeri terbaru
- **Tentang** — Profil organisasi KONI
- **Pengurusan** — Struktur kepengurusan
- **Cabang Olahraga** — Daftar lengkap cabang olahraga binaan
- **Event/Kegiatan** — Jadwal dan informasi kegiatan olahraga
- **Berita** — Daftar berita dengan pencarian, filter kategori, pagination, dan halaman detail (penghitung jumlah dibaca)
- **Galeri** — Album foto/video dengan filter kategori dan halaman detail
- **Kontak** — Informasi kontak dan media sosial

---

## 3. Fitur Utama — Admin & Penulis

### Admin Master (`/admin`)

- **Dashboard** — Ringkasan total pengguna, berita, kegiatan, cabang olahraga, aktivitas login terbaru, dan info sistem
- **Pengaturan Situs** — Kelola nama situs, deskripsi, kontak, media sosial, logo, SEO (meta keywords, description, OG image)
- **Manajemen Pengguna** — CRUD pengguna dengan soft delete dan restore
- **Aktivitas Login** — Log riwayat login pengguna
- **Backup Database** — Buat backup SQL (mysqldump/fallback PHP), download, hapus, dan restore dari file SQL
- **Statistik Pengunjung** — Data kunjungan situs: harian, mingguan, bulanan, tahunan, total pembaca berita

### Penulis (`/penulis`)

- **Dashboard** — Ringkasan konten
- **Berita** — CRUD berita (judul, slug, ringkasan, konten, status terbit/draft, tanggal terbit) dengan soft delete & restore
- **Kategori Berita** — CRUD kategori berita dengan soft delete & restore
- **Kegiatan** — CRUD kegiatan/event dengan soft delete & restore
- **Cabang Olahraga** — CRUD data cabang olahraga (nama, jumlah atlet, medali) dengan soft delete & restore
- **Media** — Upload dan kelola file media (gambar), upload via AJAX, endpoint JSON untuk integrasi editor
- **Galeri** — CRUD album galeri (kategori, slug) dengan relasi media dan soft delete & restore
- **Statistik Pengunjung** — Akses data statistik kunjungan situs
