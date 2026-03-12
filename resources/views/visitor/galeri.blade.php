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
            <span class="text-primary-200 text-xs uppercase tracking-widest">
                <a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a>
                &rsaquo;
                @if ($kategoriAktif)
                    <a href="{{ route('galeri') }}" class="hover:text-white">Galeri</a> &rsaquo; {{ $kategoriAktif }}
                @else
                    Galeri
                @endif
            </span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">
                {{ $kategoriAktif ? 'Galeri: ' . $kategoriAktif : 'Galeri Kegiatan' }}
            </h1>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                {{-- Main Content --}}
                <div class="lg:col-span-3">
                    @if (request('cari'))
                        <div class="mb-6 flex items-center gap-3 text-sm text-neutral-500">
                            <span>Hasil pencarian: <strong class="text-neutral-900">"{{ request('cari') }}"</strong></span>
                            <a href="{{ route('galeri', $kategoriAktif ? ['kategori' => $kategoriAktif] : []) }}" class="text-primary-600 hover:underline text-xs">
                                <i class="fa-solid fa-times mr-1"></i>Hapus
                            </a>
                        </div>
                    @endif

                    {{-- Album Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($galeriList as $album)
                            @php
                                $cover = $album->media->first();
                                if ($cover && $cover->tipe === 'video') {
                                    $coverUrl = 'https://img.youtube.com/vi/' . $cover->file_name . '/hqdefault.jpg';
                                } elseif ($cover) {
                                    $coverUrl = asset('storage/' . $cover->file_path);
                                } else {
                                    $coverUrl = asset('img/galeri/ypmd-irja-ulang-tahun-38-jubi.jpg');
                                }
                            @endphp
                            <a href="{{ route('galeri.detail', $album->slug) }}"
                               class="group bg-white shadow-card card-hover border border-neutral-100 overflow-hidden fade-in">
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
                        <div class="mt-8">{{ $galeriList->links() }}</div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    <div class="bg-neutral-50 p-6">
                        <h4 class="font-display font-bold text-sm uppercase mb-4 pb-3 border-b-2 border-primary-500">Cari Album</h4>
                        <form method="GET" action="{{ route('galeri') }}">
                            @if ($kategoriAktif)
                                <input type="hidden" name="kategori" value="{{ $kategoriAktif }}">
                            @endif
                            <div class="relative">
                                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari album galeri..."
                                       class="w-full border border-neutral-300 p-3 pr-10 text-sm focus:border-primary-400 focus:outline-none transition">
                                <button type="submit" class="absolute right-0 top-0 h-full px-3 text-neutral-400 hover:text-primary-500 transition">
                                    <i class="fa-solid fa-search text-sm"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="bg-neutral-50 p-6">
                        <h4 class="font-display font-bold text-sm uppercase mb-4 pb-3 border-b-2 border-primary-500">Kategori</h4>
                        <ul class="space-y-1">
                            @foreach ($kategoriListSidebar as $kat)
                                <li>
                                    <a href="{{ route('galeri', ['kategori' => $kat['nama']]) }}"
                                       class="flex justify-between items-center py-2 text-sm hover:text-primary-600 transition {{ $kategoriAktif === $kat['nama'] ? 'text-primary-600 font-semibold' : 'text-neutral-600' }}">
                                        <span>{{ $kat['nama'] }}</span>
                                        <span class="bg-neutral-200 text-neutral-600 text-xs px-2 py-0.5 font-bold">{{ $kat['jumlah'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ route('galeri') }}"
                       class="{{ !$kategoriAktif ? 'bg-primary-500' : 'bg-neutral-800' }} text-white p-4 block hover:bg-primary-600 transition text-center">
                        <span class="font-semibold text-sm uppercase">Semua Album</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
