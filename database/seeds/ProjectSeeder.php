<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->delete();
        DB::table('project_user')->delete();
        DB::table('layouts')->delete();
        DB::table('pages')->delete();

        $user = Argentum\Model\User::where('email', 'admin@admin.com')->first();
        $project = factory(Argentum\Model\Project::class, 1)->create([
            'domain' => 'website.argentum.dev'
        ]);

        $layoutId = factory(Argentum\Model\Layout::class, 1)->create([
            'project_id' => $project->id,
        ])->id;
        factory(Argentum\Model\Page::class)->create([
            'project_id' => $project->id,
            'layout_id' => $layoutId,
            'alias'     => 'index',
            'title'     => 'Home',
        ]);
        factory(Argentum\Model\Page::class, 5)->create([
            'project_id' => $project->id,
            'layout_id' => $layoutId,
        ]);

        $user->projects()->save($project);
    }
}
