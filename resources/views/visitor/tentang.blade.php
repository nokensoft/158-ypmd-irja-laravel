@extends('layouts.visitor')
@section('title', 'Tentang Kami - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-title', 'Tentang YPMD-IRJA — Yayasan Pembangunan Masyarakat Desa Irian Jaya')
@section('seo-description', 'Profil, visi, misi, dan program YPMD-IRJA — LSM pertama di Tanah Papua yang berdiri sejak 1984.')

@section('content')

    @include('partials.section-header', [
        'headerTitle' => 'Tentang YPMD-IRJA',
        'headerSubtitle' => 'Mengenal lebih dekat Yayasan Pembangunan Masyarakat Desa Irian Jaya',
        'headerBreadcrumb' => ' › Tentang Kami',
    ])

    {{-- Intro --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="fade-in">
                    <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-leaf mr-2"></i>Sejak 1984</p>
                    <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-6">LSM Pertama di Tanah Papua</h2>
                    <p class="text-neutral-600 leading-relaxed mb-4">Yayasan Pembangunan Masyarakat Desa Irian Jaya (YPMD-IRJA) adalah lembaga swadaya masyarakat pertama yang berdiri di Tanah Papua. Lahir pada <strong>1984</strong> dari keresahan kelompok idealis Gereja dan Tokoh Masyarakat, YPMD-IRJA hadir sebagai jembatan informasi dan agen perubahan.</p>
                    <p class="text-neutral-600 leading-relaxed mb-6">Selama lebih dari empat dekade, lembaga ini mendampingi masyarakat desa di Irian Jaya / Papua sekarang agar mampu berdiri sebagai <em>subjek</em> — bukan objek — dalam proses pembangunan, serta mempertahankan hak-hak mereka atas tanah dan sumber daya alam.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('sejarah') }}" class="bg-primary-500 text-white px-5 py-2.5 text-sm font-semibold hover:bg-primary-600 transition-colors">
                            <i class="fa-solid fa-clock-rotate-left mr-2"></i>Baca Sejarah
                        </a>
                        <a href="{{ route('profil') }}" class="border border-neutral-300 text-neutral-700 px-5 py-2.5 text-sm font-semibold hover:border-primary-400 hover:text-primary-600 transition-colors">
                            <i class="fa-solid fa-building mr-2"></i>Profil Lembaga
                        </a>
                    </div>
                </div>
                <div class="fade-in">
                    <img src="{{ asset('img/galeri/Kantor YPMD-IRJA.png') }}" alt="Kantor YPMD-IRJA" class="w-full rounded-lg shadow-card object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <div class="border-t border-neutral-200 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center fade-in">
                <div class="text-3xl font-display font-bold text-primary-600">1984</div>
                <div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Tahun Berdiri</div>
            </div>
            <div class="text-center fade-in">
                <div class="text-3xl font-display font-bold text-primary-600">40+</div>
                <div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Tahun Berkarya</div>
            </div>
            <div class="text-center fade-in">
                <div class="text-3xl font-display font-bold text-accent-400">10+</div>
                <div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Tahun Ekspor Kakao</div>
            </div>
            <div class="text-center fade-in">
                <div class="text-3xl font-display font-bold text-accent-400">4</div>
                <div class="text-xs text-neutral-500 mt-1 uppercase tracking-wider">Wilayah Kerja</div>
            </div>
        </div>
    </div>

    {{-- Visi Misi --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-12 fade-in text-center">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-compass mr-2"></i>Arah Organisasi</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Visi &amp; Misi</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-primary-600 text-white p-10 fade-in">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 bg-white/20 flex items-center justify-center">
                            <i class="fa-solid fa-eye text-white"></i>
                        </div>
                        <h3 class="font-display font-bold text-xl">Visi</h3>
                    </div>
                    <p class="text-primary-100 leading-relaxed">Terwujudnya masyarakat desa di Irian Jaya / Papua sekarang yang mandiri, berdaulat, dan bermartabat dalam mengelola kehidupan dan sumber daya alamnya secara berkelanjutan.</p>
                </div>
                <div class="bg-neutral-50 border border-neutral-100 p-10 fade-in">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 bg-primary-50 flex items-center justify-center">
                            <i class="fa-solid fa-bullseye text-primary-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-xl text-neutral-900">Misi</h3>
                    </div>
                    <ul class="space-y-2 text-neutral-600">
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Mendampingi masyarakat desa di Irian Jaya / Papua sekarang sebagai subjek pembangunan</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Mengembangkan program ekonomi berbasis komunitas yang berkelanjutan</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Mengadvokasi hak-hak masyarakat desa di Irian Jaya / Papua sekarang atas tanah dan sumber daya alam</span></li>
                        <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Membangun jaringan kemitraan lokal, nasional, dan internasional</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Sub-halaman Navigation --}}
    <section class="py-16 bg-neutral-50 border-t border-neutral-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-10 text-center fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-sitemap mr-2"></i>Jelajahi Lebih Lanjut</p>
                <h2 class="text-2xl font-display font-bold text-neutral-900">Informasi Organisasi</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <a href="{{ route('sejarah') }}" class="bg-white shadow-card card-hover border border-neutral-100 p-6 fade-in group">
                    <div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-4 group-hover:bg-primary-500 transition-colors">
                        <i class="fa-solid fa-clock-rotate-left text-primary-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="font-display font-bold text-neutral-900 mb-1">Sejarah Singkat</h3>
                    <p class="text-neutral-500 text-sm">Perjalanan 40 tahun pengabdian YPMD-IRJA sejak 1984.</p>
                </a>
                <a href="{{ route('profil') }}" class="bg-white shadow-card card-hover border border-neutral-100 p-6 fade-in group">
                    <div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-4 group-hover:bg-primary-500 transition-colors">
                        <i class="fa-solid fa-building text-primary-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="font-display font-bold text-neutral-900 mb-1">Profil Lembaga</h3>
                    <p class="text-neutral-500 text-sm">Visi, misi, wilayah kerja, dan identitas organisasi.</p>
                </a>
                <a href="{{ route('tokoh') }}" class="bg-white shadow-card card-hover border border-neutral-100 p-6 fade-in group">
                    <div class="w-10 h-10 bg-primary-50 flex items-center justify-center mb-4 group-hover:bg-primary-500 transition-colors">
                        <i class="fa-solid fa-user-tie text-primary-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="font-display font-bold text-neutral-900 mb-1">Direktur</h3>
                    <p class="text-neutral-500 text-sm">Direktur YPMD-IRJA dari masa ke masa sejak 1984.</p>
                </a>
                <a href="{{ route('bidang-kerja') }}" class="bg-white shadow-card card-hover border border-neutral-100 p-6 fade-in group">
                    <div class="w-10 h-10 bg-accent-50 flex items-center justify-center mb-4 group-hover:bg-accent-400 transition-colors">
                        <i class="fa-solid fa-list-check text-accent-400 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="font-display font-bold text-neutral-900 mb-1">Bidang Kerja</h3>
                    <p class="text-neutral-500 text-sm">Struktur bidang kerja yang menopang program YPMD-IRJA.</p>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-primary-600 py-14">
        <div class="max-w-4xl mx-auto px-6 text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-3">Bersama Membangun Papua</h2>
            <p class="text-primary-200 text-lg mb-8">Dukung program pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang. Setiap kontribusi membantu mewujudkan kemandirian ekonomi dan keadilan sosial.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('donasi') }}" class="bg-white text-primary-600 px-8 py-3 text-sm font-semibold hover:bg-neutral-100 transition-colors shadow-card">
                    <i class="fa-solid fa-heart mr-2"></i>Donasi Sekarang
                </a>
                <a href="{{ route('kontak') }}" class="border border-white/40 text-white px-8 py-3 text-sm font-semibold hover:bg-white/10 transition-colors">
                    <i class="fa-solid fa-envelope mr-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
