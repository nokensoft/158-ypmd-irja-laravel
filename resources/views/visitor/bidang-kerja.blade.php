@extends('layouts.visitor')
@section('title', 'Bidang Kerja - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-title', 'Bidang Kerja YPMD-IRJA')
@section('seo-description', 'Struktur bidang kerja YPMD-IRJA: Bidang Informasi, Bidang CBO & CBA, serta Bidang Administrasi dan Financial.')

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Tentang › Bidang Kerja</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Bidang Kerja</h1>
            <p class="text-primary-200 text-lg mt-3 max-w-xl">Struktur bidang kerja yang menopang seluruh program dan kegiatan YPMD-IRJA.</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">

                {{-- Bidang Informasi --}}
                <div class="shadow-card border border-neutral-100 fade-in">
                    <div class="h-1.5 bg-primary-500"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-primary-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-circle-info text-primary-500 text-xl"></i>
                        </div>
                        <h2 class="font-display font-bold text-neutral-900 text-lg mb-4">Bidang Informasi</h2>
                        <ul class="space-y-3">
                            <li class="flex gap-3 items-start">
                                <i class="fa-solid fa-microscope text-primary-500 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-semibold text-neutral-800">Penelitian</p>
                                    <p class="text-neutral-500 text-sm">Riset partisipatif mengenai isu masyarakat desa di Irian Jaya / Papua sekarang, sumber daya alam, dan kebijakan pembangunan di Tanah Papua.</p>
                                </div>
                            </li>
                            <li class="flex gap-3 items-start">
                                <i class="fa-solid fa-newspaper text-primary-500 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-semibold text-neutral-800">Penerbitan Kabar Dari Kampung</p>
                                    <p class="text-neutral-500 text-sm">Produksi dan distribusi buletin <em>Kabar Dari Kampung</em> (KDK) sebagai media alternatif masyarakat desa di Irian Jaya / Papua sekarang sejak 1982.</p>
                                </div>
                            </li>
                            <li class="flex gap-3 items-start">
                                <i class="fa-solid fa-book text-primary-500 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-semibold text-neutral-800">Dokumentasi dan Perpustakaan</p>
                                    <p class="text-neutral-500 text-sm">Pengelolaan arsip, dokumentasi kegiatan, dan perpustakaan referensi terkait isu-isu Papua.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Bidang CBO & CBA --}}
                <div class="shadow-card border border-neutral-100 fade-in">
                    <div class="h-1.5 bg-accent-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-accent-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-users text-accent-400 text-xl"></i>
                        </div>
                        <h2 class="font-display font-bold text-neutral-900 text-lg mb-4">Bidang CBO &amp; CBA</h2>
                        <p class="text-neutral-400 text-xs uppercase tracking-wider mb-4">Organisasi Berbasis Komunitas &amp; Advokasi Berbasis Komunitas</p>
                        <ul class="space-y-3">
                            <li class="flex gap-3 items-start">
                                <i class="fa-solid fa-fish text-accent-400 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-semibold text-neutral-800">Ekonomi Nelayan dan Pesisir</p>
                                    <p class="text-neutral-500 text-sm">Pendampingan ekonomi masyarakat nelayan dan pesisir untuk peningkatan taraf hidup dan pengelolaan sumber daya laut berkelanjutan.</p>
                                </div>
                            </li>
                            <li class="flex gap-3 items-start">
                                <i class="fa-solid fa-seedling text-accent-400 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-semibold text-neutral-800">Pertanian &amp; Perkebunan</p>
                                    <p class="text-neutral-500 text-sm">Pengembangan pertanian berbasis komunitas, termasuk budidaya kakao organik dan tanaman pangan lokal.</p>
                                </div>
                            </li>
                            <li class="flex gap-3 items-start">
                                <i class="fa-solid fa-droplet text-accent-400 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-semibold text-neutral-800">Penyediaan Air Bersih</p>
                                    <p class="text-neutral-500 text-sm">Program penyediaan air bersih bagi masyarakat kampung di wilayah pedalaman Papua.</p>
                                </div>
                            </li>
                            <li class="flex gap-3 items-start">
                                <i class="fa-solid fa-leaf text-accent-400 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-semibold text-neutral-800">Lingkungan</p>
                                    <p class="text-neutral-500 text-sm">Advokasi dan perlindungan lingkungan hidup, termasuk tata kelola hutan adat dan pemantauan dampak industri.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Bidang Administrasi & Financial --}}
                <div class="shadow-card border border-neutral-100 fade-in">
                    <div class="h-1.5 bg-primary-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-primary-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-briefcase text-primary-500 text-xl"></i>
                        </div>
                        <h2 class="font-display font-bold text-neutral-900 text-lg mb-4">Bidang Administrasi &amp; Keuangan</h2>
                        <ul class="space-y-3">
                            <li class="flex gap-3 items-start">
                                <i class="fa-solid fa-user-gear text-primary-400 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-semibold text-neutral-800">Administrasi Umum dan Pengembangan SDM</p>
                                    <p class="text-neutral-500 text-sm">Pengelolaan administrasi organisasi, kearsipan, serta peningkatan kapasitas dan kompetensi sumber daya manusia lembaga.</p>
                                </div>
                            </li>
                            <li class="flex gap-3 items-start">
                                <i class="fa-solid fa-coins text-primary-400 mt-1 text-sm"></i>
                                <div>
                                    <p class="font-semibold text-neutral-800">Keuangan</p>
                                    <p class="text-neutral-500 text-sm">Pengelolaan keuangan lembaga, pelaporan keuangan, serta akuntabilitas penggunaan dana program dan donasi.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 bg-neutral-50 border-t border-neutral-100">
        <div class="max-w-7xl mx-auto px-6 text-center fade-in">
            <h2 class="text-xl md:text-2xl font-display font-bold text-neutral-900 mb-3">Ingin Tahu Lebih Lanjut?</h2>
            <p class="text-neutral-500 max-w-lg mx-auto mb-6">Pelajari program-program yang dijalankan oleh setiap bidang kerja YPMD-IRJA.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('program') }}" class="bg-primary-500 text-white px-8 py-3 text-sm font-semibold hover:bg-primary-600 transition-colors shadow-card">
                    <i class="fa-solid fa-list-check mr-2"></i>Lihat Program
                </a>
                <a href="{{ route('kontak') }}" class="border border-neutral-300 text-neutral-700 px-8 py-3 text-sm font-semibold hover:border-primary-400 hover:text-primary-600 transition-colors">
                    <i class="fa-solid fa-envelope mr-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
