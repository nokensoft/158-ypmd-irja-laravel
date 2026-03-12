<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Media;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::withCount('media')
            ->with(['media' => fn ($q) => $q->limit(1)]);

        if ($request->filled('cari')) {
            $query->where('judul', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $galeri = $query->latest()->paginate(10)->withQueryString();

        return view('penulis.galeri.index', compact('galeri'));
    }

    public function create()
    {
        $media = Media::latest()->get();

        return view('penulis.galeri.form', compact('media') + ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:' . implode(',', Galeri::KATEGORI_LIST),
            'media_ids' => 'nullable|array',
            'media_ids.*' => 'exists:media,id',
        ]);

        $galeri = Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'user_id' => session('user.id'),
        ]);

        if ($request->has('media_ids')) {
            $galeri->media()->sync($request->media_ids);
        }

        return redirect()->route('penulis.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $galeri = Galeri::with('media')->findOrFail($id);
        $media = Media::latest()->get();

        return view('penulis.galeri.form', compact('galeri', 'media') + ['editMode' => true]);
    }

    public function update(Request $request, string $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:' . implode(',', Galeri::KATEGORI_LIST),
            'media_ids' => 'nullable|array',
            'media_ids.*' => 'exists:media,id',
        ]);

        $galeri->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        $galeri->media()->sync($request->media_ids ?? []);

        return redirect()->route('penulis.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->delete();

        return redirect()->route('penulis.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $galeri = Galeri::onlyTrashed()->findOrFail($id);
        $galeri->restore();

        return redirect()->route('penulis.galeri.index')->with('success', 'Galeri berhasil dipulihkan.');
    }

    public function togglePublik(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->update(['is_publik' => !$galeri->is_publik]);

        $label = $galeri->is_publik ? 'ditampilkan di publik' : 'disembunyikan dari publik';

        return redirect()->back()->with('success', "Galeri berhasil {$label}.");
    }

    public function forceDelete(string $id)
    {
        $galeri = Galeri::onlyTrashed()->findOrFail($id);
        $galeri->forceDelete();

        return redirect()->route('penulis.galeri.index', ['status' => 'terhapus'])->with('success', 'Galeri berhasil dihapus permanen.');
    }
}
