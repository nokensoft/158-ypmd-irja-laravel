<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = base_path('_backup_html/data/berita.json');

        if (!file_exists($jsonPath)) {
            $this->command->warn('File berita.json tidak ditemukan di _backup_html/data/');
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);

        if (empty($data)) {
            $this->command->warn('Data berita.json kosong atau format tidak valid.');
            return;
        }

        // Cache kategori mapping: nama => id
        $kategoriMap = KategoriBerita::pluck('id', 'nama')->toArray();

        // Default user_id (penulis)
        $userId = 2;

        foreach ($data as $item) {
            // Cari kategori_berita_id berdasarkan nama kategori
            $kategoriId = $kategoriMap[$item['kategori']] ?? null;

            // Gabungkan array konten menjadi paragraf HTML
            $konten = collect($item['konten'])
                ->map(fn($paragraf) => '<p>' . e($paragraf) . '</p>')
                ->implode("\n");

            Berita::create([
                'judul'             => $item['judul'],
                'slug'              => $item['slug'],
                'ringkasan'         => $item['ringkasan'],
                'konten'            => $konten,
                'sumber_nama'       => $item['sumber']['nama'] ?? null,
                'sumber_link'       => $item['sumber']['link'] ?? null,
                'kategori_berita_id'=> $kategoriId,
                'gambar_url'        => $item['gambar'] ?? null,
                'user_id'           => $userId,
                'status'            => 'terbit',
                'tanggal_terbit'    => $item['tanggal'] ?? null,
                'created_at'        => $item['tanggal'] ?? now(),
            ]);
        }

        $this->command->info('Berhasil import ' . count($data) . ' berita dari berita.json');
    }
}
