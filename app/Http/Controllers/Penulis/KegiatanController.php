<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->filled('cari')) {
            $query->where('judul', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $kegiatan = $query->latest()->paginate(10)->withQueryString();

        return view('penulis.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('penulis.kegiatan.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Kegiatan::create($request->only('judul', 'tanggal_mulai', 'tanggal_selesai', 'lokasi', 'deskripsi'));

        return redirect()->route('penulis.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('penulis.kegiatan.form', ['editMode' => true, 'kegiatan' => $kegiatan]);
    }

    public function update(Request $request, string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kegiatan->update($request->only('judul', 'tanggal_mulai', 'tanggal_selesai', 'lokasi', 'deskripsi'));

        return redirect()->route('penulis.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('penulis.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $kegiatan = Kegiatan::onlyTrashed()->findOrFail($id);
        $kegiatan->restore();

        return redirect()->route('penulis.kegiatan.index')->with('success', 'Kegiatan berhasil dipulihkan.');
    }
}
