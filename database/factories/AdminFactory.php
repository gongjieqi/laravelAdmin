<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2017/10/23
 * Time: 11:37
 */

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => 'admin',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});