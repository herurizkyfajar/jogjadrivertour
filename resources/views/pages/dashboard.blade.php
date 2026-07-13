@extends('layouts.dashboard')

@section('title', 'Dashboard - Yogyakarta Driver Tour')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Dashboard</h3>
        <p class="des">Welcome back! Here's an overview of your site.</p>
    </div>
    <div class="counter-grid-dashboard mb-70">
        <div class="counter-dashboard flex-three">
            <div class="icon flex-five">
                <i class="icon-Group-81"></i>
            </div>
            <div class="content">
                <span>Tour Packages</span>
                <div class="number-counter">{{ $stats['total_tours'] }}</div>
            </div>
        </div>
        <div class="counter-dashboard flex-three">
            <div class="icon flex-five">
                <i class="icon-Group-91"></i>
            </div>
            <div class="content">
                <span>Destinations</span>
                <div class="number-counter">{{ $stats['total_destinations'] }}</div>
            </div>
        </div>
        <div class="counter-dashboard flex-three">
            <div class="icon flex-five">
                <i class="icon-Vector-10"></i>
            </div>
            <div class="content">
                <span>Blog Posts</span>
                <div class="number-counter">{{ $stats['total_blogs'] }}</div>
            </div>
        </div>
        <div class="counter-dashboard flex-three">
            <div class="icon flex-five">
                <i class="icon-feedback"></i>
            </div>
            <div class="content">
                <span>Reviews</span>
                <div class="number-counter">{{ $stats['total_testimonials'] }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-8 col-xl-12">
            <div class="wg-box">
                <h5 class="mb-20">Recent Tours</h5>
                @if($recentTours->isEmpty())
                    <p class="text-muted">No tours yet.</p>
                @else
                    <div style="overflow-x:auto;">
                        <table style="width:100%;border-collapse:collapse;font-size:14px;">
                            <thead>
                                <tr style="border-bottom:1px solid #eee;text-align:left;">
                                    <th style="padding:10px 8px;">Tour Name</th>
                                    <th style="padding:10px 8px;">Category</th>
                                    <th style="padding:10px 8px;">Duration</th>
                                    <th style="padding:10px 8px;">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTours as $tour)
                                    <tr style="border-bottom:1px solid #f5f5f5;">
                                        <td style="padding:10px 8px;font-weight:600;">{{ $tour->name }}</td>
                                        <td style="padding:10px 8px;">{{ $tour->category ?? '-' }}</td>
                                        <td style="padding:10px 8px;">{{ $tour->duration_info ?? '-' }}</td>
                                        <td style="padding:10px 8px;color:#888;">{{ $tour->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-xxl-4 col-xl-12">
            <div class="wg-box">
                <h5 class="mb-20">Recent Reviews</h5>
                @if($testimonials->isEmpty())
                    <p class="text-muted">No reviews yet.</p>
                @else
                    <ul style="list-style:none;padding:0;margin:0;">
                        @foreach($testimonials as $t)
                            <li style="display:flex;gap:12px;align-items:flex-start;padding:12px 0;border-bottom:1px solid #f5f5f5;">
                                <div style="flex-shrink:0;width:40px;height:40px;border-radius:50%;background:#4DA528;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:16px;">
                                    {{ strtoupper(substr($t->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:14px;">{{ $t->name }}</div>
                                    <div style="color:#888;font-size:13px;margin-top:2px;">{{ $t->created_at->diffForHumans() }}</div>
                                    @if($t->comment)
                                        <p style="margin:6px 0 0;font-size:13px;color:#555;">{{ Str::limit($t->comment, 80) }}</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
