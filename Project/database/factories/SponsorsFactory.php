<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sponsor;
use Faker\Generator as Faker;

$factory->define(Sponsor::class, function (Faker $faker) {
    return [

      'start_sponsor' => $faker -> dateTime(),
      'end_sponsor' => $faker -> dateTime(),
      'cost' => $faker -> randomFloat($nbMaxDecimals = 2, $min = 15, $max = NULL),
      'type' => $faker -> unique() -> randomElement($array = array('basic', 'standard', 'premium'))

    ];
});
