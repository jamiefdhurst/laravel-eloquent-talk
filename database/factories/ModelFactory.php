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

$factory->define(App\SimplePatient::class, function (Faker\Generator $faker) {
    return [
        'forenames' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'date_of_birth' => $faker->dateTimeBetween('-70 years', '-18 years')
    ];
});

$factory->define(App\SimpleSession::class, function (Faker\Generator $faker) {
    return [
        'appointment' => $faker->dateTimeThisMonth,
        'pain' => $faker->numberBetween(0, 10),
        'notes' => $faker->paragraph(),
    ];
});

$factory->define(App\Solution1\Patient::class, function (Faker\Generator $faker) {
    return [];
});

$factory->define(App\Solution1\PatientValue::class, function (Faker\Generator $faker) {
    return [];
});