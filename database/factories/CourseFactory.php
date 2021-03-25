<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'description' => $faker->text,
        'outline' => $faker->text,
    ];
});
