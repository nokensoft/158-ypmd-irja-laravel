<?php

namespace Database\Seeders;

use App\Models\Donasi;
use Illuminate\Database\Seeder;

class DonasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_donatur'   => 'Bapak Yohanis Wenda',
                'email'          => 'yohanis.wenda@gmail.com',
                'telepon'        => '08123456789',
                'bank'           => 'BRI',
                'jumlah'         => 500000,
                'pesan'          => 'Semoga YPMD IRJA terus berjuang untuk masyarakat adat Papua.',
                'bukti_transfer' => null,
                'status'         => 'dikonfirmasi',
                'catatan_admin'  => 'Telah diterima, terima kasih.',
                'tanggal'        => '2026-01-15',
            ],
            [
                'nama_donatur'   => 'Ibu Maria Kogoya',
                'email'          => 'maria.kogoya@yahoo.com',
                'telepon'        => '08234567890',
                'bank'           => 'Mandiri',
                'jumlah'         => 250000,
                'pesan'          => 'Untuk program KDK dan pemberdayaan petani.',
                'bukti_transfer' => null,
                'status'         => 'pending',
                'catatan_admin'  => null,
                'tanggal'        => '2026-03-10',
            ],
        ];

        foreach ($data as $item) {
            Donasi::create($item);
        }

        $this->command->info('DonasiSeeder: ' . count($data) . ' donasi berhasil dibuat.');
    }
}
