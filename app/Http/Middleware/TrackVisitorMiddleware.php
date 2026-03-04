<?php

namespace App\Http\Middleware;

use App\Models\KunjunganSitus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $today = now()->toDateString();

        KunjunganSitus::firstOrCreate(
            ['ip_address' => $ip, 'tanggal' => $today],
            ['url' => $request->path(), 'user_agent' => $request->userAgent()]
        );

        return $next($request);
    }
}
