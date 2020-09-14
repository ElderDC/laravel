<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'action' => Permission::getActionById(rand(1, 7)),
        'scope' => Permission::getScopeById(rand(1, 2)),
    ];
});
