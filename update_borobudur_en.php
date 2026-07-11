<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->handle(new Symfony\Component\Console\Input\ArgvInput, new Symfony\Component\Console\Output\ConsoleOutput);

$realDescription = <<<HTML
<p><strong>Borobudur Temple</strong> is the world's largest Buddhist temple and a UNESCO World Heritage Site, located in Magelang, Central Java, Indonesia. Built between the 8th and 9th centuries CE during the reign of the Sailendra Dynasty, Borobudur stands as one of the greatest archaeological marvels in the world and Indonesia's most visited tourist attraction.</p>

<h4>History</h4>
<p>Borobudur was constructed around 750–850 CE during the Sailendra Dynasty's rule over the Medang Kingdom. After the center of power shifted to East Java in the 14th century and with the gradual conversion to Islam, the temple was abandoned and eventually buried under volcanic ash and jungle growth. In 1814, Sir Thomas Stamford Raffles, the then British Governor-General of Java, rediscovered the monument. A major international restoration project was carried out between 1975 and 1982 by the Indonesian Government in collaboration with UNESCO, successfully restoring the temple to its former glory.</p>

<h4>Architecture & Philosophy</h4>
<p>Borobudur is designed as a giant stepped pyramid representing a sacred mandala, symbolizing the Buddhist cosmological universe. The structure consists of nine stacked platforms — six square terraces and three circular ones — topped by a central dome stupa. The monument features 2,672 decorative relief panels and 504 Buddha statues. Architecturally, it embodies three realms of Buddhist cosmology: <em>Kamadhatu</em> (the world of desire), <em>Rupadhatu</em> (the world of forms), and <em>Arupadhatu</em> (the formless world).</p>

<h4>Reliefs & Statues</h4>
<p>The temple's narrative reliefs depict the life of the Buddha (Lalitavistara), the Jataka tales (stories of Buddha's previous incarnations), and the Gandavyuha (the spiritual journey of the young pilgrim Sudhana). The 72 perforated stupas on the upper circular terraces each contain a Buddha statue in the Dharmachakra mudra (the gesture of turning the Wheel of Dharma), many of which can be touched by visitors for good luck.</p>

<h4>Best Time to Visit</h4>
<p>The most spectacular time to visit Borobudur is at <strong>sunrise</strong>, around 5:30–6:00 AM, when the morning mist rolls in from the surrounding valleys and mountains, creating a mystical atmosphere. Early morning visits also allow you to enjoy the temple before the heat of the day and the crowds. Sunset views from the temple grounds are equally breathtaking. Avoid midday visits due to intense heat and large crowds.</p>

<h4>Visitor Information</h4>
<ul>
<li><strong>Location:</strong> Jl. Badrawati, Borobudur, Magelang, Central Java 56553</li>
<li><strong>Opening Hours:</strong> Daily 06:00 AM – 05:00 PM (Special sunrise ticket from 04:30 AM)</li>
<li><strong>Entrance Fee:</strong> Foreign tourists USD 25 | Domestic tourists IDR 50,000</li>
<li><strong>Distance from Yogyakarta:</strong> Approximately 40 km (about 1–1.5 hours by car)</li>
</ul>

<h4>Facilities</h4>
<ul>
<li>Spacious parking area, clean restrooms, and prayer rooms (musalla)</li>
<li>Karmawibhangga Museum & Samudraraksa Museum (ship museum) on-site</li>
<li>Licensed tour guides available (highly recommended for deeper insight)</li>
<li>Canteen, souvenir shops, and rest areas</li>
<li>Wheelchair-accessible paths in certain zones</li>
</ul>
HTML;

$realShortDescription = 'The world\'s largest Buddhist temple and a UNESCO World Heritage Site, built by the Sailendra Dynasty in the 8th–9th century CE in Magelang, Central Java. A timeless masterpiece of ancient architecture and spiritual heritage.';

$destination = \App\Models\Destination::where('slug', 'borobudur-temple')->first();

if (!$destination) {
    echo "Destination 'borobudur-temple' not found!\n";
    exit(1);
}

echo "Found: {$destination->name} (ID: {$destination->id})\n";
echo "Updating with real English data...\n\n";

$destination->update([
    'description'       => $realDescription,
    'short_description' => $realShortDescription,
    'location'          => 'Magelang, Central Java',
    'city'              => 'Yogyakarta',
    'rating'            => 4.9,
]);

echo "✅ Borobudur Temple updated successfully!\n";
echo "--------------------------------------------\n";
echo "Name            : {$destination->fresh()->name}\n";
echo "Location        : {$destination->fresh()->location}\n";
echo "Short Desc      : " . substr($destination->fresh()->short_description, 0, 100) . "...\n";
echo "Description     : " . strip_tags(substr($destination->fresh()->description, 0, 150)) . "...\n";
echo "Rating          : {$destination->fresh()->rating}\n";
echo "--------------------------------------------\n";
