@extends('layouts.dashboard')
@section('title', 'Dokumentasi')
@section('page-title', 'Dokumentasi')

@section('content')
    {{-- Header --}}
    <div class="bg-white shadow-sm p-6 mb-6">
        <h2 class="text-2xl font-extrabold text-dark mb-1">KONI Papua Pegunungan</h2>
        <p class="text-gray-500">Website resmi Komite Olahraga Nasional Indonesia (KONI) Kabupaten Papua Pegunungan. Menampilkan informasi cabang olahraga, berita, kegiatan/event, galeri, dan profil kepengurusan.</p>
    </div>

    {{-- Spesifikasi Teknologi --}}
    <div class="bg-white shadow-sm p-6 mb-6">
        <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
            <i class="fas fa-microchip mr-2 text-primary"></i>Spesifikasi Teknologi
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="flex items-start space-x-3 p-3 bg-gray-50">
                <i class="fas fa-server text-primary mt-1"></i>
                <div><p class="font-bold text-base">Backend</p><p class="text-sm text-gray-500">PHP 8.2+, Laravel 12</p></div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-gray-50">
                <i class="fas fa-palette text-primary mt-1"></i>
                <div><p class="font-bold text-base">Frontend</p><p class="text-sm text-gray-500">Tailwind CSS 4, Alpine.js 3, Vite 7</p></div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-gray-50">
                <i class="fas fa-database text-primary mt-1"></i>
                <div><p class="font-bold text-base">Database</p><p class="text-sm text-gray-500">MySQL</p></div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-gray-50">
                <i class="fas fa-icons text-primary mt-1"></i>
                <div><p class="font-bold text-base">Icon</p><p class="text-sm text-gray-500">Font Awesome 7</p></div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-gray-50">
                <i class="fas fa-shield-alt text-primary mt-1"></i>
                <div><p class="font-bold text-base">Autentikasi</p><p class="text-sm text-gray-500">Custom middleware, role-based access</p></div>
            </div>
            <div class="flex items-start space-x-3 p-3 bg-gray-50">
                <i class="fas fa-chart-line text-primary mt-1"></i>
                <div><p class="font-bold text-base">Tracking</p><p class="text-sm text-gray-500">Pencatatan kunjungan situs otomatis</p></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Fitur Visitor --}}
        <div class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-globe mr-2 text-primary"></i>Fitur Visitor (Publik)
            </h3>
            <div class="space-y-0">
                @php
                    $fiturVisitor = [
                        ['icon' => 'fa-home', 'title' => 'Beranda', 'desc' => 'Statistik ringkasan, daftar cabor, berita terbaru, kegiatan mendatang, galeri terbaru'],
                        ['icon' => 'fa-info-circle', 'title' => 'Tentang', 'desc' => 'Profil organisasi KONI'],
                        ['icon' => 'fa-sitemap', 'title' => 'Pengurusan', 'desc' => 'Struktur kepengurusan organisasi'],
                        ['icon' => 'fa-running', 'title' => 'Cabang Olahraga', 'desc' => 'Daftar lengkap cabang olahraga binaan'],
                        ['icon' => 'fa-calendar-alt', 'title' => 'Event/Kegiatan', 'desc' => 'Jadwal dan informasi kegiatan olahraga'],
                        ['icon' => 'fa-newspaper', 'title' => 'Berita', 'desc' => 'Pencarian, filter kategori, pagination, detail dengan penghitung pembaca'],
                        ['icon' => 'fa-images', 'title' => 'Galeri', 'desc' => 'Album foto/video dengan filter kategori dan halaman detail'],
                        ['icon' => 'fa-envelope', 'title' => 'Kontak', 'desc' => 'Informasi kontak dan media sosial'],
                    ];
                @endphp
                @foreach ($fiturVisitor as $fitur)
                    <div class="flex items-start space-x-3 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        <div class="w-8 h-8 bg-primary/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fas {{ $fitur['icon'] }} text-sm"></i>
                        </div>
                        <div>
                            <p class="font-bold text-base">{{ $fitur['title'] }}</p>
                            <p class="text-sm text-gray-500">{{ $fitur['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Fitur Admin & Penulis --}}
        <div class="bg-white shadow-sm p-6">
            <h3 class="text-lg font-bold uppercase mb-4 pb-3 border-b border-primary">
                <i class="fas fa-user-shield mr-2 text-primary"></i>Fitur Admin & Penulis
            </h3>
            <div class="space-y-0">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Admin Master</p>
                @php
                    $fiturAdmin = [
                        ['icon' => 'fa-tachometer-alt', 'title' => 'Dasbor', 'desc' => 'Ringkasan data, aktivitas login, info sistem'],
                        ['icon' => 'fa-cog', 'title' => 'Pengaturan Situs', 'desc' => 'Nama, deskripsi, kontak, sosmed, logo, SEO'],
                        ['icon' => 'fa-users', 'title' => 'Manajemen Pengguna', 'desc' => 'CRUD dengan soft delete dan restore'],
                        ['icon' => 'fa-history', 'title' => 'Aktivitas Login', 'desc' => 'Log riwayat login pengguna'],
                        ['icon' => 'fa-database', 'title' => 'Backup Database', 'desc' => 'Buat, download, hapus, dan restore SQL'],
                        ['icon' => 'fa-chart-bar', 'title' => 'Statistik Pengunjung', 'desc' => 'Harian, mingguan, bulanan, tahunan'],
                    ];
                @endphp
                @foreach ($fiturAdmin as $fitur)
                    <div class="flex items-start space-x-3 py-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-primary/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fas {{ $fitur['icon'] }} text-sm"></i>
                        </div>
                        <div>
                            <p class="font-bold text-base">{{ $fitur['title'] }}</p>
                            <p class="text-sm text-gray-500">{{ $fitur['desc'] }}</p>
                        </div>
                    </div>
                @endforeach

                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mt-4 mb-2">Penulis</p>
                @php
                    $fiturPenulis = [
                        ['icon' => 'fa-newspaper', 'title' => 'Berita', 'desc' => 'CRUD berita dengan status terbit/draft'],
                        ['icon' => 'fa-tags', 'title' => 'Kategori Berita', 'desc' => 'CRUD kategori berita'],
                        ['icon' => 'fa-calendar-alt', 'title' => 'Kegiatan', 'desc' => 'CRUD kegiatan/event'],
                        ['icon' => 'fa-running', 'title' => 'Cabang Olahraga', 'desc' => 'CRUD data cabor (atlet, medali)'],
                        ['icon' => 'fa-photo-video', 'title' => 'Media', 'desc' => 'Upload file media, AJAX upload'],
                        ['icon' => 'fa-images', 'title' => 'Galeri', 'desc' => 'CRUD album galeri dengan relasi media'],
                    ];
                @endphp
                @foreach ($fiturPenulis as $fitur)
                    <div class="flex items-start space-x-3 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        <div class="w-8 h-8 bg-primary/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fas {{ $fitur['icon'] }} text-sm"></i>
                        </div>
                        <div>
                            <p class="font-bold text-base">{{ $fitur['title'] }}</p>
                            <p class="text-sm text-gray-500">{{ $fitur['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
