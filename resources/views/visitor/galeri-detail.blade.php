@extends('layouts.visitor')
@section('title', $galeri->judul . ' - Galeri - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-title', $galeri->judul . ' - Galeri Foto')
@section('seo-description', $galeri->deskripsi ?: 'Album galeri foto ' . $galeri->judul)
@if ($galeri->media->first())
    @section('seo-image', $galeri->media->first()->tipe === 'video' ? 'https://img.youtube.com/vi/' . $galeri->media->first()->file_name . '/hqdefault.jpg' : asset('storage/' . $galeri->media->first()->file_path))
@endif

@section('json-ld')
@php
$_bc = ['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[
    ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],
    ['@type'=>'ListItem','position'=>2,'name'=>'Galeri','item'=>route('galeri')],
    ['@type'=>'ListItem','position'=>3,'name'=>$galeri->judul],
]];
$_images = $galeri->media->where('tipe', 'foto')->map(fn ($m) => [
    '@type' => 'ImageObject',
    'contentUrl' => asset('storage/' . $m->file_path),
    'name' => $galeri->judul . ' - Foto',
])->values()->toArray();
$_ig = [
    '@context' => 'https://schema.org',
    '@type' => 'ImageGallery',
    'name' => $galeri->judul,
    'description' => $galeri->deskripsi ?? 'Album galeri foto ' . $galeri->judul,
    'url' => route('galeri.detail', $galeri->slug),
    'numberOfItems' => $galeri->media->count(),
    'inLanguage' => 'id-ID',
    'creator' => ['@type' => 'Organization', 'name' => $situs['nama_situs'] ?? 'YPMD-IRJA'],
    'dateCreated' => $galeri->created_at?->toW3cString(),
    'dateModified' => $galeri->updated_at?->toW3cString(),
];
if (count($_images)) {
    $_ig['image'] = $_images;
}
$_f = JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE;
@endphp
<script type="application/ld+json">{!! json_encode($_bc, $_f) !!}</script>
<script type="application/ld+json">{!! json_encode($_ig, $_f) !!}</script>
@endsection

