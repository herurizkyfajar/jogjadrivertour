@extends('layouts.dashboard')

@section('title', 'Visitor Analytics - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Visitor Analytics</h3>
        <p class="des">Track website traffic and visitor behavior</p>
    </div>

    <!-- Period Filter -->
    <div style="display:flex;gap:8px;margin-bottom:24px;align-items:center;flex-wrap:wrap;">
        @foreach(['24h' => '24 Hours', '7d' => '7 Days', '30d' => '30 Days', '90d' => '90 Days'] as $val => $label)
            <a href="?period={{ $val }}" style="padding:8px 18px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;{{ $period === $val ? 'background:#4DA528;color:#fff;' : 'background:#f1f1f1;color:#666;' }}">{{ $label }}</a>
        @endforeach
        <span style="color:#999;font-size:13px;margin-left:4px;">|</span>
        <form method="GET" action="{{ route('admin.analytics.index') }}" style="display:flex;gap:8px;align-items:center;">
            <input type="date" name="start_date" value="{{ request('start_date') }}" style="padding:8px 12px;border:1px solid #ddd;border-radius:8px;font-size:13px;">
            <span style="color:#999;">to</span>
            <input type="date" name="end_date" value="{{ request('end_date') }}" style="padding:8px 12px;border:1px solid #ddd;border-radius:8px;font-size:13px;">
            <button type="submit" style="padding:8px 18px;border-radius:8px;font-size:13px;font-weight:600;background:#4DA528;color:#fff;border:none;cursor:pointer;">Apply</button>
        </form>
    </div>

    <!-- Stat Cards -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:30px;">
        <div class="wg-box" style="text-align:center;padding:20px;">
            <p style="margin:0;font-size:13px;color:#8A8AA0;text-transform:uppercase;letter-spacing:1px;">Today Visits</p>
            <h2 style="margin:8px 0 0;font-size:32px;color:#081E2A;">{{ number_format($todayVisits) }}</h2>
        </div>
        <div class="wg-box" style="text-align:center;padding:20px;">
            <p style="margin:0;font-size:13px;color:#8A8AA0;text-transform:uppercase;letter-spacing:1px;">Today Unique</p>
            <h2 style="margin:8px 0 0;font-size:32px;color:#4DA528;">{{ number_format($todayUnique) }}</h2>
        </div>
        <div class="wg-box" style="text-align:center;padding:20px;">
            <p style="margin:0;font-size:13px;color:#8A8AA0;text-transform:uppercase;letter-spacing:1px;">Total Visits</p>
            <h2 style="margin:8px 0 0;font-size:32px;color:#081E2A;">{{ number_format($totalVisits) }}</h2>
        </div>
        <div class="wg-box" style="text-align:center;padding:20px;">
            <p style="margin:0;font-size:13px;color:#8A8AA0;text-transform:uppercase;letter-spacing:1px;">Unique Visitors</p>
            <h2 style="margin:8px 0 0;font-size:32px;color:#f5a623;">{{ number_format($uniqueVisitors) }}</h2>
        </div>
    </div>

    <!-- Charts Row -->
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-bottom:30px;">
        <!-- Daily Visits Chart -->
        <div class="wg-box" style="padding:20px;">
            <h5 style="margin:0 0 16px;font-size:16px;color:#081E2A;">Daily Visits</h5>
            <canvas id="dailyChart" height="220"></canvas>
        </div>
        <!-- Browser Stats -->
        <div class="wg-box" style="padding:20px;">
            <h5 style="margin:0 0 16px;font-size:16px;color:#081E2A;">Browsers</h5>
            <canvas id="browserChart" height="220"></canvas>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:30px;">
        <!-- Device Stats -->
        <div class="wg-box" style="padding:20px;">
            <h5 style="margin:0 0 16px;font-size:16px;color:#081E2A;">Devices</h5>
            <canvas id="deviceChart" height="200"></canvas>
        </div>
        <!-- Peak Hours -->
        <div class="wg-box" style="padding:20px;">
            <h5 style="margin:0 0 16px;font-size:16px;color:#081E2A;">Peak Hours</h5>
            <canvas id="hourChart" height="200"></canvas>
        </div>
    </div>

    <!-- Tables Row -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:30px;">
        <!-- Top Pages -->
        <div class="wg-box" style="padding:20px;">
            <h5 style="margin:0 0 16px;font-size:16px;color:#081E2A;">Top Pages</h5>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:8px 10px;color:#666;">Page</th>
                        <th style="padding:8px 10px;color:#666;text-align:right;">Views</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pageStats as $stat)
                    <tr style="border-bottom:1px solid #f5f5f5;">
                        <td style="padding:8px 10px;font-weight:500;">{{ $stat->page }}</td>
                        <td style="padding:8px 10px;text-align:right;font-weight:600;color:#4DA528;">{{ number_format($stat->views) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2" style="padding:20px;text-align:center;color:#999;">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Top Referrers -->
        <div class="wg-box" style="padding:20px;">
            <h5 style="margin:0 0 16px;font-size:16px;color:#081E2A;">Top Referrers</h5>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:8px 10px;color:#666;">Referrer</th>
                        <th style="padding:8px 10px;color:#666;text-align:right;">Visits</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topReferrers as $ref)
                    <tr style="border-bottom:1px solid #f5f5f5;">
                        <td style="padding:8px 10px;font-weight:500;max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $ref->referrer }}">{{ $ref->referrer }}</td>
                        <td style="padding:8px 10px;text-align:right;font-weight:600;color:#4DA528;">{{ number_format($ref->count) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2" style="padding:20px;text-align:center;color:#999;">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Visits -->
    <div class="wg-box" style="padding:20px;">
        <h5 style="margin:0 0 16px;font-size:16px;color:#081E2A;">Recent Visits</h5>
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:13px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:8px 10px;color:#666;">Time</th>
                        <th style="padding:8px 10px;color:#666;">Page</th>
                        <th style="padding:8px 10px;color:#666;">URL</th>
                        <th style="padding:8px 10px;color:#666;">Device</th>
                        <th style="padding:8px 10px;color:#666;">Browser</th>
                        <th style="padding:8px 10px;color:#666;">IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentVisits as $log)
                    <tr style="border-bottom:1px solid #f5f5f5;">
                        <td style="padding:8px 10px;color:#666;white-space:nowrap;">{{ $log->created_at->format('d M H:i') }}</td>
                        <td style="padding:8px 10px;font-weight:500;">{{ $log->page }}</td>
                        <td style="padding:8px 10px;color:#666;max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">/{{ $log->url }}</td>
                        <td style="padding:8px 10px;">
                            <span style="background:{{ $log->device === 'Mobile' ? '#fff3e0' : '#e6f7e6' }};color:{{ $log->device === 'Mobile' ? '#f5a623' : '#4DA528' }};padding:3px 10px;border-radius:12px;font-size:11px;font-weight:600;">{{ $log->device }}</span>
                        </td>
                        <td style="padding:8px 10px;color:#666;">{{ $log->browser }}</td>
                        <td style="padding:8px 10px;color:#999;font-family:monospace;font-size:12px;">{{ $log->ip }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="padding:30px;text-align:center;color:#999;">No visits recorded yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var colors = {
        green: '#4DA528', greenLight: 'rgba(77,165,40,0.15)',
        orange: '#f5a623', orangeLight: 'rgba(245,166,35,0.15)',
        blue: '#3498db', red: '#e74c3c', purple: '#9b59b6',
        gray: '#95a5a6', teal: '#1abc9c'
    };

    var dailyLabels = {!! $dailyDates->toJson() !!};
    var dailyTotal = {!! $dailyStats->pluck('total')->toJson() !!};
    var dailyUnique = {!! $dailyStats->pluck('unique_count')->toJson() !!};
    new Chart(document.getElementById('dailyChart'), {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [
                { label: 'Total Visits', data: dailyTotal, borderColor: colors.green, backgroundColor: colors.greenLight, fill: true, tension: 0.4, pointRadius: 4 },
                { label: 'Unique Visitors', data: dailyUnique, borderColor: colors.orange, backgroundColor: colors.orangeLight, fill: true, tension: 0.4, pointRadius: 4 }
            ]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });

    var browserLabels = {!! $browserStats->pluck('browser')->toJson() !!};
    var browserData = {!! $browserStats->pluck('count')->toJson() !!};
    new Chart(document.getElementById('browserChart'), {
        type: 'doughnut',
        data: {
            labels: browserLabels,
            datasets: [{ data: browserData, backgroundColor: [colors.green, colors.orange, colors.blue, colors.red, colors.purple, colors.gray] }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    var deviceLabels = {!! $deviceStats->pluck('device')->toJson() !!};
    var deviceData = {!! $deviceStats->pluck('count')->toJson() !!};
    new Chart(document.getElementById('deviceChart'), {
        type: 'doughnut',
        data: {
            labels: deviceLabels,
            datasets: [{ data: deviceData, backgroundColor: [colors.green, colors.orange, colors.blue] }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    var hourLabels = {!! $hourLabels->toJson() !!};
    var hourData = {!! $peakHours->pluck('count')->toJson() !!};
    new Chart(document.getElementById('hourChart'), {
        type: 'bar',
        data: {
            labels: hourLabels,
            datasets: [{ label: 'Visits', data: hourData, backgroundColor: colors.green, borderRadius: 6 }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });
});
</script>
@endpush
@endsection
