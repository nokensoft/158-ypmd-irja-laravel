@extends('layouts.visitor')
@section('title', ($situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan'))
@section('seo-title', ($situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan'))
@section('seo-description', ($situs['seo_meta_description'] ?? 'Website resmi KONI Provinsi Papua Pegunungan'))

@section('content')

    <!-- Hero Slider -->
    <section x-data="heroSlider" class="relative h-[100vh] flex items-center bg-dark overflow-hidden">
        {{-- Background Slides --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div class="hero-slide absolute inset-0" :class="{ 'active': current === index }">
                <img :src="'{{ asset('') }}' + slide" class="hero-slide-img w-full h-full object-cover opacity-50" alt="Hero Background">
            </div>
        </template>

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-dark via-dark/70 to-transparent z-[1]"></div>

        {{-- Content --}}
        <div class="container mx-auto px-4 relative z-10 text-white">
            <p class="text-primary font-bold uppercase tracking-widest mb-4 text-base">Komite Olahraga Nasional Indonesia</p>
            <h2 class="text-4xl lg:text-6xl font-extrabold mb-4 uppercase leading-tight">Membangun Prestasi <br><span class="text-primary">Di Papua Pegunungan</span></h2>
            <p class="max-w-xl mb-8 text-gray-300 leading-relaxed text-lg">{{ $situs['deskripsi_situs'] ?? 'Berkomitmen memajukan atlet daerah Papua Pegunungan menuju pentas nasional dan internasional melalui pembinaan olahraga yang profesional.' }}</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('tentang') }}" class="bg-primary px-8 py-4 font-bold no-round hover:bg-red-700 transition inline-block text-lg">Profil Organisasi</a>
                <a href="{{ route('event') }}" class="border border-white px-8 py-4 font-bold no-round hover:bg-white hover:text-dark transition inline-block text-lg">Event Mendatang</a>
            </div>
        </div>

        {{-- Slide Indicators --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex gap-3">
            <template x-for="(slide, index) in slides" :key="'ind-' + index">
                <button @click="goTo(index)" class="hero-indicator" :class="{ 'active': current === index }"></button>
            </template>
        </div>
    </section>




    <!-- Berita & Event Preview -->
    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Berita -->
                <div class="lg:col-span-2">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-2xl font-extrabold flex items-center">
                            <span class="w-8 h-1 bg-primary mr-3"></span> Berita Terkini
                        </h3>
                        <a href="{{ route('berita') }}" class="text-primary text-base font-bold uppercase hover:underline">Semua <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="space-y-6">
                        @forelse ($beritaTerbaru as $b)
                            <a href="{{ route('berita.detail', $b->slug) }}" class="flex flex-col md:flex-row gap-6 bg-white shadow-md hover:shadow-lg transition block">
                                <img src="{{ $b->gambar }}" class="md:w-60 h-44 object-cover" alt="{{ $b->judul }}">
                                <div class="p-5 flex flex-col justify-center">
                                    <span class="text-sm text-primary font-bold uppercase">{{ $b->kategori?->nama ?? '-' }}</span>
                                    <h4 class="text-lg font-bold mt-1 mb-2">{{ $b->judul }}</h4>
                                    <p class="mt-3 text-sm text-gray-400"><i class="far fa-calendar-alt mr-1"></i> {{ $b->tanggal_terbit?->translatedFormat('d M Y') }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-400 text-center py-8">Belum ada berita.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Event Sidebar -->
                <div>
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-2xl font-extrabold flex items-center">
                            <span class="w-8 h-1 bg-primary mr-3"></span> Event
                        </h3>
                        <a href="{{ route('event') }}" class="text-primary text-base font-bold uppercase hover:underline">Semua <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="space-y-4">
                        @forelse ($kegiatanMendatang as $evt)
                            <a href="{{ route('event') }}" class="bg-dark text-white p-5 border-l-4 border-primary block hover:border-white transition">
                                <p class="text-primary font-bold text-sm uppercase tracking-wide">{{ $evt->tanggal_mulai->translatedFormat('M Y') }}</p>
                                <h5 class="font-bold mt-1 text-lg">{{ $evt->judul }}</h5>
                                <p class="text-sm text-gray-400 mt-2"><i class="fas fa-map-marker-alt mr-1"></i> {{ $evt->lokasi }}</p>
                            </a>
                        @empty
                            <p class="text-gray-400 text-center py-8">Belum ada event.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- <!-- Tentang Preview -->
    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Tentang Kami</p>
                    <h3 class="text-3xl font-extrabold mb-6 leading-tight">KONI Provinsi<br>Papua Pegunungan</h3>
                    <p class="text-gray-600 leading-relaxed mb-4 text-lg">Komite Olahraga Nasional Indonesia (KONI) Provinsi Papua Pegunungan merupakan organisasi yang mengoordinasikan dan membina olahraga prestasi di wilayah Papua Pegunungan.</p>
                    <p class="text-gray-600 leading-relaxed mb-8 text-lg">Berdiri sebagai wadah pemersatu seluruh cabang olahraga, KONI Papua Pegunungan berperan aktif dalam mencetak atlet-atlet berprestasi dari Tanah Papua.</p>
                    <a href="{{ route('tentang') }}" class="bg-primary text-white px-8 py-4 font-bold no-round hover:bg-red-700 transition inline-block text-base uppercase tracking-wide">Selengkapnya <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
                <div class="relative">
                    <img src="{{ asset('img/bg/gubernur-papua-pegunungan.png') }}" alt="Tentang KONI" class="w-full shadow-lg">
                    <div class="absolute -bottom-6 -left-6 bg-primary text-white p-6 shadow-lg hidden lg:block">
                        <p class="text-3xl font-extrabold">2022</p>
                        <p class="text-base uppercase tracking-wide">Tahun Berdiri</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Pencapaian Sejarah: PON XXI 2024 -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Pencapaian Sejarah</p>
                <h3 class="text-3xl font-extrabold">PON XXI Aceh-Sumut 2024</h3>
                <p class="text-gray-500 mt-3 text-lg max-w-2xl mx-auto">Partisipasi pertama Papua Pegunungan dengan masa persiapan hanya satu tahun.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 shadow-sm border-t-4 border-primary text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Peringkat Nasional</p>
                    <p class="text-5xl font-extrabold text-primary">23</p>
                    <p class="text-gray-500 text-base mt-2">Nasional</p>
                </div>
                <div class="bg-white p-8 shadow-sm border-t-4 border-primary text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Medali Emas</p>
                    <p class="text-5xl font-extrabold text-yellow-500">6</p>
                    <p class="text-gray-500 text-base mt-2">Medali Emas</p>
                </div>
                <div class="bg-white p-8 shadow-sm border-t-4 border-primary text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Medali Perunggu</p>
                    <p class="text-5xl font-extrabold text-orange-400">3</p>
                    <p class="text-gray-500 text-base mt-2">Medali Perunggu</p>
                </div>
            </div>

            <div class="mt-10">
                <h4 class="text-xl font-extrabold uppercase tracking-wide mb-5 text-center">Cabang Olahraga Unggulan (Peraih Emas)</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach (['Terbang Layang', 'Catur', 'Biliar', 'Sepak Bola', 'Dayung'] as $cabor)
                        <div class="bg-white border border-gray-200 p-4 text-center shadow-sm">
                            <p class="font-bold text-base text-dark">{{ $cabor }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Preview -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between items-end mb-12">
                <div>
                    <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Dokumentasi</p>
                    <h3 class="text-3xl font-extrabold">Galeri Kegiatan</h3>
                </div>
                <a href="{{ route('galeri') }}" class="text-primary font-bold uppercase text-base hover:underline">Lihat Semua <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($galeriTerbaru as $g)
                    @php $cover = $g->media->first(); @endphp
                    @if ($cover)
                        <a href="{{ route('galeri') }}" class="relative group overflow-hidden block">
                            <img src="{{ asset('storage/' . $cover->file_path) }}" class="w-full h-75 object-cover group-hover:scale-110 transition duration-500" alt="{{ $g->judul }}">
                            <div class="absolute inset-0 bg-dark/0 group-hover:bg-dark/50 transition flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-xl opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                        </a>
                    @endif
                @endforeach
                <a href="{{ route('galeri') }}" class="relative group overflow-hidden bg-primary flex items-center justify-center h-75 text-white block">
                    <div class="text-center">
                        <i class="fas fa-images text-3xl mb-2"></i>
                        <p class="font-bold uppercase text-base">Lihat Galeri</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection
