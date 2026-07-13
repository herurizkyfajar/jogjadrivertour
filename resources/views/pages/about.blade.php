@extends('layouts.app')

@section('title', 'About Us - Private Car Rental & Tour Guide in Yogyakarta')

@section('content')
<section class="breadcumb-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12 center z-index1">
                <h1 class="title">About Us</h1>
                <ul class="breadcumb-list flex-five">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>About Us</span></li>
                </ul>
                <img class="bcrumb-ab" src="{{ asset('template/assets/images/page/mask-bcrumb.png') }}" alt="">
            </div>
        </div>
    </div>
</section>

<section class="about-us-h4">
    <div class="tf-container">
        <div class="row">
            <div class="col-md-6">
                <div class="image-about-h4-wrap relative">
                    <div class="image-about-item relative about-wrap-left">
                        <img src="{{ asset('template/assets/images/about-us/about-h41.jpg') }}" alt="image" loading="lazy">
                        <img src="{{ asset('template/assets/images/page/shape5.1.png') }}" alt="image" class="shape-about-h4" loading="lazy">
                        <span class="quote">25,000 + Customer Worldwide</span>
                    </div>
                    <div class="image-about-item relative about-wrap-right">
                        <img src="{{ asset('template/assets/images/about-us/about-h4.jpg') }}" alt="image" loading="lazy">
                        <img src="{{ asset('template/assets/images/page/shape5.1.png') }}" alt="image" class="shape-about-h4" loading="lazy">
                    </div>
                    <div class="box-year center">
                        <span class="number">25</span>
                        <p>year of <br> experience</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 inner-content-about">
                <div class="mb-30">
                    <span class="sub-title-heading text-main font-yes fs-28-46">About Us</span>
                    <h2 class="title-heading mb-18">Your trusted partner for <span class="text-gray font-yes">private car rental</span> & tour guide</h2>
                    <p class="des">Yogyakarta Driver Tour is your trusted partner for private car rental and professional tour guide services in Yogyakarta and its surroundings. We are committed to delivering safe, comfortable, and memorable travel experiences at competitive rates.</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="icon-box-style6">
                            <div class="icon relative">
                                <i class="icon-Group2"></i>
                            </div>
                            <div class="content">
                                <h6 class="title-icon"><a href="#">Trusted travel guide</a></h6>
                                <p class="des-icon">Experienced professional team ready to accompany your journey.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="icon-box-style6">
                            <div class="icon relative">
                                <i class="icon-Group2"></i>
                            </div>
                            <div class="content">
                                <h6 class="title-icon"><a href="#">Personalized Trips</a></h6>
                                <p class="des-icon">Customized tour packages tailored to your preferences.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-three btn-wrap-about">
                    <a href="{{ route('tours.index') }}" class="btn-main">
                        <p class="btn-main-text">More about us</p>
                        <p class="iconer"><i class="icon-arrow-right"></i></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pd-main" style="padding-top:60px;padding-bottom:60px;">
    <div class="tf-container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="sub-title-heading text-main font-yes fs-28-46">Part of</span>
                <h2 class="title-heading mb-18">Bandung Driver Tour</h2>
                <p class="des mb-20" style="font-size:15px;line-height:1.8;">Yogyakarta Driver Tour is proudly part of <strong>Bandung Driver Tour</strong>, a trusted private car rental and tour guide platform established in Bandung, West Java. With years of experience in the travel industry, Bandung Driver Tour has expanded its services to Yogyakarta through Yogyakarta Driver Tour, bringing the same commitment to quality, safety, and professional service. Together, we aim to provide seamless travel experiences across Indonesia — from the cultural richness of Yogyakarta to the scenic landscapes of Bandung.</p>
                <a href="https://bandungdrivertour.com" target="_blank" rel="noopener noreferrer" class="btn-main" style="display:inline-flex;align-items:center;gap:8px;">
                    <p class="btn-main-text">Visit Bandung Driver Tour</p>
                    <p class="iconer"><i class="icon-arrow-right"></i></p>
                </a>
            </div>
            <div class="col-md-4 text-center" style="padding:20px 0;">
                <a href="https://bandungdrivertour.com" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('template/assets/images/bandung-driver-tour.webp') }}" alt="Bandung Driver Tour" style="max-width:220px;width:100%;height:auto;">
                </a>
            </div>
        </div>
    </div>
</section>

