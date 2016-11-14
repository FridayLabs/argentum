<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\Models\Project;

class LoadRoutes
{
    /**
     * Finds page in db and registers route.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $project = Project::where('domain', $request->getHost())->firstOrFail();
        foreach ($project->pages()->get() as $page) {
            $alias = $page->alias === 'index' ? '' : $page->alias;
            app()->get('/' . $alias, [
                'as' => $page->alias,
                function () use ($request, $page) {
                    $controller = app()->make(Controller::class);

                    return $controller->displayPage($page);
                },
            ]);
        }

        return $next($request);
    }
}
