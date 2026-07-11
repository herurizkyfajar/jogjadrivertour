<?php

namespace Database\Seeders;

use App\Models\MyTour;
use Illuminate\Database\Seeder;

class MyTourSeeder extends Seeder
{
    public function run(): void
    {
        $tours = [
            ['image' => 'my-tours/xGWCTf2MqoEOr869G5Of10W6iWcEwS7uTBEJGw5x.jpg', 'negara_asal' => 'Afghanistan'],
            ['image' => 'my-tours/4b7BTxWOFf6oqmgApZUJZvGfxuRv9sygObK36wRA.jpg', 'negara_asal' => 'Afghanistan'],
            ['image' => 'my-tours/gBOGBh3KNfvnX1pNigyplskOq19Z1hi28RMfACbK.jpg', 'negara_asal' => 'Afghanistan'],
            ['image' => 'my-tours/CIyOf3C4n40EzBOh9BSYdKd5CPUo5xbG84MoGMOz.jpg', 'negara_asal' => 'Afghanistan'],
            ['image' => 'my-tours/WFA2jQtoiNK1LdK5ZpydhQ4QV1f4OkQ1M5MvCilC.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/7Wc2UY32aXTOCdNE1rKqXAAZ7jAyfvOQwqUoyKnq.jpg', 'negara_asal' => 'India'],
            ['image' => 'my-tours/aHPEOlVU7Fwh3U3p27vWCFqrSlHWgPryWWz6XIVw.jpg', 'negara_asal' => 'Malaysia'],
            ['image' => 'my-tours/YesTOxpXP2UjYwBIATwysIzsKbFRQFCgoPF4aN0T.jpg', 'negara_asal' => 'Malaysia'],
            ['image' => 'my-tours/QZCWor3KZISkMrWuAFt2SHINjpTsZ8SvgLQet4AY.jpg', 'negara_asal' => 'Afghanistan'],
            ['image' => 'my-tours/gqT3sxUUWqoWinr07rnnVRZhNg8qxiNz6Igtahzu.jpg', 'negara_asal' => 'Afghanistan'],
            ['image' => 'my-tours/gJr0us8xNFWGPTuSI1GGkSzxFHCgErB3B00PWnca.jpg', 'negara_asal' => 'Afghanistan'],
            ['image' => 'my-tours/KybFf9bq0FjSb7KuB2LMR5vIzpV80rx24PugKHcX.jpg', 'negara_asal' => 'Malaysia'],
            ['image' => 'my-tours/HJHGp3jxrZIbi0mcPOVRD5RbZj0XJVguti1sNs2B.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/VI6U6e9nCqiYbSZQVUzxDY06WYVDQYbJDuJzdDvp.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/aNLFyo1gz8wW9iEjCXZEpDeclv3P7GEqQtFsNb0C.jpg', 'negara_asal' => 'Afghanistan'],
            ['image' => 'my-tours/iM8B6xm6OFp67D632NHjDGLyVQ3Uo2jmoB6jPSdH.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/3UyqL1Suvv4ZXcNk4thfQR8dKMV6ZndLK0r5WULp.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/zcy9eA8IFi5UwCqxm2Xt56q7JYfxO7c80swaSHZa.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/OQC9dxtZhQ0oXIPnSnVwuAJxjgeGO1hADKZe3NSD.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/dp9j5E15m7Pad5eSx6S0LfrLYaPBsW24cWhBUCwU.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/hkjgc8umty1ziZDBnnlldL4N4S51J5YHAn5PgCXj.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/VzdZqkYiKlKm9BiUiqKKJ8pNmxYsXIGnNLgXQnmc.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/nBkSX6z1e3cK1CMH7OXYmceST1i3BnmBm7gIzyc0.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/mum971YrzyUkEOurZZaLWRS5EYwCpIV8RYktlFZU.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/pB6391VCw6B9yzgXZ5iR6KOzXC7AkKUGPxzERupz.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/J6xkaX0Mxis13C1tgJeOci7IQCzf5N4YsFyEfPSD.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/axf2GnJwdYIQTqncPI0bsUNznAesBeGNiQ5uVtJf.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/hbmRDPYwYggiaSxu5sF6TT6Uq0KWZCntEZcV8NSO.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/xHu75L9RF7ulpL7YW7oj9RzjX8O6W3ICeL4E8pvb.jpg', 'negara_asal' => 'Albania'],
            ['image' => 'my-tours/2GyxWgYEj7Srf62ELspyPhpPevDxKMaMcAwjRfwt.jpg', 'negara_asal' => 'South Korea'],
        ];

        foreach ($tours as $tour) {
            MyTour::create($tour);
        }
    }
}
