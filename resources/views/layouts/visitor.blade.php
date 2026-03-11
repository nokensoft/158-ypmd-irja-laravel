<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $seoTitle = View::yieldContent('seo-title', $situs['nama_situs'] ?? 'YPMD IRJA');
        $seoDesc = View::yieldContent('seo-description', $situs['seo_meta_description'] ?? '');
        $seoImage = View::yieldContent('seo-image', !empty($situs['seo_og_image']) ? asset('storage/' . $situs['seo_og_image']) : asset('img/logo-ypmd-irja.png'));
        $seoKeywords = $situs['seo_meta_keywords'] ?? '';
    @endphp

    <title>@yield('title', $seoTitle) — YPMD IRJA</title>
    <meta name="description" content="{{ $seoDesc }}">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og-type', 'website')">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDesc }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $situs['nama_situs'] ?? 'YPMD IRJA' }}">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDesc }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    @if (!empty($situs['logo']))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $situs['logo']) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('img/logo-ypmd-irja.png') }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-neutral-800 font-sans" style="font-size:15px">

    {{-- Page Loading --}}
    @include('partials.page-loading')

    {{-- Disclaimer Modal --}}
    {{-- @include('partials.disclaimer') --}}

    {{-- Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main>
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
