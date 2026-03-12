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

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_donatur', 'like', "%{$request->cari}%")
                  ->orWhere('email', 'like', "%{$request->cari}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('program')) {
            $query->where('program_donasi_id', $request->program);
        }

        $donasi = $query->paginate(15)->withQueryString();

        $statsPending       = Donasi::where('status', 'pending')->count();
        $statsDikonfirmasi  = Donasi::where('status', 'dikonfirmasi')->count();
        $statsDitolak       = Donasi::where('status', 'ditolak')->count();
        $statsTotal         = Donasi::where('status', 'dikonfirmasi')->sum('jumlah');
        $programs           = ProgramDonasi::orderBy('judul')->get();

        return view('penulis.donasi.index', compact(
            'donasi', 'statsPending', 'statsDikonfirmasi', 'statsDitolak', 'statsTotal', 'programs'
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

    public function destroy(string $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->delete();

        return redirect()->route('penulis.donasi.index')->with('success', 'Data donasi dihapus.');
    }
}
