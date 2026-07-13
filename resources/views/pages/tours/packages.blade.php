@extends('layouts.app')

@section('title', 'Tour Packages - Private Car Rental & Tour Guide in Yogyakarta')

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

<section class="archieve-tour">
    <div class="tf-container">
        <p class="mb-37" style="font-size:15px;color:#666;">Showing <span style="color:#4DA528;font-weight:600;">{{ $tours->count() }}</span> of {{ $tours->total() }} Results</p>

        <div class="row">
            @forelse($tours as $tour)
                <div class="col-sm-6 col-xl-3 mb-32">
                    <div class="tour-listing box-sd">
                        <a href="{{ route('tours.show', $tour->slug) }}" class="tour-listing-image">
                            <div class="badge-top flex-two">
                                <span class="feature">Featured</span>
                                <div class="badge-media flex-five">
                                    <span class="media"><i class="icon-time-left"></i>{{ $tour->duration_info }}</span>
                                </div>
                            </div>
                            @if(str_starts_with($tour->image, 'tours/'))
                                <img src="{{ asset('storage/'.$tour->image) }}" alt="{{ $tour->name }}">
                            @else
                                <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}">
                            @endif
                        </a>
                        <div class="tour-listing-content">
                            <span class="map"><i class="icon-Vector4"></i>{{ $tour->category }}</span>
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
                                    <span>{{ $tour->duration_info }}</span>
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

@endsection
