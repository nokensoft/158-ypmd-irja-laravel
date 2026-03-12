<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->cari}%")
                  ->orWhere('email', 'like', "%{$request->cari}%");
            });
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $pengguna = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('admin.pengguna.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin_master,penulis',
            'nomor_hp' => 'nullable|string|max:20',
            'keterangan_singkat' => 'nullable|string|max:255',
        ]);

        $data = $request->only('name', 'email', 'password', 'role', 'nomor_hp', 'keterangan_singkat');
        $data['is_active'] = $request->boolean('is_active');

        User::create($data);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $pengguna = User::findOrFail($id);
        return view('admin.pengguna.form', ['editMode' => true, 'pengguna' => $pengguna]);
    }

    public function update(Request $request, string $id)
    {
        $pengguna = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($pengguna->id)],
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin_master,penulis',
            'nomor_hp' => 'nullable|string|max:20',
            'keterangan_singkat' => 'nullable|string|max:255',
        ]);

        $data = $request->only('name', 'email', 'role', 'nomor_hp', 'keterangan_singkat');
        $data['is_active'] = $request->boolean('is_active');
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $pengguna->update($data);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pengguna = User::findOrFail($id);

        if ($pengguna->id === session('user.id')) {
            return redirect()->route('admin.pengguna.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $pengguna->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $pengguna = User::onlyTrashed()->findOrFail($id);
        $pengguna->restore();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $pengguna = User::onlyTrashed()->findOrFail($id);
        $pengguna->forceDelete();

        return redirect()->route('admin.pengguna.index', ['status' => 'terhapus'])->with('success', 'Pengguna berhasil dihapus permanen.');
    }
}
