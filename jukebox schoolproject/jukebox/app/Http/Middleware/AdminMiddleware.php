<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Controleer of de ingelogde gebruiker administratorrechten heeft.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('songs.index')
                ->with('error', 'Je hebt geen toestemming om deze actie uit te voeren. Alleen administrators hebben toegang.');
        }

        return $next($request);
    }
}
