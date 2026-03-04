<header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-3 flex justify-between items-center lg:flex-row flex-col" x-data="{ mobileMenuOpen: false }">
        <div class="flex items-center space-x-3 lg:w-auto w-full justify-center lg:justify-start relative">
            <a href="{{ route('beranda') }}" class="flex items-center space-x-3">
                @if (!empty($situs['logo']))
                    <img src="{{ asset('storage/' . $situs['logo']) }}" alt="Logo {{ $situs['nama_situs'] ?? 'KONI' }}" class="h-12">
                @else
                    <img src="{{ asset('img/logo-koni-papua-pegunungan.jpeg') }}" alt="Logo KONI" class="h-12">
                @endif
                <div class="text-center lg:text-left">
                    <span class="font-bold text-xl leading-none text-primary block">KONI</span>
                    <span class="text-sm font-semibold tracking-widest uppercase block">Papua Pegunungan</span>
                </div>
            </a>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden absolute right-0 text-2xl">
                <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
            </button>
        </div>
        <div :class="mobileMenuOpen ? 'flex' : 'hidden'" class="lg:flex flex-col lg:flex-row lg:space-x-6 space-y-4 lg:space-y-0 mt-4 lg:mt-0 items-center text-base font-medium uppercase tracking-tight">
            @php
                $navItems = [
                    ['label' => 'Beranda',    'route' => 'beranda'],
                    ['label' => 'Tentang',    'route' => 'tentang'],
                    [
                        'label' => 'Pengurusan',
                        'route' => 'pengurusan',
                        'dropdown' => [
                            ['label' => 'Semua Pengurus',  'hash' => ''],
                            ['label' => 'Dewan',           'hash' => '#dewan'],
                            ['label' => 'Pengurus Inti',   'hash' => '#pengurus-inti'],
                            ['label' => 'Kesekretariatan', 'hash' => '#kesekretariatan'],
                            ['label' => 'Bidang-Bidang',   'hash' => '#bidang-bidang'],
                        ],
                    ],
                    ['label' => 'Cabor',   'route' => 'cabor'],
                    ['label' => 'Event',   'route' => 'event'],
                    ['label' => 'Berita',  'route' => 'berita'],
                    ['label' => 'Galeri',  'route' => 'galeri'],
                    ['label' => 'Kontak',  'route' => 'kontak'],
                ];
            @endphp
            @foreach ($navItems as $item)
                @if (!empty($item['dropdown']))
                    <div x-data="{ open: false }"
                         class="relative"
                         @mouseenter="open = true"
                         @mouseleave="open = false"
                         @click.outside="open = false">

                        <button @click="open = !open"
                                class="flex items-center gap-1 hover:text-primary uppercase transition {{ request()->routeIs($item['route']) ? 'text-primary font-bold' : '' }}">
                            {{ $item['label'] }}
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-200"
                               :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute top-full left-0 mt-2 w-52 bg-white shadow-xl border-t-2 border-primary z-50 origin-top-left">
                            @foreach ($item['dropdown'] as $sub)
                                <a href="{{ route($item['route']) }}{{ $sub['hash'] }}"
                                   class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-primary hover:text-white transition border-b border-gray-100 last:border-0 normal-case tracking-normal">
                                    <i class="fas {{ $sub['hash'] === '' ? 'fa-list' : 'fa-angle-right' }} text-xs opacity-60"></i>
                                    {{ $sub['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ route($item['route']) }}"
                       class="hover:text-primary transition {{ request()->routeIs($item['route']) ? 'text-primary font-bold' : '' }}">
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach
        </div>
    </nav>
</header>
