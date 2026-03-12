<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\ProgramDonasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Donasi::with('programDonasi')->latest();

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        } else {
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
        }

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_donatur', 'like', "%{$request->cari}%")
                  ->orWhere('email', 'like', "%{$request->cari}%");
            });
        }

        if ($request->filled('program')) {
            $query->where('program_donasi_id', $request->program);
        }

        $donasi = $query->paginate(15)->withQueryString();

        $statsPending       = Donasi::where('status', 'pending')->count();
        $statsDikonfirmasi  = Donasi::where('status', 'dikonfirmasi')->count();
        $statsDitolak       = Donasi::where('status', 'ditolak')->count();
        $statsTotal         = Donasi::where('status', 'dikonfirmasi')->sum('jumlah');
        $statsTerhapus      = Donasi::onlyTrashed()->count();
        $programs           = ProgramDonasi::orderBy('judul')->get();

        return view('penulis.donasi.index', compact(
            'donasi', 'statsPending', 'statsDikonfirmasi', 'statsDitolak', 'statsTotal', 'statsTerhapus', 'programs'
        ));
    }

    public function show(string $id)
    {
        $donasi = Donasi::with('programDonasi')->findOrFail($id);

        return view('penulis.donasi.show', compact('donasi'));
    }

    public function konfirmasi(Request $request, string $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update([
            'status'          => 'dikonfirmasi',
            'catatan_admin'   => $request->catatan_admin,
        ]);

        return redirect()->route('penulis.donasi.index')->with('success', 'Donasi berhasil dikonfirmasi.');
    }

    public function tolak(Request $request, string $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update([
            'status'        => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('penulis.donasi.index')->with('success', 'Donasi ditandai sebagai ditolak.');
    }

    public function buktiTransfer(string $id)
    {
        $donasi = Donasi::findOrFail($id);

        if (!$donasi->bukti_transfer) {
            abort(404, 'Bukti transfer tidak tersedia.');
        }

        $path = storage_path('app/public/' . $donasi->bukti_transfer);

        if (!file_exists($path)) {
            abort(404, 'File bukti transfer tidak ditemukan.');
        }

        return response()->file($path);
    }

    public function updatePesan(Request $request, string $id)
    {
        $request->validate([
            'pesan' => 'nullable|string|max:1000',
        ]);

        $donasi = Donasi::findOrFail($id);
        $donasi->update(['pesan' => $request->pesan]);

        return redirect()->route('penulis.donasi.show', $id)->with('success', 'Pesan donatur berhasil diperbarui.');
    }

    public function toggleAnonim(string $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update(['is_anonim' => !$donasi->is_anonim]);

        $label = $donasi->is_anonim ? 'ditandai sebagai anonim' : 'ditampilkan dengan nama asli';

        return redirect()->back()->with('success', "Donatur berhasil {$label}.");
    }

    public function togglePublik(string $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update(['is_publik' => !$donasi->is_publik]);

        $label = $donasi->is_publik ? 'ditampilkan di publik' : 'disembunyikan dari publik';

        return redirect()->back()->with('success', "Donasi berhasil {$label}.");
    }

    public function destroy(string $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->delete();

        return redirect()->route('penulis.donasi.index')->with('success', 'Data donasi berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $donasi = Donasi::onlyTrashed()->findOrFail($id);
        $donasi->restore();

        return redirect()->route('penulis.donasi.index')->with('success', 'Data donasi berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $donasi = Donasi::onlyTrashed()->findOrFail($id);
        $donasi->forceDelete();

        return redirect()->route('penulis.donasi.index', ['status' => 'terhapus'])->with('success', 'Data donasi berhasil dihapus permanen.');
    }
}
