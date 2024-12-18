<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(AttributeFamily::class, function (Faker $faker) {
    return [
        'name'            => $faker->word(),
        'code'            => $faker->word(),
        'is_user_defined' => rand(0, 1),
        'status'          => 0,
    ];
});