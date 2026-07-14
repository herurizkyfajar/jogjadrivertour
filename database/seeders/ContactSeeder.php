<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'contact_phone1' => '+62 812 3456 7890',
            'contact_phone2' => '+62 856 1234 5678',
            'contact_email1' => 'info@jogadrivertour.com',
            'contact_email2' => 'booking@jogadrivertour.com',
            'contact_address' => 'Jl. Malioboro No. 123, Yogyakarta, Indonesia',
            'contact_whatsapp' => '6281234567890',
        ];

        foreach ($defaults as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
