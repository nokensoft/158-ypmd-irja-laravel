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
            'nama_situs'      => 'YPMD IRJA',
            'deskripsi_situs' => 'Yayasan Pembangunan Masyarakat Desa Irian Jaya — Mendampingi masyarakat adat Papua sejak 1982',
            'email'           => 'info@ypmdirja.org',
            'telepon'         => '(0967) 123456',
            'alamat'          => 'Jl. Ahmad Yani No. 12, Jayapura, Papua',
            'logo'            => null,
            // Media Sosial
            'sosmed_facebook'  => 'https://facebook.com/ypmdirja',
            'sosmed_instagram' => 'https://instagram.com/ypmdirja',
            'sosmed_youtube'   => 'https://youtube.com/@ypmdirja',
            'sosmed_twitter'   => 'https://x.com/ypmdirja',
            'sosmed_tiktok'    => null,
            // Rekening Donasi
            'donasi_rek_bri'     => '1234-5678-9012-345 a.n. Yayasan Pembangunan Masyarakat Desa Irian Jaya',
            'donasi_rek_bni'     => '9876-5432-1098-765 a.n. YPMD IRJA',
            'donasi_rek_mandiri' => '1111-2222-3333-4444 a.n. YPMD IRJA',
            // SEO
            'seo_meta_keywords'   => 'YPMD IRJA, Papua, masyarakat adat, pemberdayaan, kakao, KDK, Kabar Dari Kampung',
            'seo_meta_description'=> 'Website resmi YPMD IRJA — Mendampingi masyarakat adat Papua dalam pemberdayaan ekonomi, hak tanah, dan ketahanan pangan sejak 1982.',
            'seo_og_image'        => null,
        ];

        foreach ($settings as $key => $value) {
            PengaturanSitus::create(['key' => $key, 'value' => $value]);
        }
    }
}
