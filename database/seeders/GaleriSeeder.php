<?php

namespace Database\Seeders;

use App\Models\Galeri;
use App\Models\Media;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        // Media sudah di-seed oleh MediaSeeder, cukup lookup by file_name
        $mediaMap = Media::pluck('id', 'file_name');

        if ($mediaMap->isEmpty()) {
            $this->command->warn('Belum ada media. Jalankan MediaSeeder terlebih dahulu.');
            return;
        }

        $userId = 2;

        $albums = [
            [
                'judul'     => 'YPMD IRJA — 38 Tahun Berkarya',
                'deskripsi' => 'Dokumentasi peringatan 38 tahun YPMD IRJA dalam mendampingi masyarakat desa di Irian Jaya / Papua sekarang.',
                'kategori'  => 'Kegiatan',
                'images'    => [
                    'ypmd-irja-ulang-tahun-38-jubi.jpg',
                    'Kantor YPMD-IRJA.png',
                    'logo-ypmd-irja.png',
                ],
            ],
            [
                'judul'     => 'Alam & Budaya Papua',
                'deskripsi' => 'Keindahan alam dan kekayaan budaya Papua yang menjadi bagian dari wilayah kerja YPMD IRJA.',
                'kategori'  => 'Budaya',
                'images'    => [
                    'danau-sentani.png',
                    'perahu-danau-sentani.png',
                    'raja-ampat.png',
                    'rumput-mei-wamena.png',
                ],
            ],
            [
                'judul'     => 'Seni & Arsitektur Tradisional Papua',
                'deskripsi' => 'Dokumentasi seni ukir, arsitektur tradisional, dan warisan budaya masyarakat desa di Irian Jaya / Papua sekarang.',
                'kategori'  => 'Budaya',
                'images'    => [
                    'honai.png',
                    'rumah-adat.png',
                    'pahatan-kayu-sentani.png',
                ],
            ],
            [
                'judul'     => 'Kehidupan Masyarakat Desa di Irian Jaya / Papua Sekarang',
                'deskripsi' => 'Kehidupan sehari-hari masyarakat kampung Papua yang menjadi sasaran program YPMD IRJA.',
                'kategori'  => 'Komunitas',
                'images'    => [
                    'anak-anak-mendayung.png',
                ],
            ],
            [
                'judul'     => 'Tokoh & Penggerak YPMD IRJA',
                'deskripsi' => 'Profil tokoh-tokoh yang berperan penting dalam perjalanan YPMD IRJA.',
                'kategori'  => 'Komunitas',
                'images'    => [
                    'avatar-decky-rumaropen.png',
                    'avatar-george-junus-aditjondro.png',
                ],
            ],
        ];

        foreach ($albums as $albumData) {
            $galeri = Galeri::create([
                'judul'     => $albumData['judul'],
                'deskripsi' => $albumData['deskripsi'],
                'kategori'  => $albumData['kategori'],
                'user_id'   => $userId,
            ]);

            $attachedCount = 0;

            foreach ($albumData['images'] as $fileName) {
                $mediaId = $mediaMap[$fileName] ?? null;

                if (!$mediaId) {
                    $this->command->warn("Media tidak ditemukan untuk: {$fileName}");
                    continue;
                }

                $galeri->media()->attach($mediaId);
                $attachedCount++;
            }

            $this->command->info("Album \"{$galeri->judul}\" berhasil dibuat dengan {$attachedCount} foto.");
        }
    }
}
