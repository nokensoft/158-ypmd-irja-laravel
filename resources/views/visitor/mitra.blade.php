@extends('layouts.visitor')
@section('title', 'Mitra Kerja - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Mitra Kerja & Sponsor YPMD IRJA')
@section('seo-description', 'Daftar mitra kerja dan sponsor yang telah mendukung program pemberdayaan masyarakat adat Papua bersama YPMD IRJA.')

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest">
                <a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> ›
                <a href="{{ route('profil') }}" class="hover:text-white">Tentang</a> › Mitra Kerja
            </span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Mitra Kerja & Sponsor</h1>
            <p class="text-primary-200 mt-2 text-lg">Lembaga dan organisasi yang telah bermitra bersama YPMD IRJA</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="max-w-2xl mb-14 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-handshake mr-2"></i>Kemitraan</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-4">Bersama Membangun Papua</h2>
                <p class="text-neutral-600 leading-relaxed">Selama lebih dari 40 tahun, YPMD IRJA telah menjalin kemitraan strategis dengan berbagai lembaga internasional, pemerintah, organisasi non-pemerintah, dan sektor korporasi. Kemitraan ini menjadi fondasi keberlanjutan program-program pemberdayaan masyarakat adat Papua.</p>
            </div>

            {{-- Organisasi Internasional / NGO --}}
            <div class="mb-14">
                <h3 class="text-xs font-bold uppercase tracking-widest text-neutral-400 mb-6 flex items-center gap-3">
                    <span class="flex-1 h-px bg-neutral-200"></span>
                    <span><i class="fa-solid fa-globe mr-2 text-primary-400"></i>Organisasi Internasional & NGO</span>
                    <span class="flex-1 h-px bg-neutral-200"></span>
                </h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ([
                        [
                            'nama'    => 'THD Asia Foundation',
                            'negara'  => 'Asia',
                            'flag'    => '🌏',
                            'desc'    => 'Lembaga donor yang mendukung program penguatan masyarakat sipil dan pemberdayaan komunitas adat.',
                        ],
                        [
                            'nama'    => 'ICCO',
                            'negara'  => 'Belanda',
                            'flag'    => '🇳🇱',
                            'desc'    => 'Organisasi Gereja-Gereja Kristen di Belanda (Interkerkelijke Coordinatie Commissie Ontwikkelingshulp). Salah satu mitra tertua YPMD IRJA.',
                        ],
                        [
                            'nama'    => 'PKN',
                            'negara'  => 'Belanda',
                            'flag'    => '🇳🇱',
                            'desc'    => 'Perkumpulan Kristen Nederland — penerus ICCO yang terus mendukung program pemberdayaan masyarakat adat Papua.',
                        ],
                        [
                            'nama'    => 'CEMOBE',
                            'negara'  => 'Internasional',
                            'flag'    => '✝️',
                            'desc'    => 'Organisasi Gereja-Gereja Katolik yang mendukung program pendampingan komunitas dan advokasi hak-hak adat.',
                        ],
                        [
                            'nama'    => 'BFDBW',
                            'negara'  => 'Jerman',
                            'flag'    => '🇩🇪',
                            'desc'    => 'Lembaga mitra dari Jerman yang memberikan dukungan program pemberdayaan masyarakat adat Papua.',
                        ],
                    ] as $m)
                    <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-primary-200 hover:shadow-card transition">
                        <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                            <img src="https://placehold.co/200x80/f0faf4/2d8057?text={{ urlencode($m['nama']) }}"
                                 alt="{{ $m['nama'] }}" class="max-h-16 max-w-full object-contain">
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xl">{{ $m['flag'] }}</span>
                                <div>
                                    <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">{{ $m['nama'] }}</h4>
                                    <p class="text-xs text-primary-500 font-semibold uppercase tracking-wider">{{ $m['negara'] }}</p>
                                </div>
                            </div>
                            <p class="text-neutral-500 text-sm leading-relaxed">{{ $m['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Pemerintah & Konsulat --}}
            <div class="mb-14">
                <h3 class="text-xs font-bold uppercase tracking-widest text-neutral-400 mb-6 flex items-center gap-3">
                    <span class="flex-1 h-px bg-neutral-200"></span>
                    <span><i class="fa-solid fa-landmark mr-2 text-accent-400"></i>Pemerintah & Konsulat</span>
                    <span class="flex-1 h-px bg-neutral-200"></span>
                </h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ([
                        [
                            'nama'    => 'Pemerintah Canada',
                            'negara'  => 'Canada',
                            'flag'    => '🇨🇦',
                            'desc'    => 'Dukungan melalui program bantuan pembangunan internasional untuk penguatan masyarakat sipil di Papua.',
                        ],
                        [
                            'nama'    => 'Pemerintah Jepang / Konsulat Jepang di Makassar',
                            'negara'  => 'Jepang',
                            'flag'    => '🇯🇵',
                            'desc'    => 'Dukungan melalui jalur diplomatik Konsulat Jepang di Makassar untuk program-program pemberdayaan dan pertanian organik.',
                        ],
                        [
                            'nama'    => 'Kantor Pos Jepang',
                            'negara'  => 'Jepang',
                            'flag'    => '🇯🇵',
                            'desc'    => 'Mitra dalam jalur pengiriman dan distribusi dalam program ekspor kakao organik ke pasar Jepang.',
                        ],
                    ] as $m)
                    <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-accent-200 hover:shadow-card transition">
                        <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                            <img src="https://placehold.co/200x80/f5f9f0/6aaa3a?text={{ urlencode($m['nama']) }}"
                                 alt="{{ $m['nama'] }}" class="max-h-16 max-w-full object-contain">
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xl">{{ $m['flag'] }}</span>
                                <div>
                                    <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">{{ $m['nama'] }}</h4>
                                    <p class="text-xs text-accent-500 font-semibold uppercase tracking-wider">{{ $m['negara'] }}</p>
                                </div>
                            </div>
                            <p class="text-neutral-500 text-sm leading-relaxed">{{ $m['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Korporasi / CSR --}}
            <div>
                <h3 class="text-xs font-bold uppercase tracking-widest text-neutral-400 mb-6 flex items-center gap-3">
                    <span class="flex-1 h-px bg-neutral-200"></span>
                    <span><i class="fa-solid fa-building mr-2 text-neutral-400"></i>Korporasi & Program CSR</span>
                    <span class="flex-1 h-px bg-neutral-200"></span>
                </h3>
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach ([
                        [
                            'nama'    => 'BP Bintuni',
                            'negara'  => 'Indonesia',
                            'flag'    => '🏭',
                            'desc'    => 'Dana CSR untuk mendampingi masyarakat yang terkena dampak operasional perusahaan di wilayah Teluk Bintuni.',
                        ],
                        [
                            'nama'    => 'PT Freeport Indonesia (PT FI)',
                            'negara'  => 'Indonesia',
                            'flag'    => '🏔️',
                            'desc'    => 'Program CSR pendampingan Organisasi Masyarakat Sipil (CSO) penerima hibah dari PT Freeport Indonesia untuk komunitas di lingkar tambang.',
                        ],
                    ] as $m)
                    <div class="bg-neutral-50 border border-neutral-100 fade-in hover:border-neutral-300 hover:shadow-card transition">
                        <div class="h-36 bg-white flex items-center justify-center p-6 border-b border-neutral-100">
                            <img src="https://placehold.co/200x80/f8f8f8/888888?text={{ urlencode($m['nama']) }}"
                                 alt="{{ $m['nama'] }}" class="max-h-16 max-w-full object-contain">
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xl">{{ $m['flag'] }}</span>
                                <div>
                                    <h4 class="font-display font-bold text-neutral-900 text-sm leading-tight">{{ $m['nama'] }}</h4>
                                    <p class="text-xs text-neutral-400 font-semibold uppercase tracking-wider">{{ $m['negara'] }} &middot; CSR</p>
                                </div>
                            </div>
                            <p class="text-neutral-500 text-sm leading-relaxed">{{ $m['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-primary-600 py-14">
        <div class="max-w-4xl mx-auto px-6 text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-3">Tertarik Bermitra dengan YPMD IRJA?</h2>
            <p class="text-primary-200 text-lg mb-8">Kami terbuka untuk kolaborasi dengan lembaga, pemerintah, dan sektor swasta yang memiliki komitmen terhadap pemberdayaan masyarakat adat Papua.</p>
            <a href="{{ route('kontak') }}"
               class="inline-flex items-center gap-2 bg-white text-primary-600 px-8 py-3 text-sm font-semibold hover:bg-neutral-100 transition-colors shadow-card">
                <i class="fa-solid fa-envelope"></i> Hubungi Kami
            </a>
        </div>
    </section>
@endsection
