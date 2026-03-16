@extends('layouts.visitor')
@section('title', 'Sejarah - ' . ($situs['nama_situs'] ?? 'YPMD-IRJA'))
@section('seo-description', 'Sejarah berdiri dan perjalanan panjang Yayasan Pembangunan Masyarakat Desa Irian Jaya sejak 1984.')

@section('content')
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-primary-200 text-xs uppercase tracking-widest"><a href="{{ route('beranda') }}" class="hover:text-white">Beranda</a> › Tentang › Sejarah</span>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mt-3">Sejarah YPMD-IRJA</h1>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-xs font-semibold tracking-widest uppercase text-primary-500 mb-2"><i class="fa-solid fa-leaf mr-2"></i>Tentang Kami</p>
            <h2 class="text-2xl md:text-3xl font-display font-bold text-neutral-900 mb-6">Perjalanan 40 Tahun Pengabdian</h2>
            <img src="{{ asset('img/logo-ypmd-irja.png') }}" alt="Logo YPMD-IRJA" class="w-full rounded-lg shadow-card mb-8 object-contain max-h-80 bg-white p-4"/>
            <div class="space-y-5 text-neutral-600 leading-relaxed">
                <p>Yayasan Pembangunan Masyarakat Desa Irian Jaya (YPMD-IRJA) merupakan Lembaga Swadaya Masyarakat (LSM) pertama di Tanah Papua. Yayasan ini lahir dari keresahan sekelompok idealis yang berasal dari kalangan Gereja dan Tokoh Masyarakat.</p>
                <p>Pada tahun 1982, kelompok ini mulai menerbitkan buletin <em>Kabar Dari Kampung</em> (KdK) sebagai media alternatif. Dua tahun kemudian, pada <strong>1984</strong>, kelompok ini secara resmi mendirikan YPMD-IRJA sebagai lembaga formal.</p>
                <p>Sejak awal berdirinya, YPMD-IRJA berkomitmen menempatkan masyarakat desa di Irian Jaya / Papua sekarang sebagai <em>subjek</em> — bukan objek — dalam proses pembangunan. Lembaga ini hadir sebagai jembatan informasi dan agen perubahan bagi masyarakat dalam mempertahankan hak-hak mereka atas tanah dan sumber daya alam.</p>
                <p>Selama lebih dari empat dekade, YPMD-IRJA telah mendampingi masyarakat di berbagai wilayah Papua, mengembangkan program ekonomi berbasis komunitas, dan membangun jaringan dengan lembaga internasional.</p>
            </div>
            <div class="mt-16">
                <h3 class="text-xl font-display font-bold text-neutral-900 mb-8">Tonggak Sejarah</h3>
                <div class="relative border-l-2 border-primary-200 pl-8 space-y-8">
                    @foreach ([
                        ['tahun'=>'1982','judul'=>'Penerbitan Buletin KdK','desc'=>'Kelompok idealis gereja & tokoh masyarakat menerbitkan Kabar Dari Kampung sebagai media alternatif.'],
                        ['tahun'=>'1984','judul'=>'Pendirian YPMD-IRJA','desc'=>'Yayasan resmi didirikan sebagai LSM pertama di Tanah Papua.'],
                        ['tahun'=>'1992','judul'=>'BPR Phidectama','desc'=>'Mendirikan Bank Perkreditan Rakyat Phidectama untuk membentuk kebiasaan menabung masyarakat kampung.'],
                        ['tahun'=>'2010','judul'=>'Ekspor Kakao Organik','desc'=>'Mulai mengekspor biji kakao organik dari Lembah Grime ke Jepang melalui kemitraan ATJ & Green Coop.'],
                        ['tahun'=>'2022','judul'=>'HUT ke-38','desc'=>'Merayakan 38 tahun pengabdian bersama masyarakat desa di Irian Jaya / Papua sekarang.'],
                    ] as $tm)
                    <div class="relative fade-in">
                        <div class="absolute -left-10 w-4 h-4 rounded-full bg-primary-500 border-2 border-white shadow"></div>
                        <span class="inline-block text-xs font-bold bg-primary-50 text-primary-600 px-3 py-1 mb-2">{{ $tm['tahun'] }}</span>
                        <h4 class="font-display font-bold text-neutral-900">{{ $tm['judul'] }}</h4>
                        <p class="text-neutral-500 text-sm mt-1">{{ $tm['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
