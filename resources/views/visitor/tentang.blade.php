@extends('layouts.visitor')
@section('title', 'Tentang Kami - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-title', 'Tentang Kami - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-description', 'Profil organisasi, visi dan misi ' . ($situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan'))

@section('content')
    @include('partials.page-banner', ['title' => 'Tentang Kami', 'breadcrumb' => 'Tentang'])

    <!-- Profil -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Profil Organisasi</p>
                    <h3 class="text-3xl font-extrabold mb-6">KONI Provinsi Papua Pegunungan</h3>
                    <p class="text-gray-600 leading-relaxed mb-4 text-lg">Komite Olahraga Nasional Indonesia (KONI) Provinsi Papua Pegunungan adalah organisasi olahraga yang bertugas mengoordinasikan, membina, dan mengembangkan olahraga prestasi di wilayah Provinsi Papua Pegunungan.</p>
                    <p class="text-gray-600 leading-relaxed mb-4 text-lg">Sebagai provinsi yang baru terbentuk berdasarkan Undang-Undang Otonomi Khusus Papua, KONI Papua Pegunungan memiliki peran strategis dalam mengangkat potensi atlet-atlet daerah.</p>
                    <p class="text-gray-600 leading-relaxed text-lg">Dengan semangat "Membangun Prestasi di Puncak Papua", KONI Papua Pegunungan bertekad menjadi wadah profesional yang mencetak atlet berprestasi.</p>
                </div>
                <div class="relative">
                    <img src="{{ asset('img/bg/pelantikan-koni-papua-pegunungan.png') }}" alt="Profil KONI" class="w-full shadow-lg">
                    <div class="absolute -bottom-6 -right-6 bg-primary text-white p-8 shadow-lg hidden lg:block">
                        <p class="text-4xl font-extrabold">2022</p>
                        <p class="text-base uppercase tracking-wide mt-1">Tahun Berdiri</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Arah Kebijakan</p>
                <h3 class="text-3xl font-extrabold">Visi & Misi</h3>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="bg-dark text-white p-10 shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-primary flex items-center justify-center mr-4"><i class="fas fa-eye text-xl"></i></div>
                        <h4 class="text-2xl font-extrabold uppercase">Visi</h4>
                    </div>
                    <p class="text-gray-300 leading-relaxed text-xl">"Menjadikan Provinsi Papua Pegunungan sebagai pusat pembinaan olahraga prestasi yang unggul, berdaya saing, dan bermartabat di Indonesia."</p>
                </div>
                <div class="bg-white p-10 shadow-lg border-t-4 border-primary">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-primary text-white flex items-center justify-center mr-4"><i class="fas fa-bullseye text-xl"></i></div>
                        <h4 class="text-2xl font-extrabold uppercase">Misi</h4>
                    </div>
                    <ul class="space-y-4">
                        @foreach ([
                            'Menyelenggarakan pembinaan dan pengembangan olahraga prestasi secara sistematis dan berkelanjutan.',
                            'Meningkatkan kualitas atlet, pelatih, dan tenaga keolahragaan di Papua Pegunungan.',
                            'Membangun infrastruktur olahraga yang memadai dan berstandar nasional.',
                            'Menjalin kerjasama strategis dengan pemerintah, swasta, dan organisasi olahraga lainnya.',
                            'Mengoptimalkan potensi olahraga unggulan daerah untuk berkompetisi di tingkat nasional dan internasional.',
                        ] as $i => $misi)
                            <li class="flex items-start">
                                <span class="w-7 h-7 bg-primary text-white flex items-center justify-center text-sm font-bold mr-3 mt-0.5 shrink-0">{{ $i + 1 }}</span>
                                <span class="text-gray-600 text-lg">{{ $misi }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
