<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $kegiatan = [
            [
                'judul' => 'Kejuaraan Daerah Atletik I',
                'deskripsi' => 'Kompetisi atletik tingkat provinsi untuk menjaring atlet potensial dari seluruh kabupaten di Papua Pegunungan.',
                'tanggal_mulai' => '2026-05-15',
                'tanggal_selesai' => '2026-05-17',
                'lokasi' => 'Stadion Wamena',
            ],
            [
                'judul' => 'Turnamen Sepak Bola Gubernur Cup',
                'deskripsi' => 'Turnamen sepak bola antar kabupaten se-Papua Pegunungan yang diselenggarakan atas dukungan Gubernur.',
                'tanggal_mulai' => '2026-06-05',
                'tanggal_selesai' => '2026-06-10',
                'lokasi' => 'Lapangan Utama Wamena',
            ],
            [
                'judul' => 'Pelatihan Pelatih Cabor',
                'deskripsi' => 'Workshop peningkatan kompetensi pelatih dari berbagai cabang olahraga di Papua Pegunungan.',
                'tanggal_mulai' => '2026-07-20',
                'tanggal_selesai' => '2026-07-22',
                'lokasi' => 'Gedung KONI',
            ],
            [
                'judul' => 'Seleksi Atlet PON 2026',
                'deskripsi' => 'Seleksi atlet Papua Pegunungan untuk persiapan Pekan Olahraga Nasional mendatang.',
                'tanggal_mulai' => '2026-08-01',
                'tanggal_selesai' => '2026-08-05',
                'lokasi' => 'Berbagai Venue',
            ],
            [
                'judul' => 'Kejuaraan Tinju Amatir',
                'deskripsi' => 'Kejuaraan tinju amatir tingkat provinsi Papua Pegunungan untuk menjaring atlet potensial.',
                'tanggal_mulai' => '2026-09-12',
                'tanggal_selesai' => '2026-09-14',
                'lokasi' => 'GOR Wamena',
            ],
            [
                'judul' => 'Hari Olahraga Nasional',
                'deskripsi' => 'Peringatan Hari Olahraga Nasional dengan berbagai kegiatan olahraga massal dan senam bersama.',
                'tanggal_mulai' => '2026-10-08',
                'tanggal_selesai' => '2026-10-08',
                'lokasi' => 'Kota Wamena',
            ],
            [
                'judul' => 'PON Bela Diri Sulawesi Utara',
                'deskripsi' => 'Pekan Olahraga Nasional cabang bela diri yang diselenggarakan di Sulawesi Utara. Papua Pegunungan akan mengirimkan atlet terbaik untuk berkompetisi di tingkat nasional.',
                'tanggal_mulai' => '2026-11-01',
                'tanggal_selesai' => '2026-11-10',
                'lokasi' => 'Sulawesi Utara',
            ],
            [
                'judul' => 'PON Pantai',
                'deskripsi' => 'Pekan Olahraga Nasional cabang olahraga pantai. Papua Pegunungan siap bersaing dalam ajang olahraga pantai tingkat nasional.',
                'tanggal_mulai' => '2026-12-01',
                'tanggal_selesai' => '2026-12-07',
                'lokasi' => 'TBA',
            ],
            [
                'judul' => 'PON Indoor & PON Remaja',
                'deskripsi' => 'Pekan Olahraga Nasional Indoor dan PON Remaja sebagai ajang pembinaan atlet muda Papua Pegunungan menuju prestasi nasional.',
                'tanggal_mulai' => '2027-06-01',
                'tanggal_selesai' => '2027-06-10',
                'lokasi' => 'TBA',
            ],
        ];

        foreach ($kegiatan as $data) {
            Kegiatan::updateOrCreate(['judul' => $data['judul']], $data);
        }
    }
}
