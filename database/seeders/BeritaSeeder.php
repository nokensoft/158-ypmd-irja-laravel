<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Media;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriMap = KategoriBerita::pluck('id', 'nama')->toArray();
        $userId = 2;

        // Ambil media logo untuk gambar default berita
        $logoMedia = Media::where('file_name', 'logo-ypmd-irja.png')->first();
        $logoMediaId = $logoMedia?->id;

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
            // ── Papua Today ──
            [
                'judul'      => 'Pemerintah Provinsi Papua Selatan Kucurkan Dana Pemberdayaan Masyarakat Melalui CSO Papua Selatan',
                'slug'       => 'pemprov-papua-selatan-dana-pemberdayaan-masyarakat-cso',
                'ringkasan'  => 'Pemerintah Provinsi Papua Selatan mengalokasikan dana khusus untuk program pemberdayaan masyarakat yang disalurkan melalui organisasi masyarakat sipil (CSO) di wilayah Papua Selatan.',
                'konten'     => '<p>Pemerintah Provinsi Papua Selatan resmi mengucurkan dana pemberdayaan masyarakat yang disalurkan melalui sejumlah Civil Society Organization (CSO) di Papua Selatan. Dana ini ditujukan untuk mendukung program-program penguatan kapasitas masyarakat desa di Irian Jaya / Papua sekarang, peningkatan ekonomi kampung, serta perlindungan hak-hak dasar warga di wilayah pedalaman yang selama ini sulit dijangkau oleh program pemerintah pusat.</p>
<p>Melalui skema pendanaan ini, CSO yang telah terverifikasi akan menjadi mitra langsung pemerintah provinsi dalam menjalankan program pemberdayaan di tingkat distrik dan kampung. Langkah ini dinilai strategis karena CSO memiliki kedekatan dengan masyarakat akar rumput dan pemahaman mendalam terhadap konteks lokal. Gubernur Papua Selatan menegaskan bahwa kolaborasi dengan CSO merupakan bentuk komitmen pemerintah daerah untuk memastikan dana pembangunan benar-benar menyentuh kebutuhan masyarakat Papua.</p>',
                'kategori'   => 'Berita Papua',
                'tanggal'    => '2026-03-10',
            ],
            [
                'judul'      => 'Lokakarya Pertemuan CSO, LSM, dan Mitra Pembangunan Tanah Papua: Membaca Konteks Kekinian dan Menguatkan Visi Bersama Tanah Papua',
                'slug'       => 'lokakarya-cso-lsm-mitra-pembangunan-tanah-papua',
                'ringkasan'  => 'CSO, LSM, dan mitra pembangunan di Tanah Papua menggelar lokakarya bersama untuk membaca situasi terkini dan memperkuat visi kolaboratif bagi masa depan Tanah Papua.',
                'konten'     => '<p>Sejumlah organisasi masyarakat sipil (CSO), lembaga swadaya masyarakat (LSM), dan mitra pembangunan yang beroperasi di Tanah Papua menggelar lokakarya bersama bertajuk "Membaca Konteks Kekinian dan Menguatkan Visi Bersama Tanah Papua". Pertemuan yang berlangsung selama tiga hari ini membahas berbagai isu strategis, mulai dari pemekaran wilayah, implementasi otonomi khusus, hingga tantangan pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang di era desentralisasi.</p>
<p>Para peserta sepakat bahwa koordinasi antar-lembaga perlu diperkuat agar tidak terjadi tumpang tindih program dan sumber daya. Lokakarya ini juga menghasilkan rekomendasi bersama yang akan disampaikan kepada pemerintah daerah dan lembaga donor internasional. Salah satu poin utama yang disepakati adalah pentingnya menempatkan masyarakat desa di Irian Jaya / Papua sekarang sebagai subjek utama pembangunan, bukan sekadar penerima manfaat pasif dari program-program yang dirancang dari luar.</p>',
                'kategori'   => 'Berita Papua',
                'tanggal'    => '2026-03-08',
            ],
            [
                'judul'      => 'Walhi Daerah Papua Ganti Nahkoda',
                'slug'       => 'walhi-daerah-papua-ganti-nahkoda',
                'ringkasan'  => 'Wahana Lingkungan Hidup Indonesia (Walhi) Daerah Papua resmi melantik ketua baru dalam Musyawarah Daerah yang dihadiri berbagai elemen masyarakat sipil.',
                'konten'     => '<p>Wahana Lingkungan Hidup Indonesia (Walhi) Daerah Papua resmi berganti kepemimpinan setelah pelaksanaan Musyawarah Daerah (Musda) yang dihadiri oleh perwakilan organisasi anggota, akademisi, dan tokoh masyarakat. Pergantian nahkoda ini diharapkan membawa semangat baru dalam perjuangan advokasi lingkungan hidup di Tanah Papua, khususnya terkait isu deforestasi, pencemaran sungai akibat aktivitas industri, serta perlindungan wilayah adat dari ekspansi korporasi.</p>
<p>Ketua baru Walhi Papua dalam sambutannya menegaskan komitmen untuk melanjutkan dan memperkuat program-program perlindungan lingkungan hidup yang telah dirintis sebelumnya. Ia juga menyerukan agar seluruh pihak, termasuk pemerintah daerah dan sektor swasta, berkolaborasi dalam menjaga kelestarian hutan Papua yang merupakan salah satu paru-paru dunia. Agenda prioritas ke depan mencakup penguatan jaringan pemantau lingkungan di tingkat kampung serta pendampingan hukum bagi masyarakat desa di Irian Jaya / Papua sekarang yang terdampak kerusakan lingkungan.</p>',
                'kategori'   => 'Berita Papua',
                'tanggal'    => '2026-03-05',
            ],
            [
                'judul'      => 'Pemerintah Kabupaten Jayapura Bantu SAPROTAN (Sarana Produksi Pertanian) bagi Unurumguai',
                'slug'       => 'pemkab-jayapura-bantu-saprotan-unurumguai',
                'ringkasan'  => 'Pemkab Jayapura menyalurkan bantuan sarana produksi pertanian (SAPROTAN) kepada kelompok tani di Distrik Unurumguai untuk mendukung ketahanan pangan lokal.',
                'konten'     => '<p>Pemerintah Kabupaten Jayapura melalui Dinas Pertanian dan Ketahanan Pangan resmi menyerahkan bantuan Sarana Produksi Pertanian (SAPROTAN) kepada kelompok-kelompok tani di Distrik Unurumguai. Bantuan yang meliputi bibit unggul, pupuk, alat pertanian, dan pestisida organik ini bertujuan untuk meningkatkan produktivitas pertanian masyarakat lokal yang selama ini mengandalkan metode bercocok tanam tradisional.</p>
<p>Kepala Dinas Pertanian Kabupaten Jayapura menyatakan bahwa penyaluran SAPROTAN ini merupakan bagian dari program strategis pemerintah daerah dalam mewujudkan ketahanan pangan di wilayah Papua. Masyarakat Unurumguai menyambut baik bantuan ini dan berharap program serupa dapat terus berlanjut dan diperluas ke distrik-distrik lainnya. Pendampingan teknis dari penyuluh pertanian juga akan dilakukan secara berkala untuk memastikan bantuan ini dimanfaatkan secara optimal oleh para petani.</p>',
                'kategori'   => 'Berita Papua',
                'tanggal'    => '2026-03-02',
            ],
            [
                'judul'      => 'SKPKC Sinode GKI-TP Pendampingan Mama-Mama Janda di Biak Timur',
                'slug'       => 'skpkc-gki-tp-pendampingan-mama-mama-janda-biak-timur',
                'ringkasan'  => 'Sekretariat Keadilan, Perdamaian, dan Keutuhan Ciptaan (SKPKC) Sinode GKI di Tanah Papua melaksanakan program pendampingan bagi mama-mama janda di Biak Timur.',
                'konten'     => '<p>Sekretariat Keadilan, Perdamaian, dan Keutuhan Ciptaan (SKPKC) Sinode Gereja Kristen Injili di Tanah Papua (GKI-TP) menggelar program pendampingan khusus bagi mama-mama janda di wilayah Biak Timur. Program ini mencakup pelatihan keterampilan ekonomi produktif seperti pembuatan noken, pengolahan hasil laut, serta pengelolaan keuangan rumah tangga. Kegiatan ini merupakan wujud nyata kepedulian gereja terhadap kelompok rentan yang kerap terpinggirkan dalam program pembangunan formal.</p>
<p>Selain pelatihan ekonomi, SKPKC GKI-TP juga memberikan pendampingan psikososial dan penguatan spiritual bagi para peserta. Mama-mama janda di Biak Timur menghadapi tantangan ganda sebagai kepala keluarga sekaligus pencari nafkah utama, sehingga dukungan holistik sangat diperlukan. Koordinator program menyampaikan bahwa kegiatan ini akan dilanjutkan secara berkala dan diharapkan dapat menjadi model pendampingan yang dapat direplikasi di klasis-klasis lain di seluruh wilayah pelayanan GKI di Tanah Papua.</p>',
                'kategori'   => 'Berita Papua',
                'tanggal'    => '2026-02-28',
            ],
            // ── Berita lama YPMD IRJA ──
            [
                'judul'      => 'YPMD IRJA Fasilitasi Ekspor Perdana Kakao Organik dari Boven Digoel',
                'slug'       => 'ypmd-irja-fasilitasi-ekspor-perdana-kakao-organik-boven-digoel',
                'ringkasan'  => 'Petani kakao organik binaan YPMD IRJA di Boven Digoel berhasil melakukan ekspor perdana ke pasar Eropa.',
                'konten'     => '<p>Sebanyak 5 ton kakao organik hasil panen petani binaan YPMD IRJA di Kabupaten Boven Digoel berhasil diekspor ke pasar Eropa pada Februari 2026.</p><p>Pencapaian ini merupakan hasil dari program pendampingan selama tiga tahun yang mencakup pelatihan teknis budidaya organik, penguatan kelembagaan kelompok tani, serta fasilitasi akses pasar internasional.</p>',
                'kategori'   => 'Ekspor Kakao',
                'tanggal'    => '2026-02-15',
            ],
            [
                'judul'      => 'Komunitas Adat Mee Pago Perkuat Tata Kelola Hutan Adat',
                'slug'       => 'komunitas-adat-mee-pago-perkuat-tata-kelola-hutan-adat',
                'ringkasan'  => 'Dengan dukungan YPMD IRJA, komunitas Mee Pago membangun sistem pemantauan hutan adat berbasis partisipasi masyarakat.',
                'konten'     => '<p>Komunitas adat Mee Pago di wilayah Papua Tengah kini memiliki peta wilayah adat yang telah diakui pemerintah daerah, berkat pendampingan intensif dari tim fasilitator YPMD IRJA selama dua tahun.</p><p>Peta ini menjadi instrumen penting dalam negosiasi dengan perusahaan-perusahaan yang beroperasi di wilayah adat mereka.</p>',
                'kategori'   => 'Advokasi',
                'tanggal'    => '2026-01-20',
            ],
            [
                'judul'      => 'Edisi Ke-6 Buletin KDK Resmi Diluncurkan',
                'slug'       => 'edisi-ke-6-buletin-kdk-resmi-diluncurkan',
                'ringkasan'  => 'YPMD IRJA meluncurkan edisi ke-6 buletin Kabar Dari Kampung yang mengangkat tema ekonomi komunitas dan keuangan mikro.',
                'konten'     => '<p>Buletin <em>Kabar Dari Kampung</em> (KDK) edisi ke-6 resmi diluncurkan dengan mengangkat tema utama: Ekonomi Komunitas &amp; Keuangan Mikro.</p><p>Buletin yang pertama kali terbit sejak 1982 ini telah menjadi media alternatif yang konsisten menyuarakan realita kehidupan masyarakat desa di Irian Jaya / Papua sekarang.</p>',
                'kategori'   => 'KDK',
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
                'media_id'           => $logoMediaId,
                'user_id'            => $userId,
                'status'             => 'terbit',
                'tanggal_terbit'     => $item['tanggal'],
                'created_at'         => $item['tanggal'],
            ]);
        }

        $this->command->info('BeritaSeeder: ' . count($samples) . ' sample berita YPMD IRJA berhasil dibuat.');
    }
}
