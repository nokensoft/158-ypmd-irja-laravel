@extends('layouts.visitor')
@section('title', ($kategoriAktif ? $kategoriAktif->nama . ' - Berita' : 'Berita') . ' - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-title', ($kategoriAktif ? 'Berita ' . $kategoriAktif->nama : 'Berita & Artikel') . ' - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-description', ($kategoriAktif ? 'Berita kategori ' . $kategoriAktif->nama : 'Kumpulan berita dan artikel terbaru') . ' dari ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))

@section('content')
    @include('partials.page-banner', [
        'title' => $kategoriAktif ? 'Berita: ' . $kategoriAktif->nama : 'Berita & Artikel',
        'breadcrumb' => $kategoriAktif ? $kategoriAktif->nama : 'Berita',
    ])

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                {{-- Main Content --}}
                <div class="lg:col-span-3">
                    <h3 class="text-2xl font-extrabold mb-8 flex items-center">
                        <span class="w-8 h-1 bg-primary mr-3"></span>
                        {{ $kategoriAktif ? 'Berita: ' . $kategoriAktif->nama : 'Semua Berita' }}
                    </h3>
                    @if (request('cari'))
                        <div class="mb-6 flex items-center gap-3 text-base text-gray-500">
                            <span>Hasil pencarian: <strong class="text-dark">"{{ request('cari') }}"</strong></span>
                            <a href="{{ $kategoriAktif ? route('berita.kategori', $kategoriAktif->slug) : route('berita') }}" class="text-primary hover:underline text-sm"><i class="fas fa-times mr-1"></i>Hapus</a>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($beritaList as $b)
                            <a href="{{ route('berita.detail', $b->slug) }}" class="bg-white shadow-sm hover:shadow-lg transition block">
                                <img src="{{ $b->gambar }}" class="w-full h-52 object-cover" alt="{{ $b->judul }}">
                                <div class="p-5">
                                    <span class="text-sm text-primary font-bold uppercase">{{ $b->kategori?->nama ?? '-' }}</span>
                                    <h4 class="font-bold mt-1 mb-2 line-clamp-2 text-base">{{ $b->judul }}</h4>
                                    <p class="text-sm text-gray-400"><i class="far fa-calendar-alt mr-1"></i> {{ $b->tanggal_terbit?->translatedFormat('d M Y') }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-12 text-gray-400">
                                <i class="fas fa-newspaper text-4xl mb-3 block"></i>
                                <p>Belum ada berita.</p>
                            </div>
                        @endforelse
                    </div>
                    @if ($beritaList->hasPages())
                        <div class="mt-8">{{ $beritaList->links() }}</div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div>
                    <div class="bg-gray-50 p-6 mb-6">
                        <h4 class="font-bold uppercase text-base mb-4 pb-3 border-b-2 border-primary">Cari Berita</h4>
                        <form method="GET" action="{{ $kategoriAktif ? route('berita.kategori', $kategoriAktif->slug) : route('berita') }}">
                            <div class="relative">
                                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari berita..." class="w-full border border-gray-300 p-3 pr-12 text-base focus:border-primary focus:outline-none transition no-round">
                                <button type="submit" class="absolute right-0 top-0 h-full px-4 text-gray-400 hover:text-primary transition">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="bg-gray-50 p-6 mb-6">
                        <h4 class="font-bold uppercase text-base mb-4 pb-3 border-b-2 border-primary">Kategori</h4>
                        <ul class="space-y-2">
                            @foreach ($kategoriList as $kat)
                                @if ($kat->slug)
                                    <li>
                                        <a href="{{ route('berita.kategori', $kat->slug) }}" class="flex justify-between items-center py-2 text-base hover:text-primary transition {{ $kategoriAktif && $kategoriAktif->id === $kat->id ? 'text-primary font-bold' : 'text-gray-600' }}">
                                            <span>{{ $kat->nama }}</span>
                                            <span class="bg-gray-200 text-gray-600 text-sm px-2 py-0.5 font-bold">{{ $kat->berita_count }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ route('berita') }}" class="bg-dark text-white p-5 block hover:bg-primary transition text-center {{ !$kategoriAktif ? 'bg-primary' : '' }}">
                        <span class="font-bold text-base uppercase">Semua Berita</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
