<?php
use App\Admin;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    static $password;
    return [
        'account' => $faker->unique()->name,
        'name' => $faker->name,
        'password' => $password ?: $password = bcrypt('123123'),
        'remember_token' => Str::random(10),
    ];
});