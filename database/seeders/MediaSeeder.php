<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaSeeder extends Seeder
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

        $userId = 2; // default penulis

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $count = 0;

        foreach ($files as $file) {
            $extension = strtolower($file->getExtension());

            if (!in_array($extension, $allowedExtensions)) {
                continue;
            }

            $fileName = $file->getFilename();

            // Skip jika sudah ada di database
            if (Media::where('file_name', $fileName)->exists()) {
                $this->command->info("Media sudah ada, skip: {$fileName}");
                continue;
            }

            // Copy ke storage/app/public/media/
            $storagePath = 'media/' . $fileName;
            Storage::disk('public')->put($storagePath, File::get($file->getPathname()));

            // Buat judul dari nama file
            $judul = Str::title(
                str_replace(['-', '_'], ' ', pathinfo($fileName, PATHINFO_FILENAME))
            );

            Media::create([
                'judul'     => $judul,
                'tipe'      => 'foto',
                'file_path' => $storagePath,
                'file_name' => $fileName,
                'file_size' => $file->getSize(),
                'user_id'   => $userId,
            ]);

            $count++;
        }

        $this->command->info("MediaSeeder: {$count} media berhasil disimpan ke storage dan database.");
    }
}
