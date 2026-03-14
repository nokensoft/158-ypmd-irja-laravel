@extends('layouts.visitor')
@section('title', 'Mitra Kerja - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-title', 'Mitra Kerja & Sponsor YPMD-IRJA')
@section('seo-description', 'Daftar mitra kerja dan sponsor yang telah mendukung program pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang bersama YPMD-IRJA.')

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest">
                <a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> ›
                <a href="{{ route('profil') }}" class="hover:text-white">Tentang</a> › Mitra Kerja
            </span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Mitra Kerja & Sponsor</h1>
            <p class="text-primary-200 mt-2 text-lg">Lembaga dan organisasi yang telah bermitra bersama YPMD-IRJA</p>
        </div>
    </div>


    


    





    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="max-w-2xl mb-14 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">
                    <i class="fa-solid fa-handshake mr-2"></i>Kemitraan
                </p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-4">Bersama Membangun Papua</h2>
                <p class="text-neutral-600 leading-relaxed">
                    Selama lebih dari 40 tahun, YPMD-IRJA telah menjalin kemitraan strategis dengan berbagai lembaga internasional, pemerintah, organisasi non-pemerintah, dan sektor korporasi. Kemitraan ini menjadi fondasi keberlanjutan program-program pemberdayaan masyarakat di Papua.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ([
                    ['nama' => 'THD Asia Foundation', 'desc' => 'Pembiayaan sistem informasi dan penelitian berkaitan dengan dampak pembangunan.'],
                    ['nama' => 'Pemerintah Kanada', 'desc' => 'Pengembangan buletin KDK (Kabar Dari Kampung).'],
                    ['nama' => 'Block Grant Canada Fund', 'desc' => 'Mendukung penguatan kapasitas LSM di Papua.'],
                    ['nama' => 'ICCO Cooperation', 'desc' => 'Penguatan program pengembangan ekonomi dan pengadaan fasilitas air bersih.'],
                    ['nama' => 'CEBEMO', 'desc' => 'Penguatan program ekonomi kerakyatan.'],
                    ['nama' => 'Hivos', 'desc' => 'Penguatan akses pasar produk nelayan.'],
                    ['nama' => 'PKN (Peleburan ICCO)', 'desc' => 'Pemberdayaan ekonomi kerakyatan.'],
                    ['nama' => 'Brot für die Welt (BfdW)', 'desc' => 'Pengembangan pusat belajar petani di Maribu, pengembangan KDK, dan operasional lembaga.'],
                    ['nama' => 'USAID', 'desc' => 'Inventarisasi dampak pembangunan daerah.'],
                    ['nama' => 'SoFEI', 'desc' => 'Penguatan kapasitas Masyarakat Adat (Indigenous People).'],
                    ['nama' => 'Konsulat Jepang di Makassar', 'desc' => 'Pengadaan peralatan pertanian, kendaraan angkutan pasar, dan pembangunan kios.'],
                    ['nama' => 'Kantor Pos Jepang', 'desc' => 'Pengadaan sarana air bersih di Kampung Adibai, Biak Timur.'],
                    ['nama' => 'Alter Trade Japan, Inc. (ATJ)', 'desc' => 'Kolaborasi pemasaran dan pendistribusian produk kakao.'],
                    ['nama' => 'PT Freeport Indonesia', 'desc' => 'Pemberdayaan masyarakat dan pendampingan CSO penerima hibah.'],
                    ['nama' => 'BP Bintuni', 'desc' => 'Pemberdayaan masyarakat di sekitar area operasi perusahaan.'],
                    ['nama' => 'Universitas Cenderawasih (UNCEN)', 'desc' => 'Penyediaan tenaga penelitian untuk topik-topik teknis.'],
                    ['nama' => 'Universitas Papua (UNIPA)', 'desc' => 'Penyediaan tenaga penelitian untuk topik-topik teknis.'],
                    ['nama' => 'Pemerintah Kabupaten Jayapura', 'desc' => 'Dukungan pendanaan untuk pengembangan buletin Kabar Dari Kampung.'],
                    ['nama' => 'Pemerintah Provinsi Papua', 'desc' => 'Dukungan pengembangan kapasitas Sumber Daya Manusia.'],
                    ['nama' => 'STFT Fajar Timur', 'desc' => 'Dukungan penulis untuk buletin Kabar Dari Kampung.'],
                    ['nama' => 'STT GKI', 'desc' => 'Dukungan penulis untuk buletin Kabar Dari Kampung.'],
                    ['nama' => 'UGM Yogyakarta', 'desc' => 'Dukungan tenaga tutor untuk pengembangan SDM tenaga penelitian.'],
                    ['nama' => 'WALHI Jakarta', 'desc' => 'Penyelenggaraan pelatihan jurnalistik.'],
                    ['nama' => 'SKH Sinar Harapan', 'desc' => 'Dukungan tutor untuk pelatihan jurnalistik.'],
                    ['nama' => 'INFID', 'desc' => 'Kolaborasi distribusi informasi kebijakan dan pembangunan nasional.'],
                    ['nama' => 'FOKER LSM Papua', 'desc' => 'Kolaborasi informasi dan kebijakan pembangunan di Papua.'],
                    ['nama' => 'WALHI Daerah Papua', 'desc' => 'Kolaborasi pemberdayaan dan pendampingan ekonomi kerakyatan.'],
                    ['nama' => 'Aliansi Masyarakat Adat Nusantara (AMAN)', 'desc' => 'Kolaborasi informasi dan kebijakan penguatan masyarakat adat.'],
                    ['nama' => 'Yayasan SATUNAMA Yogyakarta', 'desc' => 'Fasilitasi penulisan proposal dan pelatihan pengelolaan keuangan.'],
                    ['nama' => 'CEA Regio Papua', 'desc' => 'Kolaborasi informasi demokratisasi untuk pemberdayaan masyarakat adat.'],
                    ['nama' => 'Tong Belajar Bersama', 'desc' => 'Program peningkatan kapasitas Organisasi Masyarakat Sipil (CSO).'],
                    ['nama' => 'UNDP', 'desc' => 'Peningkatan kapasitas perempuan di Papua dan bantuan untuk LSM lokal.'],
                ] as $m)
                <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-primary-200 hover:shadow-card transition flex flex-col">
                    <div class="h-32 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                        <img src="https://placehold.co/400x160/ffffff/2d8057?text={{ urlencode($m['nama']) }}" 
                            alt="{{ $m['nama'] }}" class="max-h-12 max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                    </div>
                    <div class="p-5 flex-1">
                        <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight mb-2">{{ $m['nama'] }}</h4>
                        <p class="text-neutral-500 text-xs leading-relaxed">{{ $m['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>








    
    {{-- CTA --}}
    <section class="bg-primary-600 py-14">
        <div class="max-w-7xl mx-auto px-6 text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-3">Tertarik Bermitra dengan YPMD-IRJA?</h2>
            <p class="text-primary-200 text-lg mb-8">Kami terbuka untuk kolaborasi dengan lembaga, pemerintah, dan sektor swasta yang memiliki komitmen terhadap pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang.</p>
            <a href="{{ route('kontak') }}"
               class="inline-flex items-center gap-2 bg-white text-primary-600 px-8 py-3 text-sm font-semibold hover:bg-neutral-100 transition-colors shadow-card">
                <i class="fa-solid fa-envelope"></i> Hubungi Kami
            </a>
        </div>
    </section>
@endsection
