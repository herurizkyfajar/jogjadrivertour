<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CitySeeder::class,
            SettingSeeder::class,
            TourSeeder::class,
            DestinationSeeder::class,
            BlogSeeder::class,
            BlogCommentSeeder::class,
            TestimonialSeeder::class,
            MyTourSeeder::class,
        ]);
    }
}
