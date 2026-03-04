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

        // Buat album galeri
        $albums = [
            [
                'judul'     => 'Pengukuhan dan Pelantikan KONI Papua Pegunungan',
                'deskripsi' => 'Dokumentasi pengukuhan dan pelantikan kepengurusan KONI Provinsi Papua Pegunungan masa bakti 2025-2029 di Kantor KONI Pusat Senayan, Jakarta.',
                'kategori'  => 'Organisasi',
                'images'    => [
                    'KONI Papua Pegunungan, Pengukuhan dan Pelantikan.jpeg',
                    'Ketum KONI Pusat Letjen TNI Purn Marciano Norman.jpeg',
                ],
            ],
            [
                'judul'     => 'Profil Ketua Umum KONI Papua Pegunungan',
                'deskripsi' => 'Dokumentasi Dr. Hc. Jhon Tabo, SE, M.BA. selaku Ketua Umum KONI Provinsi Papua Pegunungan periode 2025-2029.',
                'kategori'  => 'Organisasi',
                'images'    => [
                    'Gubernur Jhon Tabo, KONI Papua Pegunungan.jpeg',
                    'Ketum KONI Provinsi Papua Pegunungan.jpeg',
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
