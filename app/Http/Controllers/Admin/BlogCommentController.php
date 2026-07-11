<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $query = BlogComment::with('blog')->latest();

        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        $comments = $query->paginate(15)->withQueryString();

        return view('admin.blog.comments', compact('comments', 'status'));
    }

    public function approve(BlogComment $comment)
    {
        $comment->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Comment approved successfully.');
    }

    public function reject(BlogComment $comment)
    {
        $comment->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Comment rejected successfully.');
    }

    public function destroy(BlogComment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
