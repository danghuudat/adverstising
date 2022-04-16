<?php

namespace Database\Factories;

use App\Models\Advertisement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AdvertisementPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $photoArray = ['http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg',
            'https://cafedev.vn/wp-content/uploads/2020/08/cafedev_tuhoc_php.png',
            'https://viettuts.vn/images/php/php-la-gi.png'];
        $photoIndex = rand(0, 2);
        return [
            'photo_link' => $photoArray[$photoIndex],
            'advertisement_id' => rand(1, 50),
            'is_main' => rand(0, 1)
        ];
    }
}
