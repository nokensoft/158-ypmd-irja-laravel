<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PengaturanSitusSeeder::class,
            KategoriBeritaSeeder::class,
            CabangOlahragaSeeder::class,
            BeritaSeeder::class,
            KegiatanSeeder::class,
        ]);
    }
}
