<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = session('user');

        if ($user) {
            return match ($user['role']) {
                'admin_master' => redirect()->route('admin.dashboard'),
                'penulis' => redirect()->route('penulis.dashboard'),
                default => redirect('/'),
            };
        }

        return $next($request);
    }
}
