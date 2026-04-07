<section class="page-banner relative py-20 lg:py-24 bg-neutral-900 overflow-hidden">
    {{-- Background image --}}
    <img src="{{ asset('img/galeri/Kantor YPMD-IRJA.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-20" alt="">

    {{-- Polygonal overlay --}}
    <svg class="absolute inset-0 w-full h-full pointer-events-none" preserveAspectRatio="none" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg" style="z-index:2;opacity:.12">
        <polygon fill="#2d8057" points="0,320 200,180 400,280 600,120 800,220 1000,80 1200,200 1440,100 1440,320"/>
        <polygon fill="#ffffff" points="0,320 150,240 350,300 550,180 750,260 950,140 1150,240 1350,160 1440,200 1440,320" style="opacity:.15"/>
        <polygon fill="#2d8057" points="0,320 100,280 300,320 500,240 700,300 900,200 1100,280 1300,220 1440,260 1440,320" style="opacity:.3"/>
    </svg>

    {{-- Diagonal geometric accents --}}
    <div class="absolute inset-0 pointer-events-none" style="z-index:2;overflow:hidden">
        <div style="position:absolute;top:-40%;right:-10%;width:55%;height:180%;background:rgba(45,128,87,.07);transform:rotate(-15deg)"></div>
        <div style="position:absolute;bottom:-30%;left:-8%;width:40%;height:140%;background:rgba(255,255,255,.03);transform:rotate(20deg)"></div>
    </div>

    {{-- Content: title left, breadcrumb right --}}
    <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        {{-- Left: title & subtitle --}}
        <div>
            <h2 class="text-3xl lg:text-5xl font-extrabold text-white uppercase leading-tight">{{ $title }}</h2>
            @if (!empty($subtitle))
                <p class="text-gray-400 mt-2 text-base lg:text-lg">{{ $subtitle }}</p>
            @endif
        </div>

        {{-- Right: breadcrumb navigation --}}
        <nav class="flex items-center text-sm lg:text-base text-gray-400 space-x-2 flex-shrink-0">
            <a href="{{ route('beranda') }}" class="hover:text-white transition flex items-center gap-1.5">
                <i class="fa-solid fa-house text-xs"></i> Beranda
            </a>
            <span class="text-gray-600">/</span>
            <span class="text-primary font-semibold">{!! $breadcrumb ?? e($title) !!}</span>
        </nav>
    </div>
</section>
