<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kdk;
use App\Models\Galeri;
use App\Models\Media;
use App\Models\KategoriBerita;
use App\Models\Donasi;
use App\Models\ProgramDonasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDonasi = Donasi::where('status', 'dikonfirmasi')->sum('jumlah');

        $stats = [
            ['icon' => 'fa-newspaper',          'value' => Berita::count(),                                     'label' => 'Papua Today',    'color' => 'bg-primary'],
            ['icon' => 'fa-book-open',          'value' => Kdk::count(),                                        'label' => 'Edisi KDK',      'color' => 'bg-green-600'],
            ['icon' => 'fa-images',             'value' => Galeri::count(),                                     'label' => 'Total Galeri',   'color' => 'bg-purple-600'],
            ['icon' => 'fa-photo-video',        'value' => Media::count(),                                      'label' => 'Total Media',    'color' => 'bg-orange-500'],
            ['icon' => 'fa-tags',               'value' => KategoriBerita::count(),                             'label' => 'Kategori',       'color' => 'bg-pink-600'],
            ['icon' => 'fa-hand-holding-heart', 'value' => ProgramDonasi::where('is_active', true)->count(),    'label' => 'Program Donasi', 'color' => 'bg-teal-600'],
            ['icon' => 'fa-heart',              'value' => Donasi::where('status', 'pending')->count(),         'label' => 'Donasi Pending', 'color' => 'bg-yellow-500'],
            ['icon' => 'fa-donate',             'value' => 'Rp ' . number_format($totalDonasi, 0, ',', '.'),    'label' => 'Total Terkumpul','color' => 'bg-green-700'],
        ];

        $beritaTerbaru = Berita::with('kategori')
            ->latest()
            ->take(5)
            ->get();

        return view('penulis.dashboard', compact('stats', 'beritaTerbaru'));
    }
}
