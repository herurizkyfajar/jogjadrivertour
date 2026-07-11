<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = Blog::all();

        if ($blogs->isEmpty()) {
            return;
        }

        $comments = [
            [
                'author_name' => 'John Doe',
                'author_email' => 'john@example.com',
                'content' => 'This is a fantastic and very detailed article! I followed your tips on visiting Borobudur at sunrise and it was absolutely magical. Thank you for the guide.',
                'status' => 'approved',
                'author_ip' => '192.168.1.1',
                'created_at' => now()->subDays(3),
            ],
            [
                'author_name' => 'Siti Aminah',
                'author_email' => 'siti.aminah@gmail.com',
                'content' => 'Gudeg Yu Djum memang paling legendaris! Saya selalu mampir ke sana setiap kali liburan ke Yogyakarta. Terima kasih rekomendasinya.',
                'status' => 'approved',
                'author_ip' => '192.168.1.2',
                'created_at' => now()->subDays(2),
            ],
            [
                'author_name' => 'Budi Santoso',
                'author_email' => 'budi.santoso@yahoo.com',
                'content' => 'Apakah di candi Borobudur sekarang boleh naik ke atas stupa utamanya? Mohon infonya dong.',
                'status' => 'pending',
                'author_ip' => '192.168.1.3',
                'created_at' => now()->subHours(5),
            ],
            [
                'author_name' => 'Michael Smith',
                'author_email' => 'mikesmith@example.com',
                'content' => 'Hi, is it possible to hire a private driver directly from this site for the Borobudur and Prambanan tour? How much would it be for 3 days?',
                'status' => 'pending',
                'author_ip' => '192.168.1.4',
                'created_at' => now()->subHours(2),
            ],
            [
                'author_name' => 'Spam Bot',
                'author_email' => 'spambot@casino.com',
                'content' => 'Play free online poker and win real money now at http://cheatcasinosite.com! Best rates ever.',
                'status' => 'rejected',
                'author_ip' => '203.0.113.50',
                'created_at' => now()->subDays(1),
            ],
        ];

        // Seed comments across different blogs
        foreach ($comments as $index => $commentData) {
            // Assign to different blogs in cycle
            $blog = $blogs->get($index % $blogs->count());
            if ($blog) {
                $commentData['blog_id'] = $blog->id;
                BlogComment::create($commentData);
            }
        }
    }
}
