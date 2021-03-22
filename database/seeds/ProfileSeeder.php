<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 10; $i++ ) {
            $fakerDatetime =  $faker->dateTimeBetween('-30 years', 'now');
            DB::table('profile')->insert([
                'id' => $i,
                'student_id' => $i,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'github' => $faker->userName,
                'created_at' => $fakerDatetime,
                'updated_at' => $fakerDatetime,
            ]);
        }
    }
}
