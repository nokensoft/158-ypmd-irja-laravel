<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\Media;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::with(['kategori', 'media']);

        if ($request->filled('cari')) {
            $query->where('judul', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $berita = $query->latest()->paginate(10)->withQueryString();

        return view('penulis.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = KategoriBerita::orderBy('nama')->get();
        $media = Media::where('tipe', 'foto')->orderBy('judul')->get();

        return view('penulis.berita.form', compact('kategori', 'media') + ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_berita_id' => 'required|exists:kategori_berita,id',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string',
            'media_id' => 'nullable|exists:media,id',
            'status' => 'nullable|in:draft,terbit',
            'tanggal_terbit' => 'nullable|date',
            'sumber_nama' => 'nullable|string|max:255',
            'sumber_link' => 'nullable|url|max:500',
        ]);

        Berita::create([
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'konten' => $request->konten,
            'kategori_berita_id' => $request->kategori_berita_id,
            'media_id' => $request->media_id,
            'user_id' => session('user.id'),
            'status' => $request->status ?? 'draft',
            'tanggal_terbit' => $request->tanggal_terbit,
            'sumber_nama' => $request->sumber_nama,
            'sumber_link' => $request->sumber_link,
        ]);

        return redirect()->route('penulis.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = KategoriBerita::orderBy('nama')->get();
        $media = Media::where('tipe', 'foto')->orderBy('judul')->get();

        return view('penulis.berita.form', compact('berita', 'kategori', 'media') + ['editMode' => true]);
    }

    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_berita_id' => 'required|exists:kategori_berita,id',
            'konten' => 'required|string',
            'ringkasan' => 'nullable|string',
            'media_id' => 'nullable|exists:media,id',
            'status' => 'nullable|in:draft,terbit',
            'tanggal_terbit' => 'nullable|date',
            'sumber_nama' => 'nullable|string|max:255',
            'sumber_link' => 'nullable|url|max:500',
        ]);

        $berita->update([
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'konten' => $request->konten,
            'kategori_berita_id' => $request->kategori_berita_id,
            'media_id' => $request->media_id,
            'status' => $request->status ?? $berita->status,
            'tanggal_terbit' => $request->tanggal_terbit,
            'sumber_nama' => $request->sumber_nama,
            'sumber_link' => $request->sumber_link,
        ]);

        return redirect()->route('penulis.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('penulis.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $berita = Berita::onlyTrashed()->findOrFail($id);
        $berita->restore();

        return redirect()->route('penulis.berita.index')->with('success', 'Berita berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $berita = Berita::onlyTrashed()->findOrFail($id);
        $berita->forceDelete();

        return redirect()->route('penulis.berita.index', ['status' => 'terhapus'])->with('success', 'Berita berhasil dihapus permanen.');
    }
}
