@extends('layouts.visitor')
@section('title', 'KDK')
@section('seo-title', 'Kabar Dari Kampung (KDK) — Buletin YPMD-IRJA')
@section('seo-description', 'Arsip buletin Kabar Dari Kampung, media alternatif masyarakat desa di Irian Jaya / Papua sekarang sejak 1982.')

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Kabar Dari Kampung']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › KDK</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Kabar Dari Kampung</h1>
            <p class="text-primary-200 mt-2 text-lg">Buletin — Media Alternatif Masyarakat Desa di Irian Jaya / Papua Sekarang</p>
        </div>
    </div>

    <section class="py-16 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white shadow-card p-8 md:p-12 mb-12 fade-in">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-book-open mr-2"></i>Tentang KDK</p>
                        <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-4">Apa itu KDK?</h2>
                        <p class="text-neutral-600 leading-relaxed mb-3"><em>Kabar Dari Kampung</em> (KDK) adalah buletin yang pertama kali diterbitkan pada tahun 1982 oleh kelompok idealis yang kemudian mendirikan YPMD-IRJA. Buletin ini hadir sebagai media alternatif yang menyuarakan realita kehidupan masyarakat desa di Irian Jaya / Papua sekarang.</p>
                        <p class="text-neutral-600 leading-relaxed">KDK mendokumentasikan berbagai isu penting: hak tanah adat, pengorganisasian komunitas, perkembangan program pemberdayaan, serta berbagai cerita dari kampung-kampung di seluruh Papua.</p>
                    </div>
            <div class="grid grid-cols-2 gap-4">
                        <div class="bg-neutral-50 rounded p-4 text-center shadow-sm">
                            <div class="text-2xl font-display font-bold text-primary-200">1982</div>
                            <div class="text-xs text-neutral-400 mt-1">Berdiri</div>
                        </div>
                        <div class="bg-neutral-50 rounded p-4 text-center shadow-sm">
                            <div class="text-2xl font-display font-bold text-primary-200">{{ $kdkList->total() }}+</div>
                            <div class="text-xs text-neutral-400 mt-1">Edisi Terbit</div>
                        </div>
                        <div class="bg-neutral-50 rounded p-4 text-center shadow-sm">
                            <div class="text-2xl font-display font-bold text-primary-200">{{ number_format($kdkList->sum('jumlah_dibaca')) }}</div>
                            <div class="text-xs text-neutral-400 mt-1">Total Pembaca</div>
                        </div>
                        <div class="bg-neutral-50 rounded p-4 text-center shadow-sm">
                            <div class="text-2xl font-display font-bold text-primary-200">{{ number_format($kdkList->sum('jumlah_unduhan')) }}</div>
                            <div class="text-xs text-neutral-400 mt-1">Total Unduhan</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                {{-- Main Content --}}
                <div class="lg:col-span-3">
                    <div class="mb-10 fade-in">
                        <h3 class="text-xl font-display font-bold text-neutral-900 mb-2">Arsip Edisi KDK</h3>
                        <p class="text-neutral-500">Unduh edisi-edisi buletin Kabar Dari Kampung dalam format PDF.</p>
                    </div>

                    @if (request('cari'))
                        <div class="mb-6 flex items-center gap-3 text-sm text-neutral-500">
                            <span>Hasil pencarian: <strong class="text-neutral-900">"{{ request('cari') }}"</strong></span>
                            <a href="{{ route('kdk', $tahunAktif ? ['tahun' => $tahunAktif] : []) }}" class="text-primary-600 hover:underline text-xs">
                                <i class="fa-solid fa-times mr-1"></i>Hapus
                            </a>
                        </div>
                    @endif

                    @if ($tahunAktif)
                        <div class="mb-6 flex items-center gap-3 text-sm text-neutral-500">
                            <span>Filter tahun: <strong class="text-neutral-900">{{ $tahunAktif }}</strong></span>
                            <a href="{{ route('kdk', request('cari') ? ['cari' => request('cari')] : []) }}" class="text-primary-600 hover:underline text-xs">
                                <i class="fa-solid fa-times mr-1"></i>Hapus filter
                            </a>
                        </div>
                    @endif

                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($kdkList as $k)
                            <x-kdk-card :kdk="$k" />
                        @empty
                            <div class="col-span-full text-center py-12 text-neutral-400">
                                <i class="fa-solid fa-book-open text-4xl mb-4 block"></i>
                                <p>Belum ada edisi KDK yang ditemukan.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if ($kdkList->hasPages())
                        <div class="mt-8">{{ $kdkList->links() }}</div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    {{-- Pencarian --}}
                    <div class="bg-white shadow-card p-6">
                        <h4 class="font-display font-bold text-sm uppercase mb-4 pb-3 border-b-2 border-primary-500">
                            <i class="fa-solid fa-magnifying-glass mr-2"></i>Cari Buletin
                        </h4>
                        <form method="GET" action="{{ route('kdk') }}">
                            @if ($tahunAktif)
                                <input type="hidden" name="tahun" value="{{ $tahunAktif }}">
                            @endif
                            <div class="relative">
                                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari buletin..."
                                       class="w-full border border-neutral-300 p-3 pr-10 text-sm focus:border-primary-400 focus:outline-none transition">
                                <button type="submit" class="absolute right-0 top-0 h-full px-3 text-neutral-400 hover:text-primary-500 transition">
                                    <i class="fa-solid fa-search text-sm"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Daftar Tahun --}}
                    <div class="bg-white shadow-card p-6">
                        <h4 class="font-display font-bold text-sm uppercase mb-4 pb-3 border-b-2 border-primary-500">
                            <i class="fa-solid fa-calendar-days mr-2"></i>Arsip Tahun
                        </h4>
                        <ul class="space-y-1">
                            @foreach ($tahunList as $t)
                                <li>
                                    <a href="{{ route('kdk', array_filter(['tahun' => $t->tahun, 'cari' => request('cari')])) }}"
                                       class="flex justify-between items-center py-2 text-sm hover:text-primary-600 transition {{ $tahunAktif == $t->tahun ? 'text-primary-600 font-semibold' : 'text-neutral-600' }}">
                                        <span>{{ $t->tahun }}</span>
                                        <span class="bg-neutral-200 text-neutral-600 text-xs px-2 py-0.5 font-bold">{{ $t->jumlah }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Tombol Semua --}}
                    <a href="{{ route('kdk') }}"
                       class="{{ !$tahunAktif && !request('cari') ? 'bg-primary-500' : 'bg-neutral-800' }} text-white p-4 block hover:bg-primary-600 transition text-center">
                        <span class="font-semibold text-sm uppercase">Semua Edisi KDK</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
