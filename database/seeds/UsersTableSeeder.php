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
        \App\Models\User::create([
            'name' => 'GAI',
            'username' => ' gai',
            'password' => bcrypt('test1234'),
        ]);
    }
}
