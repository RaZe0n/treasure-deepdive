<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class IsGuestMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('IsGuestMiddelware: Request received', [
            'path' => $request->path(),
            'method' => $request->method(),
            'session_id' => session()->getId(),
            'session_guest_id' => session('guest_id'),
            'session_all' => session()->all(),
            'cookies' => $request->cookies->all(),
            'headers' => $request->headers->all()
        ]);

        // Skip middleware for broadcasting auth
        if ($request->is('broadcasting/auth')) {
            Log::info('IsGuestMiddelware: Skipping for broadcasting auth');
            return $next($request);
        }

        // Check if guest_id exists in session
        if (!session()->has('guest_id')) {
            Log::warning('IsGuestMiddelware: No guest_id in session', [
                'session_id' => session()->getId(),
                'session_all' => session()->all()
            ]);
            return redirect('/');
        }

        // Ensure session is saved
        session()->save();

        Log::info('IsGuestMiddelware: Guest authenticated', [
            'guest_id' => session('guest_id'),
            'session_id' => session()->getId(),
            'session_all' => session()->all()
        ]);

        return $next($request);
    }
}
