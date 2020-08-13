<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for($i = 0; $i < 50; $i++) {
            Customer::create([
                'firstname' => $faker->firstname,
                'lastname' => $faker->lastname,
                'date_of_birth' => $faker->date,
                'is_active' => $faker->boolean,
            ]);
        }
    }
}
