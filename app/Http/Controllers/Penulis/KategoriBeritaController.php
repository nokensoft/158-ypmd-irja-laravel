<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class KategoriBeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = KategoriBerita::withCount('berita');

        if ($request->filled('cari')) {
            $query->where('nama', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $kategori = $query->latest()->paginate(10)->withQueryString();

        return view('penulis.kategori-berita.index', compact('kategori'));
    }

    public function create()
    {
        return view('penulis.kategori-berita.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_berita,nama',
        ]);

        KategoriBerita::create(['nama' => $request->nama]);

        return redirect()->route('penulis.kategori-berita.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $kategoriBerita = KategoriBerita::findOrFail($id);
        return view('penulis.kategori-berita.form', ['editMode' => true, 'kategoriBerita' => $kategoriBerita]);
    }

    public function update(Request $request, string $id)
    {
        $kategoriBerita = KategoriBerita::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_berita,nama,' . $id,
        ]);

        $kategoriBerita->update(['nama' => $request->nama]);

        return redirect()->route('penulis.kategori-berita.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kategoriBerita = KategoriBerita::findOrFail($id);
        $kategoriBerita->delete();

        return redirect()->route('penulis.kategori-berita.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $kategoriBerita = KategoriBerita::onlyTrashed()->findOrFail($id);
        $kategoriBerita->restore();

        return redirect()->route('penulis.kategori-berita.index')->with('success', 'Kategori berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $kategoriBerita = KategoriBerita::onlyTrashed()->findOrFail($id);
        $kategoriBerita->forceDelete();

        return redirect()->route('penulis.kategori-berita.index', ['status' => 'terhapus'])->with('success', 'Kategori berhasil dihapus permanen.');
    }
}
