{{-- Floating: Back-to-top + WhatsApp --}}
<div class="fixed bottom-6 right-5 z-50 flex flex-col items-center gap-3">
    <button id="btnTop"
            onclick="window.scrollTo({top:0,behavior:'smooth'})"
            class="w-11 h-11 bg-neutral-700 hover:bg-neutral-900 text-white flex items-center justify-center shadow-lg transition-all duration-300 opacity-0 translate-y-4 pointer-events-none">
        <i class="fa-solid fa-chevron-up text-sm"></i>
    </button>
    @if (!empty($situs['sosmed_whatsapp']))
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $situs['sosmed_whatsapp']) }}"
       target="_blank"
       class="w-11 h-11 bg-[#25D366] hover:bg-[#1ebe5d] text-white flex items-center justify-center shadow-lg transition-colors">
        <i class="fa-brands fa-whatsapp text-xl"></i>
    </a>
    @endif
</div>

<footer class="bg-neutral-900 text-neutral-300">
    <div class="max-w-7xl mx-auto px-6 py-14 grid sm:grid-cols-2 md:grid-cols-4 gap-10">

        {{-- Kolom 1: Logo + Deskripsi --}}
        <div>
            <div class="flex items-center gap-3 mb-4">
                <span class="bg-white rounded p-1.5 inline-flex items-center justify-center">
                    @if (!empty($situs['logo']))
                        <img src="{{ asset('storage/' . $situs['logo']) }}" alt="" class="h-16">
                    @else
                        <img src="{{ asset('img/logo-ypmd-irja.png') }}" alt="" class="h-16">
                    @endif
                </span>
                <span class="font-display font-bold text-white text-base">{{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}</span>
            </div>
            <p class="text-neutral-400 text-sm leading-relaxed">
                {{ $situs['deskripsi_situs'] ?? 'Pionir pemberdayaan dan advokasi masyarakat desa di Irian Jaya / Papua sekarang di Tanah Papua sejak 1984.' }}
            </p>
        </div>

        {{-- Kolom 2: Navigasi --}}
        <div>
            <h4 class="text-white text-xs font-semibold uppercase tracking-widest mb-4">{{ __('Navigasi') }}</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('beranda') }}" class="hover:text-white transition-colors">{{ __('Beranda') }}</a></li>
                <li><a href="{{ route('profil') }}" class="hover:text-white transition-colors">{{ __('Profil Lembaga') }}</a></li>
                <li><a href="{{ route('sejarah') }}" class="hover:text-white transition-colors">{{ __('Sejarah Singkat') }}</a></li>
                <li><a href="{{ route('program') }}" class="hover:text-white transition-colors">{{ __('Program') }}</a></li>
                <li><a href="{{ route('kdk') }}" class="hover:text-white transition-colors">{{ __('Buletin KDK') }}</a></li>
                <li><a href="{{ route('berita') }}" class="hover:text-white transition-colors">{{ __('Papua Today') }}</a></li>
            </ul>
        </div>

        {{-- Kolom 3: Halaman (dinamis dari DB) --}}
        <div>
            <h4 class="text-white text-xs font-semibold uppercase tracking-widest mb-4">Halaman</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('galeri') }}" class="hover:text-white transition-colors">Galeri</a></li>
                <li><a href="{{ route('donasi') }}" class="hover:text-white transition-colors">Donasi</a></li>
                <li><a href="{{ route('kontak') }}" class="hover:text-white transition-colors">Kontak</a></li>
                @foreach ($halamanFooter->whereNotIn('slug', ['sejarah','profil','bidang-kerja','mitra']) as $hPage)
                    <li>
                        <a href="{{ route('halaman.show', $hPage->slug) }}" class="hover:text-white transition-colors">
                            {{ $hPage->judul }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Kolom 4: Kontak --}}
        <div>
            <h4 class="text-white text-xs font-semibold uppercase tracking-widest mb-4">{{ __('Kontak') }}</h4>
            <ul class="space-y-2 text-sm text-neutral-400">
                @if (!empty($situs['alamat']))
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot text-primary-400 mt-0.5 w-4"></i>
                        <span>{{ $situs['alamat'] }}</span>
                    </li>
                @else
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot text-primary-400 mt-0.5 w-4"></i>
                        <span>Jl. Jeruk Nipis 117 Kotaraja, Jayapura 99225</span>
                    </li>
                @endif
                @if (!empty($situs['telepon']))
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-phone text-primary-400 mt-0.5 w-4"></i>
                        <span>{{ $situs['telepon'] }}</span>
                    </li>
                @else
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-phone text-primary-400 mt-0.5 w-4"></i>
                        <span>0967-581071</span>
                    </li>
                @endif
                @if (!empty($situs['email']))
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-envelope text-primary-400 mt-0.5 w-4"></i>
                        <a href="mailto:{{ $situs['email'] }}" class="hover:text-white transition-colors">{{ $situs['email'] }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    {{-- Copyright Bar --}}
    <div class="border-t border-neutral-800">
        <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-neutral-600 text-xs">&copy; {{ date('Y') }} {{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}. {{ __('Seluruh hak cipta dilindungi.') }}</p>
            <div class="flex items-center gap-4">
                {{-- Sosmed --}}
                <div class="flex items-center gap-2">
                    @if (!empty($situs['sosmed_facebook']))
                        <a href="{{ $situs['sosmed_facebook'] }}" target="_blank" class="w-7 h-7 bg-neutral-800 hover:bg-primary-500 flex items-center justify-center rounded transition-colors"><i class="fa-brands fa-facebook-f text-xs"></i></a>
                    @endif
                    @if (!empty($situs['sosmed_instagram']))
                        <a href="{{ $situs['sosmed_instagram'] }}" target="_blank" class="w-7 h-7 bg-neutral-800 hover:bg-primary-500 flex items-center justify-center rounded transition-colors"><i class="fa-brands fa-instagram text-xs"></i></a>
                    @endif
                    @if (!empty($situs['sosmed_youtube']))
                        <a href="{{ $situs['sosmed_youtube'] }}" target="_blank" class="w-7 h-7 bg-neutral-800 hover:bg-primary-500 flex items-center justify-center rounded transition-colors"><i class="fa-brands fa-youtube text-xs"></i></a>
                    @endif
                    @if (!empty($situs['sosmed_twitter']))
                        <a href="{{ $situs['sosmed_twitter'] }}" target="_blank" class="w-7 h-7 bg-neutral-800 hover:bg-primary-500 flex items-center justify-center rounded transition-colors"><i class="fa-brands fa-x-twitter text-xs"></i></a>
                    @endif
                    @if (!empty($situs['sosmed_tiktok']))
                        <a href="{{ $situs['sosmed_tiktok'] }}" target="_blank" class="w-7 h-7 bg-neutral-800 hover:bg-primary-500 flex items-center justify-center rounded transition-colors"><i class="fa-brands fa-tiktok text-xs"></i></a>
                    @endif
                </div>
                @php
                    $faqPage         = $halamanFooter->firstWhere('slug', 'faq');
                    $disclaimerPage  = $halamanFooter->firstWhere('slug', 'disclaimer');
                @endphp
                <div class="flex items-center gap-3 text-xs text-neutral-500">
                    @if ($faqPage)
                        <a href="{{ route('halaman.show', $faqPage->slug) }}" class="hover:text-white transition-colors">{{ $faqPage->judul }}</a>
                        <span class="text-neutral-700">&middot;</span>
                    @endif
                    @if ($disclaimerPage)
                        <a href="{{ route('halaman.show', $disclaimerPage->slug) }}" class="hover:text-white transition-colors">{{ $disclaimerPage->judul }}</a>
                        <span class="text-neutral-700">&middot;</span>
                    @endif
                    <a href="{{ route('peta-situs') }}" class="hover:text-white transition-colors">Peta Situs</a>
                </div>
            </div>
        </div>
    </div>
</footer>
