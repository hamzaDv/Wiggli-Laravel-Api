<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();

        $faker = \Faker\Factory::create();

        $gender = $faker->randomElement(['male', 'female']);

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 3; $i++) {
            User::create([
                'email' => $faker->email,
                'password' => Hash::make('password'), //$2a$10$sme1juiwmlQ3l/ccoVOwcu4STJvrmdfb/Sjulpbl1rNvBrC6oLDAK
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName,
                'age' => $faker->numberBetween(25, 60),
                'type' => $gender,
                'phone' => $faker->phoneNumber,
                // 'group_id' => $faker->numberBetween(1, 3)
            ]);
        } 
    }
}
