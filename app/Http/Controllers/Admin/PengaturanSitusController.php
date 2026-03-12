<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\PengaturanSitus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
            'sosmed_facebook', 'sosmed_instagram', 'sosmed_youtube', 'sosmed_twitter', 'sosmed_tiktok', 'sosmed_whatsapp',
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
            $processed = ImageHelper::processAndStore($request->file('logo'), 'situs');
            PengaturanSitus::setValue('logo', $processed['path']);
        }

        if ($request->hasFile('seo_og_image')) {
            $oldOg = PengaturanSitus::getValue('seo_og_image');
            if ($oldOg) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldOg);
            }
            $processed = ImageHelper::processAndStore($request->file('seo_og_image'), 'situs');
            PengaturanSitus::setValue('seo_og_image', $processed['path']);
        }

        Cache::forget('pengaturan_situs');

        return redirect()->route('admin.pengaturan-situs')->with('success', 'Pengaturan situs berhasil diperbarui.');
    }
}
