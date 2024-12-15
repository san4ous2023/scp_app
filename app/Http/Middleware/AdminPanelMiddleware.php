<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd(auth()->user()->role->title);
        try {
            if (auth()->user()->role->title !== 'admin') {
                return redirect()->route('home');
            }

        } catch (\Exception $message) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
