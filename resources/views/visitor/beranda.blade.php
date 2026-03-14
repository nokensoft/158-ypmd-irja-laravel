@extends('layouts.visitor')
@section('title', ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-description', ($situs['seo_meta_description'] ?? 'LSM pertama di Tanah Papua yang lahir dari keresahan kelompok idealis Gereja dan Tokoh Masyarakat'))

@section('json-ld')
@php
$_bcHome = ['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[
    ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],
]];
$_f = JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE;
@endphp
<script type="application/ld+json">{!! json_encode($_bcHome, $_f) !!}</script>
@endsection

@section('content')

    {{-- HERO --}}
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-6 py-20 md:py-28 grid md:grid-cols-2 gap-12 items-center">
            <div class="fade-in">
                <span class="inline-block text-xs font-semibold tracking-widest uppercase text-primary-500 mb-4">
                    <i class="fa-solid fa-leaf mr-2"></i>Pionir Pemberdayaan Masyarakat Desa di Irian Jaya / Papua Sekarang &middot; Sejak 1984 &middot; Jayapura, Papua
                </span>
                <h1 class="text-3xl md:text-5xl font-display font-bold text-neutral-900 leading-tight mb-5">
                    Yayasan Pembangunan<br/>
                    <span class="text-primary-600">Masyarakat Desa</span><br/>
                    Irian Jaya
                </h1>
                <p class="text-neutral-500 text-lg leading-relaxed mb-8 max-w-md">
                    {{ $situs['deskripsi_situs'] ?? 'LSM pertama di Tanah Papua yang lahir dari keresahan kelompok idealis Gereja dan Tokoh Masyarakat, hadir sebagai jembatan informasi dan agen perubahan bagi masyarakat desa di Irian Jaya / Papua sekarang dalam mempertahankan hak-hak mereka atas tanah dan sumber daya alam.' }}
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('program') }}" class="bg-primary-500 text-white px-6 py-2.5 text-sm font-semibold hover:bg-primary-600 transition-colors shadow-card">Lihat Program</a>
                    <a href="{{ route('profil') }}" class="border border-neutral-300 text-neutral-700 px-6 py-2.5 text-sm font-semibold hover:border-primary-400 hover:text-primary-600 transition-colors">Tentang Kami</a>
                </div>
            </div>
            <div class="fade-in relative">
                <img src="{{ asset('img/galeri/Kantor YPMD-IRJA.png') }}" alt="Kantor YPMD IRJA" class="w-full rounded-lg shadow-card object-cover"/>
                {{-- Logo mengambang --}}
                <div class="absolute bottom-0 right-6 translate-y-1/2 bg-white/95 backdrop-blur-sm shadow-xl rounded-xl px-4 py-3 flex items-center gap-3 border border-neutral-100">
                    <img src="{{ asset('img/logo-ypmd-irja.png') }}" alt="YPMD IRJA" class="h-16 w-auto">
                    <div class="leading-tight">
                        <p class="text-sm font-bold text-primary-700">YPMD IRJA</p>
                        <p class="text-xs text-neutral-400">Sejak 1984</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Stats Bar --}}
        <div class="border-t border-neutral-200 bg-neutral-50">
            <div class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center fade-in"><div class="text-3xl font-display font-bold text-primary-600">1984</div><div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Tahun Berdiri</div></div>
                <div class="text-center fade-in"><div class="text-3xl font-display font-bold text-primary-600">40+</div><div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Tahun Berkarya</div></div>
                <div class="text-center fade-in"><div class="text-3xl font-display font-bold text-accent-400">10+</div><div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Tahun Ekspor Kakao</div></div>
                <div class="text-center fade-in"><div class="text-3xl font-display font-bold text-accent-400">4</div><div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Wilayah Kerja</div></div>
            </div>
        </div>
    </section>

    {{-- Papua Today / Berita --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-12 fade-in">
                <span class="text-xs font-semibold tracking-widest uppercase text-primary-500"><i class="fa-solid fa-blog mr-2"></i>Berita</span>
                <h2 class="text-2xl md:text-4xl font-display font-bold text-neutral-900 mt-2">Papua Today</h2>
                <p class="text-neutral-500 text-lg mt-3 max-w-xl">Berita dan artikel terkini seputar Papua dan program YPMD IRJA.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($beritaTerbaru as $b)
                    <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in">
                        <img src="{{ $b->gambar }}" alt="{{ $b->judul }}" class="w-full h-48 object-cover"/>
                        <div class="p-5">
                            <div class="flex items-center gap-3 text-xs text-neutral-400 mb-2">
                                <span>{{ $b->kategori?->nama ?? 'Berita' }}</span>
                                <span>&bull;</span>
                                <span>{{ $b->tanggal_terbit?->translatedFormat('d M Y') }}</span>
                            </div>
                            <h3 class="font-display font-bold text-neutral-900 mb-2 line-clamp-2">{{ $b->judul }}</h3>
                            @if ($b->ringkasan)
                                <p class="text-neutral-500 text-sm leading-relaxed mb-3 line-clamp-2">{{ $b->ringkasan }}</p>
                            @endif
                            <a href="{{ route('berita.detail', $b->slug) }}" class="text-primary-600 text-sm font-semibold hover:text-primary-700">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right text-xs ml-1"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12 text-neutral-400">
                        <p>Belum ada berita.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-10 fade-in">
                <a href="{{ route('berita') }}" class="inline-flex items-center gap-2 bg-primary-500 text-white px-8 py-3 text-sm font-semibold hover:bg-primary-600 transition-colors shadow-card">
                    Lihat Semua Artikel <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- KDK Terbaru --}}
    <section class="py-20 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-12 fade-in">
                <span class="text-xs font-semibold tracking-widest uppercase text-primary-500"><i class="fa-solid fa-newspaper mr-2"></i>Buletin</span>
                <h2 class="text-2xl md:text-4xl font-display font-bold text-neutral-900 mt-2">KDK Terbaru</h2>
                <p class="text-neutral-500 text-lg mt-3 max-w-xl">Edisi terbaru buletin <em>Kabar Dari Kampung</em> &mdash; media alternatif masyarakat desa di Irian Jaya / Papua sekarang sejak 1982.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($kdkTerbaru as $k)
                    <x-kdk-card :kdk="$k" />
                @empty
                    <div class="col-span-full text-center py-12 text-neutral-400">
                        <i class="fa-solid fa-book-open text-4xl mb-4 block"></i>
                        <p>Belum ada edisi KDK yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-10 fade-in">
                <a href="{{ route('kdk') }}" class="inline-flex items-center gap-2 bg-primary-500 text-white px-8 py-3 text-sm font-semibold hover:bg-primary-600 transition-colors shadow-card">
                    Lihat Semua Buletin <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Program Unggulan --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-12 fade-in">
                <span class="text-xs font-semibold tracking-widest uppercase text-primary-500"><i class="fa-solid fa-list-check mr-2"></i>Kegiatan</span>
                <h2 class="text-2xl md:text-4xl font-display font-bold text-neutral-900 mt-2">Program Unggulan</h2>
                <p class="text-neutral-500 text-lg mt-3 max-w-2xl">Empat pilar program utama YPMD IRJA dalam memberdayakan masyarakat kampung di Papua.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- 1. Informasi --}}
                <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in">
                    <div class="h-1.5 bg-primary-500"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-primary-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-newspaper text-xl text-primary-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-2">Informasi</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">Penyebaran informasi pembangunan masyarakat melalui Buletin Kabar Dari Kampung (KDK) sejak tahun 1982 (edisi cetak sampai tahun 2000), sebagai media alternatif, advokasi, dan promosi usaha rakyat.</p>
                        <a href="{{ route('kdk') }}" class="inline-flex items-center gap-1 mt-4 text-primary-600 text-xs font-semibold hover:text-primary-700">
                            Buletin KDK <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </article>

                {{-- 2. Ekonomi Kerakyatan --}}
                <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in">
                    <div class="h-1.5 bg-accent-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-accent-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-chart-line text-xl text-accent-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-2">Ekonomi Kerakyatan</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">Pengembangan potensi lokal, aksesibilitas pasar, dan mobilisasi simpanan  keuangan masyarakat di bank.</p>
                        <a href="{{ route('program') }}" class="inline-flex items-center gap-1 mt-4 text-accent-600 text-xs font-semibold hover:text-accent-700">
                            Selengkapnya <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </article>

                {{-- 3. Clean Water Supply --}}
                <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in">
                    <div class="h-1.5 bg-sky-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-sky-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-droplet text-xl text-sky-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-2">Kesehatan Lingkungan/Clean Water Supply</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">Pembangunan dan pengelolaan instalasi air bersih, sanitasi, dan lingkungan di kampung-kampung terpencil untuk kebutuhan dasar warga.</p>
                        <a href="{{ route('program') }}" class="inline-flex items-center gap-1 mt-4 text-sky-600 text-xs font-semibold hover:text-sky-700">
                            Selengkapnya <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </article>

                {{-- 4. Promosi Usaha --}}
                <article class="shadow-card card-hover bg-white border border-neutral-100 fade-in">
                    <div class="h-1.5 bg-amber-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-amber-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-store text-xl text-amber-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-2">Promosi Usaha</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">Peningkatan kapasitas bisnis usaha kecil menengah (UKM) masyarakat agar mampu bersaing di pasar yang lebih luas.</p>
                        <a href="{{ route('program') }}" class="inline-flex items-center gap-1 mt-4 text-amber-600 text-xs font-semibold hover:text-amber-700">
                            Selengkapnya <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </article>

            </div>
            <div class="text-center mt-10 fade-in">
                <a href="{{ route('program') }}" class="inline-flex items-center gap-2 bg-primary-500 text-white px-8 py-3 text-sm font-semibold hover:bg-primary-600 transition-colors shadow-card">
                    Lihat Semua Program <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Galeri --}}
    <section class="py-20 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-12 fade-in">
                <span class="text-xs font-semibold tracking-widest uppercase text-primary-500"><i class="fa-solid fa-images mr-2"></i>Dokumentasi</span>
                <h2 class="text-2xl md:text-4xl font-display font-bold text-neutral-900 mt-2">Galeri Kegiatan</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse ($galeriTerbaru as $g)
                    @php $cover = $g->media->first(); @endphp
                    @if ($cover)
                        <div class="overflow-hidden rounded-lg shadow-card fade-in">
                            <img src="{{ asset('storage/' . $cover->file_path) }}" alt="{{ $g->judul }}" class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-300"/>
                        </div>
                    @endif
                @empty
                    <div class="overflow-hidden rounded-lg shadow-card fade-in"><img src="{{ asset('img/galeri/Kantor YPMD-IRJA.png') }}" alt="Kantor YPMD IRJA" class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-300"/></div>
                    <div class="overflow-hidden rounded-lg shadow-card fade-in"><img src="{{ asset('img/galeri/Kantor YPMD-IRJA.png') }}" alt="Kantor YPMD IRJA" class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-300"/></div>
                    <div class="overflow-hidden rounded-lg shadow-card fade-in"><img src="{{ asset('img/galeri/Kantor YPMD-IRJA.png') }}" alt="Kantor YPMD IRJA" class="w-full h-48 md:h-56 object-cover hover:scale-105 transition-transform duration-300"/></div>
                @endforelse
            </div>
            <div class="text-center mt-10 fade-in">
                <a href="{{ route('galeri') }}" class="inline-flex items-center gap-2 bg-primary-500 text-white px-8 py-3 text-sm font-semibold hover:bg-primary-600 transition-colors shadow-card">
                    Lihat Semua Galeri <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>


    {{-- Mitra Kerja & Sponsor --}}
    <section class="py-16 bg-white border-t border-neutral-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">
                    <i class="fa-solid fa-handshake mr-2"></i>Kemitraan
                </p>
                <h2 class="text-xl md:text-2xl font-display font-bold text-neutral-900">Mitra Kerja & Sponsor</h2>
            </div>
            
            <div class="flex flex-wrap justify-center items-center gap-x-8 gap-y-6">
                @foreach ([
                    'The Asia Foundation', 'Pemerintah Canada', 'Block Grant Canada Fund', 'ICCO Cooperation',
                    'CEBEMO', 'Hivos', 'PKN Belanda', 'Brot für die Welt',
                    'USAID', 'SoFEI', 'Konsulat Jepang', 'Kantor Pos Jepang',
                    'Alter Trade Japan', 'PT Freeport Indonesia', 'BP Bintuni', 'UNCEN',
                    'UNIPA', 'Pemkab Jayapura', 'Pemprov Papua', 'STFT Fajar Timur',
                    'STT GKI', 'UGM Jogjakarta', 'WALHI Jakarta', 'SKH Sinar Harapan',
                    'INFID', 'FOKER LSM Papua', 'WALHI Papua', 'AMAN',
                    'Yayasan SATUNAMA', 'CEA Regio Papua', 'Tong Belajar Bersama', 'UNDP'
                ] as $nama)
                <div class="fade-in group">
                    {{-- 
                        - Text color diubah ke 000000 (Hitam) agar kontras maksimal
                        - BG diubah ke f9f9f9 (Abu-abu sangat muda) agar terlihat bersih
                        - Grayscale dikurangi (opacity-80) agar teks tetap terbaca sebelum hover 
                    --}}
                    <img src="https://placehold.co/160x60/f9f9f9/000000?text={{ urlencode($nama) }}&font=roboto"
                         alt="{{ $nama }}" 
                         class="h-9 md:h-11 object-contain opacity-80 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-105 border border-neutral-50 rounded">
                </div>
                @endforeach
            </div>

            <div class="text-center mt-14">
                <a href="{{ route('mitra') }}" class="inline-flex items-center gap-2 bg-neutral-50 border border-neutral-200 text-neutral-700 px-6 py-2.5 text-sm font-semibold hover:bg-primary-50 hover:text-primary-600 hover:border-primary-200 transition-all">
                    Tampilkan selengkapnya di sini <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>


    {{-- CTA --}}
    <section class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6 text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-4">Bersama Membangun Papua</h2>
            <p class="text-primary-200 text-lg max-w-lg mx-auto mb-8">Dukung program pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang. Setiap kontribusi membantu mewujudkan kemandirian ekonomi dan keadilan sosial.</p>
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
