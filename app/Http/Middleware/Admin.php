<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->Role->label == 'Admin') {
                return $next($request);
            }
        }

        $data = [
            'error' => true,
            'message' => 'Vous n\'êtes pas autorisé à mener cette action'
        ];
        return response()->json($data, 403);
    }
}
