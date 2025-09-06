<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Employer
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() === null || $request->user()->employer === null) {
            return redirect()->route('employers.create')
                ->with('error', 'You must be an employer to access this page.');
        }

        return $next($request);
    }
}
