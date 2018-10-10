<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
    }
}

Class UserSeeder extends Seeder{
    public function run()
    {
        
        // DB::table('accounts')->insert(
        //     ['name'=>'Ngân', 'username'=>'ngandang', 'expiry_date'=>'1-1-1','uri'=>'dangthingan','description'=>'abc']
        // );
        // DB::table('users')->insert(
        //     ['role_id'=>'1', 'username'=>'ngan','email'=>'ngandt52@gmail.com','password'=>'123456','active'=>'1']
        // );
    }
}