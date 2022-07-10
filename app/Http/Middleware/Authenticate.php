<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson() && $request->inertia()) {
            abort(409, '', ['X-Inertia-Location' => url()->route('login')]);
        } else {
            if (! $request->expectsJson()) {
                return route('login');
            }
        }
    }
}
