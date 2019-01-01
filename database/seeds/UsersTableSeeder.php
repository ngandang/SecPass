<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = str_random(10);
        DB::table('users')->insert([
            'name' => $str,
            'email' => $str.'@secpass.com',
            'password' => bcrypt('password'),
            'active' => true,
        ]);
    }
}
