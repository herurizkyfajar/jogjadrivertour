<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'job_title' => 'Travel Blogger',
                'avatar' => 'template/assets/images/avata/1.jpg',
                'content' => 'Outstanding service from Yogyadrivertour! The Borobudur sunrise tour was absolutely memorable. The guide was incredibly friendly, insightful, and professional.',
                'rating' => 5.00,
                'is_active' => true,
            ],
            [
                'name' => 'Siti Rahayu',
                'job_title' => 'Entrepreneur',
                'avatar' => 'template/assets/images/avata/2.jpg',
                'content' => 'Our family holiday in Yogyakarta went incredibly smooth thanks to this tour service. Everything was well-organized and the prices were very affordable.',
                'rating' => 4.90,
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Fauzi',
                'job_title' => 'Photographer',
                'avatar' => 'template/assets/images/avata/3.jpg',
                'content' => 'As a professional photographer, I was highly supported by the local spots and timing recommendations from Yogyadrivertour. Excellent experience!',
                'rating' => 5.00,
                'is_active' => true,
            ],
            [
                'name' => 'Dewi Lestari',
                'job_title' => 'Designer',
                'avatar' => 'template/assets/images/avata/4.jpg',
                'content' => 'The cave tubing experience at Jomblang offered by them was thrilling! Professional team, safety-first attitude, and well-maintained equipment.',
                'rating' => 4.80,
                'is_active' => true,
            ],
            [
                'name' => 'Rizky Pratama',
                'job_title' => 'Student',
                'avatar' => 'template/assets/images/avata/5.jpg',
                'content' => 'Perfect for student budgets without sacrificing the quality of travel! Thank you Yogyadrivertour for the great deals.',
                'rating' => 4.70,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
