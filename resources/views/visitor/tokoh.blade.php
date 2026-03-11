@extends('layouts.visitor')
@section('title', 'Tokoh Pendiri - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Tokoh Pendiri YPMD IRJA')
@section('seo-description', 'Mengenal tokoh-tokoh pendiri dan penggerak YPMD IRJA.')

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Tentang › Tokoh</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Tokoh Pendiri</h1>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-12 fade-in">
                <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-users mr-2"></i>Orang-orang di Balik YPMD IRJA</p>
                <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900">Para Tokoh Penggerak</h2>
                <p class="text-neutral-500 text-lg mt-3 max-w-2xl">YPMD IRJA lahir dari keresahan sekelompok idealis yang berasal dari kalangan Gereja dan Tokoh Masyarakat. Mereka berkomitmen untuk menjadi suara bagi masyarakat adat Papua.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ([
                    ['nama'=>'Pdt. Karel Phil Erari','peran'=>'Salah satu Pendiri','desc'=>'Pendeta dan aktivis hak asasi manusia Papua yang menjadi salah satu motor penggerak lahirnya YPMD IRJA.'],
                    ['nama'=>'Tokoh Pendiri II','peran'=>'Ko-Pendiri','desc'=>'Tokoh masyarakat yang turut meletakkan fondasi organisasi pemberdayaan masyarakat adat pertama di Papua.'],
                    ['nama'=>'Tokoh Pendiri III','peran'=>'Ko-Pendiri','desc'=>'Aktivis gereja yang berperan dalam penerbitan buletin Kabar Dari Kampung sejak 1982.'],
                ] as $t)
                <div class="bg-white shadow-card card-hover border border-neutral-100 fade-in">
                    <div class="h-56 bg-neutral-100 flex items-center justify-center">
                        <div class="w-20 h-20 rounded-full bg-primary-100 flex items-center justify-center">
                            <i class="fa-solid fa-user text-primary-400 text-3xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-semibold text-primary-500 uppercase tracking-wider">{{ $t['peran'] }}</span>
                        <h3 class="font-display font-bold text-neutral-900 mt-1 mb-2">{{ $t['nama'] }}</h3>
                        <p class="text-neutral-500 text-sm leading-relaxed">{{ $t['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
