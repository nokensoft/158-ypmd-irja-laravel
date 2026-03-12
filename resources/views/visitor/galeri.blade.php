@extends('layouts.visitor')
@section('title', 'Galeri - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Galeri Foto - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-description', 'Dokumentasi kegiatan dan galeri foto ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Galeri']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Galeri</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Galeri Kegiatan</h1>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-10 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-images mr-2"></i>Dokumentasi</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Album Galeri</h2>
            </div>

            {{-- Category Filter --}}
            <div class="flex flex-wrap gap-2 mb-10">
                <a href="{{ route('galeri') }}"
                   class="px-4 py-1.5 text-xs font-semibold border transition {{ is_null($kategoriAktif) ? 'bg-primary-500 text-white border-primary-500' : 'border-neutral-300 text-neutral-600 hover:border-primary-400 hover:text-primary-600' }}">
                    Semua
                </a>
                @foreach (\App\Models\Galeri::KATEGORI_LIST as $kat)
                    <a href="{{ route('galeri', ['kategori' => $kat]) }}"
                       class="px-4 py-1.5 text-xs font-semibold border transition {{ $kategoriAktif === $kat ? 'bg-primary-500 text-white border-primary-500' : 'border-neutral-300 text-neutral-600 hover:border-primary-400 hover:text-primary-600' }}">
                        {{ $kat }}
                    </a>
                @endforeach
            </div>

            {{-- Album Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($galeriList as $album)
                    @php
                        $cover = $album->media->first();
$coverUrl = $cover ? asset('storage/' . $cover->file_path) : asset('img/galeri/ypmd-irja-ulang-tahun-38-jubi.jpg');
                    @endphp
                    <a href="{{ route('galeri.detail', $album->slug) }}"
                       class="group bg-white shadow-card card-hover border border-neutral-100 overflow-hidden">
                        <div class="relative overflow-hidden">
                            <img src="{{ $coverUrl }}" alt="{{ $album->judul }}"
                                 class="w-full h-52 object-cover group-hover:scale-105 transition duration-300">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition flex items-center justify-center">
                                <i class="fa-solid fa-images text-white text-2xl opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                            <span class="absolute top-3 left-3 bg-primary-500/90 text-white text-xs font-bold px-2 py-0.5">
                                {{ $album->kategori }}
                            </span>
                            <span class="absolute top-3 right-3 bg-black/60 text-white text-xs font-bold px-2 py-0.5">
                                <i class="fa-solid fa-image mr-1"></i>{{ $album->media_count }}
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-display font-bold text-neutral-900 group-hover:text-primary-600 transition line-clamp-2">{{ $album->judul }}</h4>
                            @if ($album->deskripsi)
                                <p class="text-neutral-500 text-sm mt-1 line-clamp-2">{{ $album->deskripsi }}</p>
                            @endif
                            <p class="text-neutral-400 text-xs mt-2">
                                <i class="fa-regular fa-calendar-alt mr-1"></i>{{ $album->created_at->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16 text-neutral-400">
                        <i class="fa-solid fa-images text-5xl mb-4 block"></i>
                        <p class="text-lg">Belum ada album di galeri.</p>
                    </div>
                @endforelse
            </div>

            @if ($galeriList->hasPages())
                <div class="mt-10">{{ $galeriList->links() }}</div>
            @endif
        </div>
    </section>
@endsection
