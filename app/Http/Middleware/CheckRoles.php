<?php

namespace App\Http\Middleware;

// app/Http/Middleware/CheckRoles.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        // Jika pengguna tidak login
        if (!$user) {
            return redirect()->route("login")->with('error', 'Please log in first.');
        }

        // Periksa apakah peran pengguna ada dalam array peran yang diperbolehkan
        if (!in_array($user->role, $roles)) {
            return redirect()->route("home")->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
