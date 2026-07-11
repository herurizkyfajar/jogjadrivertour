<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Borobudur Temple',
                'slug' => 'borobudur-temple',
                'description' => '<p><strong>Borobudur Temple</strong> is the world\'s largest Buddhist temple and a UNESCO World Heritage Site, located in Magelang, Central Java, Indonesia. Built between the 8th and 9th centuries CE during the reign of the Sailendra Dynasty, Borobudur stands as one of the greatest archaeological marvels in the world and Indonesia\'s most visited tourist attraction.</p>\n\n<h4>History</h4>\n<p>Borobudur was constructed around 750–850 CE during the Sailendra Dynasty\'s rule over the Medang Kingdom. After the center of power shifted to East Java in the 14th century and with the gradual conversion to Islam, the temple was abandoned and eventually buried under volcanic ash and jungle growth. In 1814, Sir Thomas Stamford Raffles, the then British Governor-General of Java, rediscovered the monument. A major international restoration project was carried out between 1975 and 1982 by the Indonesian Government in collaboration with UNESCO, successfully restoring the temple to its former glory.</p>\n\n<h4>Architecture &amp; Philosophy</h4>\n<p>Borobudur is designed as a giant stepped pyramid representing a sacred mandala, symbolizing the Buddhist cosmological universe. The structure consists of nine stacked platforms — six square terraces and three circular ones — topped by a central dome stupa. The monument features 2,672 decorative relief panels and 504 Buddha statues. Architecturally, it embodies three realms of Buddhist cosmology: <em>Kamadhatu</em> (the world of desire), <em>Rupadhatu</em> (the world of forms), and <em>Arupadhatu</em> (the formless world).</p>\n\n<h4>Reliefs &amp; Statues</h4>\n<p>The temple\'s narrative reliefs depict the life of the Buddha (Lalitavistara), the Jataka tales (stories of Buddha\'s previous incarnations), and the Gandavyuha (the spiritual journey of the young pilgrim Sudhana). The 72 perforated stupas on the upper circular terraces each contain a Buddha statue in the Dharmachakra mudra, many of which can be touched by visitors for good luck.</p>\n\n<h4>Best Time to Visit</h4>\n<p>The most spectacular time to visit Borobudur is at <strong>sunrise</strong>, around 5:30–6:00 AM, when the morning mist rolls in from the surrounding valleys and mountains, creating a mystical atmosphere. Avoid midday visits due to intense heat and large crowds.</p>\n\n<h4>Visitor Information</h4>\n<ul>\n<li><strong>Location:</strong> Jl. Badrawati, Borobudur, Magelang, Central Java 56553</li>\n<li><strong>Opening Hours:</strong> Daily 06:00 AM – 05:00 PM (Special sunrise ticket from 04:30 AM)</li>\n<li><strong>Entrance Fee:</strong> Foreign tourists USD 25 | Domestic tourists IDR 50,000</li>\n<li><strong>Distance from Yogyakarta:</strong> Approximately 40 km (about 1–1.5 hours by car)</li>\n</ul>\n\n<h4>Facilities</h4>\n<ul>\n<li>Spacious parking area, clean restrooms, and prayer rooms</li>\n<li>Karmawibhangga Museum &amp; Samudraraksa Museum on-site</li>\n<li>Licensed tour guides available (highly recommended)</li>\n<li>Canteen, souvenir shops, and rest areas</li>\n<li>Wheelchair-accessible paths in certain zones</li>\n</ul>',
                'short_description' => 'The world\'s largest Buddhist temple and a UNESCO World Heritage Site, built by the Sailendra Dynasty in the 8th–9th century CE in Magelang, Central Java. A timeless masterpiece of ancient architecture and spiritual heritage.',
                'image' => 'template/assets/images/destination/1.jpg',
                'location' => 'Magelang, Central Java',
                'city' => 'Yogyakarta',
                'rating' => 4.9,
                'tour_count' => 25,
                'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2885642143!2d110.20390807498!3d-7.607882292479!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a14481bb3c5f3%3A0xb839c7956ef63e87!2sBorobudur%20Temple!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'maps_link' => 'https://maps.app.goo.gl/borobudur',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Prambanan Temple',
                'slug' => 'prambanan-temple',
                'description' => '<p><strong>Prambanan Temple</strong> is the largest Hindu temple complex in Indonesia and a UNESCO World Heritage Site. Built in the 9th century, it is dedicated to the Trimurti (the expression of God as the Creator, the Preserver, and the Destroyer). The temple is famous for its towering and pointed architecture, typical of Hindu temples, and the renowned Ramayana Ballet performed under the stars.</p>',
                'short_description' => 'The largest Hindu temple complex in Indonesia, featuring towering architecture and the Ramayana Ballet.',
                'image' => 'template/assets/images/destination/2.jpg',
                'location' => 'Sleman, Yogyakarta',
                'city' => 'Yogyakarta',
                'rating' => 4.8,
                'tour_count' => 20,
                'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.705642143!2d110.48949807498!3d-7.752020292479!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59755d4c0001%3A0x6d9f9c5c5c5c5c5c!2sPrambanan%20Temple!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'maps_link' => 'https://maps.app.goo.gl/prambanan',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Malioboro Street',
                'slug' => 'malioboro-street',
                'description' => '<p><strong>Malioboro Street</strong> is the vibrant heart of Yogyakarta. It is the city\'s primary shopping street and local cultural hub, famous for its bustling street vendors, local handicrafts, traditional batik shops, and delicious street food eateries. A walk down Malioboro offers a sensory journey through the everyday life and traditions of Yogyakarta.</p>',
                'short_description' => 'The iconic main street and shopping hub of Yogyakarta, famous for batik, crafts, and street food.',
                'image' => 'template/assets/images/destination/3.jpg',
                'location' => 'Yogyakarta City',
                'city' => 'Yogyakarta',
                'rating' => 4.6,
                'tour_count' => 30,
                'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.8!2d110.3647!3d-7.7925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59c9c9c9c9c9%3A0x1234567890abcdef!2sMalioboro!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'maps_link' => 'https://maps.app.goo.gl/malioboro',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Parangtritis Beach',
                'slug' => 'parangtritis-beach',
                'description' => '<p><strong>Parangtritis Beach</strong> is a legendary coastal destination with unique black volcanic sand, towering cliffs, and rolling waves. It holds a significant place in local folklore, believed to be the gateway to the sacred underwater kingdom of the Queen of the Southern Ocean (Nyai Roro Kidul). It is the perfect spot for watching majestic sunsets and riding horse-drawn carriages along the shore.</p>',
                'short_description' => 'A legendary beach with black volcanic sand, striking cliffs, and mystical ocean folklore.',
                'image' => 'template/assets/images/destination/des1.jpg',
                'location' => 'Bantul, Yogyakarta',
                'city' => 'Yogyakarta',
                'rating' => 4.5,
                'tour_count' => 18,
                'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.5!2d110.3872!3d-8.0235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5b5b5b5b5b5b%3A0x1234567890abcdef!2sParangtritis!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'maps_link' => 'https://maps.app.goo.gl/parangtritis',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Jomblang Cave',
                'slug' => 'jomblang-cave',
                'description' => '<p><strong>Jomblang Cave</strong> is a spectacular vertical collapse-of-karst cave located in Gunung Kidul. The highlight of the adventure is the "Light of Heaven", where rays of sunlight stream directly through the sinkhole at noon, illuminating the ancient forest below. Visitors descend 60 meters using ropes into this pristine underground ecosystem.</p>',
                'short_description' => 'A breathtaking vertical cave offering vertical rope descent and the magical "Light of Heaven" sunbeams.',
                'image' => 'template/assets/images/destination/des2.jpg',
                'location' => 'Gunung Kidul, Yogyakarta',
                'city' => 'Yogyakarta',
                'rating' => 4.7,
                'tour_count' => 12,
                'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.2!2d110.6!3d-7.95!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5c5c5c5c5c5c%3A0x1234567890abcdef!2sJomblang%20Cave!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'maps_link' => 'https://maps.app.goo.gl/jomblang',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Taman Sari Water Castle',
                'slug' => 'taman-sari-water-castle',
                'description' => '<p><strong>Taman Sari Water Castle</strong> is a beautiful historic site that once served as a royal garden and bathhouse for the Sultanate of Yogyakarta. Built in the mid-18th century, it features unique bathing pools, underground tunnels, secret chambers, and the iconic Sumur Gumuling, a former subterranean mosque with stunning circular stairs.</p>',
                'short_description' => 'A royal bathing castle and garden complex of the Sultanate, featuring circular underground tunnels.',
                'image' => 'template/assets/images/destination/des3.jpg',
                'location' => 'Yogyakarta City',
                'city' => 'Yogyakarta',
                'rating' => 4.4,
                'tour_count' => 15,
                'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.8!2d110.3542!3d-7.8105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5a5a5a5a5a5a%3A0x1234567890abcdef!2sTaman%20Sari!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'maps_link' => 'https://maps.app.goo.gl/tamansari',
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }
}
