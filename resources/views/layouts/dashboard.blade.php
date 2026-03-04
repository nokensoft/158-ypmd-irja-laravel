<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ $situs['nama_situs'] ?? 'KONI Papua Pegunungan' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    @if (!empty($situs['logo']))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $situs['logo']) }}">
    @else
        <link rel="icon" type="image/jpeg" href="{{ asset('img/logo-koni-papua-pegunungan.jpeg') }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans text-lg" x-data="{ sidebarOpen: true, mobileSidebar: false }">

    {{-- Page Loading --}}
    @include('partials.page-loading')

    <div class="flex min-h-screen">

        {{-- Sidebar Overlay (Mobile) --}}
        <div x-show="mobileSidebar" @click="mobileSidebar = false"
             class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-transition.opacity></div>

        {{-- Sidebar --}}
        <aside :class="mobileSidebar ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-72 bg-dark text-white flex flex-col transition-transform duration-300 lg:translate-x-0">

            {{-- Logo --}}
            <div class="px-6 py-5 border-b border-gray-800 flex items-center space-x-3">
                @if (!empty($situs['logo']))
                    <img src="{{ asset('storage/' . $situs['logo']) }}" alt="Logo {{ $situs['nama_situs'] ?? 'KONI' }}" class="h-10">
                @else
                    <img src="{{ asset('img/logo-koni-papua-pegunungan.jpeg') }}" alt="Logo" class="h-10">
                @endif
                <div>
                    <span class="font-bold text-lg leading-none text-primary block">{{ Str::before($situs['nama_situs'] ?? 'KONI', ' ') }}</span>
                    <span class="text-xs font-medium tracking-widest uppercase text-gray-400 block">{{ Str::after($situs['nama_situs'] ?? 'KONI Papua Pegunungan', ' ') }}</span>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-6">
                @php $user = session('user'); @endphp

                @if ($user && $user['role'] === 'admin_master')
                    {{-- Admin Master Menu --}}
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Utama</p>
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-tachometer-alt w-6 text-center"></i>
                            <span>Dasbor</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Pengaturan</p>
                        <a href="{{ route('admin.pengaturan-situs') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('admin.pengaturan-situs') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-cog w-6 text-center"></i>
                            <span>Pengaturan Situs</span>
                        </a>
                        <a href="{{ route('admin.backup-database') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('admin.backup-database') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-database w-6 text-center"></i>
                            <span>Backup Database</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Pengguna</p>
                        <a href="{{ route('admin.pengguna.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('admin.pengguna.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-users w-6 text-center"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                        <a href="{{ route('admin.aktivitas-login') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('admin.aktivitas-login') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-history w-6 text-center"></i>
                            <span>Aktivitas Login</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Laporan</p>
                        <a href="{{ route('admin.statistik-pengunjung') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('admin.statistik-pengunjung') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-chart-bar w-6 text-center"></i>
                            <span>Statistik Pengunjung</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Lainnya</p>
                        <a href="{{ route('admin.dokumentasi') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('admin.dokumentasi') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-book w-6 text-center"></i>
                            <span>Dokumentasi</span>
                        </a>
                    </div>
                @endif

                @if ($user && $user['role'] === 'penulis')
                    {{-- Penulis Menu --}}
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Utama</p>
                        <a href="{{ route('penulis.dashboard') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.dashboard') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-tachometer-alt w-6 text-center"></i>
                            <span>Dasbor</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Konten</p>
                        <a href="{{ route('penulis.berita.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.berita.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-newspaper w-6 text-center"></i>
                            <span>Berita</span>
                        </a>
                        <a href="{{ route('penulis.kategori-berita.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.kategori-berita.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-tags w-6 text-center"></i>
                            <span>Kategori Berita</span>
                        </a>
                        <a href="{{ route('penulis.kegiatan.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.kegiatan.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-calendar-alt w-6 text-center"></i>
                            <span>Kegiatan</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Olahraga</p>
                        <a href="{{ route('penulis.cabang-olahraga.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.cabang-olahraga.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-running w-6 text-center"></i>
                            <span>Cabang Olahraga</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Media</p>
                        <a href="{{ route('penulis.media.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.media.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-photo-video w-6 text-center"></i>
                            <span>Media</span>
                        </a>
                        <a href="{{ route('penulis.galeri.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.galeri.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-images w-6 text-center"></i>
                            <span>Galeri</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Laporan</p>
                        <a href="{{ route('penulis.statistik-pengunjung') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.statistik-pengunjung') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-chart-bar w-6 text-center"></i>
                            <span>Statistik Pengunjung</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Lainnya</p>
                        <a href="{{ route('penulis.dokumentasi') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.dokumentasi') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-book w-6 text-center"></i>
                            <span>Dokumentasi</span>
                        </a>
                    </div>
                @endif
            </nav>

            {{-- Sidebar Footer --}}
            <div class="px-4 py-4 border-t border-gray-800">
                <a href="{{ route('beranda') }}" class="flex items-center space-x-3 px-3 py-2 text-sm text-gray-400 hover:text-white transition">
                    <i class="fas fa-globe w-6 text-center"></i>
                    <span>Lihat Website</span>
                </a>
            </div>
        </aside>

        {{-- Main Area --}}
        <div class="flex-1 flex flex-col min-w-0 lg:ml-72">

            {{-- Top Bar --}}
            <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center space-x-4">
                    <button @click="mobileSidebar = !mobileSidebar" class="lg:hidden text-xl text-gray-600">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-xl font-extrabold text-dark uppercase tracking-wide">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-base font-bold text-dark">{{ session('user.name', 'User') }}</p>
                        <p class="text-sm text-gray-400 capitalize">{{ str_replace('_', ' ', session('user.role', '')) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-primary text-white flex items-center justify-center font-bold text-base">
                        {{ strtoupper(substr(session('user.name', 'U'), 0, 1)) }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-primary transition text-lg" title="Logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-6">
                <x-flash-alert />

                @yield('content')
            </main>

        </div>

    </div>

<x-confirm-modal />
@stack('scripts')
</body>
</html>
