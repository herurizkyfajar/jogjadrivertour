<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Destination;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredTours = Tour::where('is_featured', true)
            ->where('is_active', true)
            ->limit(8)
            ->get();

        $featuredDestinations = Destination::where('is_featured', true)
            ->where('is_active', true)
            ->limit(6)
            ->get();

        $latestBlogs = Blog::where('is_active', true)
            ->latest()
            ->limit(3)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->limit(5)
            ->get();

        $tourCategories = Tour::where('is_active', true)
            ->pluck('category')
            ->unique()
            ->values();

        $cities = \App\Models\City::where('is_active', true)->orderBy('name')->pluck('name');

        $featuredDestinationsAll = Destination::where('is_featured', true)
            ->where('is_active', true)
            ->get();

        return view('pages.home', compact(
            'featuredTours',
            'featuredDestinations',
            'latestBlogs',
            'testimonials',
            'tourCategories',
            'cities',
            'featuredDestinationsAll'
        ));
    }
}
