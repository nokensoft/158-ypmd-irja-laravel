<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = User::findOrFail(session('user.id'));

        return view('profil.form', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(session('user.id'));

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
            'nomor_hp' => 'nullable|string|max:20',
            'keterangan_singkat' => 'nullable|string|max:255',
        ]);

        $data = $request->only('name', 'email', 'nomor_hp', 'keterangan_singkat');
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        // Update session data
        session([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ]);

        $prefix = $user->role === 'admin_master' ? 'admin' : 'penulis';

        return redirect()->route("{$prefix}.profil")->with('success', 'Profil berhasil diperbarui.');
    }
}
