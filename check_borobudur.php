<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->handle(
    new Symfony\Component\Console\Input\ArgvInput,
    new Symfony\Component\Console\Output\ConsoleOutput
);

$d = \App\Models\Destination::where('slug', 'borobudur-temple')->first();
echo "Name: {$d->name}\n";
echo "Description: " . substr($d->description, 0, 200) . "...\n";
echo "Gallery images: " . json_encode($d->gallery_images) . "\n";