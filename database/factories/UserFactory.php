<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Consts;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $email = $faker->unique()->safeEmail;
    $sex = $faker->randomElements(['male', 'female'])[0];

    return [
        'email' => $email,
        'email_verification_code' => Str::random(6),
        'email_verified' => Consts::TRUE,
        'username' => explode('@', $email)[0],
        'password' => bcrypt('123456'),
        'full_name' => $faker->firstName($sex) . ' ' . $faker->lastName($sex),

        'phone_number' => $faker->e164PhoneNumber,
        'avatar' => '/images/avatars/avatar-' . $sex . '-default.svg',
        'dob' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-20 years'),
        'sex' => $sex,

        'points' => mt_rand(0, 99999),
        'level' => mt_rand(0, 5),
        'role' => 'user',
        'status' => $faker->randomElements([Consts::USER_ACTIVE, Consts::USER_INACTIVE])[0],

        'remember_token' => Str::random(32)
    ];
});
