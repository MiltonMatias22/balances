<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Milton',
             'email' => 'milton@gmail.com',
             'password' => bcrypt('123456')
        ]);
        User::create([
            'name' => 'Martinho',
             'email' => 'martinho@gmail.com',
             'password' => bcrypt('121212')
        ]);
    }
}
