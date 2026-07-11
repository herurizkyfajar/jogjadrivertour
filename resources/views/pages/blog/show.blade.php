@extends('layouts.app')

@section('title', $blog->title . ' - Yogyakarta Driver Tour')

@section('content')
<section class="breadcumb-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12 center z-index1">
                <h1 class="title">Blog Details</h1>
                <ul class="breadcumb-list flex-five">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><span>{{ Str::limit($blog->title, 30) }}</span></li>
                </ul>
                <img class="bcrumb-ab" src="{{ asset('template/assets/images/page/mask-bcrumb.png') }}" alt="">
            </div>
        </div>
    </div>
</section>

<section class="our-blog pd-main">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <article class="side-blog side-blog-single">
                    <div class="image" style="border-radius:12px;overflow:hidden;margin-bottom:30px;">
                        @if(str_starts_with($blog->image, 'blogs/'))
                            <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}" style="width:100%;height:auto;display:block;">
                        @else
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width:100%;height:auto;display:block;">
                        @endif
                    </div>
                    <div class="top-detail-info">
                        <ul class="flex-three">
                            <li>
                                <i class="icon-4"></i>
                                <span>{{ $blog->created_at->format('d M Y') }}</span>
                            </li>
                            <li>
                                <i class="icon-25"></i>
                                <span>Comments ({{ $blog->approvedComments->count() }})</span>
                            </li>
                            <li>
                                <i class="icon-24"></i>
                                <span>3 min Read</span>
                            </li>
                        </ul>
                    </div>
                    <h2 class="entry-title">{{ $blog->title }}</h2>
                    <div class="des lh-32 mb-37">
                        {!! $blog->content !!}
                    </div>
                    <div class="flex-two share-blog">
                        <div class="tag-blog flex-three">
                            <span>Tag:</span>
                            <ul class="tag">
                                <li><a href="#">{{ $blog->category }}</a></li>
                                <li><a href="#">Yogyakarta</a></li>
                                <li><a href="#">Travel</a></li>
                            </ul>
                        </div>
                        <div class="social-blog flex-three">
                            <span>Share:</span>
                            <ul class="social">
                                <li><a href="#"><i class="icon-icon"></i></a></li>
                                <li><a href="#"><i class="icon-icon-2"></i></a></li>
                                <li><a href="#"><i class="icon-instagram-1"></i></a></li>
                                <li><a href="#"><i class="icon-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>

                <div class="comment-single" style="margin-top:50px;">
                    <h3 class="title mb-32">({{ sprintf('%02d', $blog->approvedComments->count()) }}) Comment</h3>
                    <div class="row">
                        <div class="col-lg-12">
                            @forelse($blog->approvedComments as $comment)
                                <div class="comment-blog flex mb-40">
                                    <div class="avata" style="width:70px;height:70px;border-radius:50%;overflow:hidden;background:#f5f5f5;display:flex;align-items:center;justify-content:center;font-weight:700;color:#4DA528;font-size:24px;border:2px solid #e6f7e6;">
                                        {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                                    </div>
                                    <div class="content" style="padding-left:20px;flex:1;">
                                        <div class="flex-one">
                                            <div class="info">
                                                <h6 class="name">{{ $comment->author_name }}</h6>
                                                <p class="date" style="font-size:12px;color:#999;">{{ $comment->created_at->format('d F Y \a\t H:i') }}</p>
                                            </div>
                                        </div>
                                        <div class="des" style="margin-top:10px;line-height:1.6;color:#4F545A;">{{ $comment->content }}</div>
                                    </div>
                                </div>
                            @empty
                                <p style="color:#999;font-style:italic;">No comments yet. Be the first to share your thoughts!</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="form-comment" style="margin-top:40px;">
                    <h3 class="title mb-32">Write your comment</h3>

                    @if(session('comment_success'))
                        <div style="background:#e6f7e6;color:#4DA528;padding:15px 20px;border-radius:8px;margin-bottom:25px;font-weight:600;border:1px solid #c2ecc2;">
                            {{ session('comment_success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div style="background:#fde8e8;color:#e74c3c;padding:15px 20px;border-radius:8px;margin-bottom:25px;border:1px solid #fbc4c4;">
                            <ul style="margin:0;padding-left:15px;font-size:14px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('blog.comments.store', $blog) }}" method="POST" id="comment">
                        @csrf
                        <div class="group-gap" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
                            <div>
                                <input type="text" name="author_name" class="input-cmt" placeholder="Enter your name*" value="{{ old('author_name') }}" required style="width:100%;box-sizing:border-box;">
                            </div>
                            <div>
                                <input type="email" name="author_email" class="input-cmt" placeholder="Enter your email*" value="{{ old('author_email') }}" required style="width:100%;box-sizing:border-box;">
                            </div>
                        </div>
                        <div style="margin-bottom:20px;">
                            <textarea name="content" cols="30" class="input-cmt" rows="8" placeholder="Enter your message*" required style="width:100%;box-sizing:border-box;">{{ old('content') }}</textarea>
                        </div>
                        <button type="submit" style="background:#4DA528;color:#fff;padding:14px 35px;border:none;border-radius:8px;font-weight:600;font-size:16px;cursor:pointer;transition:all 0.3s;">Submit Comment</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="side-bar-right">
                    <div class="sidebar-widget">
                        <div class="profile-widget center">
                            @if($blog->author_avatar)
                                @if(str_starts_with($blog->author_avatar, 'blogs/'))
                                    <img src="{{ asset('storage/'.$blog->author_avatar) }}" alt="{{ $blog->author_name }}" class="avata">
                                @else
                                    <img src="{{ asset($blog->author_avatar) }}" alt="{{ $blog->author_name }}" class="avata">
                                @endif
                            @else
                                <img src="{{ asset('template/assets/images/avata/avt-blog.jpg') }}" alt="{{ $blog->author_name }}" class="avata">
                            @endif
                            <div class="name">{{ $blog->author_name ?? 'Admin' }}</div>
                            <span class="job">Blogger/Photographer</span>
                            <p class="des">The whimsically named Egg Canvas is the design director and photographer in New York.</p>
                            <ul class="social">
                                <li><a href="#"><i class="icon-icon-2"></i></a></li>
                                <li><a href="#"><i class="icon-x"></i></a></li>
                                <li><a href="#"><i class="icon-icon_03"></i></a></li>
                                <li><a href="#"><i class="icon-2"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h4 class="block-heading">search here</h4>
                        <form action="{{ route('blog.index') }}" id="search-bar-widget">
                            <input type="text" placeholder="Search here...">
                            <button type="submit"><i class="icon-search-2"></i></button>
                        </form>
                    </div>

                    <div class="sidebar-widget">
                        <h4 class="block-heading">Recent News</h4>
                        <div class="recent-post-list">
                            @php
                                $recentBlogs = \App\Models\Blog::where('is_active', true)->where('id', '!=', $blog->id)->latest()->take(3)->get();
                            @endphp
                            @foreach($recentBlogs as $recent)
                                <div class="list-recent flex-three">
                                    <a href="{{ route('blog.show', $recent->slug) }}" class="recent-image" style="display:block;width:80px;min-width:80px;height:60px;overflow:hidden;border-radius:8px;">
                                        @if(str_starts_with($recent->image, 'blogs/'))
                                            <img src="{{ asset('storage/'.$recent->image) }}" alt="{{ $recent->title }}" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            <img src="{{ asset($recent->image) }}" alt="{{ $recent->title }}" style="width:100%;height:100%;object-fit:cover;">
                                        @endif
                                    </a>
                                    <div class="recent-info">
                                        <div class="date">
                                            <i class="icon-4"></i>
                                            <span>{{ $recent->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <h4 class="title">
                                            <a href="{{ route('blog.show', $recent->slug) }}">{{ Str::limit($recent->title, 50) }}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h4 class="block-heading">Categories</h4>
                        <ul class="category-blog">
                            @php
                                $blogCategories = \App\Models\Blog::where('is_active', true)->pluck('category')->unique();
                            @endphp
                            @foreach($blogCategories as $category)
                                <li>
                                    <a href="{{ route('blog.index') }}" class="flex-two">
                                        <span>{{ $category }}</span>
                                        <span>{{ \App\Models\Blog::where('category', $category)->count() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-widget">
                        <h4 class="block-heading">Tags</h4>
                        <ul class="tag">
                            <li><a href="#">Tour</a></li>
                            <li><a href="#">Traveling</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">Yogyakarta</a></li>
                            <li><a href="#">Nature</a></li>
                            <li><a href="#">Culture</a></li>
                            <li><a href="#" class="active">Borobudur</a></li>
                            <li><a href="#">Prambanan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb--93">
    <div class="tf-container">
        <div class="callt-to-action flex-two z-index3 relative">
            <div class="callt-to-action-content flex-three">
                <div class="image">
                    <img src="{{ asset('template/assets/images/page/ready.png') }}" alt="Image">
                </div>
                <div class="content">
                    <h2 class="title-call">Ready to adventure and enjoy natural</h2>
                    <p class="des">Book your next tour with Yogyakarta Driver Tour</p>
                </div>
            </div>
            <img src="{{ asset('template/assets/images/page/vector4.png') }}" alt="" class="shape-ab">
            <div class="callt-to-action-button">
                <a href="{{ route('tours.packages') }}" class="get-call">Let's get started</a>
            </div>
        </div>
    </div>
</section>
@endsection
