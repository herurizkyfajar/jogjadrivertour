<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => '10 Best Places to Visit in Yogyakarta',
                'slug' => '10-best-places-to-visit-in-yogyakarta',
                'content' => 'Yogyakarta is one of the most popular travel destinations in Indonesia. From historic temples to beautiful beaches, here are the top 10 places you must visit when traveling to Yogyakarta.',
                'excerpt' => 'Yogyakarta is one of the most popular travel destinations in Indonesia.',
                'image' => 'template/assets/images/blog/bl1.jpg',
                'author_name' => 'Admin',
                'author_avatar' => 'template/assets/images/avata/1.jpg',
                'category' => 'Travel',
                'view_count' => 1250,
                'is_active' => true,
            ],
            [
                'title' => 'Budget Travel Tips for Yogyakarta',
                'slug' => 'budget-travel-tips-for-yogyakarta',
                'content' => 'Traveling to Yogyakarta doesn\'t have to break the bank. With the right planning and guide, you can enjoy the beautiful city within a highly affordable budget.',
                'excerpt' => 'Traveling to Yogyakarta doesn\'t have to break the bank.',
                'image' => 'template/assets/images/blog/bl2.jpg',
                'author_name' => 'Admin',
                'author_avatar' => 'template/assets/images/avata/2.jpg',
                'category' => 'Tips',
                'view_count' => 890,
                'is_active' => true,
            ],
            [
                'title' => 'Must-Try Traditional Culinary in Yogyakarta',
                'slug' => 'must-try-traditional-culinary-in-yogyakarta',
                'content' => 'Yogyakarta is well-known for its delicious and unique culinary heritage. From Gudeg to Bakpia, here are the top traditional dishes you must try during your visit.',
                'excerpt' => 'Yogyakarta is well-known for its delicious and unique culinary heritage.',
                'image' => 'template/assets/images/blog/bl3.jpg',
                'author_name' => 'Admin',
                'author_avatar' => 'template/assets/images/avata/3.jpg',
                'category' => 'Food',
                'view_count' => 756,
                'is_active' => true,
            ],
            [
                'title' => 'Ultimate Guide to Visiting Borobudur Temple',
                'slug' => 'ultimate-guide-to-visiting-borobudur-temple',
                'content' => 'Borobudur Temple is a magnificent UNESCO World Heritage Site that you must visit. Here is the ultimate guide to make the most of your visit to the world\'s largest Buddhist monument.',
                'excerpt' => 'The ultimate guide to make the most of your visit to the magnificent Borobudur Temple.',
                'image' => 'template/assets/images/blog/bl4.jpg',
                'author_name' => 'Admin',
                'author_avatar' => 'template/assets/images/avata/4.jpg',
                'category' => 'Travel',
                'view_count' => 654,
                'is_active' => true,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
