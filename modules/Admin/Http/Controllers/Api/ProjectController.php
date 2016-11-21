<?php

namespace Modules\Admin\Http\Controllers\Api;

use Argentum\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProjectController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = app('auth')->user();
    }

    public function index()
    {
        return $this->user->projects()->get();
    }

    public function get($id)
    {
        return $this->user->projects()
            ->with('pages')
            ->where('projects.id', $id)// https://github.com/laravel/framework/issues/3553
            ->firstOrFail();
    }

    public function store(Request $request)
    {
        $this->validateProject($request);

        $project = new Project();
        $project->title = $request->get('title');
        $project->description = $request->get('description');
        $project->domain = strtolower(str_random() . '.argentum.dev');

        $this->user->projects()->save($project);
        return $project;
    }

    public function update($id, Request $request)
    {
        $this->validateProject($request);
        $project = $this->get($id);

        $project->title = $request->get('title');
        $project->description = $request->get('description');
        $project->save();
        return $project;
    }

    public function delete($id)
    {
        return ['deleted' => $this->get($id)->delete()];
    }

    protected function validateProject(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:25',
            'description' => 'max:255'
        ]);
    }
}
