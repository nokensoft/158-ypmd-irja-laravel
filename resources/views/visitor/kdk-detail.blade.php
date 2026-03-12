@extends('layouts.visitor')
@section('title', $kdk->judul . ' - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', $kdk->judul . ' — Kabar Dari Kampung Edisi ' . $kdk->nomor_edisi)
@section('seo-description', Str::limit(strip_tags($kdk->deskripsi ?? 'Buletin Kabar Dari Kampung Edisi ' . $kdk->nomor_edisi), 160))

@section('json-ld')
@php
$_bc = ['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[
    ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],
    ['@type'=>'ListItem','position'=>2,'name'=>'Kabar Dari Kampung','item'=>route('kdk')],
    ['@type'=>'ListItem','position'=>3,'name'=>'Edisi ' . $kdk->nomor_edisi],
]];
@endphp
<script type="application/ld+json">{!! json_encode($_bc, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest">
                <a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> ›
                <a href="{{ route('kdk') }}" class="hover:text-white">KDK</a> ›
                Edisi {{ $kdk->nomor_edisi }}
            </span>
            <h1 class="text-2xl md:text-3xl font-display font-bold text-white mt-3 leading-tight">{{ $kdk->judul }}</h1>
            <p class="text-primary-200 mt-2 text-sm">
                Edisi {{ $kdk->nomor_edisi }}
                @if ($kdk->tanggal_terbit) &middot; {{ $kdk->tanggal_terbit->translatedFormat('d F Y') }} @endif
            </p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                {{-- Main Content --}}
                <div class="lg:col-span-3">
                    {{-- Cover & Info --}}
                    <div class="grid md:grid-cols-2 gap-8 mb-10">
                        <div class="aspect-[2/3] overflow-hidden bg-neutral-100">
                            @if ($kdk->media && $kdk->media->file_path)
                                <img src="{{ asset('storage/' . $kdk->media->file_path) }}" alt="{{ $kdk->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-b from-neutral-600 to-neutral-800 flex flex-col items-center justify-center relative">
                                    <div class="absolute inset-0 opacity-10" style="background:radial-gradient(circle at 70% 20%, white, transparent)"></div>
                                    <div class="absolute inset-x-0 top-0 h-1 bg-accent-400"></div>
                                    <img src="{{ asset('img/logo-ypmd-irja.png') }}" alt="YPMD IRJA" class="h-16 w-auto mb-4 opacity-75 relative z-10">
                                    <p class="text-white font-display font-extrabold text-3xl tracking-wider relative z-10">KDK</p>
                                    <p class="text-neutral-300 text-sm font-semibold uppercase tracking-widest mt-1 relative z-10">Edisi {{ $kdk->nomor_edisi }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col justify-center">
                            <span class="inline-block bg-primary-500 text-white text-xs font-bold px-4 py-1.5 mb-4 w-fit">Edisi {{ $kdk->nomor_edisi }}</span>
                            <h2 class="text-2xl font-display font-bold text-neutral-900 mb-3">{{ $kdk->judul }}</h2>
                            @if ($kdk->tanggal_terbit)
                                <p class="text-sm text-neutral-500 mb-4">
                                    <i class="fa-solid fa-calendar-days mr-1"></i> {{ $kdk->tanggal_terbit->translatedFormat('d F Y') }}
                                </p>
                            @endif
                            @if ($kdk->deskripsi)
                                <p class="text-neutral-600 leading-relaxed mb-6">{{ $kdk->deskripsi }}</p>
                            @endif

                            {{-- Stats --}}
                            <div class="flex items-center gap-6 mb-6 text-sm text-neutral-500">
                                <span class="inline-flex items-center gap-1">
                                    <i class="fa-solid fa-eye"></i> {{ number_format($kdk->jumlah_dibaca) }} pembaca
                                </span>
                                <span class="inline-flex items-center gap-1">
                                    <i class="fa-solid fa-download"></i> {{ number_format($kdk->jumlah_unduhan) }} unduhan
                                </span>
                            </div>

                            {{-- Download Button --}}
                            @if ($kdk->file_pdf)
                                <a href="{{ route('kdk.download', $kdk->id) }}"
                                   class="inline-flex items-center gap-2 bg-primary-500 text-white px-6 py-3 text-sm font-bold hover:bg-primary-600 transition-colors w-fit">
                                    <i class="fa-solid fa-file-pdf"></i> Unduh PDF
                                </a>
                            @else
                                <span class="inline-flex items-center gap-2 bg-neutral-100 text-neutral-400 px-6 py-3 text-sm font-semibold cursor-not-allowed w-fit">
                                    <i class="fa-solid fa-clock"></i> PDF Belum Tersedia
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Share --}}
                    <div class="pt-6 border-t border-gray-200" x-data="{ copied: false }">
                        <p class="text-base font-bold uppercase text-gray-500 mb-3">Bagikan</p>
                        <div class="flex flex-wrap gap-3">
                            <button @click="navigator.clipboard.writeText('{{ route('kdk.detail', $kdk->id) }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="flex items-center gap-2 px-4 py-2.5 border border-gray-300 text-gray-600 hover:border-primary hover:text-primary transition text-sm font-semibold">
                                <i class="fas" :class="copied ? 'fa-check' : 'fa-link'"></i>
                                <span x-text="copied ? 'Tersalin!' : 'Salin URL'"></span>
                            </button>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('kdk.detail', $kdk->id)) }}&text={{ urlencode($kdk->judul) }}" target="_blank"
                               class="flex items-center gap-2 px-4 py-2.5 bg-black text-white hover:bg-gray-800 transition text-sm font-semibold">
                                <i class="fab fa-x-twitter"></i> Post
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('kdk.detail', $kdk->id)) }}" target="_blank"
                               class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white hover:bg-blue-700 transition text-sm font-semibold">
                                <i class="fab fa-facebook-f"></i> Share
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div>
                    <div class="bg-gray-50 p-6 mb-6">
                        <h4 class="font-bold uppercase text-base mb-4 pb-3 border-b-2 border-primary">Cari Buletin</h4>
                        <form method="GET" action="{{ route('kdk') }}">
                            <div class="relative">
                                <input type="text" name="cari" placeholder="Cari buletin..." class="w-full border border-gray-300 p-3 pr-12 text-base focus:border-primary focus:outline-none transition no-round">
                                <button type="submit" class="absolute right-0 top-0 h-full px-4 text-gray-400 hover:text-primary transition">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-50 p-6 mb-6">
                        <h4 class="font-bold uppercase text-base mb-4 pb-3 border-b-2 border-primary">Edisi Lainnya</h4>
                        @forelse ($kdkLainnya as $kl)
                            <a href="{{ route('kdk.detail', $kl->id) }}" class="flex gap-3 py-3 border-b border-gray-200 hover:bg-white transition block">
                                @if ($kl->media && $kl->media->file_path)
                                    <img src="{{ asset('storage/' . $kl->media->file_path) }}" class="w-16 h-20 object-cover shrink-0" alt="{{ $kl->judul }}">
                                @else
                                    <div class="w-16 h-20 bg-neutral-200 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-book text-neutral-400"></i>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-xs text-primary-500 font-bold">Edisi {{ $kl->nomor_edisi }}</p>
                                    <h5 class="text-sm font-bold line-clamp-2">{{ $kl->judul }}</h5>
                                    <p class="text-xs text-gray-400 mt-1">{{ $kl->tanggal_terbit?->translatedFormat('d M Y') }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-base text-gray-400">Belum ada edisi lainnya.</p>
                        @endforelse
                    </div>
                    <a href="{{ route('kdk') }}" class="bg-dark text-white p-5 block hover:bg-primary transition text-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span class="font-bold text-base uppercase">Semua Edisi KDK</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
