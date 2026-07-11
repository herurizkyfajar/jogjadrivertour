@extends('layouts.app')

@section('title', 'Tour Package - Yogyakarta Driver Tour')

@section('content')
<section class="breadcumb-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12 center z-index1">
                <h1 class="title">Tour Package</h1>
                <ul class="breadcumb-list flex-five">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>Tour Package</span></li>
                </ul>
                <img class="bcrumb-ab" src="{{ asset('template/assets/images/page/mask-bcrumb.png') }}" alt="">
            </div>
        </div>
    </div>
</section>

<div class="mt--82 z-index3 relative">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="search-form-widget-slider relative">
                    <form action="{{ route('tours.packages') }}" method="GET" id="search-form-slider">
                        <div class="flex wd-search">
                            <div class="form-group flex">
                                <i class="icon-18"></i>
                                <div class="search-bar-group">
                                    <label>Destination</label>
                                    <select name="city">
                                        <option value="">All Destinations</option>
                                        @foreach($destinations as $destination)
                                            <option value="{{ $destination->city }}" {{ request('city') == $destination->city ? 'selected' : '' }}>{{ $destination->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group flex">
                                <i class="icon-hiking-1-1"></i>
                                <div class="search-bar-group">
                                    <label>Type</label>
                                    <select name="category">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group flex">
                                <i class="icon-time-left"></i>
                                <div class="search-bar-group">
                                    <label>Duration</label>
                                    <select name="duration">
                                        <option value="">Any Duration</option>
                                        <option value="1" {{ request('duration') == '1' ? 'selected' : '' }}>1 Day</option>
                                        <option value="2" {{ request('duration') == '2' ? 'selected' : '' }}>2 Days</option>
                                        <option value="3" {{ request('duration') == '3' ? 'selected' : '' }}>3+ Days</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group flex">
                                <i class="icon-user"></i>
                                <div class="search-bar-group">
                                    <label>Guests</label>
                                    <input type="text" value="{{ request('guests', '0') }}" name="guests">
                                </div>
                            </div>
                            <div class="form-group flex-two">
                                <div class="icon-icon-filter">
                                    <i class="icon-14"></i>
                                </div>
                                <button type="submit" class="btn-search"><i class="icon-Vector5"></i>Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="archieve-tour">
    <div class="tf-container">
        <form action="/" class="tf-my-listing1 mb-37">
            <div class="row align-center">
                <div class="col-md-8">
                    <p class="showing">Showing <span class="text-main">{{ $tours->count() }}</span> of {{ $tours->total() }} Results</p>
                    <div class="flex-three filter-tour-package">
                        <select name="filter" class="nice-select">
                            <option value="">All Filter</option>
                        </select>
                        <select name="dates" class="nice-select">
                            <option value="">Dates</option>
                        </select>
                        <select name="type" class="nice-select">
                            <option value="">Type</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('type') == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                        <select name="price" class="nice-select">
                            <option value="">Price</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 flex-six">
                    <div class="listing-all-wrap">
                        <div class="group-select-recently">
                            <select name="sort">
                                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                                <option value="new" {{ request('sort') == 'new' ? 'selected' : '' }}>New</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            @forelse($tours as $tour)
                <div class="col-sm-6 col-xl-3 mb-32">
                    <div class="tour-listing box-sd">
                            <a href="{{ route('tours.show', $tour->slug) }}" class="tour-listing-image">
                            <div class="badge-top flex-two">
                                <span class="feature">Featured</span>
                                <div class="badge-media flex-five">
                                    <span class="media"><i class="icon-Group-1000002909"></i>{{ $tour->duration_days }}</span>
                                    <span class="media"><i class="icon-Group-1000002910"></i>{{ $tour->max_participants }}</span>
                                </div>
                            </div>
                            @if(str_starts_with($tour->image, 'tours/'))
                                <img src="{{ asset('storage/'.$tour->image) }}" alt="{{ $tour->name }}">
                            @else
                                <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}">
                            @endif
                        </a>
                        <div class="tour-listing-content">
                            <span class="map"><i class="icon-Vector4"></i>{{ $tour->location }}</span>
                            @if($tour->asal_negara)
                                <span class="map" style="margin-top:4px;"><i class="icon-Group-9"></i>{{ $tour->asal_negara }}</span>
                            @endif
                            <h3 class="title-tour-list">
                                <a href="{{ route('tours.show', $tour->slug) }}">{{ $tour->name }}</a>
                            </h3>
                            <div class="review">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="icon-Star"></i>
                                @endfor
                                <span>({{ $tour->review_count }} Reviews)</span>
                            </div>
                            <div class="icon-box flex-three">
                                <div class="icons flex-three">
                                    <i class="icon-time-left"></i>
                                    <span>{{ $tour->duration_days }} days</span>
                                </div>
                                <div class="icons flex-three">
                                    <i class="icon-user"></i>
                                    <span>{{ $tour->max_participants }} Person</span>
                                </div>
                            </div>
                            <div class="flex-two">
                                <div class="price-box flex-three">
                                    @if($tour->discount_price && $tour->discount_price < $tour->price)
                                        <p>From <span class="price-sale">Rp {{ number_format($tour->discount_price, 0, ',', '.') }}</span></p>
                                        <span class="price">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                                    @else
                                        <p>From <span class="price-sale">Rp {{ number_format($tour->price, 0, ',', '.') }}</span></p>
                                    @endif
                                </div>
                                <div class="icon-bookmark">
                                    <i class="icon-Vector-151"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No tours available.</p>
                </div>
            @endforelse
        </div>

        <div class="row">
            <div class="col-lg-12 center mt-44">
                {{ $tours->links() }}
            </div>
        </div>
    </div>
</section>

@if($myTours->count() > 0)
<section class="archieve-tour" style="margin-top:60px;">
    <div class="tf-container">
        <div class="row mb-40">
            <div class="col-lg-12">
                <h2 class="title" style="font-size:28px;font-weight:700;">My Tours</h2>
                <p style="color:#666;">Riwayat perjalanan klien kami</p>
            </div>
        </div>
        <div class="row">
            @foreach($myTours as $myTour)
                <div class="col-sm-6 col-xl-3 mb-32">
                    <div class="tour-listing box-sd">
                        <div class="tour-listing-image">
                            @if(str_starts_with($myTour->image, 'my-tours/'))
                                <img src="{{ asset('storage/'.$myTour->image) }}" alt="{{ $myTour->client_name }}">
                            @else
                                <img src="{{ asset($myTour->image) }}" alt="{{ $myTour->client_name }}">
                            @endif
                        </div>
                        <div class="tour-listing-content">
                            <span class="map"><i class="icon-Group-9"></i>{{ $myTour->negara_asal }}</span>
                            <h3 class="title-tour-list">{{ $myTour->tour_name }}</h3>
                            <p style="margin:8px 0;color:#666;font-size:14px;">Client: <strong>{{ $myTour->client_name }}</strong></p>
                            @if($myTour->travel_date)
                                <p style="margin:4px 0;color:#999;font-size:13px;"><i class="icon-time-left"></i> {{ $myTour->travel_date->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
