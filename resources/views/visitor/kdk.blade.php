@extends('layouts.visitor')
@section('title', 'KDK - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Kabar Dari Kampung (KDK) — Buletin YPMD IRJA')
@section('seo-description', 'Arsip buletin Kabar Dari Kampung, media alternatif masyarakat adat Papua sejak 1982.')

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Kabar Dari Kampung']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › KDK</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Kabar Dari Kampung</h1>
            <p class="text-primary-200 mt-2 text-lg">Buletin — Media Alternatif Masyarakat Adat Papua</p>
        </div>
    </div>

    <section class="py-16 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white shadow-card p-8 md:p-12 mb-12 fade-in">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-book-open mr-2"></i>Tentang KDK</p>
                        <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-4">Apa itu KDK?</h2>
                        <p class="text-neutral-600 leading-relaxed mb-3"><em>Kabar Dari Kampung</em> (KDK) adalah buletin yang pertama kali diterbitkan pada tahun 1982 oleh kelompok idealis yang kemudian mendirikan YPMD IRJA. Buletin ini hadir sebagai media alternatif yang menyuarakan realita kehidupan masyarakat adat Papua.</p>
                        <p class="text-neutral-600 leading-relaxed">KDK mendokumentasikan berbagai isu penting: hak tanah adat, pengorganisasian komunitas, perkembangan program pemberdayaan, serta berbagai cerita dari kampung-kampung di seluruh Papua.</p>
                    </div>
            <div class="grid grid-cols-2 gap-4">
                        <div class="bg-neutral-50 rounded p-4 text-center shadow-sm">
                            <div class="text-2xl font-display font-bold text-primary-200">1982</div>
                            <div class="text-xs text-neutral-400 mt-1">Berdiri</div>
                        </div>
                        <div class="bg-neutral-50 rounded p-4 text-center shadow-sm">
                            <div class="text-2xl font-display font-bold text-primary-200">{{ $kdkList->total() }}+</div>
                            <div class="text-xs text-neutral-400 mt-1">Edisi Terbit</div>
                        </div>
                        <div class="bg-neutral-50 rounded p-4 text-center shadow-sm col-span-2">
                            <div class="text-sm font-semibold text-primary-400">Media Alternatif Masyarakat Adat Papua</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-10 fade-in">
                <h3 class="text-xl font-display font-bold text-neutral-900 mb-2">Arsip Edisi KDK</h3>
                <p class="text-neutral-500">Unduh edisi-edisi buletin Kabar Dari Kampung dalam format PDF.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($kdkList as $k)
                    <x-kdk-card :kdk="$k" />
                @empty
                    <div class="col-span-full text-center py-12 text-neutral-400">
                        <i class="fa-solid fa-book-open text-4xl mb-4 block"></i>
                        <p>Belum ada edisi KDK yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($kdkList->hasPages())
            <div class="mt-8">
                {{ $kdkList->links() }}
            </div>
            @endif
        </div>
    </section>
@endsection
