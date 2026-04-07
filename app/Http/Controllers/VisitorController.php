<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Donasi;
use App\Models\Galeri;
use App\Models\Halaman;
use App\Models\Kdk;
use App\Models\KategoriBerita;
use App\Models\ProgramDonasi;
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

        $kdkTerbaru = Kdk::with('media')
            ->orderByDesc('tanggal_terbit')
            ->take(4)
            ->get();

        $galeriTerbaru = Galeri::withCount('media')
            ->with(['media' => fn ($q) => $q->limit(1)])
            ->where('is_publik', true)
            ->latest()
            ->take(6)
            ->get();

        return view('visitor.beranda', compact('beritaTerbaru', 'kdkTerbaru', 'galeriTerbaru'));
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
        $query = Galeri::withCount('media')->where('is_publik', true)->latest();

        $kategoriAktif = request('kategori');
        if ($kategoriAktif && in_array($kategoriAktif, Galeri::KATEGORI_LIST)) {
            $query->where('kategori', $kategoriAktif);
        } else {
            $kategoriAktif = null;
        }

        if (request('cari')) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . request('cari') . '%')
                  ->orWhere('deskripsi', 'like', '%' . request('cari') . '%');
            });
        }

        $galeriList = $query->paginate(12)->withQueryString();

        // Load first media for cover image
        $galeriList->load(['media' => fn ($q) => $q->limit(1)]);

        // Category list with counts (for sidebar)
        $kategoriListSidebar = collect(Galeri::KATEGORI_LIST)->map(function ($kat) {
            return [
                'nama' => $kat,
                'jumlah' => Galeri::where('is_publik', true)->where('kategori', $kat)->count(),
            ];
        });

        return view('visitor.galeri', compact('galeriList', 'kategoriAktif', 'kategoriListSidebar'));
    }

    public function galeriDetail(string $slug)
    {
        $galeri = Galeri::with('media')->where('slug', $slug)->where('is_publik', true)->firstOrFail();

        return view('visitor.galeri-detail', compact('galeri'));
    }

    public function kontak()
    {
        return view('visitor.kontak');
    }

    public function kdk()
    {
        $query = Kdk::with('media');

        if (request('cari')) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . request('cari') . '%')
                  ->orWhere('deskripsi', 'like', '%' . request('cari') . '%')
                  ->orWhere('nomor_edisi', 'like', '%' . request('cari') . '%');
            });
        }

        $tahunAktif = request('tahun');
        if ($tahunAktif) {
            $query->whereYear('tanggal_terbit', $tahunAktif);
        }

        $kdkList = $query->orderByDesc('tanggal_terbit')->paginate(12)->withQueryString();

        // Daftar tahun dengan jumlah buletin untuk sidebar
        $tahunList = Kdk::selectRaw('YEAR(tanggal_terbit) as tahun, COUNT(*) as jumlah')
            ->whereNotNull('tanggal_terbit')
            ->groupByRaw('YEAR(tanggal_terbit)')
            ->orderByDesc('tahun')
            ->get();

        return view('visitor.kdk', compact('kdkList', 'tahunList', 'tahunAktif'));
    }

    public function kdkDetail(string $id)
    {
        $kdk = Kdk::with('media')->findOrFail($id);

        $kdk->increment('jumlah_dibaca');

        $kdkLainnya = Kdk::with('media')
            ->where('id', '!=', $kdk->id)
            ->orderByDesc('tanggal_terbit')
            ->take(6)
            ->get();

        return view('visitor.kdk-detail', compact('kdk', 'kdkLainnya'));
    }

    public function kdkDownload(string $id)
    {
        $kdk = Kdk::findOrFail($id);

        if (!$kdk->file_pdf || !Storage::disk('public')->exists($kdk->file_pdf)) {
            abort(404, 'File PDF tidak ditemukan.');
        }

        $kdk->increment('jumlah_unduhan');

        return Storage::disk('public')->download($kdk->file_pdf, 'KDK-Edisi-' . $kdk->nomor_edisi . '.pdf');
    }

    public function donasi()
    {
        $programs = ProgramDonasi::with('media')
            ->where('is_active', true)
            ->latest()
            ->get();

        $testimoni = Donasi::with('programDonasi')
            ->where('status', 'dikonfirmasi')
            ->where('is_publik', true)
            ->whereNotNull('pesan')
            ->where('pesan', '!=', '')
            ->latest()
            ->take(12)
            ->get();

        return view('visitor.donasi', compact('programs', 'testimoni'));
    }

    public function donasiStore(Request $request)
    {
        $request->validate([
            'program_donasi_id' => 'required|exists:program_donasi,id',
            'nama_donatur'      => 'required|string|max:255',
            'is_anonim'         => 'nullable|boolean',
            'email'             => 'nullable|email|max:255',
            'telepon'           => 'nullable|string|max:20',
            'jumlah'            => 'required|integer|min:1',
            'pesan'             => 'nullable|string|max:1000',
            'bukti_transfer'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $ext = $file->getClientOriginalExtension() ?: 'jpg';
            $buktiPath = $file->storeAs('donasi', \App\Helpers\ImageHelper::generateFilename($ext), 'public');
        }

        Donasi::create([
            'program_donasi_id' => $request->program_donasi_id,
            'nama_donatur'      => $request->nama_donatur,
            'is_anonim'         => $request->boolean('is_anonim'),
            'email'             => $request->email,
            'telepon'           => $request->telepon,
            'bank'              => ProgramDonasi::BANK_NAMA,
            'jumlah'            => $request->jumlah,
            'pesan'             => $request->pesan,
            'bukti_transfer'    => $buktiPath,
            'status'            => 'pending',
            'tanggal'           => now()->toDateString(),
        ]);

        return redirect()->route('donasi')->with('success', 'Terima kasih! Konfirmasi donasi Anda telah kami terima dan sedang diproses.');
    }

    public function sejarah()
    {
        $halaman = Halaman::where('slug', 'sejarah')
            ->where('is_active', true)
            ->firstOrFail();

        return view('visitor.halaman', compact('halaman'));
    }

    public function profil()
    {
        $halaman = Halaman::where('slug', 'profil')
            ->where('is_active', true)
            ->firstOrFail();

        return view('visitor.halaman', compact('halaman'));
    }

    public function bidangKerja()
    {
        $halaman = Halaman::where('slug', 'bidang-kerja')
            ->where('is_active', true)
            ->firstOrFail();

        return view('visitor.halaman', compact('halaman'));
    }

    public function mitra()
    {
        $halaman = Halaman::where('slug', 'mitra')
            ->where('is_active', true)
            ->firstOrFail();

        return view('visitor.halaman', compact('halaman'));
    }

    public function halaman(string $slug)
    {
        $halaman = Halaman::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('visitor.halaman', compact('halaman'));
    }

    public function petaSitus()
    {
        $halamanList = Halaman::where('is_active', true)->orderBy('urutan')->get();
        $kategoriBeritaList = KategoriBerita::whereNotNull('slug')
            ->withCount(['berita' => fn ($q) => $q->where('status', 'terbit')])
            ->get();
        $beritaTerbaru = Berita::where('status', 'terbit')
            ->latest('tanggal_terbit')
            ->take(20)
            ->get();
        $galeriTerbaru = Galeri::latest()->take(20)->get();
        $kdkTerbaru = Kdk::orderByDesc('tanggal_terbit')->take(20)->get();

        return view('visitor.peta-situs', compact(
            'halamanList',
            'kategoriBeritaList',
            'beritaTerbaru',
            'galeriTerbaru',
            'kdkTerbaru'
        ));
    }
}
