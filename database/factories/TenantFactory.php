<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tenant;
use Faker\Generator as Faker;
use App\Models\Plan;

$factory->define(Tenant::class, function (Faker $faker) {
    return [
        'plan_id' => factory(Plan::class),
        'nif' => uniqid() . date('YmdHis'),
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
    ];
});
