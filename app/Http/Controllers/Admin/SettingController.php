<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'instagram_url' => Setting::get('instagram_url', ''),
            'instagram_images' => Setting::get('instagram_images', '[]'),
            'visited_countries' => Setting::get('visited_countries', '[]'),
        ];
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        Setting::set('instagram_url', $request->instagram_url);

        $visitedCountries = $request->visited_countries ?? [];
        Setting::set('visited_countries', json_encode($visitedCountries));

        $images = json_decode(Setting::get('instagram_images', '[]'), true) ?: [];

        if ($request->has('removed_instagram_images')) {
            foreach ($request->removed_instagram_images as $oldPath) {
                if (in_array($oldPath, $images)) {
                    Storage::disk('public')->delete($oldPath);
                    $images = array_values(array_diff($images, [$oldPath]));
                }
            }
        }

        if ($request->hasFile('instagram_images')) {
            $newFiles = $request->file('instagram_images');
            foreach ($newFiles as $file) {
                if (count($images) >= 6) break;
                $path = $file->store('instagram', 'public');
                $images[] = $path;
            }
        }

        Setting::set('instagram_images', json_encode($images));

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
