<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $kegiatan = [
            [
                'judul' => 'Pelatihan Budidaya Kakao Organik',
                'deskripsi' => 'Pelatihan teknis budidaya kakao organik bagi kelompok tani binaan YPMD IRJA di wilayah Boven Digoel dan Merauke.',
                'tanggal_mulai' => '2026-05-15',
                'tanggal_selesai' => '2026-05-17',
                'lokasi' => 'Kampung Getentiri, Boven Digoel',
            ],
            [
                'judul' => 'Lokakarya Pemetaan Wilayah Adat',
                'deskripsi' => 'Lokakarya partisipatif bersama komunitas adat untuk memetakan wilayah kelola dan hutan adat menggunakan teknologi GPS.',
                'tanggal_mulai' => '2026-06-05',
                'tanggal_selesai' => '2026-06-10',
                'lokasi' => 'Jayapura',
            ],
            [
                'judul' => 'Workshop Penguatan Koperasi Kampung',
                'deskripsi' => 'Workshop pengelolaan koperasi simpan-pinjam dan ekonomi kerakyatan bagi pengurus koperasi kampung di wilayah dampingan YPMD IRJA.',
                'tanggal_mulai' => '2026-07-20',
                'tanggal_selesai' => '2026-07-22',
                'lokasi' => 'Kantor YPMD IRJA, Jayapura',
            ],
            [
                'judul' => 'Pendampingan Hak Tanah Adat Mee Pago',
                'deskripsi' => 'Pendampingan hukum dan advokasi hak tanah adat bagi komunitas Mee Pago di Papua Tengah.',
                'tanggal_mulai' => '2026-08-01',
                'tanggal_selesai' => '2026-08-05',
                'lokasi' => 'Nabire, Papua Tengah',
            ],
            [
                'judul' => 'Peluncuran Buletin KDK Edisi 7',
                'deskripsi' => 'Peluncuran edisi ke-7 buletin Kabar Dari Kampung (KDK) dengan tema Ketahanan Pangan dan Pertanian Tradisional.',
                'tanggal_mulai' => '2026-09-12',
                'tanggal_selesai' => '2026-09-12',
                'lokasi' => 'Jayapura',
            ],
            [
                'judul' => 'Forum CSO Papua — Evaluasi Program Tahunan',
                'deskripsi' => 'Pertemuan tahunan organisasi masyarakat sipil (CSO) di Papua untuk evaluasi program dan perencanaan kolaboratif tahun berikutnya.',
                'tanggal_mulai' => '2026-10-08',
                'tanggal_selesai' => '2026-10-10',
                'lokasi' => 'Jayapura',
            ],
            [
                'judul' => 'Pelatihan Digital Marketing UMKM Papua',
                'deskripsi' => 'Pelatihan pemasaran digital untuk pelaku UMKM lokal Papua agar produk-produk kampung dapat dipromosikan secara online.',
                'tanggal_mulai' => '2026-11-01',
                'tanggal_selesai' => '2026-11-03',
                'lokasi' => 'Sentani, Jayapura',
            ],
            [
                'judul' => 'Peringatan 44 Tahun YPMD IRJA',
                'deskripsi' => 'Peringatan ulang tahun ke-44 Yayasan Pembangunan Masyarakat Desa Irian Jaya (YPMD IRJA) dengan refleksi perjalanan dan pencapaian sejak 1982.',
                'tanggal_mulai' => '2026-12-01',
                'tanggal_selesai' => '2026-12-01',
                'lokasi' => 'Jayapura',
            ],
        ];

        foreach ($kegiatan as $data) {
            Kegiatan::updateOrCreate(['judul' => $data['judul']], $data);
        }
    }
}
