<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSitus;
use Illuminate\Http\Request;

class PengaturanSitusController extends Controller
{
    public function index()
    {
        $settings = PengaturanSitus::pluck('value', 'key');
        return view('admin.pengaturan-situs', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'nama_situs', 'deskripsi_situs', 'email', 'telepon', 'alamat',
            'sosmed_facebook', 'sosmed_instagram', 'sosmed_youtube', 'sosmed_twitter', 'sosmed_tiktok',
            'seo_meta_keywords', 'seo_meta_description',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                PengaturanSitus::setValue($key, $request->input($key));
            }
        }

        if ($request->hasFile('logo')) {
            $oldLogo = PengaturanSitus::getValue('logo');
            if ($oldLogo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('logo')->store('situs', 'public');
            PengaturanSitus::setValue('logo', $path);
        }

        if ($request->hasFile('seo_og_image')) {
            $oldOg = PengaturanSitus::getValue('seo_og_image');
            if ($oldOg) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldOg);
            }
            $path = $request->file('seo_og_image')->store('situs', 'public');
            PengaturanSitus::setValue('seo_og_image', $path);
        }

        return redirect()->route('admin.pengaturan-situs')->with('success', 'Pengaturan situs berhasil diperbarui.');
    }
}
