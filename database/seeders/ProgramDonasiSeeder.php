<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\ProgramDonasi;
use Illuminate\Database\Seeder;

class ProgramDonasiSeeder extends Seeder
{
    public function run(): void
    {
        $logoMedia = Media::where('file_name', 'logo-ypmd-irja.png')->first();
        $mediaId = $logoMedia?->id;

        $programs = [
            [
                'judul'          => 'Promosi Usaha',
                'deskripsi'      => 'Pembuatan katalog digital dan media promosi digital UMKM lokal Papua. Program ini bertujuan membantu pelaku usaha kecil dan menengah di kampung-kampung Papua untuk memasarkan produk mereka secara digital, menjangkau pasar yang lebih luas, dan meningkatkan pendapatan keluarga.',
                'media_id'       => $mediaId,
                'target_nominal' => 25000000,
                'is_active'      => true,
                'user_id'        => 1,
            ],
            [
                'judul'          => 'Ekonomi Kerakyatan',
                'deskripsi'      => 'Pengembangan potensi ekonomi masyarakat desa di Irian Jaya / Papua sekarang, aksesibilitas pasar, dan sistem saving/simpanan keuangan komunitas. Program ini mendukung pengembangan koperasi dan kelompok simpan-pinjam di tingkat kampung agar masyarakat memiliki kemandirian finansial.',
                'media_id'       => $mediaId,
                'target_nominal' => 50000000,
                'is_active'      => true,
                'user_id'        => 1,
            ],
            [
                'judul'          => 'Pengembangan Program KDK',
                'deskripsi'      => 'Digitalisasi dan pengembangan buletin Kabar Dari Kampung (KDK), media alternatif masyarakat desa di Irian Jaya / Papua sekarang sejak 1982. Dana digunakan untuk digitalisasi arsip edisi lama, produksi edisi baru, dan distribusi ke kampung-kampung terpencil di seluruh Papua.',
                'media_id'       => $mediaId,
                'target_nominal' => 15000000,
                'is_active'      => true,
                'user_id'        => 1,
            ],
        ];

        foreach ($programs as $item) {
            ProgramDonasi::create($item);
        }

        $this->command->info('ProgramDonasiSeeder: ' . count($programs) . ' program donasi berhasil dibuat.');
    }
}
