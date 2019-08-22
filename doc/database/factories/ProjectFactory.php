<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) { // CANT DESCRIBE BUT CREATES A FACTORY FOR A MODEL AND USES FAKER
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph
    ];
});

