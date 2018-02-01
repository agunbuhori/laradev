<?php

namespace App\Http\Middleware;

use Closure;
use App\Module;
use App\Authorization as Author;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (request()->segment(2)) {
            $checkModule = Module::where('uri', request()->segment(2));
            $checkAuthor = Author::where('module_id', $checkModule->first()->id)->where('role_id', auth()->user()->role_id);

            if ($checkModule->count() === 1 && $checkAuthor->count() === 1) 
                return $next($request);

            abort(403, "Unauthorized");
        }

        abort(404, "Page not found");
    }
}
