<?php

namespace App\Http\Controllers\Penulis;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Kdk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KdkController extends Controller
{
    public function index(Request $request)
    {
        $query = Kdk::with('media');

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', "%{$request->cari}%")
                  ->orWhere('nomor_edisi', 'like', "%{$request->cari}%");
            });
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $kdk = $query->orderByDesc('tanggal_terbit')->paginate(10)->withQueryString();

        return view('penulis.kdk.index', compact('kdk'));
    }

    public function create()
    {
        return view('penulis.kdk.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_edisi'   => 'required|string|max:20',
            'judul'         => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'tanggal_terbit'=> 'nullable|date',
            'file_pdf'      => 'nullable|file|mimes:pdf|max:20480', // max 20 MB
            'media_id'      => 'nullable|exists:media,id',
        ]);

        $pdfPath = null;
        if ($request->hasFile('file_pdf')) {
            $pdfPath = $request->file('file_pdf')->storeAs('kdk', ImageHelper::generateFilename('pdf'), 'public');
        }

        Kdk::create([
            'nomor_edisi'    => $request->nomor_edisi,
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'tanggal_terbit' => $request->tanggal_terbit,
            'file_pdf'       => $pdfPath,
            'media_id'       => $request->media_id,
            'user_id'        => session('user.id'),
        ]);

        return redirect()->route('penulis.kdk.index')->with('success', 'Edisi KDK berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $kdk = Kdk::with('media')->findOrFail($id);

        return view('penulis.kdk.form', ['editMode' => true, 'kdk' => $kdk]);
    }

    public function update(Request $request, string $id)
    {
        $kdk = Kdk::findOrFail($id);

        $request->validate([
            'nomor_edisi'    => 'required|string|max:20',
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'tanggal_terbit' => 'nullable|date',
            'file_pdf'       => 'nullable|file|mimes:pdf|max:20480',
            'media_id'       => 'nullable|exists:media,id',
        ]);

        $pdfPath = $kdk->file_pdf;
        if ($request->hasFile('file_pdf')) {
            // Delete old file if exists
            if ($kdk->file_pdf) {
                Storage::disk('public')->delete($kdk->file_pdf);
            }
            $pdfPath = $request->file('file_pdf')->storeAs('kdk', ImageHelper::generateFilename('pdf'), 'public');
        }

        if ($request->boolean('hapus_pdf') && $kdk->file_pdf) {
            Storage::disk('public')->delete($kdk->file_pdf);
            $pdfPath = null;
        }

        $kdk->update([
            'nomor_edisi'    => $request->nomor_edisi,
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'tanggal_terbit' => $request->tanggal_terbit,
            'file_pdf'       => $pdfPath,
            'media_id'       => $request->media_id,
        ]);

        return redirect()->route('penulis.kdk.index')->with('success', 'Edisi KDK berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kdk = Kdk::findOrFail($id);
        $kdk->delete();

        return redirect()->route('penulis.kdk.index')->with('success', 'Edisi KDK berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $kdk = Kdk::onlyTrashed()->findOrFail($id);
        $kdk->restore();

        return redirect()->route('penulis.kdk.index')->with('success', 'Edisi KDK berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $kdk = Kdk::onlyTrashed()->findOrFail($id);

        if ($kdk->file_pdf) {
            Storage::disk('public')->delete($kdk->file_pdf);
        }

        $kdk->forceDelete();

        return redirect()->route('penulis.kdk.index', ['status' => 'terhapus'])->with('success', 'Edisi KDK berhasil dihapus permanen.');
    }
}
