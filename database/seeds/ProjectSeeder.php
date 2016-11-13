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

        $user = \App\Models\User::where('email', 'admin@admin.com')->first();
        $project = factory(\App\Models\Project::class, 1)->create([
            'domain' => 'website.argentum.dev'
        ]);

        $layoutId = factory(\App\Models\Layout::class, 1)->create([
            'project_id' => $project->id,
        ])->id;
        factory(\App\Models\Page::class)->create([
            'project_id' => $project->id,
            'layout_id' => $layoutId,
            'alias'     => 'index',
            'title'     => 'Home',
        ]);
        factory(\App\Models\Page::class, 5)->create([
            'project_id' => $project->id,
            'layout_id' => $layoutId,
        ]);

        $user->projects()->save($project);
    }
}