<section class="widget-video-about">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="video-h4-widget relative overflow-hidden mb--14em">
                    <div class="video-wrap">
                        <a href="https://www.youtube.com/watch?v=n9LgeoJE4EI" class="video-box flex-five z-index3 relative widget-videos">
                            <i class="icon-Polygon-4"></i>
                        </a>
                    </div>
                    <p class="font-yes text-white center text-video z-index3 relative">Watch Video</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="top-this-week-about-us bg-1">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-30 center">
                    <span class="sub-title-heading text-main font-yes fs-28-46">Featured Tour</span>
                    <h2 class="title-heading">Our top this week</h2>
                </div>
            </div>
            <div class="col-lg-12 relative top-this-week-slide">
                <div class="swiper populer-activities overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach($featuredTours as $tour)
                            <div class="swiper-slide">
                                <div class="tour-listing box-sd">
                                    <a href="{{ route('tours.show', $tour->slug) }}" class="tour-listing-image">
                                        <div class="badge-top flex-two">
                                            <span class="feature">Featured</span>
                                            <div class="badge-media flex-five">
                                            <span class="media"><i class="icon-Group-1000002909"></i>{{ $tour->rating }}</span>
                                            <span class="media"><i class="icon-Group-1000002910"></i>{{ $tour->review_count }}</span>
                                            </div>
                                        </div>
                                        <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}" loading="lazy">
                                    </a>
                                    <div class="tour-listing-content">
                                        <span class="map"><i class="icon-Vector4"></i>Yogyakarta</span>
                                        <h3 class="title-tour-list"><a href="{{ route('tours.show', $tour->slug) }}">{{ $tour->name }}</a></h3>
                                        <div class="review">
                                            <i class="icon-Star"></i>
                                            <i class="icon-Star"></i>
                                            <i class="icon-Star"></i>
                                            <i class="icon-Star"></i>
                                            <i class="icon-Star"></i>
                                            <span>(1 Review)</span>
                                        </div>
                                        <div class="icon-box flex-three">
                                            <div class="icons flex-three">
                                                <i class="icon-time-left"></i>
                                                <span>{{ $tour->duration_info }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-two">
                                            <div class="price-box flex-three">
                                                <p>From <span class="price-sale">Rp {{ number_format($tour->price, 0, ',', '.') }}</span></p>
                                            </div>
                                            <div class="icon-bookmark">
                                                <i class="icon-Vector-151"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>

<section class="mt--82">
    <div class="tf-container">
        <div class="callt-to-action flex-two z-index3 relative">
            <div class="callt-to-action-content flex-three">
                <div class="image">
                    <img src="{{ asset('template/assets/images/page/ready.png') }}" alt="Image">
                </div>
                <div class="content">
                    <h2 class="title-call">Ready to explore Yogyakarta?</h2>
                    <p class="des">Book your private car rental and tour guide today</p>
                </div>
            </div>
            <img src="{{ asset('template/assets/images/page/vector4.png') }}" alt="" class="shape-ab">
            <div class="callt-to-action-button">
                <a href="{{ route('tours.packages') }}" class="get-call">Let's get started</a>
            </div>
        </div>
    </div>
</section>

<section class="widget-service-h5 relative pd-main">
    <div class="tf-container">
        <div class="row al-i-end mb-40">
            <div class="col-md-7">
                <div class="">
                    <span class="sub-title-heading text-main fs-28-46 font-yes">Explore the world</span>
                    <h2 class="title-heading">Great opportunity for <br><span class="text-gray font-yes">adventure</span> & travels</h2>
                </div>
            </div>
            <div class="col-md-5">
                <p>Pellentesque habitant morbi tristique senectus netus et malesuada fames ac turp egestas. Aliquam viverra arcu. Donec aliquet blandit enim feugiat mattis.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="tf-icon-box icon-box-style1 relative">
                    <div class="icon">
                        <i class="icon-adventures-1"></i>
                    </div>
                    <div class="content">
                        <h4 class="title-icon"><a href="#">Adventure Plan</a></h4>
                        <p class="des-icon">Pellentesque habitant morbi tristique senectus netus et malesuada fames ac</p>
                        <a href="#" class="icons-link">Booking Now <i class="icon-Path-77287-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="tf-icon-box icon-box-style1 relative">
                    <div class="icon">
                        <i class="icon-fire-2"></i>
                    </div>
                    <div class="content">
                        <h4 class="title-icon"><a href="#">Secure Camping</a></h4>
                        <p class="des-icon">Pellentesque habitant morbi tristique senectus netus et malesuada fames ac</p>
                        <a href="#" class="icons-link">Booking Now <i class="icon-Path-77287-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="tf-icon-box icon-box-style1 relative">
                    <div class="icon">
                        <i class="icon-cabin-1"></i>
                    </div>
                    <div class="content">
                        <h4 class="title-icon"><a href="#">Trailers & RV Sports</a></h4>
                        <p class="des-icon">Pellentesque habitant morbi tristique senectus netus et malesuada fames ac</p>
                        <a href="#" class="icons-link">Booking Now <i class="icon-Path-77287-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="tf-icon-box icon-box-style1 relative">
                    <div class="icon">
                        <i class="icon-cabin-1"></i>
                    </div>
                    <div class="content">
                        <h4 class="title-icon"><a href="#">Luxury cabin</a></h4>
                        <p class="des-icon">Pellentesque habitant morbi tristique senectus netus et malesuada fames ac</p>
                        <a href="#" class="icons-link">Booking Now <i class="icon-Path-77287-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
