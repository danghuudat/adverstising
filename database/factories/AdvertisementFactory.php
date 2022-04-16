<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => Str::random(100),
            'price' => rand(1,5000),
            'description' => Str::random(1000),
            'created_at' => Carbon::now()->addDays(1)->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60)),
            'updated_at' => Carbon::now()->addDays(2)->addMinutes(rand(0,
                60 * 23))->addSeconds(rand(0, 60)),
        ];
    }
}
