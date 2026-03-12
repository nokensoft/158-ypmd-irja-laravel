<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use App\Models\AktivitasLogin;
use App\Models\User;
use Illuminate\Http\Request;

class AktivitasLoginController extends Controller
{
    public function index(Request $request)
    {
        // Hanya tampilkan aktivitas login penulis (tidak termasuk admin)
        $penulisIds = User::where('role', 'penulis')->pluck('id');

        $query = AktivitasLogin::with('user')
            ->whereIn('user_id', $penulisIds)
            ->latest();

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->cari}%")
                  ->orWhere('email', 'like', "%{$request->cari}%");
            });
        }

        $aktivitas = $query->paginate(15)->withQueryString();

        return view('penulis.aktivitas-login', compact('aktivitas'));
    }
}
