@extends('layouts.dashboard')

@section('title', 'Manage Blog - Dashboard')

@section('content')
<section class="profile-dashboard">
    <div class="inner-header mb-40">
        <h3 class="title">Manage Blog</h3>
        <p class="des">Create, edit, and delete blog posts</p>
    </div>

    @if(session('success'))
        <div style="background:#4DA528;color:#fff;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <div class="flex-two mb-30">
            <h5 style="margin:0;">Blog Posts ({{ App\Models\Blog::count() }})</h5>
            <a href="{{ route('admin.blog.create') }}" style="background:#4DA528;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;">+ Add New</a>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="border-bottom:2px solid #eee;text-align:left;">
                        <th style="padding:12px 10px;color:#666;">#</th>
                        <th style="padding:12px 10px;color:#666;">Image</th>
                        <th style="padding:12px 10px;color:#666;">Title</th>
                        <th style="padding:12px 10px;color:#666;">Author</th>
                        <th style="padding:12px 10px;color:#666;">Category</th>
                        <th style="padding:12px 10px;color:#666;">Views</th>
                        <th style="padding:12px 10px;color:#666;">Status</th>
                        <th style="padding:12px 10px;color:#666;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px 10px;">{{ $blog->id }}</td>
                        <td style="padding:12px 10px;">
                            @if(str_starts_with($blog->image, 'blogs/'))
                                <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}" style="width:80px;height:55px;object-fit:cover;border-radius:6px;">
                            @else
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width:80px;height:55px;object-fit:cover;border-radius:6px;">
                            @endif
                        </td>
                        <td style="padding:12px 10px;font-weight:600;color:#081E2A;">{{ Str::limit($blog->title, 50) }}</td>
                        <td style="padding:12px 10px;color:#666;">{{ $blog->author_name ?? 'Admin' }}</td>
                        <td style="padding:12px 10px;color:#666;">
                            <span style="background:#e6f7e6;color:#4DA528;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">{{ $blog->category }}</span>
                        </td>
                        <td style="padding:12px 10px;color:#666;">{{ $blog->view_count }}</td>
                        <td style="padding:12px 10px;">
                            @if($blog->is_active)
                                <span style="background:#e6f7e6;color:#4DA528;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Active</span>
                            @else
                                <span style="background:#fde8e8;color:#e74c3c;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Inactive</span>
                            @endif
                        </td>
                        <td style="padding:12px 10px;">
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.blog.edit', $blog) }}" style="background:#e6f7e6;color:#4DA528;padding:6px 14px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:600;">Edit</a>
                                <form action="{{ route('admin.blog.destroy', $blog) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#fde8e8;color:#e74c3c;padding:6px 14px;border-radius:6px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="padding:40px;text-align:center;color:#999;">No blog posts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;text-align:center;">
            {{ $blogs->links() }}
        </div>
    </div>
</section>
@endsection
