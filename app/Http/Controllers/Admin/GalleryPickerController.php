<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryPickerController extends Controller
{
    public function index(Request $request)
    {
        $disk = Storage::disk('public');
        $directories = ['destinations', 'tours', 'blogs'];
        $images = [];

        foreach ($directories as $dir) {
            $this->scanDirectory($disk, $dir, $images);
        }

        // Also scan root-level template images used in destinations
        $templateDirs = ['template/assets/images/destination', 'template/assets/images/tour', 'template/assets/images/blog', 'template/assets/images'];
        foreach ($templateDirs as $tDir) {
            $this->scanTemplateDirectory($tDir, $images);
        }

        rsort($images);

        return response()->json($images);
    }

    private function scanDirectory($disk, $directory, &$images)
    {
        if (!$disk->exists($directory)) return;

        $files = $disk->files($directory);
        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $images[] = [
                    'path' => $file,
                    'url' => asset('storage/' . $file),
                    'name' => basename($file),
                    'size' => $disk->size($file),
                    'folder' => $directory,
                ];
            }
        }

        $dirs = $disk->directories($directory);
        foreach ($dirs as $dir) {
            $this->scanDirectory($disk, $dir, $images);
        }
    }

    private function scanTemplateDirectory($directory, &$images)
    {
        $fullPath = public_path($directory);
        if (!is_dir($fullPath)) return;

        $files = scandir($fullPath);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            $fullFile = $fullPath . '/' . $file;
            if (is_file($fullFile)) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $images[] = [
                        'path' => $directory . '/' . $file,
                        'url' => asset($directory . '/' . $file),
                        'name' => $file,
                        'size' => filesize($fullFile),
                        'folder' => $directory,
                    ];
                }
            }
            if (is_dir($fullFile)) {
                $this->scanTemplateDirectory($directory . '/' . $file, $images);
            }
        }
    }
}
