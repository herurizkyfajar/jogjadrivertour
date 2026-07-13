@extends('layouts.app')

@section('title', 'Blog - Private Car Rental & Tour Guide in Yogyakarta')

@section('content')
<section class="breadcumb-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12 center z-index1">
                <h1 class="title">Blog Page</h1>
                <ul class="breadcumb-list flex-five">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>Blog Page</span></li>
                </ul>
                <img class="bcrumb-ab" src="{{ asset('template/assets/images/page/mask-bcrumb.png') }}" alt="" width="193" height="158">
            </div>
        </div>
    </div>
</section>

<section class="our-blog pd-main">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-8 col-12">
                @forelse($blogs as $blog)
                    <article class="side-blog mb-56px">
                        <div class="blog-image">
                            <div class="list-categories">
                                <a href="#" class="new">{{ $blog->created_at->format('d M') }}</a>
                            </div>
                            <a class="post-thumbnail" href="{{ route('blog.show', $blog->slug) }}" style="display:block;overflow:hidden;border-radius:12px;">
                                @if(str_starts_with($blog->image, 'blogs/'))
                                    <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}" loading="lazy" style="width:100%;height:auto;display:block;object-fit:cover;">
                                @else
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" loading="lazy" style="width:100%;height:auto;display:block;object-fit:cover;">
                                @endif
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="top-detail-info">
                                <ul class="flex-three">
                                    <li>
                                        <i class="icon-user"></i>
                                        <a href="#">{{ $blog->author_name ?? 'Admin' }}</a>
                                    </li>
                                    <li>
                                        <i class="icon-25"></i>
                                        <span class="date">Comments (03)</span>
                                    </li>
                                    <li>
                                        <i class="icon-24"></i>
                                        <span class="date">3 min Read</span>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="entry-title">
                                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                            </h3>
                            <p class="description">{{ Str::limit($blog->excerpt, 200) }}</p>
                            <div class="button-main">
                                <a href="{{ route('blog.show', $blog->slug) }}" class="button-link">Read More <i class="icon-Arrow-11"></i></a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-12 text-center">
                        <p>No blog posts available.</p>
                    </div>
                @endforelse

                <div class="row">
                    <div class="col-lg-12 center mt-44">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="side-bar-right">
                    <div class="sidebar-widget">
                        <div class="profile-widget center">
                            <img src="{{ asset('template/assets/images/avata/avt-blog.jpg') }}" alt="Author" class="avata" width="153" height="150">
                            <div class="name">Rosalina D. William</div>
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
                        <form action="/" id="search-bar-widget">
                            <input type="text" placeholder="Search here...">
                            <button type="button"><i class="icon-search-2"></i></button>
                        </form>
                    </div>

                    <div class="sidebar-widget">
                        <h4 class="block-heading">Recent News</h4>
                        <div class="recent-post-list">
                            @foreach($blogs->take(3) as $recent)
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
                                $blogCategories = $blogs->pluck('category')->unique();
                            @endphp
                            @foreach($blogCategories as $category)
                                <li>
                                    <a href="#" class="flex-two">
                                        <span>{{ $category }}</span>
                                        <span>{{ $blogs->where('category', $category)->count() }}</span>
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
@endsection
