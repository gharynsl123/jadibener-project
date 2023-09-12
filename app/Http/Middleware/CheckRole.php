<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // Periksa apakah peran pengguna termasuk dalam peran yang diizinkan
            $userRole = Auth::user()->level;
            if (in_array($userRole, $roles)) {
                // Jika peran pengguna termasuk dalam peran yang diizinkan, lanjutkan permintaan
                return $next($request);
            }
        }

        // Jika peran pengguna tidak termasuk dalam peran yang diizinkan, maka munculkan halaman 505
        abort(403, 'Unauthorized.');
    }
}
