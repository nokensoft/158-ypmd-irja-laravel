<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $seoTitle = View::yieldContent('seo-title', $situs['nama_situs'] ?? 'YPMD-IRJA');
        $seoDesc = View::yieldContent('seo-description', $situs['seo_meta_description'] ?? '');
        $seoImage = View::yieldContent('seo-image', !empty($situs['seo_og_image']) ? asset('storage/' . $situs['seo_og_image']) : asset('img/logo-ypmd-irja.png'));
        $seoKeywords = $situs['seo_meta_keywords'] ?? '';
    @endphp

    <title>@yield('title', $seoTitle) — {{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}</title>
    <meta name="description" content="{{ $seoDesc }}">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og-type', 'website')">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDesc }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $situs['nama_situs'] ?? 'YPMD-IRJA' }}">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDesc }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    {{-- JSON-LD: Organization (semua halaman) --}}
    @php
        $orgSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $situs['nama_situs'] ?? 'YPMD-IRJA',
            'url' => url('/'),
            'logo' => !empty($situs['logo']) ? asset('storage/' . $situs['logo']) : asset('img/logo-ypmd-irja.png'),
            'description' => $situs['seo_meta_description'] ?? 'Yayasan Pembangunan Masyarakat Desa Irian Jaya',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Jayapura',
                'addressRegion' => 'Papua',
                'addressCountry' => 'ID',
            ],
        ];
        if (!empty($situs['email']) || !empty($situs['telepon'])) {
            $contact = ['@type' => 'ContactPoint', 'contactType' => 'customer service'];
            if (!empty($situs['telepon'])) $contact['telephone'] = $situs['telepon'];
            if (!empty($situs['email'])) $contact['email'] = $situs['email'];
            $orgSchema['contactPoint'] = $contact;
        }
        $socialLinks = collect(['sosmed_facebook','sosmed_instagram','sosmed_youtube','sosmed_twitter','sosmed_tiktok'])
            ->map(fn($key) => $situs[$key] ?? null)->filter()->values();
        if ($socialLinks->isNotEmpty()) {
            $orgSchema['sameAs'] = $socialLinks->toArray();
        }
    @endphp
    @php
        $webSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $situs['nama_situs'] ?? 'YPMD-IRJA',
            'url' => url('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/berita') . '?cari={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
        $jsonFlags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
    @endphp
    <script type="application/ld+json">{!! json_encode($orgSchema, $jsonFlags) !!}</script>
    <script type="application/ld+json">{!! json_encode($webSchema, $jsonFlags) !!}</script>

    {{-- Article meta tags (dari child view) --}}
    @yield('seo-article-meta')

    {{-- JSON-LD: BreadcrumbList (dari child view) --}}
    @yield('json-ld')

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
        html { scroll-behavior: smooth; font-size: 15px; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 15px; }
        h1, h2, h3, .font-display { font-family: 'Lora', Georgia, serif; }
        [x-cloak] { display: none !important; }
        /* Nav link underline */
        .nav-link { position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: #2d8057; transition: width .25s ease; }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        /* Fade-in */
        .fade-in { opacity: 0; transform: translateY(20px); transition: opacity .5s ease, transform .5s ease; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }
        /* Card hover */
        .card-hover { transition: box-shadow .2s ease, transform .2s ease; }
        .card-hover:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.12); transform: translateY(-2px); }
        /* Timeline */
        .timeline-wrap { position: relative; }
        .timeline-wrap::before { content: ''; position: absolute; left: 19px; top: 20px; bottom: 20px; width: 2px; background: linear-gradient(to bottom, #2d8057 0%, #e8e8e8 100%); z-index: 0; }
        .timeline-item { display: flex; gap: 20px; align-items: flex-start; position: relative; z-index: 1; }
        .timeline-icon { flex-shrink: 0; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; position: relative; z-index: 2; }
        .timeline-body { flex: 1; padding-bottom: 32px; padding-top: 8px; }
        .timeline-item:last-child .timeline-body { padding-bottom: 0; }
        /* No rounded corners */
        .no-round { border-radius: 0 !important; }
        /* Visitor main animation */
        .visitor-main { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        /* Page banner overlay */
        .page-banner::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(26,26,26,0.9) 0%, rgba(26,26,26,0.5) 100%); z-index: 1; }
        /* Line clamp */
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        /* Prose typography */
        .prose p { margin-bottom: 1.25rem; color: #374151; }
        .prose p:last-child { margin-bottom: 0; }
        .prose h2 { font-size: 1.5rem; font-weight: 800; margin-top: 2rem; margin-bottom: 0.75rem; color: #1A1A1A; }
        .prose h3 { font-size: 1.25rem; font-weight: 700; margin-top: 1.75rem; margin-bottom: 0.5rem; color: #1A1A1A; }
        .prose h4 { font-size: 1.125rem; font-weight: 700; margin-top: 1.5rem; margin-bottom: 0.5rem; color: #374151; }
        .prose a { color: #2d8057; text-decoration: underline; }
        .prose a:hover { color: #1f6642; }
        .prose blockquote { border-left: 4px solid #2d8057; padding-left: 1.25rem; margin: 1.5rem 0; color: #4b5563; font-style: italic; }
        .prose ul, .prose ol { padding-left: 1.5rem; margin-bottom: 1.25rem; }
        .prose ul { list-style-type: disc; }
        .prose ol { list-style-type: decimal; }
        .prose li { margin-bottom: 0.375rem; }
        .prose img { margin: 1.5rem 0; max-width: 100%; height: auto; }
        .prose table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; }
        .prose table td, .prose table th { border: 1px solid #d1d5db; padding: 0.625rem 0.875rem; }
        .prose table th { background: #f3f4f6; font-weight: 700; }
    </style>
</head>
<body class="bg-white text-neutral-800 font-sans" style="font-size:15px">

    {{-- Page Loading --}}
    @include('partials.page-loading')

    {{-- Disclaimer Modal --}}
    {{-- @include('partials.disclaimer') --}}

    {{-- Topbar --}}
    @include('partials.topbar')

    {{-- Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="visitor-main">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Fade-in + Back-to-top JS --}}
    <script>
        // Intersection observer for .fade-in elements
        const _fadeObserver = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    _fadeObserver.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.fade-in').forEach(el => _fadeObserver.observe(el));
        });
        // Back-to-top button
        const _btnTop = document.getElementById('btnTop');
        if (_btnTop) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    _btnTop.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                    _btnTop.classList.add('opacity-100', 'translate-y-0');
                } else {
                    _btnTop.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                    _btnTop.classList.remove('opacity-100', 'translate-y-0');
                }
            });
        }
    </script>

</body>
</html>
