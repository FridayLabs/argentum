<?php

namespace App\Http\Middleware;

use App\Models\Page;
use App\Http\Controllers\Controller;

class LoadRoutes
{
    /**
     * Finds page in db and registers route
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $pages = Page::all();
        foreach ($pages as $page) {
            $alias = $page->alias === 'index' ? '' : $page->alias;
            app()->get('/' . $alias, [
                'as' => $page->alias,
                function () use ($request, $page) {
                    $controller = app()->make(Controller::class);
                    return $controller->displayPage($page);
                }
            ]);
        }
        return $next($request);
    }
}
