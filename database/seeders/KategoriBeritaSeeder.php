<?php

namespace Database\Seeders;

use App\Models\KategoriBerita;
use Illuminate\Database\Seeder;

class KategoriBeritaSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = ['Berita Papua', 'Program', 'Advokasi', 'Ekspor Kakao', 'KDK'];

        foreach ($kategori as $nama) {
            KategoriBerita::create(['nama' => $nama]);
        }
    }
}
