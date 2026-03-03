<header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-3 flex justify-between items-center lg:flex-row flex-col" x-data="{ mobileMenuOpen: false }">
        <div class="flex items-center space-x-3 lg:w-auto w-full justify-center lg:justify-start relative">
            <a href="{{ route('beranda') }}" class="flex items-center space-x-3">
                <img src="{{ asset('img/logo-koni-papua-pegunungan-transparant.png') }}" alt="Logo KONI" class="h-12">
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
                    ['label' => 'Beranda', 'route' => 'beranda'],
                    ['label' => 'Tentang', 'route' => 'tentang'],
                    ['label' => 'Pengurusan', 'route' => 'pengurusan'],
                    ['label' => 'Cabor', 'route' => 'cabor'],
                    ['label' => 'Event', 'route' => 'event'],
                    ['label' => 'Berita', 'route' => 'berita'],
                    ['label' => 'Galeri', 'route' => 'galeri'],
                    ['label' => 'Kontak', 'route' => 'kontak'],
                ];
            @endphp
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="hover:text-primary transition {{ request()->routeIs($item['route']) ? 'text-primary font-bold' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>
    </nav>
</header>
