<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $seoTitle = View::yieldContent('seo-title', $situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan');
        $seoDesc = View::yieldContent('seo-description', $situs['seo_meta_description'] ?? '');
        $seoImage = View::yieldContent('seo-image', !empty($situs['seo_og_image']) ? asset('storage/' . $situs['seo_og_image']) : asset('img/logo-koni-papua-pegunungan-transparant.png'));
        $seoKeywords = $situs['seo_meta_keywords'] ?? '';
    @endphp

    <title>@yield('title', $seoTitle)</title>
    <meta name="description" content="{{ $seoDesc }}">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og-type', 'website')">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDesc }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $situs['nama_situs'] ?? 'KONI Papua Pegunungan' }}">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDesc }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    @if (!empty($situs['logo']))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $situs['logo']) }}">
    @else
        <link rel="icon" type="image/jpeg" href="{{ asset('img/logo-koni-papua-pegunungan.jpeg') }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans text-lg">

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

    {{-- Back to Top --}}
    <div x-data="scrollTop">
        <button x-show="visible" @click="goTop()" x-transition
            class="fixed bottom-6 right-6 bg-primary text-white w-14 h-14 flex items-center justify-center shadow-lg hover:bg-red-700 transition z-50 no-round">
            <i class="fas fa-chevron-up text-lg"></i>
        </button>
    </div>

</body>
</html>
