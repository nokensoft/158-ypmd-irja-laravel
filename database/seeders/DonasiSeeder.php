<?php

namespace Database\Seeders;

use App\Models\Donasi;
use App\Models\ProgramDonasi;
use Illuminate\Database\Seeder;

class DonasiSeeder extends Seeder
{
    public function run(): void
    {
        $programs = ProgramDonasi::pluck('id', 'judul');

        $data = [
            [
                'program_donasi_id' => $programs['Ekonomi Kerakyatan'] ?? null,
                'nama_donatur'      => 'Bapak Yohanis Wenda',
                'is_anonim'         => false,
                'email'             => 'yohanis.wenda@gmail.com',
                'telepon'           => '08123456789',
                'bank'              => 'BNI',
                'jumlah'            => 500000,
                'pesan'             => 'Semoga YPMD IRJA terus berjuang untuk masyarakat desa di Irian Jaya / Papua sekarang.',
                'bukti_transfer'    => null,
                'status'            => 'dikonfirmasi',
                'catatan_admin'     => 'Telah diterima, terima kasih.',
                'tanggal'           => '2026-01-15',
            ],
            [
                'program_donasi_id' => $programs['Pengembangan Program KDK'] ?? null,
                'nama_donatur'      => 'Ibu Maria Kogoya',
                'is_anonim'         => false,
                'email'             => 'maria.kogoya@yahoo.com',
                'telepon'           => '08234567890',
                'bank'              => 'BNI',
                'jumlah'            => 250000,
                'pesan'             => 'Untuk program KDK dan pemberdayaan petani.',
                'bukti_transfer'    => null,
                'status'            => 'pending',
                'catatan_admin'     => null,
                'tanggal'           => '2026-03-10',
            ],
            [
                'program_donasi_id' => $programs['Promosi Usaha'] ?? null,
                'nama_donatur'      => 'Anonim',
                'is_anonim'         => true,
                'email'             => null,
                'telepon'           => null,
                'bank'              => 'BNI',
                'jumlah'            => 1000000,
                'pesan'             => 'Sukses selalu untuk UMKM Papua.',
                'bukti_transfer'    => null,
                'status'            => 'dikonfirmasi',
                'catatan_admin'     => 'Diterima.',
                'tanggal'           => '2026-02-20',
            ],
        ];

        foreach ($data as $item) {
            Donasi::create($item);
        }

        $this->command->info('DonasiSeeder: ' . count($data) . ' donasi berhasil dibuat.');
    }
}
