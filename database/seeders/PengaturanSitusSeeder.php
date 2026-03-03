<?php

namespace Database\Seeders;

use App\Models\PengaturanSitus;
use Illuminate\Database\Seeder;

class PengaturanSitusSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Umum
            'nama_situs' => 'KONI Provinsi Papua Pegunungan',
            'deskripsi_situs' => 'Wadah pembinaan olahraga prestasi di Provinsi Papua Pegunungan',
            'email' => 'info@konipapuapegunungan.id',
            'telepon' => '(0969) 31000',
            'alamat' => 'Jl. Trikora No. 1, Wamena, Jayawijaya',
            'logo' => null,
            // Media Sosial
            'sosmed_facebook' => null,
            'sosmed_instagram' => null,
            'sosmed_youtube' => null,
            'sosmed_twitter' => null,
            'sosmed_tiktok' => null,
            // SEO
            'seo_meta_keywords' => 'KONI, Papua Pegunungan, olahraga, prestasi, atlet',
            'seo_meta_description' => 'Website resmi KONI Provinsi Papua Pegunungan - Wadah pembinaan olahraga prestasi.',
            'seo_og_image' => null,
        ];

        foreach ($settings as $key => $value) {
            PengaturanSitus::create(['key' => $key, 'value' => $value]);
        }
    }
}
