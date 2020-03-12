<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Default Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin1234'),
            'role_id' => '1'
        ]);
    }
}
