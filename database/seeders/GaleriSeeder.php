<?php

namespace Database\Seeders;

use App\Models\Galeri;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $sourceDir = public_path('img/galeri');

        if (!File::isDirectory($sourceDir)) {
            $this->command->warn('Direktori public/img/galeri/ tidak ditemukan.');
            return;
        }

        $files = File::files($sourceDir);

        if (empty($files)) {
            $this->command->warn('Tidak ada file gambar di public/img/galeri/.');
            return;
        }

        // Default user_id (penulis)
        $userId = 2;

        // Buat album galeri YPMD IRJA
        $albums = [
            [
                'judul'     => 'YPMD IRJA — 38 Tahun Berkarya',
                'deskripsi' => 'Dokumentasi peringatan 38 tahun YPMD IRJA dalam mendampingi masyarakat adat Papua.',
                'kategori'  => 'Kegiatan',
                'images'    => [
                    'ypmd-irja-ulang-tahun-38-jubi.jpg',
                    'Kantor YPMD-IRJA.png',
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
                'deskripsi' => 'Dokumentasi seni ukir, arsitektur tradisional, dan warisan budaya masyarakat adat Papua.',
                'kategori'  => 'Budaya',
                'images'    => [
                    'honai.png',
                    'rumah-adat.png',
                    'pahatan-kayu-sentani.png',
                ],
            ],
            [
                'judul'     => 'Kehidupan Masyarakat Adat',
                'deskripsi' => 'Kehidupan sehari-hari masyarakat kampung Papua yang menjadi sasaran program YPMD IRJA.',
                'kategori'  => 'Komunitas',
                'images'    => [
                    'anak-anak-mendayung.png',
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

            foreach ($albumData['images'] as $fileName) {
                $sourcePath = $sourceDir . DIRECTORY_SEPARATOR . $fileName;

                if (!File::exists($sourcePath)) {
                    $this->command->warn("File tidak ditemukan: {$fileName}");
                    continue;
                }

                // Copy ke storage
                $storagePath = 'media/' . $fileName;
                Storage::disk('public')->put($storagePath, File::get($sourcePath));

                $media = Media::create([
                    'judul'     => pathinfo($fileName, PATHINFO_FILENAME),
                    'tipe'      => 'foto',
                    'file_path' => $storagePath,
                    'file_name' => $fileName,
                    'file_size' => File::size($sourcePath),
                    'user_id'   => $userId,
                ]);

                $galeri->media()->attach($media->id);
            }

            $this->command->info("Album \"{$galeri->judul}\" berhasil dibuat dengan " . count($albumData['images']) . " foto.");
        }
    }
}
