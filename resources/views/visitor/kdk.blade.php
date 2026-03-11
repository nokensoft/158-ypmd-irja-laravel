@extends('layouts.visitor')
@section('title', 'KDK - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Kabar Dari Kampung (KDK) — Buletin YPMD IRJA')
@section('seo-description', 'Arsip buletin Kabar Dari Kampung, media alternatif masyarakat adat Papua sejak 1982.')

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › KDK</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Kabar Dari Kampung</h1>
            <p class="text-primary-200 mt-2 text-lg">Buletin — Media Alternatif Masyarakat Adat Papua</p>
        </div>
    </div>

    <section class="py-16 bg-neutral-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="bg-white shadow-card p-8 md:p-12 mb-12 fade-in">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-book-open mr-2"></i>Tentang KDK</p>
                        <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-4">Apa itu KDK?</h2>
                        <p class="text-neutral-600 leading-relaxed mb-3"><em>Kabar Dari Kampung</em> (KDK) adalah buletin yang pertama kali diterbitkan pada tahun 1982 oleh kelompok idealis yang kemudian mendirikan YPMD IRJA. Buletin ini hadir sebagai media alternatif yang menyuarakan realita kehidupan masyarakat adat Papua.</p>
                        <p class="text-neutral-600 leading-relaxed">KDK mendokumentasikan berbagai isu penting: hak tanah adat, pengorganisasian komunitas, perkembangan program pemberdayaan, serta berbagai cerita dari kampung-kampung di seluruh Papua.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach (['1982','1984','1988','1990'] as $th)
                        <div class="bg-neutral-50 rounded p-4 text-center shadow-sm">
                            <div class="text-2xl font-display font-bold text-primary-600">{{ $th }}</div>
                            <div class="text-xs text-neutral-400 mt-1">Tahun Terbit</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-10 fade-in">
                <h3 class="text-xl font-display font-bold text-neutral-900 mb-2">Arsip Edisi KDK</h3>
                <p class="text-neutral-500">Unduh edisi-edisi buletin Kabar Dari Kampung dalam format PDF.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ([
                    ['edisi'=>'6','tahun'=>'1992','tema'=>'Ekonomi Komunitas & Keuangan Mikro','tersedia'=>true],
                    ['edisi'=>'5','tahun'=>'1990','tema'=>'Tanah Adat & Hak Masyarakat','tersedia'=>true],
                    ['edisi'=>'4','tahun'=>'1988','tema'=>'Pertanian & Ketahanan Pangan','tersedia'=>true],
                    ['edisi'=>'3','tahun'=>'1986','tema'=>'Pengorganisasian Komunitas','tersedia'=>false],
                    ['edisi'=>'2','tahun'=>'1984','tema'=>'Isu Pembangunan Papua','tersedia'=>false],
                    ['edisi'=>'1','tahun'=>'1982','tema'=>'Edisi Perdana','tersedia'=>false],
                ] as $k)
                <div class="bg-white shadow-card card-hover border border-neutral-100 fade-in">
                    <div class="h-48 bg-primary-50 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-4xl font-display font-bold text-primary-200">KDK</div>
                            <div class="text-lg font-bold text-primary-500 mt-1">Edisi {{ $k['edisi'] }}</div>
                        </div>
                    </div>
                    <div class="p-5">
                        <span class="text-xs font-semibold text-neutral-400 uppercase">Edisi {{ $k['edisi'] }} &bull; {{ $k['tahun'] }}</span>
                        <h4 class="font-display font-bold text-neutral-900 mt-1 mb-3 line-clamp-2">{{ $k['tema'] }}</h4>
                        @if ($k['tersedia'])
                            <a href="#" class="inline-flex items-center gap-2 bg-primary-500 text-white px-4 py-2 text-xs font-semibold hover:bg-primary-600 transition-colors">
                                <i class="fa-solid fa-file-pdf"></i>Unduh PDF
                            </a>
                        @else
                            <span class="inline-flex items-center gap-2 bg-neutral-100 text-neutral-400 px-4 py-2 text-xs font-semibold cursor-not-allowed">
                                <i class="fa-solid fa-clock"></i>Segera Hadir
                            </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
