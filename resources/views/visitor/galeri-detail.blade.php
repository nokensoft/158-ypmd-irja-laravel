@extends('layouts.visitor')
@section('title', $galeri->judul . ' - Galeri - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-title', $galeri->judul . ' - Galeri Foto')
@section('seo-description', $galeri->deskripsi ?: 'Album galeri foto ' . $galeri->judul)
@if ($galeri->media->first())
    @section('seo-image', asset('storage/' . $galeri->media->first()->file_path))
@endif

@section('content')
    @include('partials.page-banner', [
        'title' => $galeri->judul,
        'breadcrumb' => '<a href="' . route('galeri') . '" class="hover:text-white transition">Galeri</a> / ' . $galeri->judul
    ])

    <section class="py-20 bg-white" x-data="galeriLightbox()">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="mb-10">
                <a href="{{ route('galeri') }}" class="inline-flex items-center text-primary hover:text-primary/80 font-semibold mb-4 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Galeri
                </a>
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <h3 class="text-3xl font-extrabold text-dark">{{ $galeri->judul }}</h3>
                    <span class="bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full">{{ $galeri->kategori }}</span>
                </div>
                <p class="text-gray-400 text-sm my-2">
                    <i class="fas fa-image mr-1"></i>{{ $galeri->media->count() }} Foto
                    <span class="mx-2">&middot;</span>
                    <i class="far fa-calendar-alt mr-1"></i>{{ $galeri->created_at->translatedFormat('d F Y') }}
                </p>
                @if ($galeri->deskripsi)
                    <p class="text-gray-500">{{ $galeri->deskripsi }}</p>
                @endif
            </div>

            <!-- Photo Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse ($galeri->media as $index => $m)
                    <div @click="open({{ $index }})"
                         class="relative group overflow-hidden rounded-lg cursor-pointer">
                        <img src="{{ asset('storage/' . $m->file_path) }}"
                             class="w-full h-52 object-cover group-hover:scale-110 transition duration-500"
                             alt="{{ $galeri->judul }} - Foto {{ $index + 1 }}">
                        <div class="absolute inset-0 bg-dark/0 group-hover:bg-dark/50 transition flex items-center justify-center">
                            <i class="fas fa-search-plus text-white text-xl opacity-0 group-hover:opacity-100 transition"></i>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-400">
                        <i class="fas fa-image text-5xl mb-4 block"></i>
                        <p class="text-lg">Belum ada foto di album ini.</p>
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

            <!-- Image -->
            <div class="max-w-5xl w-full text-center px-16" @click.self="close()">
                <img :src="images[currentIndex]" class="max-w-full max-h-[80vh] mx-auto shadow-2xl rounded" :alt="caption">
                <p class="text-white/80 mt-4 text-sm font-medium" x-text="caption + ' — Foto ' + (currentIndex + 1)"></p>
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
                images: @js($galeri->media->map(fn ($m) => asset('storage/' . $m->file_path))->values()),
                open(index) {
                    this.currentIndex = index;
                    this.isOpen = true;
                },
                close() {
                    this.isOpen = false;
                },
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                }
            }
        }
    </script>
@endsection
