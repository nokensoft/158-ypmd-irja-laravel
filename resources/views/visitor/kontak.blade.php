@extends('layouts.visitor')
@section('title', 'Kontak - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Hubungi Kami - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-description', 'Informasi kontak dan alamat ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Kontak']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Kontak</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Hubungi Kami</h1>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                @foreach ([
                    ['icon' => 'fa-map-marker-alt', 'title' => 'Alamat', 'lines' => [$situs['alamat'] ?? 'Belum diatur']],
                    ['icon' => 'fa-phone', 'title' => 'Telepon', 'lines' => [$situs['telepon'] ?? 'Belum diatur']],
                    ['icon' => 'fa-envelope', 'title' => 'Email', 'lines' => [$situs['email'] ?? 'Belum diatur']],
                    ['icon' => 'fa-clock', 'title' => 'Jam Operasional', 'lines' => ['Senin - Jumat', '08:00 - 16:00 WIT']],
                ] as $card)
                    <div class="bg-neutral-50 p-8 text-center border-t-4 border-primary-500 shadow-card hover:shadow-md transition fade-in">
                        <div class="w-12 h-12 bg-primary-500 text-white flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid {{ $card['icon'] }} text-lg"></i>
                        </div>
                        <h4 class="font-display font-bold uppercase text-sm mb-2">{{ $card['title'] }}</h4>
                        @foreach ($card['lines'] as $line)
                            <p class="text-neutral-500 text-sm">{{ $line }}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                @php
                    $sosmedLinks = collect([
                        ['key' => 'sosmed_facebook', 'icon' => 'fa-facebook-f', 'label' => 'Facebook', 'color' => 'bg-blue-600 hover:bg-blue-700'],
                        ['key' => 'sosmed_instagram', 'icon' => 'fa-instagram', 'label' => 'Instagram', 'color' => 'bg-pink-500 hover:bg-pink-600'],
                        ['key' => 'sosmed_youtube', 'icon' => 'fa-youtube', 'label' => 'YouTube', 'color' => 'bg-red-600 hover:bg-red-700'],
                        ['key' => 'sosmed_twitter', 'icon' => 'fa-x-twitter', 'label' => 'Twitter / X', 'color' => 'bg-neutral-900 hover:bg-black'],
                        ['key' => 'sosmed_tiktok', 'icon' => 'fa-tiktok', 'label' => 'TikTok', 'color' => 'bg-neutral-800 hover:bg-neutral-900'],
                    ])->filter(fn ($item) => !empty($situs[$item['key']]));
                @endphp

                @if ($sosmedLinks->isNotEmpty())
                    <div class="fade-in">
                        <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">Sosial</p>
                        <h3 class="text-2xl font-display font-bold text-neutral-900 mb-8">Media Sosial</h3>
                        <div class="space-y-3">
                            @foreach ($sosmedLinks as $sosmed)
                                <a href="{{ $situs[$sosmed['key']] }}" target="_blank" rel="noopener noreferrer"
                                   class="flex items-center gap-4 p-4 bg-neutral-50 shadow-sm hover:shadow-card transition group">
                                    <div class="w-10 h-10 {{ $sosmed['color'] }} text-white flex items-center justify-center transition flex-shrink-0">
                                        <i class="fa-brands {{ $sosmed['icon'] }} text-lg"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-sm text-neutral-900">{{ $sosmed['label'] }}</p>
                                        <p class="text-xs text-neutral-400 truncate">{{ $situs[$sosmed['key']] }}</p>
                                    </div>
                                    <i class="fa-solid fa-external-link-alt text-neutral-300 group-hover:text-primary-500 transition text-xs"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="fade-in">
                    <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">Lokasi</p>
                    <h3 class="text-2xl font-display font-bold text-neutral-900 mb-8">Temukan Kami</h3>
                    <iframe width="100%" height="350" src="https://www.openstreetmap.org/export/embed.html?bbox=136.24145507812503%2C-6.189707330332176%2C141.21276855468753%2C-2.180259769681343&amp;layer=mapnik" style="border:1px solid #e5e5e5"></iframe>
                    <small class="text-neutral-400"><a href="https://www.openstreetmap.org/?#map=8/-4.188/138.727&amp;layers=NDG" class="hover:text-primary-600">Lihat Peta Lebih Besar</a></small>
                </div>
            </div>
        </div>
    </section>
@endsection
