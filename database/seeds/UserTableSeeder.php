<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Few Test Users can be easily seeded, where $password => 'password'
        User::create(array('name' => 'Jesse Parker',
            'email' => 'jparker1@crimson.ua.edu',
            'password' => Hash::make('password')));

        User::create(array('name' => 'Shea Henderson',
            'email' => 'tshenderson1@crimson.ua.edu',
            'password' => Hash::make('password')));

        User::create(array('name' => 'Tyler Gabriel',
            'email' => 'tgabriel@crimson.ua.edu',
            'password' => Hash::make('password')));

    }
}
