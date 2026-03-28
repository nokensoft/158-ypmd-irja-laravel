<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    @if (!empty($situs['logo']))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $situs['logo']) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('img/logo-ypmd-irja.png') }}">
    @endif
    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    primary: { 50:'#f0f7f2',100:'#d9ede0',200:'#b4dbc3',300:'#82c19e',400:'#4fa174',500:'#2d8057',600:'#1f6642',700:'#1a5236',800:'#163f2b',900:'#0f2b1d',DEFAULT:'#2d8057' },
                    accent:  { 50:'#fdf8ee',100:'#f9eccc',200:'#f2d68d',300:'#e8bc4f',400:'#c9972a',500:'#a67820',DEFAULT:'#c9972a' },
                    neutral: { 50:'#fafafa',100:'#f4f4f4',200:'#e8e8e8',300:'#d0d0d0',400:'#a0a0a0',500:'#707070',600:'#505050',700:'#383838',800:'#242424',900:'#141414' },
                    dark: '#1A1A1A'
                },
                fontFamily: {
                    display: ['Lora','Georgia','serif'],
                    sans: ['"Plus Jakarta Sans"','ui-sans-serif','system-ui','sans-serif']
                },
                boxShadow: {
                    'card': '0 2px 12px rgba(0,0,0,0.08)',
                    'card-hover': '0 6px 24px rgba(0,0,0,0.12)'
                }
            }}
        }
    </script>
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Lora', Georgia, serif; }
        [x-cloak] { display: none !important; }
        /* No rounded corners */
        .no-round { border-radius: 0 !important; }
        /* Line clamp */
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        /* CKEditor 5 overrides */
        .ck.ck-editor__main > .ck-editor__editable, .ck.ck-toolbar, .ck.ck-editor { border-radius: 0 !important; }
        .ck.ck-toolbar { background: #f9fafb !important; border-color: #d1d5db !important; padding: 6px 8px !important; }
        .ck.ck-button, .ck.ck-dropdown .ck-button { border-radius: 0 !important; }
        .ck.ck-button.ck-on, .ck.ck-button:hover { background: #2d8057 !important; color: #fff !important; }
        .ck.ck-editor__main > .ck-editor__editable { border-color: #d1d5db !important; min-height: 360px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1rem; line-height: 1.75; color: #1A1A1A; padding: 1.25rem !important; }
        .ck.ck-editor__main > .ck-editor__editable.ck-focused { border-color: #2d8057 !important; box-shadow: none !important; }
        .ck.ck-dropdown .ck-dropdown__panel { border-radius: 0 !important; }
        .ck.ck-list__item .ck-button:hover { background: #2d8057 !important; color: #fff !important; }
        .ck-content h2 { font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem; color: #1A1A1A; }
        .ck-content h3 { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; color: #1A1A1A; }
        .ck-content h4 { font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem; color: #374151; }
        .ck-content p { margin-bottom: 0.75rem; }
        .ck-content a { color: #2d8057; text-decoration: underline; }
        .ck-content blockquote { border-left: 4px solid #2d8057; padding-left: 1rem; margin: 1rem 0; color: #4b5563; font-style: italic; }
        .ck-content ul, .ck-content ol { padding-left: 1.5rem; margin-bottom: 0.75rem; }
        .ck-content ul { list-style-type: disc; }
        .ck-content ol { list-style-type: decimal; }
        .ck-content li { margin-bottom: 0.25rem; }
        .ck-content table { width: 100%; border-collapse: collapse; margin: 1rem 0; }
        .ck-content table td, .ck-content table th { border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; }
        .ck-content table th { background: #f3f4f6; font-weight: 700; }
    </style>
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
                    <img src="{{ asset('storage/' . $situs['logo']) }}" alt="Logo {{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}" class="h-10">
                @else
                    <img src="{{ asset('img/logo-ypmd-irja.png') }}" alt="Logo" class="h-10 object-contain" onerror="this.style.display='none'">
                @endif
                <div>
                    <span class="font-bold text-sm leading-tight text-primary block">{{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}</span>
                    <span class="text-xs font-medium tracking-widest uppercase text-gray-400 block">{{ session('user.role') === 'admin_master' ? 'Admin' : 'Penulis' }}</span>
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
                        <a href="{{ route('beranda') }}" target="_blank"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round text-gray-300 hover:bg-gray-800 hover:text-white">
                            <i class="fas fa-globe w-6 text-center"></i>
                            <span>Lihat Website</span>
                            <i class="fas fa-external-link-alt text-xs ml-auto opacity-50"></i>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Konten</p>
                        <a href="{{ route('admin.halaman.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('admin.halaman.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-file-alt w-6 text-center"></i>
                            <span>Halaman</span>
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
                        <a href="{{ route('admin.backup-storage') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('admin.backup-storage') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-folder-open w-6 text-center"></i>
                            <span>Backup Storage</span>
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
                        <a href="{{ route('beranda') }}" target="_blank"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round text-gray-300 hover:bg-gray-800 hover:text-white">
                            <i class="fas fa-globe w-6 text-center"></i>
                            <span>Lihat Website</span>
                            <i class="fas fa-external-link-alt text-xs ml-auto opacity-50"></i>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Papua Today</p>
                        <a href="{{ route('penulis.berita.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.berita.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-newspaper w-6 text-center"></i>
                            <span>Artikel</span>
                        </a>
                        <a href="{{ route('penulis.kategori-berita.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.kategori-berita.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-tags w-6 text-center"></i>
                            <span>Kategori</span>
                        </a>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">KdK</p>
                        <a href="{{ route('penulis.kdk.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.KdK.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-book-open w-6 text-center"></i>
                            <span>Edisi KdK</span>
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
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Donasi</p>
                        <a href="{{ route('penulis.program-donasi.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.program-donasi.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-hand-holding-heart w-6 text-center"></i>
                            <span>Program Donasi</span>
                        </a>
                        <a href="{{ route('penulis.donasi.index') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.donasi.*') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-heart w-6 text-center"></i>
                            <span>Kelola Donasi</span>
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
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3 px-3">Pengguna</p>
                        <a href="{{ route('penulis.aktivitas-login') }}"
                           class="flex items-center space-x-3 px-3 py-3 text-base font-medium transition no-round {{ request()->routeIs('penulis.aktivitas-login') ? 'bg-primary text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <i class="fas fa-history w-6 text-center"></i>
                            <span>Aktivitas Login</span>
                        </a>
                    </div>
                @endif
            </nav>

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
                @php $dashPrefix = session('user.role') === 'admin_master' ? 'admin' : 'penulis'; @endphp
                <div class="flex items-center space-x-4" x-data="{ profileOpen: false }">
                    <div class="relative">
                        <button @click="profileOpen = !profileOpen" class="flex items-center space-x-3 cursor-pointer select-none">
                            <div class="text-right hidden sm:block">
                                <p class="text-base font-bold text-dark">{{ session('user.name', 'User') }}</p>
                                <p class="text-sm text-gray-400 capitalize">{{ str_replace('_', ' ', session('user.role', '')) }}</p>
                            </div>
                            <div class="w-10 h-10 bg-primary text-white flex items-center justify-center font-bold text-base">
                                {{ strtoupper(substr(session('user.name', 'U'), 0, 1)) }}
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200" :class="profileOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="profileOpen" @click.outside="profileOpen = false" x-transition style="display:none;"
                             class="absolute right-0 top-full mt-2 w-52 bg-white border border-gray-200 shadow-lg z-50 overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-bold text-dark">{{ session('user.name', 'User') }}</p>
                                <p class="text-xs text-gray-400">{{ session('user.email', '') }}</p>
                            </div>
                            <a href="{{ route("{$dashPrefix}.profil") }}"
                               class="w-full flex items-center gap-2.5 px-4 py-3 hover:bg-gray-50 transition-colors text-left text-gray-600 text-sm">
                                <i class="fas fa-user-pen w-5 text-center"></i> Edit Profil
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-2.5 px-4 py-3 hover:bg-red-50 hover:text-red-600 transition-colors text-left text-gray-600 text-sm border-t border-gray-100">
                                    <i class="fas fa-sign-out-alt w-5 text-center"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-6">
                <x-flash-alert />

                @yield('content')
            </main>

            {{-- Footer --}}
            @php
                $faqPage = $halamanFooter->firstWhere('slug', 'faq');
                $disclaimerPage = $halamanFooter->firstWhere('slug', 'disclaimer');
            @endphp
            <footer class="bg-white border-t border-gray-200 px-6 py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-gray-500">
                    <p>&copy; {{ date('Y') }} {{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}</p>
                    <div class="flex items-center gap-3">
                        <a href="{{ route("{$dashPrefix}.dokumentasi") }}" class="hover:text-primary transition-colors">Dokumentasi</a>
                        @if ($faqPage)
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('halaman.show', $faqPage->slug) }}" target="_blank" class="hover:text-primary transition-colors">FAQ</a>
                        @endif
                        @if ($disclaimerPage)
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('halaman.show', $disclaimerPage->slug) }}" target="_blank" class="hover:text-primary transition-colors">Disclaimer</a>
                        @endif
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('peta-situs') }}" target="_blank" class="hover:text-primary transition-colors">Site Map</a>
                    </div>
                </div>
            </footer>

        </div>

    </div>

<x-confirm-modal />
<x-toast-notification />
@stack('scripts')
</body>
</html>
