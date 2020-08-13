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

$factory->define(App\Models\Book::class, function (Faker\Generator $faker) {
    return [
        'title'=> $faker->sentence,
        'secondaryTitle'=> $faker->sentence,
        'isbn'=>$faker->unique()->isbn10,
        'clasification'=> str_random(10),
        'year'=> $faker->year($max = 'now'),
        'tome'=> $faker->numberBetween(1,3),
        'edition'=> $faker->numberBetween(1,3),
        'extension'=> $faker->numberBetween(300,500),
        'dimensions'=> $faker->word(10),
        'accompaniment'=> $faker->word(10),
        'observations'=>$faker->sentence(5),
        'chapters'=> $faker->text(100),
        'summary'=> $faker->text(100),
        'keywords'=> $faker->sentence,
        
    ];
});