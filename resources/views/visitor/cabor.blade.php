@extends('layouts.visitor')
@section('title', 'Cabang Olahraga - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-title', 'Cabang Olahraga - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-description', 'Daftar cabang olahraga binaan ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))

@section('content')
    @include('partials.page-banner', ['title' => 'Cabang Olahraga', 'breadcrumb' => 'Cabor'])

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 text-center max-w-3xl">
            <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Daftar Lengkap</p>
            <h3 class="text-3xl font-extrabold mb-4">Cabang Olahraga Binaan</h3>
            <p class="text-gray-600 leading-relaxed text-lg">Berikut adalah daftar cabang olahraga yang berada di bawah pembinaan {{ $situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan' }}.</p>
        </div>
    </section>

    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($caborList as $item)
                    <div class="bg-white p-6 text-center shadow-sm hover:shadow-lg hover:border-primary border-b-4 border-transparent transition group">
                        <div class="w-16 h-16 bg-gray-50 group-hover:bg-primary text-primary group-hover:text-white flex items-center justify-center mx-auto mb-4 transition">
                            <i class="fas {{ $item->icon ?? 'fa-trophy' }} text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-base uppercase mb-3">{{ $item->nama }}</h4>
                        <div class="flex justify-center gap-4 text-sm text-gray-500">
                            <span><i class="fas fa-users text-primary mr-1"></i> {{ $item->jumlah_atlet ?? 0 }} Atlet</span>
                            <span><i class="fas fa-medal text-primary mr-1"></i> {{ $item->jumlah_medali ?? 0 }} Medali</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400">
                        <i class="fas fa-running text-4xl mb-3 block"></i>
                        <p>Belum ada data cabang olahraga.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
