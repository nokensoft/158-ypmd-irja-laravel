@extends('layouts.visitor')
@section('title', 'Galeri - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-title', 'Galeri Foto - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-description', 'Dokumentasi kegiatan dan galeri foto ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))

@section('content')
    @include('partials.page-banner', ['title' => 'Galeri', 'breadcrumb' => 'Galeri'])

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Dokumentasi</p>
                <h3 class="text-3xl font-extrabold">Album Galeri</h3>
            </div>

            <!-- Category Filter -->
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                <a href="{{ route('galeri') }}"
                   class="px-5 py-2 rounded-full text-sm font-semibold transition {{ is_null($kategoriAktif) ? 'bg-primary text-white shadow' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach (\App\Models\Galeri::KATEGORI_LIST as $kat)
                    <a href="{{ route('galeri', ['kategori' => $kat]) }}"
                       class="px-5 py-2 rounded-full text-sm font-semibold transition {{ $kategoriAktif === $kat ? 'bg-primary text-white shadow' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $kat }}
                    </a>
                @endforeach
            </div>

            <!-- Album Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($galeriList as $album)
                    @php
                        $cover = $album->media->first();
                        $coverUrl = $cover ? asset('storage/' . $cover->file_path) : asset('images/placeholder.jpg');
                    @endphp
                    <a href="{{ route('galeri.detail', $album->slug) }}"
                       class="group bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                        <div class="relative overflow-hidden">
                            <img src="{{ $coverUrl }}" alt="{{ $album->judul }}"
                                 class="w-full h-52 object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-dark/0 group-hover:bg-dark/40 transition flex items-center justify-center">
                                <i class="fas fa-images text-white text-2xl opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                            <span class="absolute top-3 left-3 bg-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full">
                                {{ $album->kategori }}
                            </span>
                            <span class="absolute top-3 right-3 bg-dark/70 text-white text-xs font-bold px-3 py-1 rounded-full">
                                <i class="fas fa-image mr-1"></i>{{ $album->media_count }} Foto
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-dark group-hover:text-primary transition line-clamp-2">{{ $album->judul }}</h4>
                            @if ($album->deskripsi)
                                <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $album->deskripsi }}</p>
                            @endif
                            <p class="text-gray-400 text-xs mt-2">
                                <i class="far fa-calendar-alt mr-1"></i>{{ $album->created_at->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-400">
                        <i class="fas fa-images text-5xl mb-4 block"></i>
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
