<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $disk = Storage::disk('public');
        $folder = $request->get('folder', '');
        $search = $request->get('search', '');
        $page = (int) $request->get('page', 1);
        $perPage = 21;

        $allImages = $this->getAllImages($disk, $folder, $search);
        $total = count($allImages);
        $images = array_slice($allImages, ($page - 1) * $perPage, $perPage);
        $hasMore = ($page * $perPage) < $total;

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'images' => $images,
                'hasMore' => $hasMore,
                'page' => $page,
                'total' => $total,
            ]);
        }

        $folders = $this->getFolderCounts($disk);

        return view('admin.media.index', compact('images', 'folders', 'folder', 'search', 'hasMore', 'total', 'page'));
    }

    public function destroy(Request $request)
    {
        $path = $request->input('path');

        if (!$path) {
            return redirect()->route('admin.media.index')
                ->with('error', 'No path provided.');
        }

        $deleted = $this->deleteFile($path);

        return redirect()->route('admin.media.index', request()->only('folder', 'search'))
            ->with($deleted ? 'success' : 'error', $deleted ? 'Image deleted successfully.' : 'Image not found.');
    }

    public function bulkDelete(Request $request)
    {
        $paths = $request->input('paths', []);
        $deleted = 0;

        foreach ($paths as $path) {
            if ($this->deleteFile($path)) {
                $deleted++;
            }
        }

        return redirect()->route('admin.media.index', request()->only('folder', 'search'))
            ->with('success', $deleted . ' image(s) deleted successfully.');
    }

    private function deleteFile($path)
    {
        // Try storage disk first (for uploaded images)
        $disk = Storage::disk('public');
        if ($disk->exists($path)) {
            $disk->delete($path);
            return true;
        }

        // Try public directory (for template images)
        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
            return true;
        }

        return false;
    }

    private function getAllImages($disk, $folderFilter, $search)
    {
        $images = [];
        $directories = ['destinations', 'tours', 'blogs'];

        foreach ($directories as $dir) {
            $this->scanDirectory($disk, $dir, $images, $folderFilter, $search);
        }

        $templateDirs = ['template/assets/images/destination', 'template/assets/images/tour', 'template/assets/images/blog', 'template/assets/images'];
        foreach ($templateDirs as $tDir) {
            $this->scanTemplateDirectory($tDir, $images, $folderFilter, $search);
        }

        rsort($images);
        return $images;
    }

    private function scanDirectory($disk, $directory, &$images, $folderFilter, $search)
    {
        if (!$disk->exists($directory)) return;

        $files = $disk->files($directory);
        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $name = basename($file);
                if ($search && stripos($name, $search) === false && stripos($file, $search) === false) continue;
                if ($folderFilter && strpos($file, $folderFilter) === false) continue;

                $images[] = [
                    'path' => $file,
                    'url' => asset('storage/' . $file),
                    'name' => $name,
                    'size' => $disk->size($file),
                    'folder' => $directory,
                    'modified' => $disk->lastModified($file),
                ];
            }
        }

        $dirs = $disk->directories($directory);
        foreach ($dirs as $dir) {
            $this->scanDirectory($disk, $dir, $images, $folderFilter, $search);
        }
    }

    private function scanTemplateDirectory($directory, &$images, $folderFilter, $search)
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
                    if ($search && stripos($file, $search) === false) continue;
                    if ($folderFilter && strpos($directory, $folderFilter) === false) continue;

                    $images[] = [
                        'path' => $directory . '/' . $file,
                        'url' => asset($directory . '/' . $file),
                        'name' => $file,
                        'size' => filesize($fullFile),
                        'folder' => $directory,
                        'modified' => filemtime($fullFile),
                    ];
                }
            }
            if (is_dir($fullFile)) {
                $this->scanTemplateDirectory($directory . '/' . $file, $images, $folderFilter, $search);
            }
        }
    }

    private function getFolderCounts($disk)
    {
        $folders = [];
        $dirs = ['destinations', 'tours', 'blogs', 'template'];
        foreach ($dirs as $dir) {
            $count = $this->countImages($disk, $dir);
            if ($count > 0) {
                $folders[$dir] = $count;
            }
        }
        return $folders;
    }

    private function countImages($disk, $directory)
    {
        $count = 0;
        if ($disk->exists($directory)) {
            $files = $disk->files($directory);
            foreach ($files as $file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) $count++;
            }
            $dirs = $disk->directories($directory);
            foreach ($dirs as $dir) {
                $count += $this->countImages($disk, $dir);
            }
        }
        return $count;
    }
}
