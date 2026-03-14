@extends('layouts.visitor')
@section('title', 'Struktur Pengurusan - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-title', 'Struktur Pengurusan - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-description', 'Struktur pengurusan ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))

@section('content')
    @include('partials.page-banner', ['title' => 'Struktur Pengurusan', 'breadcrumb' => 'Pengurusan'])

    {{-- Info SK --}}
    <section class="py-10 bg-primary text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div>
                    <p class="text-white/70 text-sm uppercase tracking-widest mb-1">Masa Bakti</p>
                    <p class="font-extrabold text-2xl">2025 &ndash; 2029</p>
                </div>
                <div>
                    <p class="text-white/70 text-sm uppercase tracking-widest mb-1">Berdasarkan</p>
                    <p class="font-bold text-base leading-snug">SK KONI Pusat Nomor /69 Tahun 2025</p>
                    <p class="text-white/70 text-sm mt-1">Hasil Musorproviub 21 September 2025</p>
                </div>
                <div>
                    <p class="text-white/70 text-sm uppercase tracking-widest mb-1">Ditetapkan</p>
                    <p class="font-bold text-base">Jakarta, September 2025</p>
                    <p class="text-white/70 text-sm mt-1">Berlaku s.d. September 2029</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Dewan --}}
    <section id="dewan" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <p class="text-primary font-bold uppercase tracking-widest text-sm mb-2">Badan Kehormatan</p>
                <h3 class="text-3xl font-extrabold">Dewan</h3>
                <div class="w-16 h-1 bg-primary mx-auto mt-3"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                <div class="bg-white border border-gray-200 shadow-md p-6 text-center hover:border-primary hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-primary/10 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-crown text-primary text-xl"></i>
                    </div>
                    <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Dewan Pembina</p>
                    <h4 class="font-extrabold text-lg">Agus Nikilik Hubi</h4>
                </div>
                <div class="bg-white border border-gray-200 shadow-md p-6 text-center hover:border-primary hover:shadow-lg transition">
                    <div class="w-14 h-14 bg-primary/10 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-tie text-primary text-xl"></i>
                    </div>
                    <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Dewan Penasehat</p>
                    <h4 class="font-extrabold text-lg">Drs. Wasuok Demianus Siep</h4>
                </div>
            </div>
        </div>
    </section>

    {{-- Pengurus Inti --}}
    <section id="pengurus-inti" class="py-16 bg-accent">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <p class="text-primary font-bold uppercase tracking-widest text-sm mb-2">Pimpinan Eksekutif</p>
                <h3 class="text-3xl font-extrabold">Pengurus Inti</h3>
                <div class="w-16 h-1 bg-primary mx-auto mt-3"></div>
            </div>

            {{-- Ketua Umum --}}
            <div class="max-w-sm mx-auto mb-10">
                <div class="bg-white shadow-xl border-t-4 border-primary p-8 text-center">
                    <div class="w-20 h-20 bg-primary/10 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-primary text-3xl"></i>
                    </div>
                    <p class="text-xs font-bold text-primary uppercase tracking-widest mb-1">Ketua Umum</p>
                    <h4 class="font-extrabold text-xl">Dr. HC. Jhon Tabo, SE, M.BA</h4>
                </div>
            </div>

            {{-- Ketua Harian --}}
            <div class="max-w-sm mx-auto mb-10">
                <div class="bg-white shadow-md border border-gray-200 p-6 text-center hover:border-primary transition">
                    <div class="w-16 h-16 bg-primary/10 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-shield text-primary text-2xl"></i>
                    </div>
                    <p class="text-xs font-bold text-primary uppercase tracking-widest mb-1">Ketua Harian</p>
                    <h4 class="font-extrabold text-lg">Paul Wetipo, S.Pd, A.D.Min</h4>
                </div>
            </div>

            {{-- Wakil Ketua I & II --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto mb-10">
                @foreach ([
                    ['icon' => 'fa-users', 'pos' => 'Wakil Ketua I',  'name' => 'Elai Giban, SH, MM'],
                    ['icon' => 'fa-users', 'pos' => 'Wakil Ketua II', 'name' => 'Dr. Lukas Waika Kosay, SE, M.Si'],
                ] as $item)
                    <div class="bg-white shadow-md border border-gray-200 p-6 text-center hover:border-primary transition">
                        <div class="w-14 h-14 bg-primary/10 flex items-center justify-center mx-auto mb-3">
                            <i class="fas {{ $item['icon'] }} text-primary text-xl"></i>
                        </div>
                        <p class="text-xs font-bold text-primary uppercase tracking-widest mb-1">{{ $item['pos'] }}</p>
                        <h4 class="font-extrabold text-base">{{ $item['name'] }}</h4>
                    </div>
                @endforeach
            </div>

            {{-- Sekretaris & Bendahara --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">
                @foreach ([
                    ['icon' => 'fa-pen-nib',    'pos' => 'Sekretaris Umum',        'name' => 'Timotius Matuan, S.Pd, M.Pd'],
                    ['icon' => 'fa-pen-nib',    'pos' => 'Wakil Sekretaris Umum',  'name' => 'Charles P. Panggabean, SH, M.Si'],
                    ['icon' => 'fa-wallet',     'pos' => 'Bendahara Umum',         'name' => 'Noak Tabo, S.IP'],
                    ['icon' => 'fa-wallet',     'pos' => 'Wakil Bendahara I',      'name' => 'Abedzon Kurni, SE'],
                ] as $item)
                    <div class="bg-white shadow-md border border-gray-200 p-5 text-center hover:border-primary transition">
                        <div class="w-12 h-12 bg-primary/10 flex items-center justify-center mx-auto mb-3">
                            <i class="fas {{ $item['icon'] }} text-primary text-lg"></i>
                        </div>
                        <p class="text-xs font-bold text-primary uppercase tracking-widest mb-1">{{ $item['pos'] }}</p>
                        <h4 class="font-bold text-sm">{{ $item['name'] }}</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Kesekretariatan --}}
    <section id="kesekretariatan" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <p class="text-primary font-bold uppercase tracking-widest text-sm mb-2">Staf Pendukung</p>
                <h3 class="text-3xl font-extrabold">Kesekretariatan</h3>
                <div class="w-16 h-1 bg-primary mx-auto mt-3"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 max-w-5xl mx-auto">
                @foreach ([
                    'Dr. H. Kajagi Kalman, SH, MH',
                    'Otomin Gombo, S.IP',
                    'Hengki Elopere',
                    'Wahid Burhanuddin',
                    'Elince Omi Togodly, S.Sos',
                ] as $nama)
                    <div class="bg-gray-50 border border-gray-200 p-4 text-center hover:border-primary hover:bg-white transition">
                        <div class="w-10 h-10 bg-primary/10 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <p class="font-semibold text-sm leading-snug">{{ $nama }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Bidang-Bidang --}}
    <section id="bidang-bidang" class="py-16 bg-accent">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <p class="text-primary font-bold uppercase tracking-widest text-sm mb-2">Unit Kerja</p>
                <h3 class="text-3xl font-extrabold">Bidang-Bidang</h3>
                <div class="w-16 h-1 bg-primary mx-auto mt-3"></div>
            </div>

            @php
            $bidang = [
                [
                    'icon'    => 'fa-sitemap',
                    'nama'    => 'Pembinaan Organisasi',
                    'ketua'   => 'Semi Hisage, SE',
                    'anggota' => ['Lepianus Kogoya, Sp.M.KP', 'Ilham', 'Mari Mirin'],
                ],
                [
                    'icon'    => 'fa-trophy',
                    'nama'    => 'Pembinaan Prestasi',
                    'ketua'   => 'Amiel Amon Kosay, S.Kom',
                    'anggota' => ['Yosafat Aligat Alitnoe, S.Pd', 'Obet Kwijangge, S.Ak', 'Otius Wenda, S.Ian'],
                ],
                [
                    'icon'    => 'fa-graduation-cap',
                    'nama'    => 'Pendidikan & Penataran',
                    'ketua'   => 'Pere Karoba, S.Pd',
                    'anggota' => ['Doby Weya', 'Eklon Amohoso', 'Nas Gombo'],
                ],
                [
                    'icon'    => 'fa-microscope',
                    'nama'    => 'Penelitian & Pengembangan',
                    'ketua'   => 'Anis Kogoya',
                    'anggota' => ['Denius Kogoya, S.Pd', 'Junius Tangket, SE, M.Si', 'Benny Lokobal, SE'],
                ],
                [
                    'icon'    => 'fa-flask',
                    'nama'    => 'Sport Science & IPTEK',
                    'ketua'   => 'Antonius Wetipo, SE, M.Si',
                    'anggota' => ['Yan Yogobi', 'Ortis Uropmabin', 'Julius Tengket, SE, M.Si'],
                ],
                [
                    'icon'    => 'fa-chart-line',
                    'nama'    => 'Perencanaan Program & Anggaran',
                    'ketua'   => 'Marthen Kogoya, SH, M.AP',
                    'anggota' => ['Arnold Walilo, S.Pd, M.Si', 'Julio Foat', 'Sugeng Irianto Itlay, S.Stp'],
                ],
                [
                    'icon'    => 'fa-bullhorn',
                    'nama'    => 'Media, Humas & Protokoler',
                    'ketua'   => 'Noel Iman Wenda, SH',
                    'anggota' => ['Paul Korwa', 'Nies Tabuni', 'Steven Wetipo, S.Kom'],
                ],
                [
                    'icon'    => 'fa-gavel',
                    'nama'    => 'Pembinaan Hukum Keolahragaan',
                    'ketua'   => 'Yoseph Seraphino Ukago, SH, M.Si',
                    'anggota' => ['Paulus Waker, SH', 'Nur Wenda, SH'],
                ],
                [
                    'icon'    => 'fa-building',
                    'nama'    => 'Usaha, Sarana & Prasarana',
                    'ketua'   => 'Melisa Tabo',
                    'anggota' => ['Adi Wetipo, S.IP', 'Delar Kogoya', 'Melan Tabo'],
                ],
                [
                    'icon'    => 'fa-heartbeat',
                    'nama'    => 'Kesehatan',
                    'ketua'   => 'Mathias A. Korwa, A.Md.Kes',
                    'wakil'   => 'Arvit Naninty, A.Md.GZ',
                    'anggota' => ['dr. Susan Wetipo', 'Mince Itlay', 'Natalia Pekey'],
                ],
            ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($bidang as $b)
                    <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md hover:border-primary transition">
                        <div class="bg-primary px-5 py-4 flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $b['icon'] }} text-white"></i>
                            </div>
                            <h4 class="font-extrabold text-white text-sm uppercase leading-tight">Bidang {{ $b['nama'] }}</h4>
                        </div>
                        <div class="px-5 py-4">
                            <div class="mb-3">
                                <span class="text-xs font-bold text-primary uppercase tracking-wider">Ketua</span>
                                <p class="font-semibold text-gray-800 text-sm mt-0.5">{{ $b['ketua'] }}</p>
                            </div>
                            @if (!empty($b['wakil']))
                                <div class="mb-3">
                                    <span class="text-xs font-bold text-primary uppercase tracking-wider">Wakil Ketua</span>
                                    <p class="font-semibold text-gray-800 text-sm mt-0.5">{{ $b['wakil'] }}</p>
                                </div>
                            @endif
                            @if (!empty($b['anggota']))
                                <div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Anggota</span>
                                    <ul class="mt-1 space-y-1">
                                        @foreach ($b['anggota'] as $anggota)
                                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                                <i class="fas fa-circle text-[6px] text-primary mt-2 flex-shrink-0"></i>
                                                {{ $anggota }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
