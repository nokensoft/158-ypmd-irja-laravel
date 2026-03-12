<?php

namespace Database\Seeders;

use App\Models\Kdk;
use App\Models\Media;
use Illuminate\Database\Seeder;

class KdkSeeder extends Seeder
{
    public function run(): void
    {
        $logoMedia = Media::where('file_name', 'logo-ypmd-irja.png')->first();
        $mediaId = $logoMedia?->id;

        if (!$mediaId) {
            $this->command->warn('Media logo-ypmd-irja.png belum tersedia. KDK akan dibuat tanpa gambar sampul.');
        }

        $edisi = [
            [
                'nomor_edisi'    => '6',
                'judul'          => 'Kabar Dari Kampung — Edisi 6: Ekonomi Komunitas & Keuangan Mikro',
                'deskripsi'      => 'Edisi ini membahas perkembangan simpan-pinjam komunitas, koperasi petani kakao, dan model keuangan mikro yang berhasil dikembangkan di beberapa kampung di Papua.',
                'tanggal_terbit' => '1992-06-01',
                'file_pdf'       => null,
                'media_id'       => $mediaId,
                'user_id'        => 1,
            ],
            [
                'nomor_edisi'    => '5',
                'judul'          => 'Kabar Dari Kampung — Edisi 5: Tanah Adat & Hak Masyarakat',
                'deskripsi'      => 'Mengulas perjuangan masyarakat desa di Irian Jaya / Papua sekarang dalam mempertahankan hak atas tanah leluhur mereka di tengah arus investasi dan pembangunan.',
                'tanggal_terbit' => '1990-03-15',
                'file_pdf'       => null,
                'media_id'       => $mediaId,
                'user_id'        => 1,
            ],
            [
                'nomor_edisi'    => '4',
                'judul'          => 'Kabar Dari Kampung — Edisi 4: Pertanian & Ketahanan Pangan',
                'deskripsi'      => 'Laporan dari kampung-kampung tentang praktik pertanian tradisional, introduksi varietas baru, dan upaya menjaga ketahanan pangan lokal.',
                'tanggal_terbit' => '1988-09-01',
                'file_pdf'       => null,
                'media_id'       => $mediaId,
                'user_id'        => 1,
            ],
        ];

        foreach ($edisi as $item) {
            Kdk::create($item);
        }

        $this->command->info('KdkSeeder: ' . count($edisi) . ' edisi KDK berhasil dibuat.');
    }
}
