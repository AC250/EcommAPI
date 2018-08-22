<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->word,
        'details'=>$faker->paragraph,
        'price'=>$faker->numberBetween(100,1000),
        'stock'=>$faker->randomDigitNotNull,
         
        'discount'=>$faker->numberBetween(0,50),
        'user_id'=>function(){
            return App\User::all()->random();
        }
    ];
});
