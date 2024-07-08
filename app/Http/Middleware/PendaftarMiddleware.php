<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PendaftarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna adalah pendaftar atau bukan
        if (auth('pendaftar')->check()) {
            return $next($request);
        } else {
            return redirect()->route('flogin');
        }
    }
}
