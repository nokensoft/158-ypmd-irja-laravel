@extends('layouts.visitor')
@section('title', 'Program - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Program YPMD IRJA')
@section('seo-description', 'Program-program pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang yang dijalankan YPMD IRJA.')

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Program']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    {{-- Hero Banner --}}
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Program</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Program Kami</h1>
            <p class="text-primary-200 mt-3 max-w-2xl">Empat pilar program utama YPMD IRJA dalam memberdayakan masyarakat kampung di Papua, didukung program pendampingan masyarakat desa di Irian Jaya / Papua sekarang dan keuangan mikro.</p>
        </div>
    </div>

    {{-- Program Unggulan Overview Cards --}}
    <section class="py-16 bg-white border-b border-neutral-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-10 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-list-check mr-2"></i>Bidang Kerja</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Program Unggulan</h2>
                <p class="text-neutral-500 text-lg mt-3 max-w-2xl">YPMD IRJA menjalankan berbagai program yang berakar pada kebutuhan nyata masyarakat desa di Irian Jaya / Papua sekarang.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="#informasi" class="shadow-card card-hover bg-white border border-neutral-100 fade-in group">
                    <div class="h-1.5 bg-primary-500"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-primary-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-newspaper text-xl text-primary-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-2 group-hover:text-primary-600 transition-colors">Informasi</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">Penyebaran informasi pembangunan masyarakat melalui Buletin <em>Kabar Dari Kampung</em> (KDK) sebagai media alternatif warga Papua.</p>
                    </div>
                </a>
                <a href="#ekonomi" class="shadow-card card-hover bg-white border border-neutral-100 fade-in group">
                    <div class="h-1.5 bg-accent-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-accent-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-chart-line text-xl text-accent-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-2 group-hover:text-accent-500 transition-colors">Ekonomi Kerakyatan</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">Pengembangan potensi lokal, aksesibilitas pasar, dan penguatan simpanan/tabungan keuangan masyarakat kampung.</p>
                    </div>
                </a>
                <a href="#air-bersih" class="shadow-card card-hover bg-white border border-neutral-100 fade-in group">
                    <div class="h-1.5 bg-sky-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-sky-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-droplet text-xl text-sky-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-2 group-hover:text-sky-600 transition-colors">Clean Water Supply</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">Pembangunan dan pengelolaan instalasi air bersih di kampung-kampung terpencil untuk kebutuhan dasar warga.</p>
                    </div>
                </a>
                <a href="#promosi-usaha" class="shadow-card card-hover bg-white border border-neutral-100 fade-in group">
                    <div class="h-1.5 bg-amber-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-amber-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-store text-xl text-amber-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-2 group-hover:text-amber-600 transition-colors">Promosi Usaha</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">Peningkatan kapasitas bisnis usaha kecil menengah (UKM) masyarakat Papua agar mampu bersaing di pasar yang lebih luas.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Detail Program --}}
    <section class="py-20 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-6 space-y-24">

            {{-- 01. Informasi / Media & Komunikasi Alternatif --}}
            <div id="informasi" class="scroll-mt-24">
                <div class="grid md:grid-cols-2 gap-10 items-center fade-in">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-newspaper text-primary-500"></i></div>
                            <span class="text-5xl font-display font-bold text-neutral-200">01</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-3">Informasi — Media &amp; Komunikasi Alternatif</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">Melalui buletin <em>Kabar Dari Kampung</em> (KDK) yang pertama kali terbit pada 1982, YPMD IRJA membangun media alternatif yang menyuarakan realita kehidupan masyarakat desa di Irian Jaya / Papua sekarang. KDK menjadi jembatan informasi antara masyarakat kampung dengan dunia luar, menyampaikan isu-isu kritis seperti hak tanah ulayat, pembangunan, dan pelestarian budaya.</p>
                        <ul class="space-y-1.5 mb-6">
                            @foreach (['Buletin KDK aktif sejak 1982 — media alternatif tertua di Papua','Dokumentasi gerakan dan perjuangan masyarakat desa di Irian Jaya / Papua sekarang','Arsip digital untuk pelestarian sejarah Papua','Jurnalisme komunitas oleh dan untuk masyarakat kampung','Distribusi ke jaringan advokasi nasional & internasional'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                        <a href="{{ route('kdk') }}" class="inline-flex items-center gap-2 bg-primary-500 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-600 transition-colors">
                            <i class="fa-solid fa-file-pdf"></i>Lihat Arsip Buletin KDK
                        </a>
                    </div>
                    <div class="h-72 bg-primary-50 rounded-lg shadow-card flex flex-col items-center justify-center gap-4">
                        <i class="fa-solid fa-newspaper text-6xl text-primary-200"></i>
                        <div class="text-center">
                            <p class="text-primary-700 font-display font-bold text-lg">Buletin KDK</p>
                            <p class="text-primary-400 text-sm">Sejak 1982 &middot; 6+ Edisi</p>
                        </div>
                    </div>
                </div>
                {{-- Sub-detail: Dampak --}}
                <div class="mt-10 grid sm:grid-cols-3 gap-6 fade-in">
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-3"><i class="fa-solid fa-clock-rotate-left text-primary-500"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">40+ Tahun Publikasi</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">KDK telah menjadi suara masyarakat desa di Irian Jaya / Papua sekarang selama lebih dari empat dekade, mencatat perjalanan perjuangan dan pembangunan.</p>
                    </div>
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-3"><i class="fa-solid fa-globe text-primary-500"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Jangkauan Luas</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Didistribusikan ke berbagai lembaga, organisasi masyarakat sipil, dan jaringan advokasi di tingkat lokal, nasional, hingga internasional.</p>
                    </div>
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-3"><i class="fa-solid fa-book-open text-primary-500"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Arsip Sejarah</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Edisi-edisi KDK kini didigitalisasi sebagai sumber referensi sejarah dan budaya masyarakat desa di Irian Jaya / Papua sekarang yang tak ternilai.</p>
                    </div>
                </div>
            </div>

            <hr class="border-neutral-200">

            {{-- 02. Ekonomi Kerakyatan --}}
            <div id="ekonomi" class="scroll-mt-24">
                <div class="grid md:grid-cols-2 gap-10 items-center fade-in">
                    <div class="md:order-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-accent-50 flex items-center justify-center"><i class="fa-solid fa-chart-line text-accent-500"></i></div>
                            <span class="text-5xl font-display font-bold text-neutral-200">02</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-3">Ekonomi Kerakyatan</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">YPMD IRJA mengembangkan program ekonomi kerakyatan yang berfokus pada pengembangan potensi lokal, aksesibilitas pasar, dan penguatan keuangan masyarakat kampung. Program ini mencakup dua pilar utama: ekspor kakao organik dan keuangan mikro melalui BPR Phidectama.</p>
                        <ul class="space-y-1.5">
                            @foreach (['Pengembangan potensi ekonomi lokal masyarakat kampung','Fasilitasi akses pasar untuk produk hasil bumi','Pelatihan manajemen usaha & keuangan','Penguatan simpanan dan tabungan masyarakat','Kemitraan strategis dengan lembaga dalam & luar negeri'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-accent-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="h-72 bg-accent-50 rounded-lg shadow-card flex flex-col items-center justify-center gap-4 md:order-1">
                        <i class="fa-solid fa-chart-line text-6xl text-accent-200"></i>
                        <div class="text-center">
                            <p class="text-accent-500 font-display font-bold text-lg">Ekonomi Kerakyatan</p>
                            <p class="text-accent-300 text-sm">Kakao Organik &middot; BPR Phidectama</p>
                        </div>
                    </div>
                </div>

                {{-- Sub-program: Ekspor Kakao Organik --}}
                <div class="mt-12 grid md:grid-cols-2 gap-8 fade-in">
                    <div class="bg-white border border-neutral-100 p-8 shadow-card">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-seedling text-primary-500"></i></div>
                            <h4 class="font-display font-bold text-neutral-900">Ekspor Kakao Organik</h4>
                        </div>
                        <p class="text-neutral-600 text-sm leading-relaxed mb-4">Sejak 2010, YPMD IRJA memfasilitasi ekspor biji kakao organik dari petani di Lembah Grime, Kabupaten Jayapura, ke pasar Jepang melalui kemitraan dengan All To Japan (ATJ) dan Green Coop. Program ini membuktikan bahwa produk lokal Papua mampu bersaing di pasar internasional.</p>
                        <ul class="space-y-1.5">
                            @foreach (['Lebih dari 10 tahun ekspor ke Jepang','Kemitraan dengan ATJ & Green Coop','Pertanian organik berkelanjutan','Peningkatan pendapatan petani lokal'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="bg-white border border-neutral-100 p-8 shadow-card">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-piggy-bank text-primary-500"></i></div>
                            <h4 class="font-display font-bold text-neutral-900">Keuangan Mikro — BPR Phidectama</h4>
                        </div>
                        <p class="text-neutral-600 text-sm leading-relaxed mb-4">Pada tahun 1992, YPMD IRJA mendirikan Bank Perkreditan Rakyat (BPR) Phidectama sebagai instrumen keuangan mikro untuk membangun kebiasaan menabung dan akses permodalan bagi masyarakat kampung, sehingga mereka tidak bergantung pada rentenir.</p>
                        <ul class="space-y-1.5">
                            @foreach (['Berdiri sejak 1992','Akses modal untuk UMKM masyarakat kampung','Program tabungan masyarakat kampung','Pendampingan & edukasi keuangan'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Stats Ekonomi --}}
                <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 fade-in">
                    <div class="bg-white border border-neutral-100 p-5 text-center shadow-card">
                        <div class="text-2xl font-display font-bold text-accent-500">10+</div>
                        <div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Tahun Ekspor Kakao</div>
                    </div>
                    <div class="bg-white border border-neutral-100 p-5 text-center shadow-card">
                        <div class="text-2xl font-display font-bold text-accent-500">1992</div>
                        <div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">BPR Phidectama Berdiri</div>
                    </div>
                    <div class="bg-white border border-neutral-100 p-5 text-center shadow-card">
                        <div class="text-2xl font-display font-bold text-primary-600">Jepang</div>
                        <div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Pasar Ekspor Kakao</div>
                    </div>
                    <div class="bg-white border border-neutral-100 p-5 text-center shadow-card">
                        <div class="text-2xl font-display font-bold text-primary-600">Lembah Grime</div>
                        <div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Sentra Produksi</div>
                    </div>
                </div>
            </div>

            <hr class="border-neutral-200">

            {{-- 03. Clean Water Supply --}}
            <div id="air-bersih" class="scroll-mt-24">
                <div class="grid md:grid-cols-2 gap-10 items-center fade-in">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-sky-50 flex items-center justify-center"><i class="fa-solid fa-droplet text-sky-500"></i></div>
                            <span class="text-5xl font-display font-bold text-neutral-200">03</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-3">Clean Water Supply</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">Program penyediaan air bersih merupakan salah satu pilar penting YPMD IRJA. Banyak kampung di pedalaman Papua yang belum memiliki akses air bersih layak konsumsi. YPMD IRJA membangun dan mengelola instalasi air bersih berbasis gravitasi maupun pompa untuk memenuhi kebutuhan dasar warga.</p>
                        <ul class="space-y-1.5 mb-6">
                            @foreach (['Pembangunan instalasi air bersih berbasis gravitasi','Pemasangan sistem pompa air untuk daerah dataran rendah','Pelatihan pemeliharaan & pengelolaan instalasi oleh warga','Pemetaan sumber mata air di wilayah terpencil','Kerjasama dengan pemerintah daerah & lembaga donor'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-sky-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="h-72 bg-sky-50 rounded-lg shadow-card flex flex-col items-center justify-center gap-4">
                        <i class="fa-solid fa-droplet text-6xl text-sky-200"></i>
                        <div class="text-center">
                            <p class="text-sky-600 font-display font-bold text-lg">Air Bersih</p>
                            <p class="text-sky-400 text-sm">Hak Dasar Masyarakat Kampung</p>
                        </div>
                    </div>
                </div>
                {{-- Sub-detail --}}
                <div class="mt-10 grid sm:grid-cols-3 gap-6 fade-in">
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-sky-50 flex items-center justify-center mb-3"><i class="fa-solid fa-faucet-drip text-sky-500"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Instalasi Gravitasi</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Memanfaatkan sumber mata air pegunungan yang dialirkan melalui pipa ke kampung-kampung, tanpa membutuhkan energi listrik.</p>
                    </div>
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-sky-50 flex items-center justify-center mb-3"><i class="fa-solid fa-people-carry-box text-sky-500"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Pengelolaan Komunitas</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Masyarakat kampung dilibatkan langsung dalam pembangunan dan pengelolaan instalasi agar terjaga keberlanjutannya.</p>
                    </div>
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-sky-50 flex items-center justify-center mb-3"><i class="fa-solid fa-heart-pulse text-sky-500"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Dampak Kesehatan</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Akses air bersih menurunkan angka penyakit yang ditularkan melalui air dan meningkatkan kualitas hidup masyarakat kampung.</p>
                    </div>
                </div>
            </div>

            <hr class="border-neutral-200">

            {{-- 04. Promosi Usaha --}}
            <div id="promosi-usaha" class="scroll-mt-24">
                <div class="grid md:grid-cols-2 gap-10 items-center fade-in">
                    <div class="md:order-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-amber-50 flex items-center justify-center"><i class="fa-solid fa-store text-amber-500"></i></div>
                            <span class="text-5xl font-display font-bold text-neutral-200">04</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-3">Promosi Usaha</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">YPMD IRJA membantu meningkatkan kapasitas bisnis usaha kecil menengah (UKM) masyarakat Papua agar mampu bersaing di pasar yang lebih luas. Program ini meliputi pelatihan keterampilan produksi, pemasaran, branding produk lokal, hingga pendampingan akses modal usaha.</p>
                        <ul class="space-y-1.5 mb-6">
                            @foreach (['Pelatihan keterampilan produksi & manajemen usaha','Pendampingan branding dan pengemasan produk lokal','Fasilitasi akses ke pasar regional dan nasional','Pelatihan pemasaran digital untuk pelaku UKM','Mentoring bisnis berkelanjutan untuk wirausaha lokal'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-amber-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="h-72 bg-amber-50 rounded-lg shadow-card flex flex-col items-center justify-center gap-4 md:order-1">
                        <i class="fa-solid fa-store text-6xl text-amber-200"></i>
                        <div class="text-center">
                            <p class="text-amber-600 font-display font-bold text-lg">Promosi Usaha</p>
                            <p class="text-amber-400 text-sm">Memajukan UKM Papua</p>
                        </div>
                    </div>
                </div>
                {{-- Sub-detail --}}
                <div class="mt-10 grid sm:grid-cols-3 gap-6 fade-in">
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-amber-50 flex items-center justify-center mb-3"><i class="fa-solid fa-graduation-cap text-amber-500"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Pelatihan Usaha</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Workshop dan pelatihan praktis untuk meningkatkan keterampilan produksi, manajemen keuangan, dan pemasaran bagi pelaku UKM Papua.</p>
                    </div>
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-amber-50 flex items-center justify-center mb-3"><i class="fa-solid fa-tags text-amber-500"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Branding Produk Lokal</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Pendampingan dalam pengembangan identitas merek, desain kemasan, dan strategi pemasaran untuk produk-produk unggulan Papua.</p>
                    </div>
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-amber-50 flex items-center justify-center mb-3"><i class="fa-solid fa-handshake text-amber-500"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Akses Pasar</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Menghubungkan pelaku UKM Papua dengan jaringan distribusi dan marketplace untuk memperluas jangkauan pasar produk mereka.</p>
                    </div>
                </div>
            </div>

            <hr class="border-neutral-200">

            {{-- 05. Pendampingan Masyarakat Desa di Irian Jaya / Papua Sekarang --}}
            <div id="pendampingan" class="scroll-mt-24">
                <div class="grid md:grid-cols-2 gap-10 items-center fade-in">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-accent-50 flex items-center justify-center"><i class="fa-solid fa-users text-accent-400"></i></div>
                            <span class="text-5xl font-display font-bold text-neutral-200">05</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-3">Pendampingan Masyarakat Desa di Irian Jaya / Papua Sekarang</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">Program inti YPMD IRJA adalah mendampingi dan mengorganisir masyarakat desa di Irian Jaya / Papua sekarang agar mampu mengadvokasi hak-hak mereka atas tanah ulayat dan sumber daya alam. Melalui pendidikan hukum, penguatan organisasi komunitas, dan jaringan advokasi, masyarakat desa di Irian Jaya / Papua sekarang dibekali kemampuan untuk memperjuangkan hak-haknya secara mandiri.</p>
                        <ul class="space-y-1.5 mb-6">
                            @foreach (['Pendidikan hukum adat dan hak-hak masyarakat desa di Irian Jaya / Papua sekarang','Penguatan organisasi dan kelembagaan komunitas','Advokasi hak tanah ulayat dan sumber daya alam','Jaringan advokasi di tingkat nasional & internasional','Pendokumentasian kearifan lokal dan budaya adat Papua'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-accent-400 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="h-72 bg-accent-50 rounded-lg shadow-card flex flex-col items-center justify-center gap-4">
                        <i class="fa-solid fa-users text-6xl text-accent-200"></i>
                        <div class="text-center">
                            <p class="text-accent-500 font-display font-bold text-lg">Masyarakat Desa di Irian Jaya / Papua Sekarang</p>
                            <p class="text-accent-300 text-sm">Advokasi &middot; Organisasi &middot; Hak Ulayat</p>
                        </div>
                    </div>
                </div>
                {{-- Sub-detail --}}
                <div class="mt-10 grid sm:grid-cols-3 gap-6 fade-in">
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-accent-50 flex items-center justify-center mb-3"><i class="fa-solid fa-scale-balanced text-accent-400"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Pendidikan Hukum</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Edukasi tentang hak-hak hukum masyarakat desa di Irian Jaya / Papua sekarang, termasuk UU terkait tanah ulayat, sumber daya alam, dan hak asasi manusia.</p>
                    </div>
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-accent-50 flex items-center justify-center mb-3"><i class="fa-solid fa-sitemap text-accent-400"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Penguatan Organisasi</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Membantu masyarakat desa di Irian Jaya / Papua sekarang membentuk dan mengelola organisasi komunitas yang kuat sebagai wadah aspirasi dan perjuangan bersama.</p>
                    </div>
                    <div class="bg-white border border-neutral-100 p-6 shadow-card">
                        <div class="w-10 h-10 bg-accent-50 flex items-center justify-center mb-3"><i class="fa-solid fa-earth-asia text-accent-400"></i></div>
                        <h4 class="font-display font-bold text-neutral-900 mb-1">Jaringan Advokasi</h4>
                        <p class="text-neutral-500 text-sm leading-relaxed">Membangun kemitraan dengan lembaga advokasi lokal, nasional, dan internasional untuk memperkuat suara masyarakat desa di Irian Jaya / Papua sekarang.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6 text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-4">Dukung Program Kami</h2>
            <p class="text-primary-200 text-lg max-w-lg mx-auto mb-8">Setiap kontribusi membantu mewujudkan kemandirian ekonomi dan keadilan sosial bagi masyarakat desa di Irian Jaya / Papua sekarang.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('donasi') }}" class="bg-white text-primary-600 px-8 py-3 text-sm font-semibold hover:bg-neutral-100 transition-colors shadow-card">
                    <i class="fa-solid fa-heart mr-2"></i>Donasi Sekarang
                </a>
                <a href="{{ route('kontak') }}" class="border border-white/40 text-white px-8 py-3 text-sm font-semibold hover:bg-white/10 transition-colors">
                    <i class="fa-solid fa-envelope mr-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
