<?php

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $fakerDatetime =  $faker->dateTimeBetween('-30 years', 'now');
            Student::create([
                'id' => $i,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'register_at' => $fakerDatetime,
            ]);
        }
    }
}
