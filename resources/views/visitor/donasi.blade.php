@extends('layouts.visitor')
@section('title', 'Donasi - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Donasi untuk ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-description', 'Dukung program pemberdayaan masyarakat desa di Irian Jaya / Papua sekarang melalui donasi kepada ' . ($situs['nama_situs'] ?? 'YPMD IRJA') . '.')

@section('json-ld')
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>route('beranda')],['@type'=>'ListItem','position'=>2,'name'=>'Donasi']]], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('content')
    {{-- Floating Sidebar Navigation --}}
    <nav id="donasi-sidebar" class="hidden lg:flex fixed right-6 top-1/2 -translate-y-1/2 z-50 flex-col gap-2">
        @if ($programs->isNotEmpty())
        <a href="#program-donasi" class="donasi-nav-item group flex items-center gap-2 justify-end" data-section="program-donasi">
            <span class="nav-label hidden group-hover:block bg-neutral-800 text-white text-xs px-3 py-1.5 whitespace-nowrap shadow-lg">Program Donasi</span>
            <span class="w-9 h-9 flex items-center justify-center bg-white shadow-card border border-neutral-200 text-neutral-400 hover:bg-primary-500 hover:text-white hover:border-primary-500 transition-all">
                <i class="fa-solid fa-hand-holding-heart text-xs"></i>
            </span>
        </a>
        @endif
        @if ($testimoni->isNotEmpty())
        <a href="#testimoni" class="donasi-nav-item group flex items-center gap-2 justify-end" data-section="testimoni">
            <span class="nav-label hidden group-hover:block bg-neutral-800 text-white text-xs px-3 py-1.5 whitespace-nowrap shadow-lg">Pesan Donatur</span>
            <span class="w-9 h-9 flex items-center justify-center bg-white shadow-card border border-neutral-200 text-neutral-400 hover:bg-primary-500 hover:text-white hover:border-primary-500 transition-all">
                <i class="fa-solid fa-quote-left text-xs"></i>
            </span>
        </a>
        @endif
        <a href="#rekening" class="donasi-nav-item group flex items-center gap-2 justify-end" data-section="rekening">
            <span class="nav-label hidden group-hover:block bg-neutral-800 text-white text-xs px-3 py-1.5 whitespace-nowrap shadow-lg">Rekening</span>
            <span class="w-9 h-9 flex items-center justify-center bg-white shadow-card border border-neutral-200 text-neutral-400 hover:bg-primary-500 hover:text-white hover:border-primary-500 transition-all">
                <i class="fa-solid fa-building-columns text-xs"></i>
            </span>
        </a>
        <a href="#form-donasi" class="donasi-nav-item group flex items-center gap-2 justify-end" data-section="form-donasi">
            <span class="nav-label hidden group-hover:block bg-neutral-800 text-white text-xs px-3 py-1.5 whitespace-nowrap shadow-lg">Form Donasi</span>
            <span class="w-9 h-9 flex items-center justify-center bg-white shadow-card border border-neutral-200 text-neutral-400 hover:bg-primary-500 hover:text-white hover:border-primary-500 transition-all">
                <i class="fa-solid fa-pen-to-square text-xs"></i>
            </span>
        </a>
        <a href="#penutup" class="donasi-nav-item group flex items-center gap-2 justify-end" data-section="penutup">
            <span class="nav-label hidden group-hover:block bg-neutral-800 text-white text-xs px-3 py-1.5 whitespace-nowrap shadow-lg">Terima Kasih</span>
            <span class="w-9 h-9 flex items-center justify-center bg-white shadow-card border border-neutral-200 text-neutral-400 hover:bg-primary-500 hover:text-white hover:border-primary-500 transition-all">
                <i class="fa-solid fa-heart text-xs"></i>
            </span>
        </a>
    </nav>

    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Donasi</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Donasi</h1>
            <p class="text-primary-200 mt-2 text-lg">Bersama Membangun Papua yang Bermartabat</p>
        </div>
    </div>

    {{-- Program Donasi --}}
    @if ($programs->isNotEmpty())
    <section id="program-donasi" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-hand-holding-heart mr-2"></i>Program Kami</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Pilih Program Donasi</h2>
                <p class="text-neutral-500 mt-3">Setiap donasi disalurkan langsung ke program yang Anda pilih.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($programs as $prog)
                <div class="bg-white shadow-card border border-neutral-100 fade-in flex flex-col">
                    <img src="{{ $prog->gambar }}" alt="{{ $prog->judul }}" class="w-full h-48 object-cover">
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="font-display font-bold text-neutral-900 mb-2">{{ $prog->judul }}</h3>
                        <p class="text-sm text-neutral-500 mb-4 flex-1 line-clamp-3">{{ Str::limit(strip_tags($prog->deskripsi), 150) }}</p>

                        @if ($prog->target_nominal)
                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-neutral-500 mb-1">
                                <span>Terkumpul: <strong class="text-primary-600">{{ $prog->terkumpul_format }}</strong></span>
                                <span>Target: {{ $prog->target_format }}</span>
                            </div>
                            <div class="w-full bg-neutral-200 h-2">
                                <div class="bg-primary-500 h-2 transition-all" style="width: {{ $prog->progress_persen ?? 0 }}%"></div>
                            </div>
                        </div>
                        @endif

                        <a href="#form-donasi" onclick="pilihProgram({{ $prog->id }}, '{{ addslashes($prog->judul) }}')"
                           class="block text-center bg-primary-500 text-white py-3 font-semibold text-sm hover:bg-primary-600 transition-colors uppercase tracking-wide">
                            <i class="fa-solid fa-heart mr-2"></i>Donasi Sekarang
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Testimoni / Pesan Donatur --}}
    @if ($testimoni->isNotEmpty())
    <section id="testimoni" class="py-16 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-quote-left mr-2"></i>Pesan Donatur</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Pesan & Doa dari Para Donatur</h2>
                <p class="text-neutral-500 mt-3">Terima kasih atas dukungan dan doa yang telah diberikan.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($testimoni as $testi)
                <div class="bg-white shadow-card p-6 fade-in flex flex-col">
                    <div class="text-primary-300 mb-3">
                        <i class="fa-solid fa-quote-left text-2xl"></i>
                    </div>
                    <p class="text-sm text-neutral-600 flex-1 italic leading-relaxed">"{{ Str::limit($testi->pesan, 200) }}"</p>
                    <div class="mt-4 pt-4 border-t border-neutral-100 flex items-center gap-3">
                        <div class="w-9 h-9 bg-primary-100 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-user text-primary-500 text-xs"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-neutral-800 truncate">{{ $testi->nama_tampil }}</p>
                            <p class="text-xs text-neutral-400">
                                {{ $testi->jumlah_format }}
                                @if ($testi->programDonasi)
                                    · {{ Str::limit($testi->programDonasi->judul, 30) }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Info Rekening BNI --}}
    <section id="rekening" class="py-12 bg-{{ $testimoni->isNotEmpty() ? 'white' : 'neutral-50' }}">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white shadow-card p-8 fade-in">
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-primary-50 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-building-columns text-primary-500 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-1">Rekening Donasi</p>
                        <h3 class="font-display font-bold text-neutral-900 text-xl mb-3">Bank {{ \App\Models\ProgramDonasi::BANK_NAMA }}</h3>
                        <div class="bg-neutral-50 p-4 border border-neutral-100 inline-flex items-center gap-4">
                            <div>
                                <p id="norek-text" class="font-mono font-bold text-xl text-neutral-900 tracking-wider">{{ \App\Models\ProgramDonasi::BANK_NO_REKENING }}</p>
                                <p class="text-sm text-neutral-500 mt-1">a.n. {{ \App\Models\ProgramDonasi::BANK_ATAS_NAMA }}</p>
                            </div>
                            <button type="button" onclick="copyNorek()" id="btn-copy-norek"
                                    class="flex-shrink-0 bg-primary-500 hover:bg-primary-600 text-white px-4 py-2.5 text-sm font-semibold transition-colors flex items-center gap-2">
                                <i class="fa-regular fa-copy"></i>
                                <span id="copy-norek-label">Salin</span>
                            </button>
                        </div>
                        <p class="text-sm text-neutral-500 mt-4">Setelah transfer, lengkapi formulir di bawah untuk konfirmasi donasi Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Form Konfirmasi Donasi --}}
    <section class="py-16 bg-white" id="form-donasi">
        <div class="max-w-7xl mx-auto px-6">
            @if (session('success'))
                <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-800 text-sm font-semibold">
                    <i class="fa-solid fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif
            <div class="text-center mb-10 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2">Konfirmasi</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Sudah Transfer? Konfirmasi di Sini</h2>
                <p class="text-neutral-500 mt-3">Isi formulir berikut setelah melakukan transfer.</p>
            </div>
            <div class="bg-neutral-50 shadow-card p-8 fade-in" x-data="donasiForm()">
                <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    {{-- Pilih Program --}}
                    <div>
                        <label class="text-xs font-semibold uppercase text-neutral-500 block mb-1">Program Donasi <span class="text-red-500">*</span></label>
                        <select name="program_donasi_id" id="program_donasi_id" required
                                class="w-full border border-neutral-300 p-3 text-sm focus:border-primary-500 focus:outline-none transition bg-white">
                            <option value="">-- Pilih Program --</option>
                            @foreach ($programs as $prog)
                                <option value="{{ $prog->id }}" {{ old('program_donasi_id') == $prog->id ? 'selected' : '' }}>{{ $prog->judul }}</option>
                            @endforeach
                        </select>
                        @error('program_donasi_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Nama + Anonim --}}
                    <div>
                        <label class="text-xs font-semibold uppercase text-neutral-500 block mb-1">Nama Donatur <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_donatur" required
                               x-model="namaDonatur"
                               :readonly="isAnonim"
                               :class="isAnonim ? 'bg-neutral-200 text-neutral-400' : ''"
                               class="w-full border border-neutral-300 p-3 text-sm focus:border-primary-500 focus:outline-none transition"
                               placeholder="Nama lengkap">
                        @error('nama_donatur') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <label class="flex items-center gap-2 mt-2 cursor-pointer">
                            <input type="checkbox" name="is_anonim" value="1" x-model="isAnonim"
                                   @change="if(isAnonim) { namaBkp = namaDonatur; namaDonatur = 'Anonim'; } else { namaDonatur = namaBkp || ''; }"
                                   class="w-4 h-4">
                            <span class="text-sm text-neutral-600">Donasi sebagai <strong>Anonim</strong></span>
                        </label>
                    </div>

                    {{-- Email & Telepon --}}
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="text-xs font-semibold uppercase text-neutral-500 block mb-1">Email</label>
                            <input type="email" name="email"
                                   value="{{ old('email') }}"
                                   class="w-full border border-neutral-300 p-3 text-sm focus:border-primary-500 focus:outline-none transition"
                                   placeholder="email@domain.com">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase text-neutral-500 block mb-1">Telepon / WhatsApp</label>
                            <input type="text" name="telepon"
                                   value="{{ old('telepon') }}"
                                   class="w-full border border-neutral-300 p-3 text-sm focus:border-primary-500 focus:outline-none transition"
                                   placeholder="08xxxxxxxxxx">
                            @error('telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Nominal Donasi --}}
                    <div>
                        <label class="text-xs font-semibold uppercase text-neutral-500 block mb-2">Nominal Donasi <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-3">
                            @foreach ([50000, 100000, 500000, 1000000] as $nominal)
                            <button type="button"
                                    @click="pilihNominal({{ $nominal }})"
                                    :class="selectedNominal === {{ $nominal }} ? 'bg-primary-500 text-white border-primary-500' : 'bg-white text-neutral-700 border-neutral-300 hover:border-primary-400'"
                                    class="border p-3 text-sm font-semibold transition text-center">
                                Rp {{ number_format($nominal, 0, ',', '.') }}
                            </button>
                            @endforeach
                        </div>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-neutral-400 font-semibold">Rp</span>
                            <input type="number" name="jumlah" required min="1"
                                   x-model="jumlah"
                                   @input="selectedNominal = null"
                                   class="w-full border border-neutral-300 p-3 pl-10 text-sm focus:border-primary-500 focus:outline-none transition"
                                   placeholder="Atau masukkan nominal lainnya">
                        </div>
                        @error('jumlah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Bukti Transfer --}}
                    <div>
                        <label class="text-xs font-semibold uppercase text-neutral-500 block mb-1">Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" accept="image/*,.pdf"
                               class="w-full border border-neutral-300 p-3 text-sm bg-white">
                        <p class="text-xs text-neutral-400 mt-1">Format: JPG, PNG, atau PDF. Maks 5 MB.</p>
                        @error('bukti_transfer') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Pesan --}}
                    <div>
                        <label class="text-xs font-semibold uppercase text-neutral-500 block mb-1">Pesan (opsional)</label>
                        <textarea name="pesan" rows="3"
                                  class="w-full border border-neutral-300 p-3 text-sm focus:border-primary-500 focus:outline-none transition resize-none"
                                  placeholder="Pesan atau doa untuk YPMD IRJA...">{{ old('pesan') }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-primary-500 text-white py-4 font-bold uppercase tracking-wide hover:bg-primary-600 transition-colors text-sm">
                        <i class="fa-solid fa-paper-plane mr-2"></i>Kirim Konfirmasi Donasi
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section id="penutup" class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6 text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-4">Terima Kasih atas Kepedulian Anda</h2>
            <p class="text-primary-200 text-lg">Bersama kita membangun Papua yang bermartabat, mandiri, dan berdaulat.</p>
        </div>
    </section>

    <script>
    function pilihProgram(id, judul) {
        const sel = document.getElementById('program_donasi_id');
        if (sel) sel.value = id;
    }

    function copyNorek() {
        const norek = '{{ \App\Models\ProgramDonasi::BANK_NO_REKENING }}'.replace(/-/g, '');
        navigator.clipboard.writeText(norek).then(() => {
            const label = document.getElementById('copy-norek-label');
            const btn = document.getElementById('btn-copy-norek');
            const icon = btn.querySelector('i');
            label.textContent = 'Tersalin!';
            icon.className = 'fa-solid fa-check';
            btn.classList.remove('bg-primary-500', 'hover:bg-primary-600');
            btn.classList.add('bg-green-500', 'hover:bg-green-600');
            setTimeout(() => {
                label.textContent = 'Salin';
                icon.className = 'fa-regular fa-copy';
                btn.classList.remove('bg-green-500', 'hover:bg-green-600');
                btn.classList.add('bg-primary-500', 'hover:bg-primary-600');
            }, 2000);
        });
    }

    function donasiForm() {
        return {
            isAnonim: {{ old('is_anonim') ? 'true' : 'false' }},
            namaDonatur: '{{ old('nama_donatur', old('is_anonim') ? 'Anonim' : '') }}',
            namaBkp: '',
            jumlah: '{{ old('jumlah', '') }}',
            selectedNominal: null,
            pilihNominal(nominal) {
                this.jumlah = nominal;
                this.selectedNominal = nominal;
            }
        };
    }

    // Sidebar active section highlight
    document.addEventListener('DOMContentLoaded', () => {
        const navItems = document.querySelectorAll('.donasi-nav-item');
        if (!navItems.length) return;

        const sections = [];
        navItems.forEach(item => {
            const id = item.dataset.section;
            const el = document.getElementById(id);
            if (el) sections.push({ id, el });
        });

        function updateActive() {
            let currentId = sections[0]?.id;
            const scrollY = window.scrollY + window.innerHeight / 3;

            sections.forEach(({ id, el }) => {
                if (el.offsetTop <= scrollY) currentId = id;
            });

            navItems.forEach(item => {
                const span = item.querySelector('span:last-child');
                if (item.dataset.section === currentId) {
                    span.classList.add('bg-primary-500', 'text-white', 'border-primary-500');
                    span.classList.remove('bg-white', 'text-neutral-400', 'border-neutral-200');
                } else {
                    span.classList.remove('bg-primary-500', 'text-white', 'border-primary-500');
                    span.classList.add('bg-white', 'text-neutral-400', 'border-neutral-200');
                }
            });
        }

        window.addEventListener('scroll', updateActive, { passive: true });
        updateActive();
    });
    </script>
@endsection
