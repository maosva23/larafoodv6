<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use App\Models\Tenant;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'name' => $faker->unique()->name,
        'image' => 'no_image.png',
        'price' => 109.7,
        'description' => $faker->sentence,
    ];
});
