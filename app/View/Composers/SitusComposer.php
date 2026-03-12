<?php

namespace App\View\Composers;

use App\Models\Halaman;
use App\Models\PengaturanSitus;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SitusComposer
{
    public function compose(View $view): void
    {
        $situs = Cache::remember('pengaturan_situs', 300, function () {
            return PengaturanSitus::pluck('value', 'key')->toArray();
        });

        $halamanFooter = Cache::remember('halaman_footer', 300, function () {
            return Halaman::where('is_active', true)
                ->orderBy('urutan')
                ->get(['judul', 'slug']);
        });

        $view->with('situs', $situs)
             ->with('halamanFooter', $halamanFooter);
    }
}
