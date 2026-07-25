<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $userRole = strtolower(auth()->user()->role);
        $allowedRoles = array_map('strtolower', $roles);

        // Tambahkan logika bahwa Owner memiliki akses ke semua fitur Manager
        if ($userRole === 'owner' && in_array('manager', $allowedRoles)) {
            $allowedRoles[] = 'owner';
        }

        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki akses ke fitur ini');
        }

        return $next($request);
    }
}
