<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'super user'
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
            'description' => 'can add expenses'
        ]);
    }
}
