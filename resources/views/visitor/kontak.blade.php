@extends('layouts.visitor')
@section('title', 'Kontak - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-title', 'Hubungi Kami - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-description', 'Informasi kontak dan alamat ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Kontak']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    @include('partials.section-header', [
        'headerTitle' => 'Hubungi Kami',
        'headerBreadcrumb' => ' › Kontak',
    ])

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                @foreach ([
                    ['icon' => 'fa-map-marker-alt', 'title' => 'Alamat', 'lines' => [$situs['alamat'] ?? 'Jl. Jeruk Nipis 117 Kotaraja, Jayapura 99225']],
                    ['icon' => 'fa-phone', 'title' => 'Telepon', 'lines' => ['+62 822-3908-4055']],
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

            {{-- Media Sosial --}}
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
                <div class="fade-in mb-16">
                    <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">Sosial</p>
                    <h3 class="text-2xl font-display font-bold text-neutral-900 mb-8">Media Sosial</h3>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
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
        </div>
    </section>

    {{-- Peta Full Width --}}
    <section class="fade-in">
        <div class="max-w-7xl mx-auto px-6 mb-4">
            <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">Lokasi</p>
            <h3 class="text-2xl font-display font-bold text-neutral-900">Temukan Kami</h3>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.0008698508836!2d140.67660557395212!3d-2.5942201967531062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x686cf5f6f988a501%3A0x46658cf19a11d8d0!2sYPMD%20Papua!5e1!3m2!1sid!2sid!4v1773553228539!5m2!1sid!2sid"
                class="w-full" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
@endsection
