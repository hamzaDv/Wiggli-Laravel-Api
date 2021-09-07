<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Group::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 5; $i++) {
            Group::create([
                'name' => $faker->title,
                'description' => $faker->paragraph,
                // 'user_id' => $faker->numberBetween(1, 3)
            ]);
        } 
    }
}
