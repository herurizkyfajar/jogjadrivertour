<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            ['name' => 'Avanza TSS', 'image' => 'template/assets/images/cars/avanza.webp', 'passengers' => 7, 'luggage' => 3, 'type' => 'Regular Car', 'description' => 'Compact & fuel-efficient MPV, perfect for small families and city tours around Yogyakarta.', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'Hiace Premium', 'image' => 'template/assets/images/cars/hiace.webp', 'passengers' => 16, 'luggage' => 8, 'type' => 'Regular Car', 'description' => 'Spacious minibus ideal for group travel with ample luggage space and premium comfort.', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'New Terios', 'image' => 'template/assets/images/cars/terios.webp', 'passengers' => 7, 'luggage' => 4, 'type' => 'Regular Car', 'description' => 'Stylish SUV with higher clearance, great for adventurous routes like Lava Tour Merapi.', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'Innova Reborn', 'image' => 'template/assets/images/cars/innova.webp', 'passengers' => 7, 'luggage' => 4, 'type' => 'Premium Car', 'description' => 'Premium MPV with spacious cabin and smooth ride, the most popular choice for touring.', 'is_active' => true, 'sort_order' => 4],
            ['name' => 'Alphard', 'image' => 'template/assets/images/cars/alphard.webp', 'passengers' => 7, 'luggage' => 4, 'type' => 'Premium Car', 'description' => 'Luxury MPV with first-class comfort, perfect for VIP transfers and special occasions.', 'is_active' => true, 'sort_order' => 5],
        ];

        foreach ($cars as $car) {
            Car::updateOrCreate(['name' => $car['name']], $car);
        }
    }
}
