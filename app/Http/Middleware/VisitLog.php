<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\Cache;

class VisitLog
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->method() !== 'GET' || $request->ajax() || $request->is('admin/*') || $request->is('api/*')) {
            return $response;
        }

        try {
            $ip = $request->ip();
            $url = $request->path();
            $ua = $request->userAgent() ?? '';
            $page = $this->getPageName($url);

            $todayKey = 'visitor_' . $ip . '_' . date('Y-m-d');
            $isUnique = !Cache::has($todayKey);
            Cache::put($todayKey, true, now()->addHours(24));

            VisitorLog::create([
                'ip' => $ip,
                'url' => $url,
                'page' => $page,
                'method' => 'GET',
                'user_agent' => substr($ua, 0, 500),
                'referrer' => $request->headers->get('referer') ? substr($request->headers->get('referer'), 0, 500) : null,
                'device' => $this->detectDevice($ua),
                'browser' => $this->detectBrowser($ua),
                'is_unique' => $isUnique,
                'created_at' => now(),
            ]);
        } catch (\Exception $e) {
            // silently fail — never break the app
        }

        return $response;
    }

    private function getPageName(string $url): string
    {
        if ($url === '' || $url === '/') return 'Home';
        $segments = explode('/', $url);
        $first = $segments[0] ?? '';
        return match($first) {
            'tours' => 'Tours',
            'destinations' => 'Destinations',
            'blog' => 'Blog',
            'about' => 'About',
            'contact' => 'Contact',
            'login' => 'Login',
            'register' => 'Register',
            default => ucfirst($first),
        };
    }

    private function detectDevice(string $ua): string
    {
        if (preg_match('/mobile|android|iphone|ipad|ipod/i', $ua)) return 'Mobile';
        if (preg_match('/tablet|kindle|silk/i', $ua)) return 'Tablet';
        return 'Desktop';
    }

    private function detectBrowser(string $ua): string
    {
        if (preg_match('/chrome/i', $ua) && !preg_match('/edg/i', $ua)) return 'Chrome';
        if (preg_match('/firefox/i', $ua)) return 'Firefox';
        if (preg_match('/safari/i', $ua) && !preg_match('/chrome/i', $ua)) return 'Safari';
        if (preg_match('/edg/i', $ua)) return 'Edge';
        if (preg_match('/opera|opr/i', $ua)) return 'Opera';
        return 'Other';
    }
}
