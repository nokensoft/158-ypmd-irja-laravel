<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AktivitasLogin;
use Illuminate\Http\Request;

class AktivitasLoginController extends Controller
{
    public function index(Request $request)
    {
        $query = AktivitasLogin::with('user')->latest();

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->cari}%")
                  ->orWhere('email', 'like', "%{$request->cari}%");
            });
        }

        $aktivitas = $query->paginate(15)->withQueryString();

        return view('admin.aktivitas-login', compact('aktivitas'));
    }
}
