<?php

namespace Database\Seeders;

use App\Models\CabangOlahraga;
use Illuminate\Database\Seeder;

class CabangOlahragaSeeder extends Seeder
{
    public function run(): void
    {
        $cabor = [
            ['nama' => 'Atletik', 'icon' => 'fa-person-running', 'jumlah_atlet' => 45, 'jumlah_medali' => 18, 'deskripsi' => 'Cabang olahraga atletik meliputi lari, lompat, dan lempar.'],
            ['nama' => 'Sepak Bola', 'icon' => 'fa-futbol', 'jumlah_atlet' => 30, 'jumlah_medali' => 5, 'deskripsi' => 'Olahraga beregu paling populer di Papua Pegunungan.'],
            ['nama' => 'Bola Basket', 'icon' => 'fa-basketball', 'jumlah_atlet' => 24, 'jumlah_medali' => 3, 'deskripsi' => 'Olahraga beregu dengan popularitas tinggi di kalangan muda.'],
            ['nama' => 'Bola Voli', 'icon' => 'fa-volleyball', 'jumlah_atlet' => 24, 'jumlah_medali' => 6, 'deskripsi' => 'Olahraga beregu yang dimainkan di berbagai pelosok Papua Pegunungan.'],
            ['nama' => 'Tinju', 'icon' => 'fa-hand-fist', 'jumlah_atlet' => 20, 'jumlah_medali' => 15, 'deskripsi' => 'Cabang olahraga bela diri unggulan Papua Pegunungan.'],
            ['nama' => 'Pencak Silat', 'icon' => 'fa-yin-yang', 'jumlah_atlet' => 18, 'jumlah_medali' => 12, 'deskripsi' => 'Seni bela diri tradisional Indonesia.'],
            ['nama' => 'Renang', 'icon' => 'fa-person-swimming', 'jumlah_atlet' => 15, 'jumlah_medali' => 8, 'deskripsi' => 'Olahraga air yang menjanjikan potensi medali.'],
            ['nama' => 'Panahan', 'icon' => 'fa-bullseye', 'jumlah_atlet' => 12, 'jumlah_medali' => 10, 'deskripsi' => 'Cabang olahraga ketepatan yang semakin berkembang.'],
            ['nama' => 'Badminton', 'icon' => 'fa-shuttlecock', 'jumlah_atlet' => 16, 'jumlah_medali' => 7, 'deskripsi' => 'Olahraga raket yang populer di seluruh Indonesia.'],
            ['nama' => 'Tenis Meja', 'icon' => 'fa-table-tennis-paddle-ball', 'jumlah_atlet' => 10, 'jumlah_medali' => 9, 'deskripsi' => 'Olahraga indoor dengan pertumbuhan atlet yang pesat.'],
            ['nama' => 'Karate', 'icon' => 'fa-hand-back-fist', 'jumlah_atlet' => 14, 'jumlah_medali' => 11, 'deskripsi' => 'Seni bela diri asal Jepang yang populer di kalangan pemuda.'],
            ['nama' => 'Dayung', 'icon' => 'fa-ship', 'jumlah_atlet' => 12, 'jumlah_medali' => 4, 'deskripsi' => 'Cabang olahraga air yang menjadi potensi unggulan daerah.'],
        ];

        foreach ($cabor as $data) {
            CabangOlahraga::updateOrCreate(['nama' => $data['nama']], $data);
        }
    }
}
