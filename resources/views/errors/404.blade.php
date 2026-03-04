@extends('layouts.visitor')
@section('title', '404 - Halaman Tidak Ditemukan')
@section('seo-title', '404 - Halaman Tidak Ditemukan')
@section('seo-description', 'Halaman yang Anda cari tidak ditemukan.')

@section('content')
    @include('partials.page-banner', ['title' => '404', 'breadcrumb' => 'Halaman Tidak Ditemukan'])

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 text-center max-w-2xl">
            <div class="mb-8">
                <i class="fas fa-exclamation-triangle text-primary text-7xl"></i>
            </div>
            <h3 class="text-4xl font-extrabold mb-4">Halaman Tidak Ditemukan</h3>
            <p class="text-gray-600 text-lg mb-10 leading-relaxed">
                Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
                Silakan kembali ke beranda atau gunakan navigasi di atas.
            </p>
            <a href="{{ route('beranda') }}"
               class="inline-flex items-center gap-2 bg-primary text-white px-8 py-4 font-bold uppercase tracking-wide hover:bg-red-700 transition shadow-lg">
                <i class="fas fa-home"></i>
                Kembali ke Beranda
            </a>
        </div>
    </section>
@endsection
