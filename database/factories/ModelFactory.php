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

// Factory para users
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => 'admin@email.com',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'role_id' => 1
    ];
});

// Factory para brands
$factory->define(App\Brand::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence,
        'slug' => $faker->slug,
        'url_image' => 'default.jpg',
        'status' => '1'
    ];
});

// Factory para categorias
$factory->define(App\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence,
        'slug' => $faker->slug,
        'description' => $faker->text,
        'url_image' => 'default.jpg',
        'status' => '1'
    ];
});

// Factory para mercados
$factory->define(App\Market::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->sentence,
        'slug' => $faker->slug,
        'url_image' => 'default.jpg',
    ];
});
