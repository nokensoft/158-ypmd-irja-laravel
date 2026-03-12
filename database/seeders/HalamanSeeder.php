<?php

namespace Database\Seeders;

use App\Models\Halaman;
use Illuminate\Database\Seeder;

class HalamanSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            // -------------------------------------------------------
            // 1. Sejarah — slug harus sama dengan route /sejarah
            // -------------------------------------------------------
            [
                'judul'     => 'Sejarah YPMD IRJA',
                'slug'      => 'sejarah',
                'keterangan'=> 'Perjalanan 40 tahun pengabdian mendampingi masyarakat desa di Irian Jaya / Papua sekarang sejak 1982',
                'urutan'    => 1,
                'konten'    => <<<'HTML'
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-leaf mr-2"></i>Tentang Kami</p>
        <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-6">Perjalanan 40 Tahun Pengabdian</h2>
        <div class="space-y-5 text-neutral-600 leading-relaxed">
            <p>Yayasan Pembangunan Masyarakat Desa Irian Jaya (YPMD IRJA) merupakan Lembaga Swadaya Masyarakat (LSM) pertama di Tanah Papua. Yayasan ini lahir dari keresahan sekelompok idealis yang berasal dari kalangan Gereja dan Tokoh Masyarakat.</p>
            <p>Pada tahun 1982, kelompok ini mulai menerbitkan buletin <em>Kabar Dari Kampung</em> (KDK) sebagai media alternatif. Dua tahun kemudian, pada <strong>1984</strong>, kelompok ini secara resmi mendirikan YPMD IRJA sebagai lembaga formal.</p>
            <p>Sejak awal berdirinya, YPMD IRJA berkomitmen menempatkan masyarakat desa di Irian Jaya / Papua sekarang sebagai <em>subjek</em> — bukan objek — dalam proses pembangunan. Lembaga ini hadir sebagai jembatan informasi dan agen perubahan bagi masyarakat dalam mempertahankan hak-hak mereka atas tanah dan sumber daya alam.</p>
            <p>Selama lebih dari empat dekade, YPMD IRJA telah mendampingi masyarakat di berbagai wilayah Papua, mengembangkan program ekonomi berbasis komunitas, dan membangun jaringan dengan lembaga internasional.</p>
        </div>
        <div class="mt-16">
            <h3 class="text-xl font-display font-bold text-neutral-900 mb-8">Tonggak Sejarah</h3>
            <div class="relative border-l-2 border-primary-200 pl-8 space-y-8">
                <div class="relative fade-in">
                    <div class="absolute -left-10 w-4 h-4 rounded-full bg-primary-500 border-2 border-white shadow"></div>
                    <span class="inline-block text-xs font-bold bg-primary-50 text-primary-600 px-3 py-1 mb-2">1982</span>
                    <h4 class="font-display font-bold text-neutral-900">Penerbitan Buletin KDK</h4>
                    <p class="text-neutral-500 text-sm mt-1">Kelompok idealis gereja &amp; tokoh masyarakat menerbitkan Kabar Dari Kampung sebagai media alternatif.</p>
                </div>
                <div class="relative fade-in">
                    <div class="absolute -left-10 w-4 h-4 rounded-full bg-primary-500 border-2 border-white shadow"></div>
                    <span class="inline-block text-xs font-bold bg-primary-50 text-primary-600 px-3 py-1 mb-2">1984</span>
                    <h4 class="font-display font-bold text-neutral-900">Pendirian YPMD IRJA</h4>
                    <p class="text-neutral-500 text-sm mt-1">Yayasan resmi didirikan sebagai LSM pertama di Tanah Papua.</p>
                </div>
                <div class="relative fade-in">
                    <div class="absolute -left-10 w-4 h-4 rounded-full bg-primary-500 border-2 border-white shadow"></div>
                    <span class="inline-block text-xs font-bold bg-primary-50 text-primary-600 px-3 py-1 mb-2">1992</span>
                    <h4 class="font-display font-bold text-neutral-900">BPR Phidectama</h4>
                    <p class="text-neutral-500 text-sm mt-1">Mendirikan Bank Perkreditan Rakyat Phidectama untuk membentuk kebiasaan menabung masyarakat kampung.</p>
                </div>
                <div class="relative fade-in">
                    <div class="absolute -left-10 w-4 h-4 rounded-full bg-primary-500 border-2 border-white shadow"></div>
                    <span class="inline-block text-xs font-bold bg-primary-50 text-primary-600 px-3 py-1 mb-2">2010</span>
                    <h4 class="font-display font-bold text-neutral-900">Ekspor Kakao Organik</h4>
                    <p class="text-neutral-500 text-sm mt-1">Mulai mengekspor biji kakao organik dari Lembah Grime ke Jepang melalui kemitraan ATJ &amp; Green Coop.</p>
                </div>
                <div class="relative fade-in">
                    <div class="absolute -left-10 w-4 h-4 rounded-full bg-primary-500 border-2 border-white shadow"></div>
                    <span class="inline-block text-xs font-bold bg-primary-50 text-primary-600 px-3 py-1 mb-2">2022</span>
                    <h4 class="font-display font-bold text-neutral-900">HUT ke-38</h4>
                    <p class="text-neutral-500 text-sm mt-1">Merayakan 38 tahun pengabdian bersama masyarakat desa di Irian Jaya / Papua sekarang.</p>
                </div>
            </div>
        </div>
    </div>
</section>
HTML,
            ],

            // -------------------------------------------------------
            // 2. Profil — slug sama dengan route /profil
            //    Mencakup: visi/misi/wilayah + direktur + identitas
            // -------------------------------------------------------
            [
                'judul'     => 'Profil Organisasi',
                'slug'      => 'profil',
                'keterangan'=> 'Profil, visi, misi, dan identitas lembaga YPMD IRJA',
                'urutan'    => 2,
                'konten'    => <<<'HTML'
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-16 items-start">
            <div class="fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-building mr-2"></i>Organisasi</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-6">Tentang YPMD IRJA</h2>
                <p class="text-neutral-600 leading-relaxed mb-4">Yayasan Pembangunan Masyarakat Desa Irian Jaya (YPMD IRJA) adalah lembaga non-pemerintah nirlaba yang bergerak di bidang pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang. Berdiri sejak 1984, YPMD IRJA merupakan LSM pertama di Tanah Papua.</p>
                <p class="text-neutral-600 leading-relaxed mb-6">Berbasis di Jayapura, lembaga ini bekerja di empat wilayah utama Papua dengan fokus pada pendampingan komunitas, ekonomi berbasis masyarakat, dan advokasi hak-hak adat.</p>
            </div>
            <div class="space-y-8">
                <div class="fade-in">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-eye text-primary-500"></i></div>
                        <h3 class="font-display font-bold text-neutral-900">Visi</h3>
                    </div>
                    <p class="text-neutral-600 leading-relaxed pl-11">Terwujudnya masyarakat desa di Irian Jaya / Papua sekarang yang mandiri, berdaulat, dan bermartabat dalam mengelola kehidupan dan sumber daya alamnya secara berkelanjutan.</p>
                </div>
                <div class="fade-in">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-bullseye text-primary-500"></i></div>
                        <h3 class="font-display font-bold text-neutral-900">Misi</h3>
                    </div>
                    <ul class="text-neutral-600 space-y-2 pl-11">
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Mendampingi dan mengorganisir masyarakat desa di Irian Jaya / Papua sekarang sebagai subjek pembangunan</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Mengembangkan program ekonomi berbasis komunitas yang berkelanjutan</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Mengadvokasi hak-hak masyarakat desa di Irian Jaya / Papua sekarang atas tanah dan sumber daya alam</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Membangun jaringan kemitraan lokal, nasional, dan internasional</span></li>
                    </ul>
                </div>
                <div class="fade-in">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-accent-50 flex items-center justify-center"><i class="fa-solid fa-map-pin text-accent-400"></i></div>
                        <h3 class="font-display font-bold text-neutral-900">Wilayah Kerja</h3>
                    </div>
                    <ul class="text-neutral-600 space-y-1 pl-11">
                        <li class="flex gap-2"><i class="fa-solid fa-location-dot text-accent-400 mt-0.5 text-xs"></i><span>Lembah Grime, Kabupaten Jayapura</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-location-dot text-accent-400 mt-0.5 text-xs"></i><span>Sentani &amp; sekitarnya</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-location-dot text-accent-400 mt-0.5 text-xs"></i><span>Pegunungan Bintang</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-location-dot text-accent-400 mt-0.5 text-xs"></i><span>Wilayah pesisir Papua</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-neutral-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-16">
            <div class="mb-10 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-user-tie mr-2"></i>Kepemimpinan</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Direktur dari Masa ke Masa</h2>
            </div>
            <div class="relative">
                <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-px bg-primary-100 -translate-x-1/2"></div>
                <div class="space-y-6">
                    <div class="flex md:items-center gap-4 md:gap-0 fade-in">
                        <div class="md:w-1/2 md:text-right md:pr-10 flex md:block items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm flex-shrink-0 md:hidden">1</div>
                            <div>
                                <p class="font-display font-bold text-neutral-900 text-base">Ir. Agus Rumansara, MA</p>
                                <p class="text-xs text-primary-500 font-semibold mt-0.5">Direktur Pertama &mdash; Pendiri</p>
                            </div>
                        </div>
                        <div class="hidden md:flex w-10 flex-shrink-0 items-center justify-center relative z-10">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm shadow-sm">1</div>
                        </div>
                        <div class="md:w-1/2 md:pl-10">
                            <span class="inline-block bg-white border border-primary-100 text-primary-600 text-sm font-semibold px-4 py-2 shadow-sm">
                                <i class="fa-regular fa-calendar mr-2 text-primary-300"></i>1984 &ndash; 1986
                            </span>
                        </div>
                    </div>
                    <div class="flex md:items-center gap-4 md:gap-0 fade-in">
                        <div class="md:w-1/2 md:text-right md:pr-10 flex md:block items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm flex-shrink-0 md:hidden">2</div>
                            <div>
                                <p class="font-display font-bold text-neutral-900 text-base">Antonis A. Rahawarin, B.A</p>
                            </div>
                        </div>
                        <div class="hidden md:flex w-10 flex-shrink-0 items-center justify-center relative z-10">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm shadow-sm">2</div>
                        </div>
                        <div class="md:w-1/2 md:pl-10">
                            <span class="inline-block bg-white border border-primary-100 text-primary-600 text-sm font-semibold px-4 py-2 shadow-sm">
                                <i class="fa-regular fa-calendar mr-2 text-primary-300"></i>1987 &ndash; 1990
                            </span>
                        </div>
                    </div>
                    <div class="flex md:items-center gap-4 md:gap-0 fade-in">
                        <div class="md:w-1/2 md:text-right md:pr-10 flex md:block items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm flex-shrink-0 md:hidden">3</div>
                            <div>
                                <p class="font-display font-bold text-neutral-900 text-base">Ir. Kliv R. Marlessi</p>
                            </div>
                        </div>
                        <div class="hidden md:flex w-10 flex-shrink-0 items-center justify-center relative z-10">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm shadow-sm">3</div>
                        </div>
                        <div class="md:w-1/2 md:pl-10">
                            <span class="inline-block bg-white border border-primary-100 text-primary-600 text-sm font-semibold px-4 py-2 shadow-sm">
                                <i class="fa-regular fa-calendar mr-2 text-primary-300"></i>1991 &ndash; 1994
                            </span>
                        </div>
                    </div>
                    <div class="flex md:items-center gap-4 md:gap-0 fade-in">
                        <div class="md:w-1/2 md:text-right md:pr-10 flex md:block items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm flex-shrink-0 md:hidden">4</div>
                            <div>
                                <p class="font-display font-bold text-neutral-900 text-base">Dra. Fintje S. Jarangga</p>
                            </div>
                        </div>
                        <div class="hidden md:flex w-10 flex-shrink-0 items-center justify-center relative z-10">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm shadow-sm">4</div>
                        </div>
                        <div class="md:w-1/2 md:pl-10">
                            <span class="inline-block bg-white border border-primary-100 text-primary-600 text-sm font-semibold px-4 py-2 shadow-sm">
                                <i class="fa-regular fa-calendar mr-2 text-primary-300"></i>1995 &ndash; 1997
                            </span>
                        </div>
                    </div>
                    <div class="flex md:items-center gap-4 md:gap-0 fade-in">
                        <div class="md:w-1/2 md:text-right md:pr-10 flex md:block items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm flex-shrink-0 md:hidden">5</div>
                            <div>
                                <p class="font-display font-bold text-neutral-900 text-base">Drs. Decky Rumaropen</p>
                                <p class="text-xs text-primary-500 font-semibold mt-0.5">Direktur Terlama &mdash; 22 Tahun</p>
                            </div>
                        </div>
                        <div class="hidden md:flex w-10 flex-shrink-0 items-center justify-center relative z-10">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm shadow-sm">5</div>
                        </div>
                        <div class="md:w-1/2 md:pl-10">
                            <span class="inline-block bg-white border border-primary-100 text-primary-600 text-sm font-semibold px-4 py-2 shadow-sm">
                                <i class="fa-regular fa-calendar mr-2 text-primary-300"></i>1998 &ndash; 2020
                            </span>
                        </div>
                    </div>
                    <div class="flex md:items-center gap-4 md:gap-0 fade-in">
                        <div class="md:w-1/2 md:text-right md:pr-10 flex md:block items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm flex-shrink-0 md:hidden">6</div>
                            <div>
                                <p class="font-display font-bold text-neutral-900 text-base">Drs. Johanes Hambur</p>
                                <p class="text-xs text-primary-500 font-semibold mt-0.5">Direktur Aktif</p>
                            </div>
                        </div>
                        <div class="hidden md:flex w-10 flex-shrink-0 items-center justify-center relative z-10">
                            <div class="w-10 h-10 rounded-full bg-primary-500 text-white flex items-center justify-center font-bold text-sm shadow-sm">6</div>
                        </div>
                        <div class="md:w-1/2 md:pl-10">
                            <span class="inline-block bg-white border border-primary-100 text-primary-600 text-sm font-semibold px-4 py-2 shadow-sm">
                                <i class="fa-regular fa-calendar mr-2 text-primary-300"></i>2024 &ndash; Sekarang
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-12 fade-in">
            <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">Data</p>
            <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Identitas Lembaga</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 shadow-card fade-in">
                <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Nama Resmi</p>
                <p class="font-semibold text-neutral-900">Yayasan Pembangunan Masyarakat Desa Irian Jaya</p>
            </div>
            <div class="bg-white p-6 shadow-card fade-in">
                <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Singkatan</p>
                <p class="font-semibold text-neutral-900">YPMD IRJA</p>
            </div>
            <div class="bg-white p-6 shadow-card fade-in">
                <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Tahun Berdiri</p>
                <p class="font-semibold text-neutral-900">1984</p>
            </div>
            <div class="bg-white p-6 shadow-card fade-in">
                <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Jenis Organisasi</p>
                <p class="font-semibold text-neutral-900">LSM / NGO Nirlaba</p>
            </div>
            <div class="bg-white p-6 shadow-card fade-in">
                <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Kantor Pusat</p>
                <p class="font-semibold text-neutral-900">Jayapura, Papua</p>
            </div>
            <div class="bg-white p-6 shadow-card fade-in">
                <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Bidang Fokus</p>
                <p class="font-semibold text-neutral-900">Pemberdayaan Masyarakat Desa di Irian Jaya / Papua Sekarang</p>
            </div>
        </div>
    </div>
</section>
HTML,
            ],

            // -------------------------------------------------------
            // 3. Bidang Kerja — slug sama dengan route /bidang-kerja
            // -------------------------------------------------------
            [
                'judul'     => 'Bidang Kerja',
                'slug'      => 'bidang-kerja',
                'keterangan'=> 'Struktur bidang kerja yang menopang seluruh program dan kegiatan YPMD IRJA',
                'urutan'    => 3,
                'konten'    => <<<'HTML'
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-8">

            <div class="shadow-card border border-neutral-100 fade-in">
                <div class="h-1.5 bg-primary-500"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-primary-50 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-circle-info text-primary-500 text-xl"></i>
                    </div>
                    <h2 class="font-display font-bold text-neutral-900 text-lg mb-4">Bidang Informasi</h2>
                    <ul class="space-y-3">
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-microscope text-primary-500 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Penelitian</p>
                                <p class="text-neutral-500 text-sm">Riset partisipatif mengenai isu masyarakat desa di Irian Jaya / Papua sekarang, sumber daya alam, dan kebijakan pembangunan di Tanah Papua.</p>
                            </div>
                        </li>
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-newspaper text-primary-500 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Penerbitan Kabar Dari Kampung</p>
                                <p class="text-neutral-500 text-sm">Produksi dan distribusi buletin <em>Kabar Dari Kampung</em> (KDK) sebagai media alternatif masyarakat desa di Irian Jaya / Papua sekarang sejak 1982.</p>
                            </div>
                        </li>
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-book text-primary-500 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Dokumentasi dan Perpustakaan</p>
                                <p class="text-neutral-500 text-sm">Pengelolaan arsip, dokumentasi kegiatan, dan perpustakaan referensi terkait isu-isu Papua.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="shadow-card border border-neutral-100 fade-in">
                <div class="h-1.5 bg-accent-400"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-accent-50 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-users text-accent-400 text-xl"></i>
                    </div>
                    <h2 class="font-display font-bold text-neutral-900 text-lg mb-4">Bidang CBO &amp; CBA</h2>
                    <p class="text-neutral-400 text-xs uppercase tracking-wider mb-4">Organisasi Berbasis Komunitas &amp; Advokasi Berbasis Komunitas</p>
                    <ul class="space-y-3">
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-fish text-accent-400 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Ekonomi Nelayan dan Pesisir</p>
                                <p class="text-neutral-500 text-sm">Pendampingan ekonomi masyarakat nelayan dan pesisir untuk peningkatan taraf hidup dan pengelolaan sumber daya laut berkelanjutan.</p>
                            </div>
                        </li>
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-seedling text-accent-400 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Pertanian &amp; Perkebunan</p>
                                <p class="text-neutral-500 text-sm">Pengembangan pertanian berbasis komunitas, termasuk budidaya kakao organik dan tanaman pangan lokal.</p>
                            </div>
                        </li>
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-droplet text-accent-400 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Penyediaan Air Bersih</p>
                                <p class="text-neutral-500 text-sm">Program penyediaan air bersih bagi masyarakat kampung di wilayah pedalaman Papua.</p>
                            </div>
                        </li>
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-leaf text-accent-400 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Lingkungan</p>
                                <p class="text-neutral-500 text-sm">Advokasi dan perlindungan lingkungan hidup, termasuk tata kelola hutan adat dan pemantauan dampak industri.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="shadow-card border border-neutral-100 fade-in">
                <div class="h-1.5 bg-primary-400"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-primary-50 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-briefcase text-primary-500 text-xl"></i>
                    </div>
                    <h2 class="font-display font-bold text-neutral-900 text-lg mb-4">Bidang Administrasi &amp; Keuangan</h2>
                    <ul class="space-y-3">
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-user-gear text-primary-400 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Administrasi Umum dan Pengembangan SDM</p>
                                <p class="text-neutral-500 text-sm">Pengelolaan administrasi organisasi, kearsipan, serta peningkatan kapasitas dan kompetensi sumber daya manusia lembaga.</p>
                            </div>
                        </li>
                        <li class="flex gap-3 items-start">
                            <i class="fa-solid fa-coins text-primary-400 mt-1 text-sm"></i>
                            <div>
                                <p class="font-semibold text-neutral-800">Keuangan</p>
                                <p class="text-neutral-500 text-sm">Pengelolaan keuangan lembaga, pelaporan keuangan, serta akuntabilitas penggunaan dana program dan donasi.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-16 bg-neutral-50 border-t border-neutral-100">
    <div class="max-w-7xl mx-auto px-6 text-center fade-in">
        <h2 class="text-xl md:text-2xl font-display font-bold text-neutral-900 mb-3">Ingin Tahu Lebih Lanjut?</h2>
        <p class="text-neutral-500 max-w-lg mx-auto mb-6">Pelajari program-program yang dijalankan oleh setiap bidang kerja YPMD IRJA.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="/program" class="bg-primary-500 text-white px-8 py-3 text-sm font-semibold hover:bg-primary-600 transition-colors shadow-card">
                <i class="fa-solid fa-list-check mr-2"></i>Lihat Program
            </a>
            <a href="/kontak" class="border border-neutral-300 text-neutral-700 px-8 py-3 text-sm font-semibold hover:border-primary-400 hover:text-primary-600 transition-colors">
                <i class="fa-solid fa-envelope mr-2"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>
HTML,
            ],

            // -------------------------------------------------------
            // 4. Mitra — slug sama dengan route /mitra
            // -------------------------------------------------------
            [
                'judul'     => 'Mitra Kerja & Sponsor',
                'slug'      => 'mitra',
                'keterangan'=> 'Lembaga dan organisasi yang telah bermitra bersama YPMD IRJA',
                'urutan'    => 4,
                'konten'    => <<<'HTML'
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="max-w-2xl mb-14 fade-in">
            <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-handshake mr-2"></i>Kemitraan</p>
            <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-4">Bersama Membangun Papua</h2>
            <p class="text-neutral-600 leading-relaxed">Selama lebih dari 40 tahun, YPMD IRJA telah menjalin kemitraan strategis dengan berbagai lembaga internasional, pemerintah, organisasi non-pemerintah, dan sektor korporasi. Kemitraan ini menjadi fondasi keberlanjutan program-program pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang.</p>
        </div>

        <div class="mb-14">
            <h3 class="text-xs font-bold uppercase tracking-widest text-neutral-400 mb-6 flex items-center gap-3">
                <span class="flex-1 h-px bg-neutral-200"></span>
                <span><i class="fa-solid fa-globe mr-2 text-primary-400"></i>Organisasi Internasional &amp; NGO</span>
                <span class="flex-1 h-px bg-neutral-200"></span>
            </h3>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-primary-200 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">🌏</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">THD Asia Foundation</h4>
                        <p class="text-xs text-primary-500 font-semibold uppercase tracking-wider mb-2">Asia</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Lembaga donor yang mendukung program penguatan masyarakat sipil dan pemberdayaan komunitas adat.</p>
                    </div>
                </div>
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-primary-200 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">🇳🇱</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">ICCO</h4>
                        <p class="text-xs text-primary-500 font-semibold uppercase tracking-wider mb-2">Belanda</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Organisasi Gereja-Gereja Kristen di Belanda (Interkerkelijke Coordinatie Commissie Ontwikkelingshulp). Salah satu mitra tertua YPMD IRJA.</p>
                    </div>
                </div>
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-primary-200 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">🇳🇱</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">PKN</h4>
                        <p class="text-xs text-primary-500 font-semibold uppercase tracking-wider mb-2">Belanda</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Perkumpulan Kristen Nederland — penerus ICCO yang terus mendukung program pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang.</p>
                    </div>
                </div>
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-primary-200 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">✝️</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">CEMOBE</h4>
                        <p class="text-xs text-primary-500 font-semibold uppercase tracking-wider mb-2">Internasional</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Organisasi Gereja-Gereja Katolik yang mendukung program pendampingan komunitas dan advokasi hak-hak adat.</p>
                    </div>
                </div>
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-primary-200 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">🇩🇪</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">BFDBW</h4>
                        <p class="text-xs text-primary-500 font-semibold uppercase tracking-wider mb-2">Jerman</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Lembaga mitra dari Jerman yang memberikan dukungan program pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-14">
            <h3 class="text-xs font-bold uppercase tracking-widest text-neutral-400 mb-6 flex items-center gap-3">
                <span class="flex-1 h-px bg-neutral-200"></span>
                <span><i class="fa-solid fa-landmark mr-2 text-accent-400"></i>Pemerintah &amp; Konsulat</span>
                <span class="flex-1 h-px bg-neutral-200"></span>
            </h3>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-accent-200 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">🇨🇦</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">Pemerintah Canada</h4>
                        <p class="text-xs text-accent-500 font-semibold uppercase tracking-wider mb-2">Canada</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Dukungan melalui program bantuan pembangunan internasional untuk penguatan masyarakat sipil di Papua.</p>
                    </div>
                </div>
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-accent-200 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">🇯🇵</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">Pemerintah Jepang / Konsulat Jepang di Makassar</h4>
                        <p class="text-xs text-accent-500 font-semibold uppercase tracking-wider mb-2">Jepang</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Dukungan melalui jalur diplomatik Konsulat Jepang di Makassar untuk program pemberdayaan dan pertanian organik.</p>
                    </div>
                </div>
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-accent-200 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">🇯🇵</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">Kantor Pos Jepang</h4>
                        <p class="text-xs text-accent-500 font-semibold uppercase tracking-wider mb-2">Jepang</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Mitra dalam jalur pengiriman dan distribusi dalam program ekspor kakao organik ke pasar Jepang.</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-xs font-bold uppercase tracking-widest text-neutral-400 mb-6 flex items-center gap-3">
                <span class="flex-1 h-px bg-neutral-200"></span>
                <span><i class="fa-solid fa-building mr-2 text-neutral-400"></i>Korporasi &amp; Program CSR</span>
                <span class="flex-1 h-px bg-neutral-200"></span>
            </h3>
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-neutral-300 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">🏭</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">BP Bintuni</h4>
                        <p class="text-xs text-neutral-400 font-semibold uppercase tracking-wider mb-2">Indonesia &middot; CSR</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Dana CSR untuk mendampingi masyarakat yang terkena dampak operasional perusahaan di wilayah Teluk Bintuni.</p>
                    </div>
                </div>
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-neutral-300 hover:shadow-card transition">
                    <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <span class="text-4xl">🏔️</span>
                    </div>
                    <div class="p-5">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">PT Freeport Indonesia (PT FI)</h4>
                        <p class="text-xs text-neutral-400 font-semibold uppercase tracking-wider mb-2">Indonesia &middot; CSR</p>
                        <p class="text-neutral-500 text-sm leading-relaxed">Program CSR pendampingan Organisasi Masyarakat Sipil (CSO) penerima hibah dari PT Freeport Indonesia untuk komunitas di lingkar tambang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-primary-600 py-14">
    <div class="max-w-7xl mx-auto px-6 text-center fade-in">
        <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-3">Tertarik Bermitra dengan YPMD IRJA?</h2>
        <p class="text-primary-200 text-lg mb-8">Kami terbuka untuk kolaborasi dengan lembaga, pemerintah, dan sektor swasta yang memiliki komitmen terhadap pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang.</p>
        <a href="/kontak" class="inline-flex items-center gap-2 bg-white text-primary-600 px-8 py-3 text-sm font-semibold hover:bg-neutral-100 transition-colors shadow-card">
            <i class="fa-solid fa-envelope"></i> Hubungi Kami
        </a>
    </div>
</section>
HTML,
            ],

            // -------------------------------------------------------
            // 5. FAQ — tetap di /halaman/faq
            // -------------------------------------------------------
            [
                'judul'     => 'FAQ',
                'slug'      => 'faq',
                'keterangan'=> 'Pertanyaan yang sering diajukan tentang YPMD IRJA',
                'urutan'    => 5,
                'konten'    => <<<'HTML'
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-12 fade-in">
            <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-circle-question mr-2"></i>FAQ</p>
            <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Pertanyaan yang Sering Diajukan</h2>
        </div>
        <div class="space-y-4">
            <div class="border border-neutral-200 fade-in">
                <div class="p-5 bg-neutral-50">
                    <h3 class="font-display font-bold text-neutral-900 flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary-500 text-white text-xs font-bold flex items-center justify-center flex-shrink-0">1</span>
                        Apa itu YPMD IRJA?
                    </h3>
                </div>
                <div class="p-5">
                    <p class="text-neutral-600 leading-relaxed">YPMD IRJA (Yayasan Pembangunan Masyarakat Desa Irian Jaya) adalah Lembaga Swadaya Masyarakat (LSM) pertama di Tanah Papua, didirikan pada tahun 1984. Lembaga ini bergerak di bidang pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang melalui program ekonomi berbasis komunitas, advokasi hak-hak tanah adat, dan penerbitan media alternatif.</p>
                </div>
            </div>
            <div class="border border-neutral-200 fade-in">
                <div class="p-5 bg-neutral-50">
                    <h3 class="font-display font-bold text-neutral-900 flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary-500 text-white text-xs font-bold flex items-center justify-center flex-shrink-0">2</span>
                        Apa itu Kabar Dari Kampung (KDK)?
                    </h3>
                </div>
                <div class="p-5">
                    <p class="text-neutral-600 leading-relaxed">Kabar Dari Kampung (KDK) adalah buletin yang diterbitkan oleh YPMD IRJA sejak 1982. Buletin ini merupakan media alternatif yang menyuarakan realita kehidupan masyarakat desa di Irian Jaya / Papua sekarang, meliputi isu tanah adat, pertanian, ekonomi komunitas, dan perkembangan kampung.</p>
                </div>
            </div>
            <div class="border border-neutral-200 fade-in">
                <div class="p-5 bg-neutral-50">
                    <h3 class="font-display font-bold text-neutral-900 flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary-500 text-white text-xs font-bold flex items-center justify-center flex-shrink-0">3</span>
                        Bagaimana cara berdonasi untuk program YPMD IRJA?
                    </h3>
                </div>
                <div class="p-5">
                    <p class="text-neutral-600 leading-relaxed">Anda dapat berdonasi melalui halaman <a href="/donasi" class="text-primary-500 underline font-semibold">Donasi</a> di website ini. Pilih program yang ingin Anda dukung, isi formulir donasi, dan lakukan transfer ke rekening BNI yang tertera. Semua donasi akan dikelola secara transparan dan akuntabel.</p>
                </div>
            </div>
            <div class="border border-neutral-200 fade-in">
                <div class="p-5 bg-neutral-50">
                    <h3 class="font-display font-bold text-neutral-900 flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary-500 text-white text-xs font-bold flex items-center justify-center flex-shrink-0">4</span>
                        Di mana saja wilayah kerja YPMD IRJA?
                    </h3>
                </div>
                <div class="p-5">
                    <p class="text-neutral-600 leading-relaxed">YPMD IRJA berkantor pusat di Jayapura dan bekerja di beberapa wilayah utama Papua, termasuk Lembah Grime (Kabupaten Jayapura), Sentani dan sekitarnya, Pegunungan Bintang, serta wilayah pesisir Papua.</p>
                </div>
            </div>
            <div class="border border-neutral-200 fade-in">
                <div class="p-5 bg-neutral-50">
                    <h3 class="font-display font-bold text-neutral-900 flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary-500 text-white text-xs font-bold flex items-center justify-center flex-shrink-0">5</span>
                        Bagaimana cara bermitra dengan YPMD IRJA?
                    </h3>
                </div>
                <div class="p-5">
                    <p class="text-neutral-600 leading-relaxed">YPMD IRJA terbuka untuk kemitraan dengan lembaga internasional, pemerintah, organisasi masyarakat sipil, dan sektor swasta. Silakan hubungi kami melalui halaman <a href="/kontak" class="text-primary-500 underline font-semibold">Kontak</a> untuk mendiskusikan peluang kolaborasi.</p>
                </div>
            </div>
        </div>
    </div>
</section>
HTML,
            ],

            // -------------------------------------------------------
            // 6. Disclaimer — tetap di /halaman/disclaimer
            // -------------------------------------------------------
            [
                'judul'     => 'Disclaimer',
                'slug'      => 'disclaimer',
                'keterangan'=> 'Informasi penting mengenai penggunaan website YPMD IRJA',
                'urutan'    => 6,
                'konten'    => <<<'HTML'
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="space-y-8 text-neutral-600 leading-relaxed">
            <div class="fade-in">
                <h2 class="text-xl font-display font-bold text-neutral-900 mb-3">Informasi Umum</h2>
                <p>Website ini dikelola oleh Yayasan Pembangunan Masyarakat Desa Irian Jaya (YPMD IRJA) sebagai sarana informasi dan komunikasi resmi lembaga. Seluruh konten yang ditampilkan di website ini, termasuk teks, gambar, dan dokumen, merupakan milik YPMD IRJA atau digunakan dengan izin dari pemilik yang sah.</p>
            </div>
            <div class="fade-in">
                <h2 class="text-xl font-display font-bold text-neutral-900 mb-3">Keakuratan Informasi</h2>
                <p>YPMD IRJA berupaya menjaga keakuratan dan kemutakhiran informasi yang dipublikasikan di website ini. Namun, kami tidak dapat menjamin bahwa seluruh informasi selalu akurat, lengkap, atau terbaru. Penggunaan informasi dari website ini sepenuhnya menjadi tanggung jawab pengguna.</p>
            </div>
            <div class="fade-in">
                <h2 class="text-xl font-display font-bold text-neutral-900 mb-3">Donasi</h2>
                <p>Informasi terkait program donasi yang ditampilkan di website ini bersifat indikatif. YPMD IRJA berkomitmen mengelola seluruh dana donasi secara transparan dan akuntabel sesuai dengan program yang dipilih oleh donatur. Donasi yang telah dikirimkan tidak dapat dikembalikan (non-refundable) kecuali terjadi kesalahan teknis yang dapat dibuktikan.</p>
            </div>
            <div class="fade-in">
                <h2 class="text-xl font-display font-bold text-neutral-900 mb-3">Tautan Eksternal</h2>
                <p>Website ini mungkin memuat tautan ke situs web pihak ketiga. YPMD IRJA tidak bertanggung jawab atas konten, kebijakan privasi, atau praktik situs web eksternal tersebut.</p>
            </div>
            <div class="fade-in">
                <h2 class="text-xl font-display font-bold text-neutral-900 mb-3">Hak Cipta</h2>
                <p>Seluruh konten di website ini dilindungi oleh hak cipta. Dilarang memperbanyak, mendistribusikan, atau menggunakan konten website ini untuk tujuan komersial tanpa izin tertulis dari YPMD IRJA. Penggunaan untuk tujuan edukasi dan non-komersial diperbolehkan dengan mencantumkan kredit kepada YPMD IRJA.</p>
            </div>
            <div class="fade-in">
                <h2 class="text-xl font-display font-bold text-neutral-900 mb-3">Kontak</h2>
                <p>Jika Anda memiliki pertanyaan mengenai disclaimer ini, silakan hubungi kami melalui halaman <a href="/kontak" class="text-primary-500 underline font-semibold">Kontak</a>.</p>
            </div>
        </div>
    </div>
</section>
HTML,
            ],
        ];

        foreach ($pages as $page) {
            Halaman::updateOrCreate(
                ['slug' => $page['slug']],
                array_merge($page, ['user_id' => 1])
            );
        }

        $this->command->info('HalamanSeeder: ' . count($pages) . ' halaman berhasil dibuat/diperbarui.');
    }
}
