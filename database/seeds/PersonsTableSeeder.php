<?php

use Illuminate\Database\Seeder;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 1000000;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('persons')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'address' => $faker->address,
                'phone' => $faker->unique()->phoneNumber,
                'faculty_id' => $faker->numerify(1),
                'date' => $faker->date(),
                'gender' => $faker->numerify(1),
                'image' => $faker->numerify(1),
                'slug' => $faker->slug,
            ]);
        }
    }
}
