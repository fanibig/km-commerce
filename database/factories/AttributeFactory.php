<?php

namespace Database\Factories;

use App\Models\Attribute;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(Attribute::class, function (Faker $faker, array $attributes) {
    $types = [
        'text',
        'textarea',
        'price',
        'boolean',
        'select',
        'multiselect',
        'datetime',
        'date',
        'image',
        'file',
        'checkbox',
    ];

    return [
        'admin_name'          => $faker->word,
        'code'                => $faker->word,
        'type'                => array_rand($types),
        'validation'          => '',
        'position'            => $faker->randomDigit,
        'is_required'         => false,
        'is_unique'           => false,
        'value_per_locale'    => false,
        'value_per_channel'   => false,
        'is_filterable'       => false,
        'is_configurable'     => false,
        'is_user_defined'     => true,
        'is_visible_on_front' => true,
        'swatch_type'         => null,
        'use_in_flat'         => true,
    ];
});

$factory->state(Attribute::class, 'validation_numeric', [
    'validation' => 'numeric',
]);

$factory->state(Attribute::class, 'validation_email', [
    'validation' => 'email',
]);

$factory->state(Attribute::class, 'validation_decimal', [
    'validation' => 'decimal',
]);

$factory->state(Attribute::class, 'validation_url', [
    'validation' => 'url',
]);

$factory->state(Attribute::class, 'required', [
    'is_required' => true,
]);

$factory->state(Attribute::class, 'unique', [
    'is_unique' => true,
]);

$factory->state(Attribute::class, 'filterable', [
    'is_filterable' => true,
]);

$factory->state(Attribute::class, 'configurable', [
    'is_configurable' => true,
]);