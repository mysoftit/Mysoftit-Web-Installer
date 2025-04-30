<?php

namespace MySoftITWebInstaller\Middleware;

use Closure;
use Illuminate\Support\Facades\File;

class CanInstall
{
    public function handle($request, Closure $next)
    {
        if (File::exists(storage_path('installed'))) {
            abort(403, 'The application is already installed.');
        }

        return $next($request);
    }
}