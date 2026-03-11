@extends('layouts.visitor')
@section('title', 'Program - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Program YPMD IRJA')
@section('seo-description', 'Program-program pemberdayaan masyarakat adat Papua yang dijalankan YPMD IRJA.')

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Program</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Program Kami</h1>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-12 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-list-check mr-2"></i>Bidang Kerja</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Program Unggulan</h2>
                <p class="text-neutral-500 text-lg mt-3 max-w-2xl">YPMD IRJA menjalankan berbagai program yang berakar pada kebutuhan nyata masyarakat adat Papua.</p>
            </div>
            <div class="space-y-16">

                <div class="grid md:grid-cols-2 gap-10 items-center fade-in">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-seedling text-primary-500"></i></div>
                            <span class="text-5xl font-display font-bold text-neutral-100">01</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-3">Ekonomi &amp; Ekspor Kakao Organik</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">Sejak 2010, YPMD IRJA memfasilitasi ekspor biji kakao organik dari petani di Lembah Grime, Kabupaten Jayapura, ke pasar Jepang melalui kemitraan dengan All To Japan (ATJ) dan Green Coop.</p>
                        <ul class="space-y-1.5">
                            @foreach (['Lebih dari 10 tahun ekspor ke Jepang','Kemitraan dengan ATJ & Green Coop','Pertanian organik berkelanjutan','Peningkatan pendapatan petani'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="h-64 bg-primary-50 rounded-lg shadow-card flex items-center justify-center">
                        <i class="fa-solid fa-seedling text-6xl text-primary-200"></i>
                    </div>
                </div>

                <hr class="border-neutral-100">

                <div class="grid md:grid-cols-2 gap-10 items-center fade-in">
                    <div class="md:order-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-accent-50 flex items-center justify-center"><i class="fa-solid fa-users text-accent-400"></i></div>
                            <span class="text-5xl font-display font-bold text-neutral-100">02</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-3">Pendampingan Masyarakat Adat</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">Program inti YPMD IRJA adalah mendampingi dan mengorganisir masyarakat adat Papua agar mampu mengadvokasi hak-hak mereka atas tanah ulayat dan sumber daya alam.</p>
                        <ul class="space-y-1.5">
                            @foreach (['Pendidikan hukum adat','Penguatan organisasi komunitas','Advokasi tanah ulayat','Jaringan advokasi nasional & internasional'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="h-64 bg-accent-50 rounded-lg shadow-card flex items-center justify-center md:order-1">
                        <i class="fa-solid fa-users text-6xl text-accent-200"></i>
                    </div>
                </div>

                <hr class="border-neutral-100">

                <div class="grid md:grid-cols-2 gap-10 items-center fade-in">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-piggy-bank text-primary-500"></i></div>
                            <span class="text-5xl font-display font-bold text-neutral-100">03</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-3">Keuangan Mikro — BPR Phidectama</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">Pada tahun 1992, YPMD IRJA mendirikan Bank Perkreditan Rakyat (BPR) Phidectama sebagai instrumen keuangan mikro untuk membangun kebiasaan menabung dan akses permodalan bagi masyarakat kampung.</p>
                        <ul class="space-y-1.5">
                            @foreach (['Berdiri sejak 1992','Akses modal untuk UMKM','Tabungan masyarakat kampung','Pendampingan keuangan'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="h-64 bg-primary-50 rounded-lg shadow-card flex items-center justify-center">
                        <i class="fa-solid fa-piggy-bank text-6xl text-primary-200"></i>
                    </div>
                </div>

                <hr class="border-neutral-100">

                <div class="grid md:grid-cols-2 gap-10 items-center fade-in">
                    <div class="md:order-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-newspaper text-primary-500"></i></div>
                            <span class="text-5xl font-display font-bold text-neutral-100">04</span>
                        </div>
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-3">Media &amp; Komunikasi Alternatif</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">Melalui buletin <em>Kabar Dari Kampung</em> (KDK) yang pertama kali terbit pada 1982, YPMD IRJA membangun media alternatif yang menyuarakan realita kehidupan masyarakat adat Papua.</p>
                        <ul class="space-y-1.5">
                            @foreach (['Buletin KDK sejak 1982','Dokumentasi gerakan masyarakat adat','Arsip digital Papua','Jurnalisme komunitas'] as $p)
                            <li class="flex items-start gap-2 text-sm text-neutral-600"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>{{ $p }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="h-64 bg-neutral-50 rounded-lg shadow-card flex items-center justify-center md:order-1">
                        <i class="fa-solid fa-newspaper text-6xl text-neutral-200"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
