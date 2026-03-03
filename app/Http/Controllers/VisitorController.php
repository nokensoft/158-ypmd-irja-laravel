<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\CabangOlahraga;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\KategoriBerita;

class VisitorController extends Controller
{
    public function beranda()
    {
        $stats = [
            ['icon' => 'fa-running', 'value' => CabangOlahraga::count(), 'label' => 'Cabang Olahraga'],
            ['icon' => 'fa-users', 'value' => CabangOlahraga::sum('jumlah_atlet') ?: '0', 'label' => 'Atlet Binaan'],
            ['icon' => 'fa-medal', 'value' => CabangOlahraga::sum('jumlah_medali') ?: '0', 'label' => 'Medali Diraih'],
            ['icon' => 'fa-calendar-check', 'value' => Kegiatan::count(), 'label' => 'Event'],
        ];

        $caborList = CabangOlahraga::take(6)->get();
        $beritaTerbaru = Berita::with('kategori', 'media')->where('status', 'terbit')->latest('tanggal_terbit')->take(3)->get();
        $kegiatanMendatang = Kegiatan::where('tanggal_mulai', '>=', now())->orderBy('tanggal_mulai')->take(3)->get();
        $galeriTerbaru = Galeri::with('media')->latest()->take(3)->get();

        return view('visitor.beranda', compact('stats', 'caborList', 'beritaTerbaru', 'kegiatanMendatang', 'galeriTerbaru'));
    }

    public function tentang()
    {
        return view('visitor.tentang');
    }

    public function pengurusan()
    {
        return view('visitor.pengurusan');
    }

    public function cabor()
    {
        $caborList = CabangOlahraga::orderBy('nama')->get();

        return view('visitor.cabor', compact('caborList'));
    }

    public function event()
    {
        $kegiatanList = Kegiatan::orderBy('tanggal_mulai')->get();

        return view('visitor.event', compact('kegiatanList'));
    }

    public function berita()
    {
        $query = Berita::with('kategori', 'media')
            ->where('status', 'terbit');

        if (request('cari')) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . request('cari') . '%')
                  ->orWhere('ringkasan', 'like', '%' . request('cari') . '%');
            });
        }

        $beritaList = $query->latest('tanggal_terbit')->paginate(9)->withQueryString();
        $kategoriList = KategoriBerita::withCount(['berita' => fn ($q) => $q->where('status', 'terbit')])->get();
        $kategoriAktif = null;

        return view('visitor.berita.index', compact('beritaList', 'kategoriList', 'kategoriAktif'));
    }

    public function beritaKategori(string $slug)
    {
        $kategoriAktif = KategoriBerita::where('slug', $slug)->firstOrFail();

        $query = Berita::with('kategori', 'media')
            ->where('status', 'terbit')
            ->where('kategori_berita_id', $kategoriAktif->id);

        if (request('cari')) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . request('cari') . '%')
                  ->orWhere('ringkasan', 'like', '%' . request('cari') . '%');
            });
        }

        $beritaList = $query->latest('tanggal_terbit')->paginate(9)->withQueryString();
        $kategoriList = KategoriBerita::withCount(['berita' => fn ($q) => $q->where('status', 'terbit')])->get();

        return view('visitor.berita.index', compact('beritaList', 'kategoriList', 'kategoriAktif'));
    }

    public function beritaDetail(string $slug)
    {
        $berita = Berita::with('kategori', 'media', 'user')
            ->where('slug', $slug)
            ->where('status', 'terbit')
            ->firstOrFail();

        $beritaLainnya = Berita::with('kategori', 'media')
            ->where('status', 'terbit')
            ->where('id', '!=', $berita->id)
            ->latest('tanggal_terbit')
            ->take(5)
            ->get();

        return view('visitor.berita.detail', compact('berita', 'beritaLainnya'));
    }

    public function galeri()
    {
        $query = Galeri::withCount('media')->latest();

        $kategoriAktif = request('kategori');
        if ($kategoriAktif && in_array($kategoriAktif, Galeri::KATEGORI_LIST)) {
            $query->where('kategori', $kategoriAktif);
        } else {
            $kategoriAktif = null;
        }

        $galeriList = $query->paginate(12)->withQueryString();

        // Load first media for cover image
        $galeriList->load(['media' => fn ($q) => $q->limit(1)]);

        return view('visitor.galeri', compact('galeriList', 'kategoriAktif'));
    }

    public function galeriDetail(string $slug)
    {
        $galeri = Galeri::with('media')->where('slug', $slug)->firstOrFail();

        return view('visitor.galeri-detail', compact('galeri'));
    }

    public function kontak()
    {
        return view('visitor.kontak');
    }
}
