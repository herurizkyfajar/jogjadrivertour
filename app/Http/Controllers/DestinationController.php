<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::where('is_active', true);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', true);
        }

        $destinations = $query->latest()->paginate(12)->withQueryString();

        if ($request->ajax()) {
            $html = view('pages.destinations._items', ['destinations' => $destinations])->render();
            return response()->json(['html' => $html, 'hasMore' => $destinations->hasMorePages()]);
        }

        $cities = Destination::where('is_active', true)
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        return view('pages.destinations.index', compact('destinations', 'cities'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.destinations.show', compact('destination'));
    }
}
