<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PengaturanSitusSeeder::class,
            KategoriBeritaSeeder::class,
            CabangOlahragaSeeder::class,
            BeritaSeeder::class,
            KegiatanSeeder::class,
            GaleriSeeder::class,
        ]);
    }
}
