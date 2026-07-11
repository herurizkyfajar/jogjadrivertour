<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Blog;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tours' => Tour::count(),
            'total_destinations' => Destination::count(),
            'total_blogs' => Blog::count(),
            'total_testimonials' => Testimonial::count(),
        ];

        $recentTours = Tour::latest()->take(5)->get();
        $testimonials = Testimonial::latest()->take(3)->get();

        return view('pages.dashboard', compact('stats', 'recentTours', 'testimonials'));
    }
}
