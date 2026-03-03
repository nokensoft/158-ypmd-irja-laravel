<?php

namespace Database\Seeders;

use App\Models\KategoriBerita;
use Illuminate\Database\Seeder;

class KategoriBeritaSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = ['Organisasi', 'Prestasi', 'Pembinaan', 'Event'];

        foreach ($kategori as $nama) {
            KategoriBerita::create(['nama' => $nama]);
        }
    }
}
