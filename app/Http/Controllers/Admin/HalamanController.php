<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Halaman::query();

        if ($request->filled('cari')) {
            $query->where('judul', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $halaman = $query->orderBy('urutan')->latest()->paginate(15)->withQueryString();

        return view('admin.halaman.index', compact('halaman'));
    }

    public function create()
    {
        return view('admin.halaman.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'slug'      => 'nullable|string|max:255|unique:halaman,slug',
            'keterangan'=> 'nullable|string|max:500',
            'konten'    => 'nullable|string',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        Halaman::create([
            'judul'     => $request->judul,
            'slug'      => $request->slug ?: null,
            'keterangan'=> $request->keterangan,
            'konten'    => $request->konten,
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
            'user_id'   => session('user.id'),
        ]);

        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $halaman = Halaman::findOrFail($id);

        return view('admin.halaman.form', ['editMode' => true, 'halaman' => $halaman]);
    }

    public function update(Request $request, string $id)
    {
        $halaman = Halaman::findOrFail($id);

        $request->validate([
            'judul'     => 'required|string|max:255',
            'slug'      => 'nullable|string|max:255|unique:halaman,slug,' . $id,
            'keterangan'=> 'nullable|string|max:500',
            'konten'    => 'nullable|string',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $halaman->update([
            'judul'     => $request->judul,
            'slug'      => $request->slug ?: $halaman->slug,
            'keterangan'=> $request->keterangan,
            'konten'    => $request->konten,
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $halaman = Halaman::findOrFail($id);
        $halaman->delete();

        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $halaman = Halaman::onlyTrashed()->findOrFail($id);
        $halaman->restore();

        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $halaman = Halaman::onlyTrashed()->findOrFail($id);
        $halaman->forceDelete();

        return redirect()->route('admin.halaman.index', ['status' => 'terhapus'])->with('success', 'Halaman berhasil dihapus permanen.');
    }
}
