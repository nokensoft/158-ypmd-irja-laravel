@extends('layouts.visitor')
@section('title', 'Struktur Pengurusan - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-title', 'Struktur Pengurusan - ' . ($situs['nama_situs'] ?? 'KONI Papua Pegunungan'))
@section('seo-description', 'Struktur organisasi dan pengurus ' . ($situs['nama_situs'] ?? 'KONI Provinsi Papua Pegunungan'))

@section('content')
    @include('partials.page-banner', ['title' => 'Struktur Pengurusan', 'breadcrumb' => 'Pengurusan'])

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Periode 2024 - 2028</p>
                <h3 class="text-3xl font-extrabold">Pimpinan Organisasi</h3>
            </div>
            <div class="max-w-md mx-auto text-center">
                <div class="bg-white shadow-xl border-t-4 border-primary p-8">
                    <img src="https://placehold.co/300x300/EEE/31343C" class="w-40 h-40 rounded-full mx-auto mb-6 object-cover shadow-md" alt="Ketua Umum">
                    <h4 class="font-extrabold text-xl uppercase">Nama Ketua Umum, S.Pd., M.M.</h4>
                    <p class="text-primary font-bold uppercase text-base mt-1 tracking-wide">Ketua Umum</p>
                    <div class="w-12 h-1 bg-primary mx-auto my-4"></div>
                    <p class="text-gray-500 text-lg leading-relaxed">Memimpin KONI Provinsi Papua Pegunungan dalam mengoordinasikan seluruh kegiatan pembinaan olahraga prestasi daerah.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-accent">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <p class="text-primary font-bold uppercase tracking-widest text-base mb-2">Tim Kerja</p>
                <h3 class="text-3xl font-extrabold">Pengurus Inti</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ([
                    ['name' => 'Nama Wakil Ketua I, S.H.', 'pos' => 'Wakil Ketua I'],
                    ['name' => 'Nama Wakil Ketua II, S.E.', 'pos' => 'Wakil Ketua II'],
                    ['name' => 'Nama Sekretaris, M.Si.', 'pos' => 'Sekretaris Umum'],
                    ['name' => 'Nama Bendahara, S.Ak.', 'pos' => 'Bendahara Umum'],
                ] as $person)
                    <div class="bg-white shadow-md p-6 text-center group hover:shadow-xl transition border-t-4 border-transparent hover:border-primary">
                        <img src="https://placehold.co/300x300/EEE/31343C" class="w-28 h-28 rounded-full mx-auto mb-4 object-cover">
                        <h4 class="font-bold text-base uppercase">{{ $person['name'] }}</h4>
                        <p class="text-primary font-medium text-base mt-1">{{ $person['pos'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
