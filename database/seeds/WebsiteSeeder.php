<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('layouts')->delete();
        DB::table('pages')->delete();

        $layoutId = factory(\App\Models\Layout::class, 1)->create()->id;
        factory(\App\Models\Page::class)->create([
            'layout_id' => $layoutId,
            'alias'     => 'index',
            'title'     => 'Home',
        ]);
        factory(\App\Models\Page::class, 5)->create([
            'layout_id' => $layoutId,
        ]);
    }
}
