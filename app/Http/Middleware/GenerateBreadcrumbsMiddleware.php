<?php

namespace App\Http\Middleware;

use Closure;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class GenerateBreadcrumbsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $breadcrumbs = Breadcrumbs::generate();

        if (!empty($breadcrumbs)) {
            $breadcrumbs[count($breadcrumbs) - 1]->current = true;
        }

        Inertia::share('breadcrumbs', $breadcrumbs);

        return $next($request);
    }
}
