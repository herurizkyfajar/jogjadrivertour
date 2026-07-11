<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class InstagramController extends Controller
{
    public function feed()
    {
        $username = Setting::get('instagram_url', '');
        if (!$username) {
            return response()->json(['images' => []]);
        }

        $username = trim(parse_url($username, PHP_URL_PATH), '/@');
        if (empty($username)) {
            return response()->json(['images' => []]);
        }

        $cacheKey = 'instagram_feed_' . $username;
        $images = Cache::get($cacheKey);

        if ($images === null) {
            $images = $this->fetchInstagramFeed($username);
            Cache::put($cacheKey, $images, now()->addHours(6));
        }

        return response()->json(['images' => $images]);
    }

    private function fetchInstagramFeed($username)
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.5',
            ])->timeout(10)->get("https://www.instagram.com/{$username}/");

            if ($response->failed()) {
                return [];
            }

            $html = $response->body();

            if (preg_match('/window\._sharedData\s*=\s*({.*?});\s*<\/script>/', $html, $matches)) {
                $data = json_decode($matches[1], true);
                $edges = $data['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ?? [];
                return collect($edges)->take(6)->map(function ($edge) {
                    $node = $edge['node'];
                    return $node['display_url'] ?? ($node['thumbnail_src'] ?? '');
                })->filter()->values()->toArray();
            }

            if (preg_match('/"edge_owner_to_timeline_media":\s*\{"count":\d+,"page_info":.*?"edges":\s*(\[.*?\])\s*,\s*"page_info"/s', $html, $matches)) {
                $edges = json_decode($matches[1], true);
                return collect($edges)->take(6)->map(function ($edge) {
                    $node = $edge['node'];
                    return $node['display_url'] ?? ($node['thumbnail_src'] ?? '');
                })->filter()->values()->toArray();
            }

            return [];
        } catch (\Exception $e) {
            return [];
        }
    }
}
