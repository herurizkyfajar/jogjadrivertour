<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\MyTour;
use App\Models\Destination;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->get('page', 2);
            $myTours = MyTour::latest()->paginate(12, ['*'], 'page', $page);
            $html = view('pages.tours._items', ['myTours' => $myTours])->render();
            return response()->json(['html' => $html, 'hasMore' => $myTours->hasMorePages()]);
        }

        $myTours = MyTour::latest()->paginate(12);
        return view('pages.tours.index', compact('myTours'));
    }

    public function packages(Request $request)
    {
        $query = Tour::where('is_active', true);

        if ($request->filled('city')) {
            $query->where('location', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('duration')) {
            $duration = (int) $request->duration;
            if ($duration === 3) {
                $query->where('duration_days', '>=', 3);
            } else {
                $query->where('duration_days', $duration);
            }
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'new') {
                $query->latest();
            } else {
                $query->orderBy('discount_price');
            }
        } else {
            $query->latest();
        }

        $tours = $query->paginate(12)->withQueryString();
        $myTours = MyTour::latest()->get();
        $destinations = Destination::where('is_active', true)->get();
        $categories = Tour::where('is_active', true)->distinct()->pluck('category')->filter();

        return view('pages.tours.packages', compact('tours', 'myTours', 'destinations', 'categories'));
    }

    public function show($slug)
    {
        $tour = Tour::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.tours.show', compact('tour'));
    }
}
