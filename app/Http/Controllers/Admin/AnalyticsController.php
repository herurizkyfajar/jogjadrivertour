<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', '7d');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if ($startDate && $endDate) {
            $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();
            $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();
            $period = 'custom';
        } else {
            $startDate = match($period) {
                '24h' => now()->subDay(),
                '7d'  => now()->subDays(7),
                '30d' => now()->subDays(30),
                '90d' => now()->subDays(90),
                default => now()->subDays(7),
            };
            $endDate = now();
        }

        $totalVisits = VisitorLog::where('created_at', '>=', $startDate)->count();
        $uniqueVisitors = VisitorLog::where('created_at', '>=', $startDate)->where('is_unique', true)->count();
        $todayVisits = VisitorLog::whereDate('created_at', today())->count();
        $todayUnique = VisitorLog::whereDate('created_at', today())->where('is_unique', true)->count();

        $dailyStats = VisitorLog::where('created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN is_unique = 1 THEN 1 ELSE 0 END) as unique_count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $pageStats = VisitorLog::where('created_at', '>=', $startDate)
            ->select('page', DB::raw('COUNT(*) as views'))
            ->groupBy('page')
            ->orderByDesc('views')
            ->take(10)
            ->get();

        $browserStats = VisitorLog::where('created_at', '>=', $startDate)
            ->select('browser', DB::raw('COUNT(*) as count'))
            ->groupBy('browser')
            ->orderByDesc('count')
            ->get();

        $deviceStats = VisitorLog::where('created_at', '>=', $startDate)
            ->select('device', DB::raw('COUNT(*) as count'))
            ->groupBy('device')
            ->orderByDesc('count')
            ->get();

        $recentVisits = VisitorLog::latest('created_at')
            ->take(20)
            ->get();

        $topReferrers = VisitorLog::where('created_at', '>=', $startDate)
            ->whereNotNull('referrer')
            ->where('referrer', '!=', '')
            ->select('referrer', DB::raw('COUNT(*) as count'))
            ->groupBy('referrer')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        $peakHours = VisitorLog::where('created_at', '>=', $startDate)
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('COUNT(*) as count'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $dailyDates = $dailyStats->pluck('date')->map(function($d) { return \Carbon\Carbon::parse($d)->format('d M'); })->values();
        $hourLabels = $peakHours->pluck('hour')->map(function($h) { return str_pad($h, 2, '0', STR_PAD_LEFT) . ':00'; })->values();

        return view('admin.analytics.index', compact(
            'period', 'totalVisits', 'uniqueVisitors', 'todayVisits', 'todayUnique',
            'dailyStats', 'pageStats', 'browserStats', 'deviceStats',
            'recentVisits', 'topReferrers', 'peakHours', 'dailyDates', 'hourLabels'
        ));
    }
}
