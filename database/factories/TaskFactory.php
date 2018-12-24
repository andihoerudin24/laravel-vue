<?php

use Faker\Generator as Faker;
$prior=['low','medium','high'];
$factory->define(App\Task::class, function (Faker $faker) use ($prior) {
    return [
        'title'=>$faker->sentence(3),
        'prior'=>$prior[mt_rand(0,count($prior)-1)],
        'user_id'=>1
    ];
});
