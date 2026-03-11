<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Donasi::latest();

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_donatur', 'like', "%{$request->cari}%")
                  ->orWhere('email', 'like', "%{$request->cari}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $donasi = $query->paginate(15)->withQueryString();

        $totalPending       = Donasi::where('status', 'pending')->count();
        $totalDikonfirmasi  = Donasi::where('status', 'dikonfirmasi')->count();
        $totalJumlah        = Donasi::where('status', 'dikonfirmasi')->sum('jumlah');

        return view('admin.donasi.index', compact(
            'donasi', 'totalPending', 'totalDikonfirmasi', 'totalJumlah'
        ));
    }

    public function show(string $id)
    {
        $donasi = Donasi::findOrFail($id);

        return view('admin.donasi.show', compact('donasi'));
    }

    public function konfirmasi(Request $request, string $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update([
            'status'          => 'dikonfirmasi',
            'catatan_admin'   => $request->catatan_admin,
        ]);

        return redirect()->route('admin.donasi.index')->with('success', 'Donasi berhasil dikonfirmasi.');
    }

    public function tolak(Request $request, string $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update([
            'status'        => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.donasi.index')->with('success', 'Donasi ditandai sebagai ditolak.');
    }

    public function destroy(string $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->delete();

        return redirect()->route('admin.donasi.index')->with('success', 'Data donasi dihapus.');
    }
}
