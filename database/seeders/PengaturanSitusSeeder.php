<?php

namespace Database\Seeders;

use App\Models\PengaturanSitus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PengaturanSitusSeeder extends Seeder
{
    public function run(): void
    {
        // Copy logo ke storage
        $logoSrc = public_path('img/logo-ypmd-irja.png');
        $logoPath = null;
        if (File::exists($logoSrc)) {
            $logoPath = 'situs/logo-ypmd-irja.png';
            Storage::disk('public')->put($logoPath, File::get($logoSrc));
            $this->command->info('Logo disalin ke storage: ' . $logoPath);
        }

        // Copy gambar kantor ke storage untuk OG Image
        $kantorSrc = public_path('img/galeri/Kantor YPMD-IRJA.png');
        $ogImagePath = null;
        if (File::exists($kantorSrc)) {
            $ogImagePath = 'situs/og-image-kantor-ypmd-irja.png';
            Storage::disk('public')->put($ogImagePath, File::get($kantorSrc));
            $this->command->info('OG Image disalin ke storage: ' . $ogImagePath);
        }

        $settings = [
            // Umum
            'nama_situs'      => 'YPMD IRJA',
            'deskripsi_situs' => 'Yayasan Pembangunan Masyarakat Desa Irian Jaya — Mendampingi masyarakat desa di Irian Jaya / Papua sekarang sejak 1982',
'email'           => 'info@ypmd-irja.org',
            'telepon'         => '(0967) 123456',
            'alamat'          => 'Jl. Ahmad Yani No. 12, Jayapura, Papua',
            'logo'            => $logoPath,
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
            'seo_meta_keywords'   => 'YPMD IRJA, Papua, masyarakat desa di Irian Jaya / Papua sekarang, pemberdayaan, kakao, KDK, Kabar Dari Kampung',
            'seo_meta_description'=> 'Website resmi YPMD IRJA — Mendampingi masyarakat desa di Irian Jaya / Papua sekarang dalam pemberdayaan ekonomi, hak tanah, dan ketahanan pangan sejak 1982.',
            'seo_og_image'        => $ogImagePath,
        ];

        foreach ($settings as $key => $value) {
            PengaturanSitus::create(['key' => $key, 'value' => $value]);
        }
    }
}
