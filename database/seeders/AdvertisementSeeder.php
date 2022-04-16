<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertisements')->insert([
            'name' => Str::random(100),
            'price' => rand(1,5000),
            'description' => Str::random(1000),
            'created_at' => Carbon::now(),
        ]);
    }
}
