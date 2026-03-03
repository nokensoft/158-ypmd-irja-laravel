<?php

namespace App\Http\Controllers;

use App\Models\AktivitasLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            AktivitasLogin::create([
                'user_id' => $user?->id,
                'nama' => $user?->name ?? 'Unknown',
                'email' => $request->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'gagal',
            ]);

            return back()->with('error', 'Email atau password salah.')->withInput();
        }

        if (!$user->is_active) {
            AktivitasLogin::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'gagal',
            ]);

            return back()->with('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.')->withInput();
        }

        AktivitasLogin::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'berhasil',
        ]);

        session(['user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ]]);

        return match ($user->role) {
            'admin_master' => redirect()->route('admin.dashboard'),
            'penulis' => redirect()->route('penulis.dashboard'),
            default => redirect('/'),
        };
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
