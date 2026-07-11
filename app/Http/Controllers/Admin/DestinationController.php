<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        $cities = \App\Models\City::where('is_active', true)->orderBy('name')->get();
        return view('admin.destinations.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'tour_count' => 'nullable|integer|min:0',
            'maps_embed' => 'nullable|string',
            'maps_link' => 'nullable|url|max:500',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_featured' => 'nullable',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->convertToWebp($request->file('image'), 'destinations');
        }

        if ($request->hasFile('gallery_images')) {
            $validated['gallery_images'] = $this->handleGalleryUpload($request->file('gallery_images'));
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['rating'] = $validated['rating'] ?? 5.00;
        $validated['tour_count'] = $validated['tour_count'] ?? 0;

        Destination::create($validated);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination created successfully.');
    }

    public function edit(Destination $destination)
    {
        $cities = \App\Models\City::where('is_active', true)->orderBy('name')->get();
        return view('admin.destinations.edit', compact('destination', 'cities'));
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'tour_count' => 'nullable|integer|min:0',
            'maps_embed' => 'nullable|string',
            'maps_link' => 'nullable|url|max:500',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'delete_gallery' => 'nullable|array',
            'is_featured' => 'nullable',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            if ($destination->image && str_starts_with($destination->image, 'destinations/') && Storage::disk('public')->exists($destination->image)) {
                Storage::disk('public')->delete($destination->image);
            }
            $validated['image'] = $this->convertToWebp($request->file('image'), 'destinations');
        } else {
            unset($validated['image']);
        }

        // Handle gallery images
        $existingGallery = $destination->gallery_images ?? [];
        
        if ($request->has('delete_gallery') && is_array($request->delete_gallery)) {
            foreach ($request->delete_gallery as $index) {
                $idx = (int)$index;
                if (isset($existingGallery[$idx])) {
                    $path = $existingGallery[$idx];
                    if (str_starts_with($path, 'destinations/gallery/') && Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                    unset($existingGallery[$idx]);
                }
            }
            $existingGallery = array_values($existingGallery);
        }

        if ($request->hasFile('gallery_images')) {
            $newImages = $this->handleGalleryUpload($request->file('gallery_images'));
            $existingGallery = array_merge($existingGallery, $newImages);
        }

        $validated['gallery_images'] = $existingGallery;

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['rating'] = $validated['rating'] ?? 5.00;
        $validated['tour_count'] = $validated['tour_count'] ?? 0;

        $destination->update($validated);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image && str_starts_with($destination->image, 'destinations/') && Storage::disk('public')->exists($destination->image)) {
            Storage::disk('public')->delete($destination->image);
        }

        foreach ($destination->gallery_images ?? [] as $galleryPath) {
            if (str_starts_with($galleryPath, 'destinations/gallery/') && Storage::disk('public')->exists($galleryPath)) {
                Storage::disk('public')->delete($galleryPath);
            }
        }

        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('admin.destinations.index')->with('success', 'No destinations selected.');
        }

        $ids = array_map('intval', $ids);
        $destinations = Destination::whereIn('id', $ids)->get();
        $deleted = 0;

        foreach ($destinations as $destination) {
            if ($destination->image && str_starts_with($destination->image, 'destinations/') && Storage::disk('public')->exists($destination->image)) {
                Storage::disk('public')->delete($destination->image);
            }
            foreach ($destination->gallery_images ?? [] as $galleryPath) {
                if (str_starts_with($galleryPath, 'destinations/gallery/') && Storage::disk('public')->exists($galleryPath)) {
                    Storage::disk('public')->delete($galleryPath);
                }
            }
            $destination->delete();
            $deleted++;
        }

        return redirect()->route('admin.destinations.index')->with('success', $deleted . ' destination(s) deleted successfully.');
    }

    private function convertToWebp($file, $folder)
    {
        $originalPath = $file->getRealPath();
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.webp';
        $path = $folder . '/gallery/' . $filename;

        $imageInfo = getimagesize($originalPath);
        if (!$imageInfo) {
            return $file->store($folder . '/gallery', 'public');
        }

        $mime = $imageInfo['mime'];
        switch ($mime) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($originalPath);
                break;
            case 'image/png':
                $source = imagecreatefrompng($originalPath);
                break;
            case 'image/webp':
                $source = imagecreatefromwebp($originalPath);
                break;
            default:
                return $file->store($folder . '/gallery', 'public');
        }

        if (!$source) {
            return $file->store($folder . '/gallery', 'public');
        }

        $tempPath = storage_path('app/temp_' . $filename);
        imagewebp($source, $tempPath, 85);
        imagedestroy($source);

        $content = file_get_contents($tempPath);
        Storage::disk('public')->put($path, $content);

        if (file_exists($tempPath)) {
            unlink($tempPath);
        }

        return $path;
    }

    private function handleGalleryUpload($files)
    {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = $this->convertToWebp($file, 'destinations');
        }
        return $paths;
    }
}