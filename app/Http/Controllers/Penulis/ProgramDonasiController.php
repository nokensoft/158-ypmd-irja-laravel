<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;

class ProgramDonasiController extends Controller
{
    public function index(Request $request)
    {
        $query = ProgramDonasi::with('media')->withCount('donasi');

        if ($request->filled('cari')) {
            $query->where('judul', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $programs = $query->latest()->paginate(10)->withQueryString();

        $totalAktif = ProgramDonasi::where('is_active', true)->count();
        $totalNonaktif = ProgramDonasi::where('is_active', false)->count();

        return view('penulis.program-donasi.index', compact('programs', 'totalAktif', 'totalNonaktif'));
    }

    public function create()
    {
        return view('penulis.program-donasi.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'media_id'       => 'nullable|exists:media,id',
            'target_nominal' => 'nullable|integer|min:0',
            'is_active'      => 'nullable|boolean',
        ]);

        ProgramDonasi::create([
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'media_id'       => $request->media_id,
            'target_nominal' => $request->target_nominal,
            'is_active'      => $request->boolean('is_active', true),
            'user_id'        => session('user.id'),
        ]);

        return redirect()->route('penulis.program-donasi.index')->with('success', 'Program donasi berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $program = ProgramDonasi::with('media')->findOrFail($id);

        return view('penulis.program-donasi.form', ['editMode' => true, 'program' => $program]);
    }

    public function update(Request $request, string $id)
    {
        $program = ProgramDonasi::findOrFail($id);

        $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'media_id'       => 'nullable|exists:media,id',
            'target_nominal' => 'nullable|integer|min:0',
            'is_active'      => 'nullable|boolean',
        ]);

        $program->update([
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'media_id'       => $request->media_id,
            'target_nominal' => $request->target_nominal,
            'is_active'      => $request->boolean('is_active', true),
        ]);

        return redirect()->route('penulis.program-donasi.index')->with('success', 'Program donasi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $program = ProgramDonasi::findOrFail($id);
        $program->delete();

        return redirect()->route('penulis.program-donasi.index')->with('success', 'Program donasi berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $program = ProgramDonasi::onlyTrashed()->findOrFail($id);
        $program->restore();

        return redirect()->route('penulis.program-donasi.index')->with('success', 'Program donasi berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $program = ProgramDonasi::onlyTrashed()->findOrFail($id);
        $program->forceDelete();

        return redirect()->route('penulis.program-donasi.index', ['status' => 'terhapus'])->with('success', 'Program donasi berhasil dihapus permanen.');
    }
}
