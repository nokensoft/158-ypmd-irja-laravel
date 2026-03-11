<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Donasi;
use App\Models\Galeri;
use App\Models\Kdk;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisitorController extends Controller
{
    public function beranda()
    {
        $beritaTerbaru = Berita::with('kategori', 'media')
            ->where('status', 'terbit')
            ->latest('tanggal_terbit')
            ->take(3)
            ->get();

        $galeriTerbaru = Galeri::with('media')->latest()->take(6)->get();

        return view('visitor.beranda', compact('beritaTerbaru', 'galeriTerbaru'));
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

        $berita->increment('jumlah_dibaca');

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

    public function kdk()
    {
        $kdkList = Kdk::orderByDesc('tanggal_terbit')->paginate(12);

        return view('visitor.kdk', compact('kdkList'));
    }

    public function donasi()
    {
        return view('visitor.donasi');
    }

    public function donasiStore(Request $request)
    {
        $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'telepon'      => 'nullable|string|max:20',
            'bank'         => 'required|string|max:100',
            'jumlah'       => 'nullable|integer|min:0',
            'pesan'        => 'nullable|string|max:1000',
            'bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $buktiPath = $request->file('bukti_transfer')->store('donasi', 'public');
        }

        Donasi::create([
            'nama_donatur'   => $request->nama_donatur,
            'email'          => $request->email,
            'telepon'        => $request->telepon,
            'bank'           => $request->bank,
            'jumlah'         => $request->jumlah,
            'pesan'          => $request->pesan,
            'bukti_transfer' => $buktiPath,
            'status'         => 'pending',
            'tanggal'        => now()->toDateString(),
        ]);

        return redirect()->route('donasi')->with('success', 'Terima kasih! Konfirmasi donasi Anda telah kami terima dan sedang diproses.');
    }
}
