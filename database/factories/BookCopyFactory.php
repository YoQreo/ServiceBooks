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

$factory->define(App\Models\BookCopy::class, function (Faker\Generator $faker) {
    return [
        'incomeNumber'=> $faker->ean13,
        'volume'=> $faker->numberBetween(1,3),
        'availability'=> 1,
        'acquisitionModality'=> $faker->numberBetween(1,3),
        'acquisitionSource'=> null,
        'acquisitionPrice'=> null,
        'acquisitionDate'=> null,
        'publicationLocation'=> "Peru",
        'printType'=> $faker->numberBetween(1,2),
        'barcode'=> $faker->ean13,
        'stand_id'=> $faker->numberBetween(1,20),
        'book_id'=> $faker->numberBetween(1,40),
        
    ];
});