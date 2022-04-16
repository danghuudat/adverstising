<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\AdvertisementPhoto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Advertisement::factory()
            ->count(50)
            ->create();
        AdvertisementPhoto::factory()
            ->count(1500)
            ->create();
    }
}
