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
           <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="shadow-card card-hover bg-white border border-neutral-100 fade-in group">
                    <div class="h-1.5 bg-green-600"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-green-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-newspaper text-xl text-green-600"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-4 group-hover:text-green-600 transition-colors">Informasi</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">
                            Penyebaran informasi pembangunan masyarakat melalui Buletin Kabar Dari Kampung (KdK) sejak tahun 1982 (edisi cetak sampai tahun 2000), sebagai media alternatif, advokasi, dan promosi usaha rakyat.
                        </p>
                    </div>
                </div>

                <div class="shadow-card card-hover bg-white border border-neutral-100 fade-in group">
                    <div class="h-1.5 bg-yellow-500"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-yellow-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-chart-line text-xl text-yellow-600"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-4 group-hover:text-yellow-600 transition-colors">Ekonomi Kerakyatan</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">
                            Pengembangan potensi lokal, aksesibilitas pasar, dan mobilisasi simpanan keuangan masyarakat di bank.
                        </p>
                    </div>
                </div>

                <div class="shadow-card card-hover bg-white border border-neutral-100 fade-in group">
                    <div class="h-1.5 bg-sky-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-sky-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-droplet text-xl text-sky-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-4 group-hover:text-sky-600 transition-colors">Kesehatan Lingkungan / Clean Water Supply</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">
                            Pembangunan dan pengelolaan instalasi air bersih, sanitasi, dan lingkungan di kampung-kampung terpencil untuk kebutuhan dasar warga.
                        </p>
                    </div>
                </div>

                <div class="shadow-card card-hover bg-white border border-neutral-100 fade-in group">
                    <div class="h-1.5 bg-orange-400"></div>
                    <div class="p-6">
                        <div class="w-12 h-12 bg-orange-50 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-shop text-xl text-orange-500"></i>
                        </div>
                        <h3 class="font-display font-bold text-neutral-900 mb-4 group-hover:text-orange-600 transition-colors">Promosi Usaha</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">
                            Peningkatan kapasitas bisnis usaha kecil menengah (UKM) masyarakat agar mampu bersaing di pasar yang lebih luas.
                        </p>
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
