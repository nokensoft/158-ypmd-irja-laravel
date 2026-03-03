<?php

namespace App\View\Composers;

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

        $view->with('situs', $situs);
    }
}
