<?php

namespace App\Http\Middleware;

use Closure;

class Pic
{
    public function handle($request, Closure $next)
    {
        $isPremium = $request->route()->parameters('picCategory')['picCategory']->premium;

        if ($isPremium) {
            if (auth()->check()) {
                $user = auth()->user();
                if ($user->hasAccess()) {
                    return $next($request);
                } else {
                    return redirect()->route('renewplan');
                }
            } else {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
