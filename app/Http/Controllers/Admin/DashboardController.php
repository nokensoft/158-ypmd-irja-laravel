<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Berita;
use App\Models\Kdk;
use App\Models\Donasi;
use App\Models\Galeri;
use App\Models\AktivitasLogin;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            ['icon' => 'fa-users',     'value' => User::count(),                          'label' => 'Total Pengguna',       'color' => 'bg-primary'],
            ['icon' => 'fa-newspaper', 'value' => Berita::count(),                        'label' => 'Papua Today',          'color' => 'bg-secondary'],
            ['icon' => 'fa-book-open', 'value' => Kdk::count(),                           'label' => 'Edisi KDK',           'color' => 'bg-green-600'],
            ['icon' => 'fa-heart',     'value' => Donasi::where('status','pending')->count(), 'label' => 'Donasi Pending', 'color' => 'bg-orange-500'],
        ];

        $loginTerbaru = AktivitasLogin::with('user')
            ->latest()
            ->take(5)
            ->get();

        $sistem = [
            'laravel' => App::version(),
            'php' => PHP_VERSION,
            'database' => config('database.default') . ' (' . DB::getDatabaseName() . ')',
        ];

        return view('admin.dashboard', compact('stats', 'loginTerbaru', 'sistem'));
    }
}
