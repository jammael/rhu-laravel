<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Check if user is admin
        if ($request->user()->role !== 'admin') {
            return redirect()->back()
                ->with('error', 'Unauthorized access. Only administrators can access NutriCare Overview.');
        }

        return $next($request);
    }
}
