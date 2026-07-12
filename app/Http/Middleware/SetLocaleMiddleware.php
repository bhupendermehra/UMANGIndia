<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', 'en');

        if ($request->has('lang')) {
            $lang = $request->input('lang');
            if (in_array($lang, ['en', 'hi'])) {
                session(['locale' => $lang]);
                $locale = $lang;
            }
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
