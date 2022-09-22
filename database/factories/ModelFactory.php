<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Transaction::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence(2),
        'amount' => $faker->numberBetween(5, 10),
        'category_id' => function () {
            return create(App\Category::class)->id;
        },
        'user_id' => function () {
            return create(App\User::class)->id;
        }
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Category::class, function (Faker\Generator $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'user_id' => function () {
            return create(App\User::class)->id;
        }
    ];
});
