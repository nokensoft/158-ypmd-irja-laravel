@props(['kdk'])

<article class="shadow-card card-hover bg-white border border-neutral-100 fade-in">
    {{-- Cover portrait --}}
    <div class="aspect-[2/3] relative overflow-hidden">
        @if ($kdk->media && $kdk->media->file_path)
            <img src="{{ asset('storage/' . $kdk->media->file_path) }}" alt="{{ $kdk->judul }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-b from-neutral-600 to-neutral-800 flex flex-col items-center justify-center relative">
                <div class="absolute inset-0 opacity-10" style="background:radial-gradient(circle at 70% 20%, white, transparent)"></div>
                <div class="absolute inset-x-0 top-0 h-1 bg-accent-400"></div>
                <div class="absolute inset-0 border-[6px] border-white/10 m-3"></div>
                <img src="{{ asset('img/logo-ypmd-irja.png') }}" alt="YPMD-IRJA" class="h-16 w-auto mb-4 opacity-75 relative z-10">
                <p class="text-white font-display font-extrabold text-2xl tracking-wider relative z-10">KDK</p>
                <p class="text-neutral-300 text-xs font-semibold uppercase tracking-widest mt-1 relative z-10">Edisi {{ $kdk->nomor_edisi }}</p>
                @if ($kdk->tanggal_terbit)
                    <p class="text-neutral-400 text-xs mt-2 relative z-10">{{ $kdk->tanggal_terbit->translatedFormat('F Y') }}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="p-5">
        <span class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">
            Edisi {{ $kdk->nomor_edisi }}
            @if ($kdk->tanggal_terbit) &bull; {{ $kdk->tanggal_terbit->translatedFormat('F Y') }} @endif
        </span>
        <h3 class="font-display font-bold text-neutral-900 mt-1 mb-2 line-clamp-2">
            <a href="{{ route('kdk.detail', $kdk->id) }}" class="hover:text-primary-600 transition-colors">{{ $kdk->judul }}</a>
        </h3>
        @if ($kdk->deskripsi)
            <p class="text-xs text-neutral-500 mb-3 line-clamp-2">{{ $kdk->deskripsi }}</p>
        @endif
        <div class="flex items-center gap-4 mb-3">
            <span class="inline-flex items-center gap-1 text-xs text-neutral-400">
                <i class="fa-solid fa-eye"></i> {{ number_format($kdk->jumlah_dibaca ?? 0) }} pembaca
            </span>
            <span class="inline-flex items-center gap-1 text-xs text-neutral-400">
                <i class="fa-solid fa-download"></i> {{ number_format($kdk->jumlah_unduhan ?? 0) }} unduhan
            </span>
        </div>
        @if ($kdk->file_pdf)
            <a href="{{ route('kdk.download', $kdk->id) }}"
               class="inline-flex items-center gap-2 bg-primary-500 text-white px-4 py-2 text-xs font-semibold hover:bg-primary-600 transition-colors">
                <i class="fa-solid fa-file-pdf"></i>Unduh PDF
            </a>
        @else
            <span class="inline-flex items-center gap-2 bg-neutral-100 text-neutral-400 px-4 py-2 text-xs font-semibold cursor-not-allowed">
                <i class="fa-solid fa-clock"></i>PDF Belum Tersedia
            </span>
        @endif
    </div>
</article>
