@extends('layouts.visitor')
@section('title', 'Donasi - ' . ($situs['nama_situs'] ?? 'YPMD IRJA'))
@section('seo-title', 'Donasi untuk YPMD IRJA')
@section('seo-description', 'Dukung program pemberdayaan masyarakat adat Papua melalui donasi kepada YPMD IRJA.')

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Donasi</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Donasi</h1>
            <p class="text-primary-200 mt-2 text-lg">Bersama Membangun Papua yang Bermartabat</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-start">
                <div class="fade-in">
                    <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-heart mr-2"></i>Dukung Kami</p>
                    <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-6">Mengapa Donasi?</h2>
                    <p class="text-neutral-600 leading-relaxed mb-4">Selama lebih dari 40 tahun, YPMD IRJA telah menjadi mitra terpercaya masyarakat adat Papua dalam perjuangan mereka untuk keadilan, kemandirian, dan martabat. Dukungan Anda memungkinkan kami untuk terus menjalankan program-program vital.</p>
                    <p class="text-neutral-600 leading-relaxed mb-8">Setiap donasi, besar maupun kecil, berkontribusi langsung pada kehidupan masyarakat kampung di Papua.</p>
                    <div class="space-y-4">
                        @foreach ([
                            ['icon'=>'fa-seedling','judul'=>'Pertanian Organik','desc'=>'Membantu petani kakao organik meningkatkan kualitas dan akses pasar ekspor'],
                            ['icon'=>'fa-users','judul'=>'Pendampingan Komunitas','desc'=>'Mendukung fasilitator lapangan yang mendampingi masyarakat adat'],
                            ['icon'=>'fa-newspaper','judul'=>'Media KDK','desc'=>'Melestarikan dan mendigitalkan arsip buletin Kabar Dari Kampung'],
                        ] as $item)
                        <div class="flex items-start gap-4 p-4 bg-neutral-50 fade-in">
                            <div class="w-10 h-10 bg-primary-50 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid {{ $item['icon'] }} text-primary-500"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-neutral-900">{{ $item['judul'] }}</h4>
                                <p class="text-sm text-neutral-500">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="fade-in">
                    <div class="bg-neutral-50 p-8 shadow-card">
                        <h3 class="font-display font-bold text-neutral-900 text-xl mb-6">Informasi Rekening Donasi</h3>
                        <div class="space-y-4 mb-8">
                            @foreach ([
                                ['bank'=>'BRI','atas_nama'=>'Yayasan Pembangunan Masyarakat Desa Irian Jaya','no'=>'1234-5678-9012-345'],
                                ['bank'=>'BNI','atas_nama'=>'YPMD IRJA','no'=>'9876-5432-1098-765'],
                                ['bank'=>'Mandiri','atas_nama'=>'YPMD IRJA','no'=>'1111-2222-3333-4444'],
                            ] as $rek)
                            <div class="bg-white p-4 border border-neutral-100">
                                <p class="text-xs text-neutral-400 uppercase tracking-wider">Bank {{ $rek['bank'] }}</p>
                                <p class="font-bold text-neutral-900 mt-1">{{ $rek['no'] }}</p>
                                <p class="text-sm text-neutral-500">a.n. {{ $rek['atas_nama'] }}</p>
                            </div>
                            @endforeach
                        </div>
                        <div class="bg-primary-50 p-4 border-l-4 border-primary-500 mb-6">
                            <p class="text-sm text-neutral-700">Setelah melakukan transfer, silakan konfirmasi donasi Anda melalui WhatsApp atau email kami untuk mendapatkan tanda bukti penerimaan.</p>
                        </div>
                        @if (!empty($situs['telepon']))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $situs['telepon']) }}" target="_blank"
                           class="flex items-center justify-center gap-2 bg-green-500 text-white px-6 py-3 font-semibold hover:bg-green-600 transition-colors w-full">
                            <i class="fa-brands fa-whatsapp text-xl"></i>Konfirmasi via WhatsApp
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary-600 py-16">
        <div class="max-w-4xl mx-auto px-6 text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-display font-bold text-white mb-4">Terima Kasih atas Kepedulian Anda</h2>
            <p class="text-primary-200 text-lg">Bersama kita membangun Papua yang bermartabat, mandiri, dan berdaulat.</p>
        </div>
    </section>
@endsection
