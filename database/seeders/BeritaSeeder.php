<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriMap = KategoriBerita::pluck('id', 'nama')->toArray();
        $userId = 2;

        $jsonPath = base_path('_backup_html/data/berita.json');

        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);
            if (!empty($data)) {
                foreach ($data as $item) {
                    $kategoriId = $kategoriMap[$item['kategori']] ?? null;
                    $konten = collect($item['konten'])
                        ->map(fn($paragraf) => '<p>' . e($paragraf) . '</p>')
                        ->implode("\n");
                    Berita::create([
                        'judul'              => $item['judul'],
                        'slug'               => $item['slug'],
                        'ringkasan'          => $item['ringkasan'],
                        'konten'             => $konten,
                        'sumber_nama'        => $item['sumber']['nama'] ?? null,
                        'sumber_link'        => $item['sumber']['link'] ?? null,
                        'kategori_berita_id' => $kategoriId,
                        'gambar_url'         => $item['gambar'] ?? null,
                        'user_id'            => $userId,
                        'status'             => 'terbit',
                        'tanggal_terbit'     => $item['tanggal'] ?? null,
                        'created_at'         => $item['tanggal'] ?? now(),
                    ]);
                }
                $this->command->info('Berhasil import ' . count($data) . ' berita dari berita.json');
                return;
            }
        }

        // Fallback: sample berita bertema YPMD IRJA
        $samples = [
            [
                'judul'      => 'YPMD IRJA Fasilitasi Ekspor Perdana Kakao Organik dari Boven Digoel',
                'slug'       => 'ypmd-irja-fasilitasi-ekspor-perdana-kakao-organik-boven-digoel',
                'ringkasan'  => 'Petani kakao organik binaan YPMD IRJA di Boven Digoel berhasil melakukan ekspor perdana ke pasar Eropa.',
                'konten'     => '<p>Sebanyak 5 ton kakao organik hasil panen petani binaan YPMD IRJA di Kabupaten Boven Digoel berhasil diekspor ke pasar Eropa pada Februari 2026.</p><p>Pencapaian ini merupakan hasil dari program pendampingan selama tiga tahun yang mencakup pelatihan teknis budidaya organik, penguatan kelembagaan kelompok tani, serta fasilitasi akses pasar internasional.</p>',
                'kategori'   => 'Ekspor Kakao',
                'gambar_url' => null,
                'tanggal'    => '2026-02-15',
            ],
            [
                'judul'      => 'Komunitas Adat Mee Pago Perkuat Tata Kelola Hutan Adat',
                'slug'       => 'komunitas-adat-mee-pago-perkuat-tata-kelola-hutan-adat',
                'ringkasan'  => 'Dengan dukungan YPMD IRJA, komunitas Mee Pago membangun sistem pemantauan hutan adat berbasis partisipasi masyarakat.',
                'konten'     => '<p>Komunitas adat Mee Pago di wilayah Papua Tengah kini memiliki peta wilayah adat yang telah diakui pemerintah daerah, berkat pendampingan intensif dari tim fasilitator YPMD IRJA selama dua tahun.</p><p>Peta ini menjadi instrumen penting dalam negosiasi dengan perusahaan-perusahaan yang beroperasi di wilayah adat mereka.</p>',
                'kategori'   => 'Advokasi',
                'gambar_url' => null,
                'tanggal'    => '2026-01-20',
            ],
            [
                'judul'      => 'Edisi Ke-6 Buletin KDK Resmi Diluncurkan',
                'slug'       => 'edisi-ke-6-buletin-kdk-resmi-diluncurkan',
                'ringkasan'  => 'YPMD IRJA meluncurkan edisi ke-6 buletin Kabar Dari Kampung yang mengangkat tema ekonomi komunitas dan keuangan mikro.',
                'konten'     => '<p>Buletin <em>Kabar Dari Kampung</em> (KDK) edisi ke-6 resmi diluncurkan dengan mengangkat tema utama: Ekonomi Komunitas &amp; Keuangan Mikro.</p><p>Buletin yang pertama kali terbit sejak 1982 ini telah menjadi media alternatif yang konsisten menyuarakan realita kehidupan masyarakat adat Papua.</p>',
                'kategori'   => 'KDK',
                'gambar_url' => null,
                'tanggal'    => '2026-01-10',
            ],
        ];

        foreach ($samples as $item) {
            Berita::create([
                'judul'              => $item['judul'],
                'slug'               => $item['slug'],
                'ringkasan'          => $item['ringkasan'],
                'konten'             => $item['konten'],
                'kategori_berita_id' => $kategoriMap[$item['kategori']] ?? null,
                'gambar_url'         => $item['gambar_url'],
                'user_id'            => $userId,
                'status'             => 'terbit',
                'tanggal_terbit'     => $item['tanggal'],
                'created_at'         => $item['tanggal'],
            ]);
        }

        $this->command->info('BeritaSeeder: ' . count($samples) . ' sample berita YPMD IRJA berhasil dibuat.');
    }
}
