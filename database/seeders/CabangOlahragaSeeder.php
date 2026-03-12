<?php

namespace Database\Seeders;

use App\Models\CabangOlahraga;
use Illuminate\Database\Seeder;

class CabangOlahragaSeeder extends Seeder
{
    public function run(): void
    {
        $bidang = [
            ['nama' => 'Pemberdayaan Ekonomi', 'icon' => 'fa-hand-holding-dollar', 'jumlah_atlet' => 120, 'jumlah_medali' => 15, 'deskripsi' => 'Pengembangan ekonomi kerakyatan melalui koperasi kampung, simpan-pinjam, dan akses pasar bagi masyarakat desa di Irian Jaya / Papua sekarang.'],
            ['nama' => 'Budidaya Kakao', 'icon' => 'fa-seedling', 'jumlah_atlet' => 85, 'jumlah_medali' => 10, 'deskripsi' => 'Pendampingan petani kakao organik di Papua mulai dari budidaya, pasca panen, hingga ekspor ke pasar internasional.'],
            ['nama' => 'Advokasi Hak Tanah Adat', 'icon' => 'fa-scale-balanced', 'jumlah_atlet' => 50, 'jumlah_medali' => 8, 'deskripsi' => 'Pendampingan hukum dan advokasi hak-hak tanah adat bagi komunitas masyarakat desa di Irian Jaya / Papua sekarang.'],
            ['nama' => 'Pemetaan Wilayah Adat', 'icon' => 'fa-map-location-dot', 'jumlah_atlet' => 35, 'jumlah_medali' => 12, 'deskripsi' => 'Pemetaan partisipatif wilayah kelola dan hutan adat menggunakan teknologi GPS bersama komunitas adat.'],
            ['nama' => 'Ketahanan Pangan', 'icon' => 'fa-wheat-awn', 'jumlah_atlet' => 90, 'jumlah_medali' => 7, 'deskripsi' => 'Program pertanian berkelanjutan dan ketahanan pangan lokal untuk masyarakat kampung di Papua.'],
            ['nama' => 'Pendidikan & Literasi', 'icon' => 'fa-graduation-cap', 'jumlah_atlet' => 60, 'jumlah_medali' => 5, 'deskripsi' => 'Program pendidikan alternatif dan peningkatan literasi bagi masyarakat kampung Papua.'],
            ['nama' => 'Media Komunitas (KDK)', 'icon' => 'fa-newspaper', 'jumlah_atlet' => 25, 'jumlah_medali' => 6, 'deskripsi' => 'Penerbitan buletin Kabar Dari Kampung (KDK) sebagai media alternatif masyarakat desa di Irian Jaya / Papua sekarang sejak 1982.'],
            ['nama' => 'Penguatan Kelembagaan', 'icon' => 'fa-building-columns', 'jumlah_atlet' => 40, 'jumlah_medali' => 9, 'deskripsi' => 'Penguatan kapasitas organisasi masyarakat sipil dan kelembagaan adat di tingkat kampung.'],
        ];

        foreach ($bidang as $data) {
            CabangOlahraga::updateOrCreate(['nama' => $data['nama']], $data);
        }
    }
}
