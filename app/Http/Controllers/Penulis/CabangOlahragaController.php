<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\CabangOlahraga;
use Illuminate\Http\Request;

class CabangOlahragaController extends Controller
{
    public function index(Request $request)
    {
        $query = CabangOlahraga::query();

        if ($request->filled('cari')) {
            $query->where('nama', 'like', "%{$request->cari}%");
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $cabor = $query->latest()->paginate(10)->withQueryString();

        return view('penulis.cabang-olahraga.index', compact('cabor'));
    }

    public function create()
    {
        return view('penulis.cabang-olahraga.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'jumlah_atlet' => 'nullable|integer|min:0',
            'jumlah_medali' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        CabangOlahraga::create($request->only('nama', 'icon', 'jumlah_atlet', 'jumlah_medali', 'deskripsi'));

        return redirect()->route('penulis.cabang-olahraga.index')->with('success', 'Cabang olahraga berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $cabor = CabangOlahraga::findOrFail($id);
        return view('penulis.cabang-olahraga.form', ['editMode' => true, 'cabor' => $cabor]);
    }

    public function update(Request $request, string $id)
    {
        $cabor = CabangOlahraga::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'jumlah_atlet' => 'nullable|integer|min:0',
            'jumlah_medali' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $cabor->update($request->only('nama', 'icon', 'jumlah_atlet', 'jumlah_medali', 'deskripsi'));

        return redirect()->route('penulis.cabang-olahraga.index')->with('success', 'Cabang olahraga berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $cabor = CabangOlahraga::findOrFail($id);
        $cabor->delete();

        return redirect()->route('penulis.cabang-olahraga.index')->with('success', 'Cabang olahraga berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $cabor = CabangOlahraga::onlyTrashed()->findOrFail($id);
        $cabor->restore();

        return redirect()->route('penulis.cabang-olahraga.index')->with('success', 'Cabang olahraga berhasil dipulihkan.');
    }
}
