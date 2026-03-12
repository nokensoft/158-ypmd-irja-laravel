@extends('layouts.visitor')
@section('title', 'Peta Situs - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Peta Situs - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-description', 'Daftar lengkap seluruh halaman publik pada situs ' . ($situs['nama_situs'] ?? 'YPMD IRJA') . ' untuk memudahkan navigasi pengunjung dan mesin pencari.')

@section('json-ld')
@php
$_bc = ['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[
    ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],
    ['@type'=>'ListItem','position'=>2,'name'=>'Peta Situs'],
]];
$_f = JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE;
@endphp
<script type="application/ld+json">{!! json_encode($_bc, $_f) !!}</script>
@endsection

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest">
                <a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Peta Situs
            </span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Peta Situs</h1>
            <p class="text-primary-200 mt-2 text-lg">Daftar lengkap halaman publik untuk pengunjung dan mesin pencari</p>
        </div>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 space-y-10">

            {{-- Info XML Sitemap --}}
            <div class="bg-primary-50 border border-primary-100 p-6">
                <p class="text-sm text-primary-700">
                    <i class="fa-solid fa-robot mr-1"></i>
                    Untuk crawler mesin pencari, sitemap XML tersedia di:
                    <a href="{{ url('/sitemap.xml') }}" class="font-semibold underline hover:text-primary-900">{{ url('/sitemap.xml') }}</a>
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                {{-- Halaman Utama --}}
                <div class="bg-neutral-50 border border-neutral-100 p-6">
                    <h2 class="text-lg font-display font-bold text-neutral-900 mb-4">
                        <i class="fa-solid fa-house text-primary-500 mr-2 text-sm"></i>Halaman Utama
                    </h2>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('beranda') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Beranda</a></li>
                        <li><a href="{{ route('profil') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Profil Lembaga</a></li>
                        <li><a href="{{ route('sejarah') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Sejarah Singkat</a></li>
                        <li><a href="{{ route('tokoh') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Direktur</a></li>
                        <li><a href="{{ route('bidang-kerja') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Bidang Kerja</a></li>
                        <li><a href="{{ route('mitra') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Mitra Kerja</a></li>
                        <li><a href="{{ route('program') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Program</a></li>
                        <li><a href="{{ route('kdk') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Buletin KDK</a></li>
                        <li><a href="{{ route('berita') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Papua Today (Berita)</a></li>
                        <li><a href="{{ route('galeri') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Galeri</a></li>
                        <li><a href="{{ route('donasi') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Donasi</a></li>
                        <li><a href="{{ route('kontak') }}" class="text-neutral-700 hover:text-primary-600 transition"><i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>Kontak</a></li>
                    </ul>
                </div>

                {{-- Halaman CMS --}}
                <div class="bg-neutral-50 border border-neutral-100 p-6">
                    <h2 class="text-lg font-display font-bold text-neutral-900 mb-4">
                        <i class="fa-solid fa-file-lines text-primary-500 mr-2 text-sm"></i>Halaman Lainnya
                    </h2>
                    <ul class="space-y-2 text-sm">
                        @forelse ($halamanList as $h)
                            @if (!in_array($h->slug, ['sejarah', 'profil', 'mitra', 'bidang-kerja']))
                                <li>
                                    <a href="{{ route('halaman.show', $h->slug) }}" class="text-neutral-700 hover:text-primary-600 transition">
                                        <i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>{{ $h->judul }}
                                    </a>
                                </li>
                            @endif
                        @empty
                            <li class="text-neutral-400 text-sm">Belum ada halaman CMS aktif.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                {{-- Kategori Berita --}}
                <div class="bg-neutral-50 border border-neutral-100 p-6">
                    <h2 class="text-lg font-display font-bold text-neutral-900 mb-4">
                        <i class="fa-solid fa-tags text-primary-500 mr-2 text-sm"></i>Kategori Berita
                    </h2>
                    <ul class="space-y-2 text-sm">
                        @forelse ($kategoriBeritaList as $kat)
                            <li>
                                <a href="{{ route('berita.kategori', $kat->slug) }}" class="text-neutral-700 hover:text-primary-600 transition">
                                    <i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>{{ $kat->nama }}
                                    <span class="text-neutral-400 text-xs ml-1">({{ $kat->berita_count }})</span>
                                </a>
                            </li>
                        @empty
                            <li class="text-neutral-400 text-sm">Belum ada kategori berita.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Berita Terbaru --}}
                <div class="bg-neutral-50 border border-neutral-100 p-6">
                    <h2 class="text-lg font-display font-bold text-neutral-900 mb-4">
                        <i class="fa-solid fa-newspaper text-primary-500 mr-2 text-sm"></i>Berita Terbaru
                    </h2>
                    <ul class="space-y-2 text-sm">
                        @forelse ($beritaTerbaru as $b)
                            <li>
                                <a href="{{ route('berita.detail', $b->slug) }}" class="text-neutral-700 hover:text-primary-600 transition">
                                    <i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>{{ $b->judul }}
                                </a>
                                <span class="text-neutral-400 text-xs ml-1">{{ $b->tanggal_terbit?->translatedFormat('d M Y') }}</span>
                            </li>
                        @empty
                            <li class="text-neutral-400 text-sm">Belum ada berita.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                {{-- Album Galeri --}}
                <div class="bg-neutral-50 border border-neutral-100 p-6">
                    <h2 class="text-lg font-display font-bold text-neutral-900 mb-4">
                        <i class="fa-solid fa-images text-primary-500 mr-2 text-sm"></i>Album Galeri
                    </h2>
                    <ul class="space-y-2 text-sm">
                        @forelse ($galeriTerbaru as $g)
                            <li>
                                <a href="{{ route('galeri.detail', $g->slug) }}" class="text-neutral-700 hover:text-primary-600 transition">
                                    <i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>{{ $g->judul }}
                                </a>
                            </li>
                        @empty
                            <li class="text-neutral-400 text-sm">Belum ada album galeri.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- KDK Terbaru --}}
                <div class="bg-neutral-50 border border-neutral-100 p-6">
                    <h2 class="text-lg font-display font-bold text-neutral-900 mb-4">
                        <i class="fa-solid fa-book-open text-primary-500 mr-2 text-sm"></i>Buletin KDK
                    </h2>
                    <ul class="space-y-2 text-sm">
                        @forelse ($kdkTerbaru as $k)
                            <li>
                                <a href="{{ $k->pdf_url ?? '#' }}" class="text-neutral-700 hover:text-primary-600 transition" {{ $k->pdf_url ? 'target=_blank rel=noopener' : '' }}>
                                    <i class="fa-solid fa-angle-right text-neutral-300 mr-2 text-xs"></i>{{ $k->judul }}
                                </a>
                            </li>
                        @empty
                            <li class="text-neutral-400 text-sm">Belum ada buletin KDK.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </section>
@endsection
