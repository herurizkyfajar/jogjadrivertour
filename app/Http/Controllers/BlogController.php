<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_active', true)
            ->latest()
            ->paginate(9);

        return view('pages.blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('is_active', true)
            ->with(['approvedComments' => function ($query) {
                $query->latest();
            }])
            ->firstOrFail();

        return view('pages.blog.show', compact('blog'));
    }

    public function storeComment(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'content' => 'required|string|max:5000',
        ]);

        $blog->comments()->create([
            'author_name' => $validated['author_name'],
            'author_email' => $validated['author_email'],
            'content' => $validated['content'],
            'status' => 'pending',
            'author_ip' => $request->ip(),
        ]);

        return redirect()->back()->with('comment_success', 'Thank you! Your comment has been submitted and is awaiting moderation.');
    }
}
