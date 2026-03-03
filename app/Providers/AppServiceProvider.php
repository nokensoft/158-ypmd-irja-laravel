<?php

namespace App\Providers;

use App\View\Composers\SitusComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer([
            'layouts.visitor',
            'partials.header',
            'partials.footer',
        ], SitusComposer::class);
    }
}
