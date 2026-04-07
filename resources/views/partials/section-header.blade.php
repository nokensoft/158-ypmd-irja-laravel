{{-- Section Header: title left, breadcrumb right, polygonal background --}}
<div class="bg-primary-600 py-16 relative overflow-hidden">
    {{-- Polygonal overlay --}}
    <svg class="absolute inset-0 w-full h-full pointer-events-none" preserveAspectRatio="none" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg" style="z-index:1;opacity:.08">
        <polygon fill="#ffffff" points="0,320 200,180 400,280 600,120 800,220 1000,80 1200,200 1440,100 1440,320"/>
        <polygon fill="#ffffff" points="0,320 150,240 350,300 550,180 750,260 950,140 1150,240 1350,160 1440,200 1440,320" style="opacity:.5"/>
        <polygon fill="#ffffff" points="0,320 100,280 300,320 500,240 700,300 900,200 1100,280 1300,220 1440,260 1440,320" style="opacity:.3"/>
    </svg>
    <div class="absolute inset-0 pointer-events-none" style="z-index:1;overflow:hidden">
        <div style="position:absolute;top:-40%;right:-10%;width:55%;height:180%;background:rgba(255,255,255,.04);transform:rotate(-15deg)"></div>
        <div style="position:absolute;bottom:-30%;left:-8%;width:40%;height:140%;background:rgba(255,255,255,.02);transform:rotate(20deg)"></div>
    </div>

    {{-- Content --}}
    <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        {{-- Left: title, subtitle, meta --}}
        <div>
            <h1 class="text-2xl md:text-3xl lg:text-4xl font-display font-bold text-white leading-tight">{{ $headerTitle }}</h1>
            @if (!empty($headerSubtitle))
                <p class="text-primary-200 mt-2 text-lg max-w-2xl">{{ $headerSubtitle }}</p>
            @endif
            @if (!empty($headerMeta))
                <p class="text-primary-200 mt-2 text-sm">{!! $headerMeta !!}</p>
            @endif
        </div>

        {{-- Right: breadcrumb --}}
        <nav aria-label="Breadcrumb" class="flex items-center text-xs lg:text-sm text-primary-200 uppercase tracking-widest flex-shrink-0 whitespace-nowrap">
            <a href="{{ route('beranda') }}" class="hover:text-white transition flex items-center gap-1.5">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            {!! $headerBreadcrumb !!}
        </nav>
    </div>
</div>
