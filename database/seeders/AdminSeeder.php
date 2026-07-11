<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'herurizkyfajar@gmail.com'],
            [
                'name' => 'Heru Rizky Fajar',
                'password' => Hash::make('224589herU!'),
                'role' => 'admin',
            ]
        );
    }
}
