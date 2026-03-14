@extends('layouts.visitor')
@section('title', 'Kegiatan - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-title', 'Kegiatan - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-description', 'Jadwal kegiatan dan program ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))

@section('content')
    @include('partials.page-banner', ['title' => 'Event & Kegiatan', 'breadcrumb' => 'Event'])

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Jadwal</p>
                <h3 class="text-3xl font-extrabold">Event & Kegiatan</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($kegiatanList as $item)
                    @php
                        $mulai = $item->tanggal_mulai;
                        $selesai = $item->tanggal_selesai;
                        $day = $mulai->format('d') . ($selesai && !$mulai->isSameDay($selesai) ? '-' . $selesai->format('d') : '');
                    @endphp
                    <div class="bg-white shadow-md hover:shadow-xl transition border-l-4 border-primary">
                        <div class="bg-dark text-white p-4 flex items-center space-x-4">
                            <div class="text-center">
                                <p class="text-2xl font-extrabold text-primary">{{ $day }}</p>
                                <p class="text-sm uppercase tracking-wide">{{ $mulai->translatedFormat('M Y') }}</p>
                            </div>
                            <div class="border-l border-gray-700 pl-4">
                                <span class="text-sm bg-primary px-2 py-0.5 font-bold uppercase">Kegiatan</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <h4 class="font-bold text-lg mb-2">{{ $item->judul }}</h4>
                            <p class="text-base text-gray-500 mb-3 line-clamp-2">{{ $item->deskripsi }}</p>
                            <p class="text-sm text-gray-400"><i class="fas fa-map-marker-alt text-primary mr-1"></i> {{ $item->lokasi }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400">
                        <i class="fas fa-calendar-times text-4xl mb-3 block"></i>
                        <p>Belum ada kegiatan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
