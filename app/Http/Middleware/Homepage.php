<?php

namespace App\Http\Middleware;

use Closure;

class Homepage
{
    /**
     * Finds page in db and registers route.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->getPathInfo();
        $index = '/index';
        if (starts_with($path, $index)) {
            $path = ltrim(str_replace_first($index, '', $request->getRequestUri()), '/');

            return redirect('/'.$path, 301);
        }

        return $next($request);
    }
}
