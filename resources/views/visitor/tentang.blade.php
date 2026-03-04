@extends('layouts.visitor')
@section('title', 'Tentang Kami - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-title', 'Tentang Kami - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-description', 'Profil KONI Provinsi Papua Pegunungan, data organisasi, capaian PON XXI 2024, dan target strategis menuju PON XXII 2028.')

@section('content')
    @include('partials.page-banner', ['title' => 'Tentang Kami', 'breadcrumb' => 'Tentang'])
    {{-- Profil --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Profil Organisasi</p>
                    <h3 class="text-3xl font-extrabold mb-6">KONI Provinsi Papua Pegunungan</h3>
                    <p class="text-gray-600 leading-relaxed mb-4 text-lg">
                        Kami adalah induk organisasi olahraga di Daerah Otonom Baru (DOB) Papua Pegunungan yang memiliki tanggung jawab besar dalam mengoordinasikan, membina, dan mengembangkan olahraga prestasi di seluruh wilayah provinsi. Sebagai lembaga yang lahir dari semangat pemekaran, kami hadir untuk memastikan bahwa potensi luar biasa para atlet di bumi pegunungan ini mendapat wadah pembinaan yang profesional dan berkelanjutan.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-4 text-lg">
                        Meskipun berstatus sebagai provinsi baru, kami telah menunjukkan taji di kancah nasional dengan prestasi yang impresif pada debut perdana di PON XXI Aceh-Sumut 2024. Pencapaian ini menjadi bukti nyata bahwa dengan tekad kuat, dukungan pemerintah daerah, dan kerja keras seluruh elemen keolahragaan, Papua Pegunungan mampu bersaing dan mengukir sejarah di pentas olahraga nasional.
                    </p>
                </div>
                <div class="relative">
                    <img src="{{ asset('img/Gubernur Jhon Tabo, KONI Papua Pegunungan.jpeg') }}" alt="Profil KONI" class="w-full h-full shadow-lg">
                    <div class="absolute -bottom-6 -right-6 bg-primary text-white p-8 shadow-lg hidden lg:block">
                        <p class="text-4xl font-extrabold">Dr. Hc. Jhon Tabo, SE, M.BA.</p>
                        <p class="text-base uppercase tracking-wide mt-1">Ketua Umum KONI Papua Pegunungan masa bakti 2025-2029, dilantik pada 8 Desember 2025.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Data Organisasi --}}
    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Informasi Resmi</p>
                <h3 class="text-3xl font-extrabold">Data Organisasi</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 shadow-lg border-t-4 border-primary">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary text-white flex items-center justify-center shrink-0"><i class="fas fa-user-tie"></i></div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Ketua Umum (2025-2029)</p>
                            <p class="text-lg font-extrabold text-dark">Dr. Hc. Jhon Tabo, SE, M.BA.</p>
                            <p class="text-sm text-gray-500 mt-1">Dilantik 8 Desember 2025</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 shadow-lg border-t-4 border-primary">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary text-white flex items-center justify-center shrink-0"><i class="fas fa-landmark"></i></div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Status Kepemimpinan</p>
                            <p class="text-lg font-extrabold text-dark">Dipimpin langsung oleh Gubernur</p>
                            <p class="text-sm text-gray-500 mt-1">Menjamin dukungan optimal dari pemerintah daerah dan SDM</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 shadow-lg border-t-4 border-primary">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary text-white flex items-center justify-center shrink-0"><i class="fas fa-calendar-check"></i></div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Tahun Pembentukan</p>
                            <p class="text-lg font-extrabold text-dark">Resmi dibentuk tahun 2023</p>
                            <p class="text-sm text-gray-500 mt-1">Sebagai KONI persiapan pasca pemekaran wilayah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Visi dan Target --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Arah Kebijakan</p>
                <h3 class="text-3xl font-extrabold">Visi dan Target Masa Depan</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="bg-dark text-white p-10 shadow-lg">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-primary flex items-center justify-center mr-4"><i class="fas fa-eye text-xl"></i></div>
                        <h4 class="text-2xl font-extrabold uppercase">Visi</h4>
                    </div>
                    <p class="text-gray-300 leading-relaxed text-xl">Membawa atlet lokal ke puncak prestasi dunia dengan karakter khas wilayah pegunungan.</p>
                </div>

                <div class="bg-accent p-10 shadow-lg border-t-4 border-primary">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-primary text-white flex items-center justify-center mr-4"><i class="fas fa-bullseye text-xl"></i></div>
                        <h4 class="text-2xl font-extrabold uppercase">Fokus Strategis</h4>
                    </div>
                    <ul class="space-y-4">
                        @foreach ([
                            'Target utama: peningkatan prestasi pada PON XXII 2028 NTT-NTB.',
                            'Melanjutkan program pembinaan atlet pada cabang olahraga unggulan hingga level nasional, internasional, dan Olimpiade.',
                            'Penguatan organisasi melalui dukungan Pemda dan bimbingan dari KONI Pusat untuk mengembangkan potensi SDM atlet di wilayah baru.',
                        ] as $i => $item)
                            <li class="flex items-start">
                                <span class="w-7 h-7 bg-primary text-white flex items-center justify-center text-sm font-bold mr-3 mt-0.5 shrink-0">{{ $i + 1 }}</span>
                                <span class="text-gray-700 text-lg">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Kutipan --}}
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4 text-center max-w-5xl">
            <i class="fas fa-quote-left text-4xl opacity-40 mb-6 block"></i>
            <p class="text-2xl lg:text-3xl font-extrabold leading-relaxed">"Bendera KONI Provinsi Papua Pegunungan nantinya akan kami kibarkan setinggi-tingginya... hingga mencapai puncak prestasi dunia."</p>
            <p class="text-base uppercase tracking-widest mt-6 text-white/90">— Dr. Hc. Jhon Tabo, SE, M.BA.</p>
        </div>
    </section>
@endsection
