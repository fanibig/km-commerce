<?php

namespace Database\Factories;

use App\Models\Attribute;
use Faker\Generator as Faker;
use App\Models\AttributeOption;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(AttributeOption::class, function (Faker $faker, array $attributes) {

    return [
        'admin_name'   => $faker->word,
        'sort_order'   => $faker->randomDigit,
        'attribute_id' => function () {
            return Attribute::factory()->create()->id;
        },
        'swatch_value' => null,
    ];
});

$factory->define(AttributeOption::class, function (Faker $faker, array $attributes) {
    return [
        'admin_name'   => $faker->word,
        'sort_order'   => $faker->randomDigit,
        'attribute_id' => function () {
            return Attribute::factory()
                ->create(['swatch_type' => 'color'])
                ->id;
        },
        'swatch_value' => $faker->hexColor,
    ];
});

$factory->define(AttributeOption::class, function (Faker $faker, array $attributes) {
    return [
        'admin_name'   => $faker->word,
        'sort_order'   => $faker->randomDigit,
        'attribute_id' => function () {
            return Attribute::factory()
                ->create(['swatch_type' => 'image'])
                ->id;
        },
        'swatch_value' => '/tests/_data/ProductImageExampleForUpload.jpg',
    ];
});

$factory->define(AttributeOption::class, function (Faker $faker, array $attributes) {
    return [
        'admin_name'   => $faker->word,
        'sort_order'   => $faker->randomDigit,
        'attribute_id' => function () {
            return Attribute::factory()
                ->create(['swatch_type' => 'dropdown'])
                ->id;
        },
        'swatch_value' => null,
    ];
});

$factory->define(AttributeOption::class, function (Faker $faker, array $attributes) {
    return [
        'admin_name'   => $faker->word,
        'sort_order'   => $faker->randomDigit,
        'attribute_id' => function () {
            return Attribute::factory()
                ->create(['swatch_type' => 'text'])
                ->id;
        },
        'swatch_value' => null,
    ];
});