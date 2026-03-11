<header class="sticky top-0 z-50 bg-white shadow-md border-b border-neutral-200" x-data="{ menuOpen: false, tentangOpen: false }">
    <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

        {{-- Logo Desktop --}}
        <a href="{{ route('beranda') }}" class="hidden md:flex items-center gap-3 flex-shrink-0">
            @if (!empty($situs['logo']))
                <img src="{{ asset('storage/' . $situs['logo']) }}" alt="{{ $situs['nama_situs'] ?? 'YPMD IRJA' }}" class="h-16">
            @else
                <img src="{{ asset('img/logo-ypmd-irja.png') }}" alt="YPMD IRJA" class="h-16">
            @endif
            <div class="hidden sm:block">
                <span class="font-display font-bold text-primary-700 text-base leading-tight block">{{ $situs['nama_situs'] ?? 'YPMD IRJA' }}</span>
                <span class="text-neutral-400 text-xs leading-none">Yayasan Pembangunan Masyarakat Desa Irian Jaya</span>
            </div>
        </a>

        {{-- Nav Desktop --}}
        <ul class="hidden md:flex items-center gap-6">
            <li>
                <a href="{{ route('beranda') }}"
                   class="nav-link text-sm font-medium transition-colors {{ request()->routeIs('beranda') ? 'active text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">
                    Beranda
                </a>
            </li>

            {{-- Tentang Dropdown --}}
            <li class="relative" x-data="{ open: false }" @mouseenter="open=true" @mouseleave="open=false">
                <button class="nav-link text-sm font-medium flex items-center gap-1 transition-colors
                    {{ request()->routeIs('sejarah') || request()->routeIs('profil') || request()->routeIs('tokoh') ? 'active text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">
                    Tentang <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </button>
                <div x-show="open" x-transition style="display:none;"
                     class="absolute top-full left-0 mt-1 w-48 bg-white shadow-lg border border-neutral-100 py-1 z-50">
                    <a href="{{ route('sejarah') }}"
                       class="block px-4 py-2.5 text-sm hover:bg-primary-50 hover:text-primary-600 {{ request()->routeIs('sejarah') ? 'font-semibold text-primary-600 bg-primary-50' : 'text-neutral-600' }}">
                        Sejarah Singkat
                    </a>
                    <a href="{{ route('profil') }}"
                       class="block px-4 py-2.5 text-sm hover:bg-primary-50 hover:text-primary-600 {{ request()->routeIs('profil') ? 'font-semibold text-primary-600 bg-primary-50' : 'text-neutral-600' }}">
                        Profil Lembaga
                    </a>
                    <a href="{{ route('tokoh') }}"
                       class="block px-4 py-2.5 text-sm hover:bg-primary-50 hover:text-primary-600 {{ request()->routeIs('tokoh') ? 'font-semibold text-primary-600 bg-primary-50' : 'text-neutral-600' }}">
                        Tokoh Kunci
                    </a>
                </div>
            </li>

            <li><a href="{{ route('program') }}" class="nav-link text-sm font-medium transition-colors {{ request()->routeIs('program') ? 'active text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">Program</a></li>
            <li><a href="{{ route('kdk') }}" class="nav-link text-sm font-medium transition-colors {{ request()->routeIs('kdk') ? 'active text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">KDK</a></li>
            <li><a href="{{ route('berita') }}" class="nav-link text-sm font-medium transition-colors {{ request()->routeIs('berita*') ? 'active text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">Papua Today</a></li>
            <li><a href="{{ route('donasi') }}" class="nav-link text-sm font-medium transition-colors {{ request()->routeIs('donasi') ? 'active text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">Donasi</a></li>
            <li><a href="{{ route('kontak') }}" class="nav-link text-sm font-medium transition-colors {{ request()->routeIs('kontak') ? 'active text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">Kontak</a></li>
        </ul>

        {{-- Logo Mobile Center --}}
        <div class="md:hidden absolute left-1/2 -translate-x-1/2 flex items-center gap-2">
            @if (!empty($situs['logo']))
                <img src="{{ asset('storage/' . $situs['logo']) }}" alt="" class="h-7">
            @else
                <img src="{{ asset('img/logo-ypmd-irja.png') }}" alt="" class="h-7">
            @endif
            <span class="font-display font-bold text-primary-700 text-sm">{{ $situs['nama_situs'] ?? 'YPMD IRJA' }}</span>
        </div>

        {{-- Hamburger --}}
        <button class="md:hidden ml-auto text-neutral-600" @click="menuOpen=!menuOpen">
            <i class="fa-solid text-lg" :class="menuOpen ? 'fa-xmark' : 'fa-bars'"></i>
        </button>
    </nav>

    {{-- Mobile Menu --}}
    <div x-show="menuOpen" x-transition style="display:none;"
         class="md:hidden bg-white border-t border-neutral-200 shadow-md">
        <ul class="flex flex-col py-2">
            <li>
                <a href="{{ route('beranda') }}"
                   class="block px-6 py-3 text-sm {{ request()->routeIs('beranda') ? 'font-semibold text-primary-600 bg-primary-50' : 'text-neutral-700 hover:bg-neutral-50' }}">
                    Beranda
                </a>
            </li>
            <li>
                <button @click="tentangOpen=!tentangOpen"
                        class="w-full flex items-center justify-between px-6 py-3 text-sm
                        {{ request()->routeIs('sejarah') || request()->routeIs('profil') || request()->routeIs('tokoh') ? 'text-primary-600 font-semibold bg-primary-50' : 'text-neutral-700 hover:bg-neutral-50' }}">
                    Tentang
                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform" :class="tentangOpen && 'rotate-180'"></i>
                </button>
                <div x-show="tentangOpen" x-transition style="display:none;" class="bg-neutral-50">
                    <a href="{{ route('sejarah') }}" class="block px-10 py-2.5 text-sm {{ request()->routeIs('sejarah') ? 'font-semibold text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">Sejarah Singkat</a>
                    <a href="{{ route('profil') }}" class="block px-10 py-2.5 text-sm {{ request()->routeIs('profil') ? 'font-semibold text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">Profil Lembaga</a>
                    <a href="{{ route('tokoh') }}" class="block px-10 py-2.5 text-sm {{ request()->routeIs('tokoh') ? 'font-semibold text-primary-600' : 'text-neutral-600 hover:text-primary-600' }}">Tokoh Kunci</a>
                </div>
            </li>
            <li><a href="{{ route('program') }}" class="block px-6 py-3 text-sm {{ request()->routeIs('program') ? 'font-semibold text-primary-600 bg-primary-50' : 'text-neutral-700 hover:bg-neutral-50' }}">Program</a></li>
            <li><a href="{{ route('kdk') }}" class="block px-6 py-3 text-sm {{ request()->routeIs('kdk') ? 'font-semibold text-primary-600 bg-primary-50' : 'text-neutral-700 hover:bg-neutral-50' }}">KDK</a></li>
            <li><a href="{{ route('berita') }}" class="block px-6 py-3 text-sm {{ request()->routeIs('berita*') ? 'font-semibold text-primary-600 bg-primary-50' : 'text-neutral-700 hover:bg-neutral-50' }}">Papua Today</a></li>
            <li><a href="{{ route('donasi') }}" class="block px-6 py-3 text-sm {{ request()->routeIs('donasi') ? 'font-semibold text-primary-600 bg-primary-50' : 'text-neutral-700 hover:bg-neutral-50' }}">Donasi</a></li>
            <li><a href="{{ route('kontak') }}" class="block px-6 py-3 text-sm {{ request()->routeIs('kontak') ? 'font-semibold text-primary-600 bg-primary-50' : 'text-neutral-700 hover:bg-neutral-50' }}">Kontak</a></li>
        </ul>
    </div>
</header>
