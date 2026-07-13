<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ImageResizeSeeder extends Seeder
{
    public function run(): void
    {
        $resizeList = [
            // path => [maxWidth, maxHeight, quality]
            'template/assets/images/destination/1.jpg' => [800, 600, 80],
            'template/assets/images/destination/2.jpg' => [800, 600, 80],
            'template/assets/images/slide/slide3.jpg' => [1200, 800, 80],
            'template/assets/images/logo.webp' => [400, 200, 85],
            'template/assets/images/slide/slide1.webp' => [1200, 800, 80],
            'template/assets/images/slide/slide2.webp' => [1200, 800, 80],
        ];

        foreach ($resizeList as $relPath => [$maxW, $maxH, $quality]) {
            $fullPath = public_path($relPath);
            if (!file_exists($fullPath)) {
                $this->command->info("SKIP (not found): {$relPath}");
                continue;
            }

            $origSize = filesize($fullPath);
            $info = getimagesize($fullPath);
            $origW = $info[0];
            $origH = $info[1];
            $mime = $info['mime'];

            if ($origW <= $maxW && $origH <= $maxH) {
                $this->command->info("SKIP (already small): {$relPath} ({$origW}x{$origH})");
                continue;
            }

            $ratio = min($maxW / $origW, $maxH / $origH);
            $newW = (int)($origW * $ratio);
            $newH = (int)($origH * $ratio);

            switch ($mime) {
                case 'image/jpeg':
                    $src = imagecreatefromjpeg($fullPath);
                    $dst = imagecreatetruecolor($newW, $newH);
                    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
                    imagejpeg($dst, $fullPath, $quality);
                    break;
                case 'image/webp':
                    $src = imagecreatefromwebp($fullPath);
                    $dst = imagecreatetruecolor($newW, $newH);
                    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
                    imagewebp($dst, $fullPath, $quality);
                    break;
                case 'image/png':
                    $src = imagecreatefrompng($fullPath);
                    $dst = imagecreatetruecolor($newW, $newH);
                    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
                    imagepng($dst, $fullPath, 6);
                    break;
                default:
                    $this->command->info("SKIP (unsupported): {$relPath} ({$mime})");
                    continue 2;
            }

            if (is_resource($src)) imagedestroy($src);
            if (is_resource($dst)) imagedestroy($dst);

            $newSize = filesize($fullPath);
            $saved = round(($origSize - $newSize) / 1024);
            $this->command->info("RESIZED: {$relPath} {$origW}x{$origH} -> {$newW}x{$newH} ({$saved}KB saved)");
        }
    }
}
