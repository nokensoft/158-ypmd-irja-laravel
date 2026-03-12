@extends('layouts.visitor')
@section('title', 'Direktur dari Masa ke Masa - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Direktur YPMD IRJA dari Masa ke Masa')
@section('seo-description', 'Daftar direktur YPMD IRJA dari tahun 1984 hingga sekarang.')

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Tentang','item'=>route('profil')],['@type'=>'ListItem','position'=>3,'name'=>'Direktur']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest">
                <a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> ›
                <a href="{{ route('profil') }}" class="hover:text-white">Tentang</a> › Direktur
            </span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Direktur dari Masa ke Masa</h1>
            <p class="text-primary-200 mt-2 text-lg">Pemimpin yang menggerakkan YPMD IRJA sejak 1984</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="mb-14 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-user-tie mr-2"></i>Kepemimpinan</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-4">Estafet Kepemimpinan YPMD IRJA</h2>
                <p class="text-neutral-600 leading-relaxed max-w-2xl">Selama lebih dari empat dekade, YPMD IRJA telah dipimpin oleh enam direktur yang masing-masing membawa dedikasi dan visi dalam memajukan pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang.</p>
            </div>

            @php
            $direktur = [
                [
                    'no'        => 1,
                    'nama'      => 'Ir. Agus Rumansara, MA',
                    'periode'   => '1984 – 1986',
                    'label'     => 'Direktur Pertama & Pendiri',
                    'foto'      => null,
                    'aktif'     => false,
                ],
                [
                    'no'        => 2,
                    'nama'      => 'Antonis A. Rahawarin, B.A',
                    'periode'   => '1987 – 1990',
                    'label'     => 'Direktur Kedua',
                    'foto'      => null,
                    'aktif'     => false,
                ],
                [
                    'no'        => 3,
                    'nama'      => 'Ir. Kliv R. Marlessi',
                    'periode'   => '1991 – 1994',
                    'label'     => 'Direktur Ketiga',
                    'foto'      => null,
                    'aktif'     => false,
                ],
                [
                    'no'        => 4,
                    'nama'      => 'Dra. Fintje S. Jarangga',
                    'periode'   => '1995 – 1997',
                    'label'     => 'Direktur Keempat',
                    'foto'      => null,
                    'aktif'     => false,
                ],
                [
                    'no'        => 5,
                    'nama'      => 'Drs. Decky Rumaropen',
                    'periode'   => '1998 – 2020',
                    'label'     => 'Direktur Terlama · 22 Tahun',
                    'foto'      => 'img/galeri/avatar-decky-rumaropen.png',
                    'aktif'     => false,
                ],
                [
                    'no'        => 6,
                    'nama'      => 'Drs. Johanes Hambur',
                    'periode'   => '2024 – Sekarang',
                    'label'     => 'Direktur Aktif',
                    'foto'      => null,
                    'aktif'     => true,
                ],
            ];
            @endphp

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($direktur as $d)
                <div class="bg-white border {{ $d['aktif'] ? 'border-primary-300 shadow-card' : 'border-neutral-100' }} fade-in relative">
                    @if ($d['aktif'])
                        <div class="absolute top-3 right-3">
                            <span class="bg-primary-500 text-white text-xs font-bold px-2 py-0.5 uppercase tracking-wider">Aktif</span>
                        </div>
                    @endif
                    {{-- Foto / Avatar --}}
                    <div class="h-48 {{ $d['aktif'] ? 'bg-primary-50' : 'bg-neutral-50' }} flex items-center justify-center">
                        @if ($d['foto'])
                            <img src="{{ asset($d['foto']) }}" alt="{{ $d['nama'] }}"
                                 class="w-28 h-28 rounded-full object-cover border-4 {{ $d['aktif'] ? 'border-primary-200' : 'border-white' }} shadow">
                        @else
                            <img src="https://placehold.co/400/{{ $d['aktif'] ? 'e8f5ee/2d8057' : 'f5f5f5/999999' }}?text={{ urlencode($d['nama']) }}"
                                 alt="{{ $d['nama'] }}"
                                 class="w-28 h-28 rounded-full object-cover border-4 {{ $d['aktif'] ? 'border-primary-200' : 'border-white' }} shadow">
                        @endif
                    </div>
                    {{-- Info --}}
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-6 h-6 rounded-full bg-primary-500 text-white text-xs font-bold flex items-center justify-center flex-shrink-0">{{ $d['no'] }}</span>
                            <span class="text-xs text-primary-500 font-semibold uppercase tracking-wider">{{ $d['label'] }}</span>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 text-base mt-2 mb-1">{{ $d['nama'] }}</h3>
                        <p class="text-sm text-neutral-500">
                            <i class="fa-regular fa-calendar mr-1.5 text-neutral-300"></i>{{ $d['periode'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
