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
	$gender        = $faker->randomElements(['male', 'female'])[0];
    $genderInt     = $gender == 'male' ? 1 : 0;
    $firstName     = $faker->firstName($gender);
    $lastName      = $faker->lastName($gender);
    $fullName      = $firstName.' '.$lastName;
    return [
    	'username'		 => Str::random(6),
        'full_name'      => $fullName,
        'email'          => $faker->unique()->safeEmail,
        'email_verified' => Consts::TRUE,
        'gender'         => $genderInt,
        'status'         => Consts::USER_ACTIVE,
        'avatar'         => '/images/avatars/avatar-'.$gender.'-default.svg',
        'password'       => bcrypt('123123'), // password
        'remember_token' => Str::random(32)
    ];
});
