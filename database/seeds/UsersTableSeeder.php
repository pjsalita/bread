<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
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
            'name' => 'Dummy',
            'email' => 'sample@gmail.com',
            'username' => 'sample',
            'password' => app('hash')->make('password'),
        ]);
    }
}
