<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        factory(\App\Models\User::class, 1)->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
    }
}
