<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


class AdvertisementPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photoArray = ['http://dotnetguru.org/wp-content/uploads/2019/08/php.jpg',
            'https://cafedev.vn/wp-content/uploads/2020/08/cafedev_tuhoc_php.png',
            'https://viettuts.vn/images/php/php-la-gi.png'];
        $photoIndex = rand(0, 2);
        DB::table('advertisement_photo')->insert([
            'image_link' => $photoArray[$photoIndex],
            'advertisement_id' => rand(1, 50)
        ]);
    }
}