@section('content')
    @include('partials.section-header', [
        'headerTitle' => $galeri->judul,
        'headerBreadcrumb' => ' › <a href="' . route('galeri') . '" class="hover:text-white">Galeri</a> › ' . e($galeri->judul),
    ])

    <section class="py-20 bg-white" x-data="galeriLightbox()" itemscope itemtype="https://schema.org/ImageGallery">
        <meta itemprop="name" content="{{ $galeri->judul }}">
        <meta itemprop="numberOfItems" content="{{ $galeri->media->count() }}">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-10">
                <a href="{{ route('galeri') }}" class="inline-flex items-center text-primary hover:text-primary/80 font-semibold mb-4 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Galeri
                </a>
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <h3 class="text-3xl font-extrabold text-dark">{{ $galeri->judul }}</h3>
                    <span class="bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full">{{ $galeri->kategori }}</span>
                </div>
                @php
                    $fotoCount = $galeri->media->where('tipe', 'foto')->count();
                    $videoCount = $galeri->media->where('tipe', 'video')->count();
                @endphp
                <p class="text-gray-400 text-sm my-2">
                    @if ($fotoCount > 0)
                        <i class="fas fa-image mr-1"></i>{{ $fotoCount }} Foto
                    @endif
                    @if ($fotoCount > 0 && $videoCount > 0)
                        <span class="mx-1">&middot;</span>
                    @endif
                    @if ($videoCount > 0)
                        <i class="fab fa-youtube mr-1"></i>{{ $videoCount }} Video
                    @endif
                </p>
                @if ($galeri->deskripsi)
                    <p class="text-gray-500">{{ $galeri->deskripsi }}</p>
                @endif
            </div>

            <!-- Media Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse ($galeri->media as $index => $m)
                    @if ($m->tipe === 'video')
                        <div @click="open({{ $index }})"
                             class="relative group overflow-hidden rounded-lg cursor-pointer">
                    <img src="https://img.youtube.com/vi/{{ $m->file_name }}/hqdefault.jpg"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                 alt="{{ $galeri->judul }} - Video {{ $index + 1 }}">
                            <div class="absolute inset-0 bg-dark/0 group-hover:bg-dark/50 transition flex items-center justify-center">
                                <span class="bg-red-600/90 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                                    <i class="fas fa-play text-lg ml-0.5"></i>
                                </span>
                            </div>
                            <span class="absolute bottom-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded">
                                <i class="fab fa-youtube mr-1"></i>Video
                            </span>
                        </div>
                    @else
                        <div @click="open({{ $index }})"
                             class="relative group overflow-hidden rounded-lg cursor-pointer">
                    <img src="{{ asset('storage/' . $m->file_path) }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                 alt="{{ $galeri->judul }} - Foto {{ $index + 1 }}" itemprop="image">
                            <div class="absolute inset-0 bg-dark/0 group-hover:bg-dark/50 transition flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-xl opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-span-full text-center py-16 text-gray-400">
                        <i class="fas fa-image text-5xl mb-4 block"></i>
                        <p class="text-lg">Belum ada media di album ini.</p>
                    </div>
                @endforelse
            </div>
            

            <!-- Share Buttons -->
            <div class="mt-8 flex flex-wrap gap-3" x-data="{ copied: false }">
                <button @click="navigator.clipboard.writeText('{{ route('galeri.detail', $galeri->slug) }}'); copied = true; setTimeout(() => copied = false, 2000)"
                        class="flex items-center gap-2 px-4 py-2.5 border border-gray-300 text-gray-600 hover:border-primary hover:text-primary transition text-sm font-semibold rounded-lg">
                    <i class="fas" :class="copied ? 'fa-check' : 'fa-link'"></i>
                    <span x-text="copied ? 'Tersalin!' : 'Salin URL'"></span>
                </button>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('galeri.detail', $galeri->slug)) }}&text={{ urlencode($galeri->judul) }}" target="_blank"
                   class="flex items-center gap-2 px-4 py-2.5 bg-black text-white hover:bg-gray-800 transition text-sm font-semibold rounded-lg">
                    <i class="fab fa-x-twitter"></i> Post
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('galeri.detail', $galeri->slug)) }}" target="_blank"
                   class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white hover:bg-blue-700 transition text-sm font-semibold rounded-lg">
                    <i class="fab fa-facebook-f"></i> Share
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('galeri.detail', $galeri->slug)) }}" target="_blank"
                   class="flex items-center gap-2 px-4 py-2.5 bg-sky-700 text-white hover:bg-sky-800 transition text-sm font-semibold rounded-lg">
                    <i class="fab fa-linkedin-in"></i> LinkedIn
                </a>
            </div>

        </div>

        <!-- Lightbox with Navigation -->
        <div x-show="isOpen" x-transition.opacity x-cloak
             class="fixed inset-0 bg-black/95 z-50 flex items-center justify-center"
             @keydown.escape.window="close()" @keydown.left.window="prev()" @keydown.right.window="next()">

            <button @click="close()" class="absolute top-6 right-6 text-white/70 hover:text-white text-3xl transition z-10">
                <i class="fas fa-times"></i>
            </button>

            <!-- Counter -->
            <div class="absolute top-6 left-6 text-white/70 text-sm font-medium">
                <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
            </div>

            <!-- Prev -->
            <button @click="prev()" x-show="images.length > 1"
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white text-3xl transition z-10">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Content -->
            <div class="max-w-5xl w-full text-center px-16" @click.self="close()">
                <template x-if="items[currentIndex] && items[currentIndex].type === 'video'">
                    <div>
                        <div class="aspect-video max-w-4xl mx-auto">
                            <iframe :src="isOpen ? 'https://www.youtube.com/embed/' + items[currentIndex].ytId + '?autoplay=1' : ''" class="w-full h-full rounded shadow-2xl" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                        <p class="text-white/80 mt-4 text-sm font-medium" x-text="caption + ' — Video ' + (currentIndex + 1)"></p>
                    </div>
                </template>
                <template x-if="!items[currentIndex] || items[currentIndex].type === 'foto'">
                    <div>
                        <img :src="items[currentIndex] ? items[currentIndex].src : ''" class="max-w-full max-h-[80vh] mx-auto shadow-2xl rounded" :alt="caption">
                        <p class="text-white/80 mt-4 text-sm font-medium" x-text="caption + ' — Foto ' + (currentIndex + 1)"></p>
                    </div>
                </template>
            </div>

            <!-- Next -->
            <button @click="next()" x-show="images.length > 1"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white text-3xl transition z-10">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </section>

    <script>
        function galeriLightbox() {
            return {
                isOpen: false,
                currentIndex: 0,
                caption: @js($galeri->judul),
                items: @js($galeri->media->map(fn ($m) => [
                    'type' => $m->tipe,
                    'src' => $m->tipe === 'video' ? 'https://img.youtube.com/vi/' . $m->file_name . '/hqdefault.jpg' : asset('storage/' . $m->file_path),
                    'ytId' => $m->tipe === 'video' ? $m->file_name : null,
                ])->values()),
                open(index) {
                    this.currentIndex = index;
                    this.isOpen = true;
                },
                close() {
                    this.isOpen = false;
                },
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.items.length;
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
                }
            }
        }
    </script>
@endsection
