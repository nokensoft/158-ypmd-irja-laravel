@extends('layouts.visitor')
@section('title', 'Profil - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-title', 'Profil Organisasi YPMD-IRJA')
@section('seo-description', 'Profil, visi, misi, dan struktur organisasi YPMD-IRJA.')

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Tentang › Profil</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Profil Organisasi</h1>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-start">
                <div class="fade-in">
                    <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-building mr-2"></i>Organisasi</p>
                    <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-6">Tentang YPMD-IRJA</h2>
                    <p class="text-neutral-600 leading-relaxed mb-4">Yayasan Pembangunan Masyarakat Desa Irian Jaya (YPMD-IRJA) adalah lembaga non-pemerintah nirlaba yang bergerak di bidang pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang. Berdiri sejak 1984, YPMD-IRJA merupakan LSM pertama di Tanah Papua.</p>
                    <p class="text-neutral-600 leading-relaxed mb-6">Berbasis di Jayapura, lembaga ini bekerja di empat wilayah utama Papua dengan fokus pada pendampingan komunitas, ekonomi berbasis masyarakat, dan advokasi hak-hak adat.</p>
                    <img src="{{ asset('img/galeri/Kantor YPMD-IRJA.png') }}" alt="Kantor YPMD-IRJA" class="w-full rounded-lg shadow-card"/>
                </div>
                <div class="space-y-8">
                    <div class="fade-in">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-eye text-primary-500"></i></div>
                            <h3 class="font-display font-bold text-neutral-900">Visi</h3>
                        </div>
                        <p class="text-neutral-600 leading-relaxed pl-11">Terwujudnya masyarakat desa di Irian Jaya / Papua sekarang yang mandiri, berdaulat, dan bermartabat dalam mengelola kehidupan dan sumber daya alamnya secara berkelanjutan.</p>
                    </div>
                    <div class="fade-in">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-primary-50 flex items-center justify-center"><i class="fa-solid fa-bullseye text-primary-500"></i></div>
                            <h3 class="font-display font-bold text-neutral-900">Misi</h3>
                        </div>
                        <ul class="text-neutral-600 space-y-2 pl-11">
                            <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Mendampingi dan mengorganisir masyarakat desa di Irian Jaya / Papua sekarang sebagai subjek pembangunan</span></li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Mengembangkan program ekonomi berbasis komunitas yang berkelanjutan</span></li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Mengadvokasi hak-hak masyarakat desa di Irian Jaya / Papua sekarang atas tanah dan sumber daya alam</span></li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-primary-500 mt-0.5 text-xs"></i><span>Membangun jaringan kemitraan lokal, nasional, dan internasional</span></li>
                        </ul>
                    </div>
                    <div class="fade-in">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-accent-50 flex items-center justify-center"><i class="fa-solid fa-map-pin text-accent-400"></i></div>
                            <h3 class="font-display font-bold text-neutral-900">Wilayah Kerja</h3>
                        </div>
                        <ul class="text-neutral-600 space-y-1 pl-11">
                            <li class="flex gap-2"><i class="fa-solid fa-location-dot text-accent-400 mt-0.5 text-xs"></i><span>Lembah Grime, Kabupaten Jayapura</span></li>
                            <li class="flex gap-2"><i class="fa-solid fa-location-dot text-accent-400 mt-0.5 text-xs"></i><span>Sentani &amp; sekitarnya</span></li>
                            <li class="flex gap-2"><i class="fa-solid fa-location-dot text-accent-400 mt-0.5 text-xs"></i><span>Pegunungan Bintang</span></li>
                            <li class="flex gap-2"><i class="fa-solid fa-location-dot text-accent-400 mt-0.5 text-xs"></i><span>Wilayah pesisir Papua</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-6">

            
            


            <div class="mb-16">
                <div class="mb-12 text-center fade-in">
                    <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">
                        <i class="fa-solid fa-user-tie mr-2"></i>Kepemimpinan
                    </p>
                    <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Direktur dari Masa ke Masa</h2>
                    <p class="text-neutral-500 text-sm mt-2">Pejabat Direktur YPMD IRJA, Th. 1982 – 2026</p>
                </div>

                <div class="relative">
                    {{-- Garis Tengah (Desktop) --}}
                    <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-px bg-primary-100 -translate-x-1/2"></div>

                    <div class="space-y-12 md:space-y-8 relative">
                        @foreach ([
                            ['no'=>1, 'nama'=>'George Junus Aditjondro', 'periode'=>'1982 – 1986', 'ket'=>'Direktur Pertama', 'img'=>'https://ui-avatars.com/api/?name=George+Junus+Aditjondro&background=0D8ABC&color=fff'],
                            ['no'=>2, 'nama'=>'Ir. August Rumansara, MA', 'periode'=>'1986 – 1987', 'ket'=>'', 'img'=>'https://ui-avatars.com/api/?name=August+Rumansara&background=0D8ABC&color=fff'],
                            ['no'=>3, 'nama'=>'Antonius A. Rahawarin, BA', 'periode'=>'1988 – 1991', 'ket'=>'', 'img'=>'https://ui-avatars.com/api/?name=Antonius+Rahawarin&background=0D8ABC&color=fff'],
                            ['no'=>4, 'nama'=>'Ir. Cliff R. Marlessy', 'periode'=>'1992 – 1994', 'ket'=>'', 'img'=>'https://ui-avatars.com/api/?name=Cliff+Marlessy&background=0D8ABC&color=fff'],
                            ['no'=>5, 'nama'=>'Fientje Salomina Jarangga, SE', 'periode'=>'1995 – 1997', 'ket'=>'', 'img'=>'https://ui-avatars.com/api/?name=Fientje+Jarangga&background=0D8ABC&color=fff'],
                            ['no'=>6, 'nama'=>'Drs. Decky Rumaropen', 'periode'=>'1998 – 2022', 'ket'=>'Direktur Terlama — 24 Tahun', 'img'=>'https://ui-avatars.com/api/?name=Decky+Rumaropen&background=0D8ABC&color=fff'],
                            ['no'=>7, 'nama'=>'Drs. Yohannes Hambur', 'periode'=>'2024 – Sekarang', 'ket'=>'Direktur Aktif', 'img'=>'https://ui-avatars.com/api/?name=Yohannes+Hambur&background=0D8ABC&color=fff'],
                        ] as $index => $d)
                        
                        <div class="flex flex-col md:flex-row md:items-center gap-6 md:gap-0 fade-in">
                            {{-- Sisi Nama (Kiri pada Desktop) --}}
                            <div class="md:w-1/2 flex items-center gap-4 {{ $index % 2 == 0 ? 'md:flex-row-reverse md:text-right md:pr-12' : 'md:pl-12' }}">
                                <div class="relative flex-shrink-0">
                                    <img src="{{ $d['img'] }}" alt="{{ $d['nama'] }}" class="w-14 h-14 rounded-full border-2 border-white shadow-md object-cover grayscale hover:grayscale-0 transition-all duration-300">
                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-primary-500 rounded-full flex items-center justify-center text-[10px] text-white font-bold border-2 border-white md:hidden">
                                        {{ $d['no'] }}
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-display font-bold text-neutral-900 text-base leading-tight">{{ $d['nama'] }}</h4>
                                    @if($d['ket'])
                                        <p class="text-[10px] uppercase tracking-wider text-primary-500 font-bold mt-1">{{ $d['ket'] }}</p>
                                    @endif
                                    <p class="text-xs text-neutral-500 mt-1 md:hidden"><i class="fa-regular fa-calendar mr-1"></i> {{ $d['periode'] }}</p>
                                </div>
                            </div>

                            {{-- Nomor Tengah (Desktop) --}}
                            <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 z-10 w-10 h-10 rounded-full bg-white border-2 border-primary-500 text-primary-600 items-center justify-center font-bold text-xs shadow-sm">
                                {{ $d['no'] }}
                            </div>

                            {{-- Sisi Periode (Kanan pada Desktop) --}}
                            <div class="md:w-1/2 hidden md:block {{ $index % 2 == 0 ? 'md:pl-12' : 'md:pr-12 md:text-right' }}">
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-primary-50 text-primary-700 text-xs font-bold border border-primary-100">
                                    <i class="fa-regular fa-calendar mr-2 opacity-70"></i> {{ $d['periode'] }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>






            {{-- Identitas Lembaga --}}
            <div class="mb-12 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">Data</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Identitas Lembaga</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ([
                    ['label'=>'Nama Resmi','value'=>'Yayasan Pembangunan Masyarakat Desa Irian Jaya'],
                    ['label'=>'Singkatan','value'=>'YPMD-IRJA'],
                    ['label'=>'Tahun Berdiri','value'=>'1984'],
                    ['label'=>'Jenis Organisasi','value'=>'LSM / NGO Nirlaba'],
                    ['label'=>'Kantor Pusat','value'=>$situs['alamat'] ?? 'Jayapura, Papua'],
                    ['label'=>'Bidang Fokus','value'=>'Pemberdayaan Masyarakat Desa di Irian Jaya / Papua Sekarang'],
                ] as $item)
                <div class="bg-white p-6 shadow-card fade-in">
                    <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">{{ $item['label'] }}</p>
                    <p class="font-semibold text-neutral-900">{{ $item['value'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
