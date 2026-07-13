@extends('layouts.app')

@section('title', 'Yogyakarta Driver Tour - Private Car Rental & Tour Guide in Yogyakarta')

@section('content')
<!-- Widget Slider -->
<section class="slider relative">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="slider-home1 relative overflow-hidden swiper-slide">
                <div class="silider-image">
                    <img src="{{ asset('template/assets/images/slide/slide1.webp') }}" alt="Borobudur Sunrise" class="image-slide">
                    <img src="{{ asset('template/assets/images/slide/mask-slide.png') }}" alt="" class="mask-slide">
                    <img src="{{ asset('template/assets/images/slide/mask-fly.png') }}" alt="" class="mask-flane">
                    <div class="booking-title tf-anime-rorate">
                        <p class="booking">Booking</p>
                        <span></span>
                    </div>
                </div>
                <div class="slider-content">
                    <div class="tf-container">
                        <div class="row">
                            <div class="col-lg-8">
                                <span class="sub-title text-main font-yes fs-28-46 fadeInDown wow">Yogyakarta Heritage</span>
                                <h1 class="title-slide text-white mb-32 fadeInDown wow">Borobudur<br>
                                    <span class="animationtext clip text-main">
                                        <span class="cd-words-wrapper">
                                            <span class="item-text is-visible">Sunrise Temple</span>
                                            <span class="item-text is-hidden">Sunrise Temple</span>
                                        </span>
                                    </span>
                                </h1>
                                <p class="des text-white mb-45 fadeInDown wow">Witness the magical sunrise at Borobudur Temple, a breathtaking UNESCO World Heritage site with stunning views of Mount Merapi in the distance.</p>
                                <div class="btn-group">
                                    <a href="{{ route('tours.index') }}" class="btn-main fadeInDown wow">
                                        <p class="btn-main-text">Book Now</p>
                                        <p class="iconer"><i class="icon-arrow-right"></i></p>
                                    </a>
                                    <a href="{{ route('about') }}" class="btn-w-wa fadeInDown wow">Learn more <i class="icon-Group-13"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-home1 relative overflow-hidden swiper-slide">
                <div class="silider-image">
                    <img src="{{ asset('template/assets/images/slide/slide2.webp') }}" alt="Lava Tour Merapi" class="image-slide">
                    <img src="{{ asset('template/assets/images/slide/mask-slide.png') }}" alt="" class="mask-slide">
                    <img src="{{ asset('template/assets/images/slide/mask-fly.png') }}" alt="" class="mask-flane">
                    <div class="booking-title tf-anime-rorate">
                        <p class="booking">Booking</p>
                        <span></span>
                    </div>
                </div>
                <div class="slider-content">
                    <div class="tf-container">
                        <div class="row">
                            <div class="col-lg-8">
                                <span class="sub-title text-main font-yes fs-28-46 fadeInDown wow">Adventure Awaits</span>
                                <h1 class="title-slide text-white mb-32 fadeInDown wow">Lava Tour<br>
                                    <span class="animationtext clip text-main">
                                        <span class="cd-words-wrapper">
                                            <span class="item-text is-visible">Merapi Jeep</span>
                                            <span class="item-text is-hidden">Merapi Jeep</span>
                                        </span>
                                    </span>
                                </h1>
                                <p class="des text-white mb-45 fadeInDown wow">Explore the slopes of Mount Merapi with an exciting jeep adventure! See the aftermath of eruptions and the spectacular volcanic landscape.</p>
                                <div class="btn-group">
                                    <a href="{{ route('tours.packages') }}" class="btn-main fadeInDown wow">
                                        <p class="btn-main-text">Explore tours</p>
                                        <p class="iconer"><i class="icon-arrow-right"></i></p>
                                    </a>
                                    <a href="{{ route('destinations.index') }}" class="btn-w-wa fadeInDown wow">Destinations <i class="icon-Group-13"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-home1 relative overflow-hidden swiper-slide">
                <div class="silider-image">
                    <img src="{{ asset('template/assets/images/slide/slide3.webp') }}" alt="Taman Sari Water Castle" class="image-slide">
                    <img src="{{ asset('template/assets/images/slide/mask-slide.png') }}" alt="" class="mask-slide">
                    <img src="{{ asset('template/assets/images/slide/mask-fly.png') }}" alt="" class="mask-flane">
                    <div class="booking-title tf-anime-rorate">
                        <p class="booking">Booking</p>
                        <span></span>
                    </div>
                </div>
                <div class="slider-content">
                    <div class="tf-container">
                        <div class="row">
                            <div class="col-lg-8">
                                <span class="sub-title text-main font-yes fs-28-46 fadeInDown wow">Royal Heritage</span>
                                <h1 class="title-slide text-white mb-32 fadeInDown wow">Taman Sari<br>
                                    <span class="animationtext clip text-main">
                                        <span class="cd-words-wrapper">
                                            <span class="item-text is-visible">Water Castle</span>
                                            <span class="item-text is-hidden">Water Castle</span>
                                        </span>
                                    </span>
                                </h1>
                                <p class="des text-white mb-45 fadeInDown wow">Visit Taman Sari, the former royal garden of the Yogyakarta Sultanate featuring unique architecture and fascinating history.</p>
                                <div class="btn-group">
                                    <a href="{{ route('tours.index') }}" class="btn-main fadeInDown wow">
                                        <p class="btn-main-text">View deals</p>
                                        <p class="iconer"><i class="icon-arrow-right"></i></p>
                                    </a>
                                    <a href="{{ route('contact') }}" class="btn-w-wa fadeInDown wow">Contact us <i class="icon-Group-13"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-nex-prev">
            <div class="swiper-button-next next-home1"></div>
            <div class="swiper-button-prev prev-home1"></div>
        </div>
    </div>
</section>

<!-- Widget Select Form -->
<div class="mt--82 z-index4 relative fadeInUp wow">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="search-form-widget-slider relative" style="padding: 30px 40px; background: #fff; border-radius: 16px; box-shadow: 0 15px 45px rgba(0,0,0,0.08); border: 1px solid #f1f1f1;">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3 mb-md-0" style="border-right: 1px solid #eee;">
                            <div style="padding: 10px 0;">
                                <i class="icon-map-1" style="font-size: 32px; color: #4DA528; display: block; margin-bottom: 10px;"></i>
                                <span style="font-size: 36px; font-weight: 800; color: #081E2A; display: block; line-height: 1.2;">{{ App\Models\Destination::count() }}+</span>
                                 <span style="font-size: 13px; font-weight: 700; color: #8A8AA0; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-top: 6px;">Destinations</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0" style="border-right: 1px solid #eee;">
                            <div style="padding: 10px 0;">
                                <i class="icon-uniE914" style="font-size: 32px; color: #4DA528; display: block; margin-bottom: 10px;"></i>
                                <span style="font-size: 36px; font-weight: 800; color: #081E2A; display: block; line-height: 1.2;">15+</span>
                                 <span style="font-size: 13px; font-weight: 700; color: #8A8AA0; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-top: 6px;">Visitor Nationalities</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="padding: 10px 0;">
                                <i class="icon-user" style="font-size: 32px; color: #4DA528; display: block; margin-bottom: 10px;"></i>
                                <span style="font-size: 36px; font-weight: 800; color: #081E2A; display: block; line-height: 1.2;">12,500+</span>
                                 <span style="font-size: 13px; font-weight: 700; color: #8A8AA0; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-top: 6px;">Website Visitors</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Widget Aboutus -->
<section class="about-us pb-150" style="padding-top: 100px;">
    <div class="tf-container">

        <div class="row pt-60">
            <div class="col-lg-6">
                <div class="travel-video relative" style="overflow:visible;">
                    <img src="{{ asset('template/assets/images/destination/1.jpg') }}" 
                         alt="Borobudur Temple" 
                         class="image-video" 
                         loading="lazy"
                         style="width:100%;height:420px;object-fit:cover;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                    <div class="video-wrap">
                        <a href="https://www.youtube.com/watch?v=bka65YgaD0A" class="widget-icon-video widget-videos flex-five z-index3">
                            <i class="icon-Polygon-4"></i>
                        </a>
                    </div>
                    <img src="{{ asset('template/assets/images/destination/2.jpg') }}" 
                         alt="Prambanan Temple"
                         class="mask-video tf-anime-rorate" 
                         loading="lazy"
                         style="width:180px;height:240px;object-fit:cover;border-radius:12px;border:6px solid #fff;box-shadow:0 10px 25px rgba(0,0,0,0.15);position:absolute;bottom:-40px;right:-20px;">
                    <img src="{{ asset('template/assets/images/page/enjoy.png') }}" alt="Image" class="mask-enjoy">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="inner-content-about">
                    <span class="sub-title-heading text-main mb-15 fadeInUp wow">About Yogyakarta Driver Tour</span>
                    <h2 class="title-heading mb-18 fadeInUp wow">Your trusted partner for <span class="text-gray font-yes">private car rental</span> & tour guide</h2>
                     <p class="des-heading fadeInUp wow">Yogyakarta Driver Tour is your trusted partner for private car rental and professional tour guide services in Yogyakarta and its surroundings. We deliver safe, comfortable, and memorable travel experiences at competitive prices.</p>
                    <div class="row mt-27 fadeInUp wow">
                        <div class="col-sm-6">
                            <div class="icon-box-style3">
                                <div class="icon flex-three">
                                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_40_471)">
                                            <path d="M37.5511 9.06618C37.5511 5.77106 34.8703 3.09027 31.5752 3.09027C28.2801 3.09027 25.5993 5.77106 25.5993 9.06618C25.5993 12.3613 28.2801 15.0421 31.5752 15.0421C34.8703 15.0421 37.5511 12.3613 37.5511 9.06618ZM31.5752 12.0541C29.9277 12.0541 28.5873 10.7137 28.5873 9.06618C28.5873 7.41862 29.9277 6.07823 31.5752 6.07823C33.2228 6.07823 34.5632 7.41862 34.5632 9.06618C34.5632 10.7137 33.2228 12.0541 31.5752 12.0541Z" fill="currentColor"/>
                                            <path d="M50.2947 10.8487C49.0667 8.96556 46.5591 8.33461 44.586 9.41226L34.279 15.0416C33.3084 15.0416 16.1894 15.0416 15.1914 15.0416V1.49617C15.1914 0.671101 14.5225 0.00219727 13.6974 0.00219727H1.49398C0.668903 0.00219727 0 0.671101 0 1.49617V10.5596C0 11.3847 0.668903 12.0536 1.49398 12.0536H12.2033V49.5026C12.2033 50.3277 12.8722 50.9966 13.6973 50.9966C14.5224 50.9966 15.1913 50.3277 15.1913 49.5026V24.0054H24.1551V46.5147C24.1551 50.399 28.7646 52.4156 31.625 49.8526C34.4825 52.4131 39.0949 50.4048 39.0949 46.5147V23.3212L49.0299 16.8488C51.038 15.5407 51.6042 12.8565 50.2947 10.8487ZM2.98795 9.06556V2.99005H12.2033V9.06556H2.98795ZM34.613 48.0086C33.7892 48.0086 33.119 47.3384 33.119 46.5146C33.119 45.3559 33.119 38.5353 33.119 37.4511C33.119 36.626 32.4501 35.9571 31.625 35.9571C30.7999 35.9571 30.131 36.626 30.131 37.4511V46.5146C30.131 47.3384 29.4608 48.0086 28.637 48.0086C27.8133 48.0086 27.1431 47.3384 27.1431 46.5146V32.9692H36.1069V46.5146C36.1069 47.3384 35.4367 48.0086 34.613 48.0086ZM47.399 14.3452L36.7854 21.2596C36.3622 21.5354 36.1069 22.0063 36.1069 22.5114V29.9812H27.1431V22.5114C27.1431 21.6863 26.4742 21.0174 25.6491 21.0174H15.1913V18.0294C35.5362 17.9654 34.7563 18.1854 35.3764 17.8467L46.0182 12.0346C46.6312 11.6997 47.4104 11.8957 47.7919 12.4809C48.1988 13.1046 48.0231 13.9387 47.399 14.3452Z" fill="currentColor"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_40_471">
                                                <rect width="51" height="51" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <h6 class="title mb-10"><a href="#">Trusted travel guide</a></h6>
                                 <p class="des">A professional team ready to assist you throughout your journey</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="icon-box-style3">
                                <div class="icon flex-three">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_40_476" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="40" height="40">
                                            <path d="M0 0H40V40H0V0Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask0_40_476)">
                                            <path d="M20 23.125V38.8281H38.8281V12.2656H34.1406" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.85938 12.2656H1.17188V38.8281H20V23.2031" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M20 1.17188C14.6974 1.17188 11.3111 6.82758 13.8151 11.5017L20 23.0469L26.1849 11.5017C28.6889 6.82758 25.3027 1.17188 20 1.17188Z" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                    </svg>
                                </div>
                                <h6 class="title mb-10"><a href="#">Personalized Trips</a></h6>
                                 <p class="des">Tour packages tailored to your personal preferences</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-three btn-wrap-about mb-30 fadeInUp wow">
                        <a href="{{ route('about') }}" class="btn-main">
                            <p class="btn-main-text">More about us</p>
                            <p class="iconer"><i class="icon-arrow-right"></i></p>
                        </a>
                    </div>
                    <div class="map-check flex-three fadeInUp wow">
                        <div class="icon">
                            <svg width="33" height="30" viewBox="0 0 33 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_321_31)">
                                    <path d="M24.3102 0.240601C26.0182 0.240601 27.5818 0.938222 28.7124 2.04479C29.819 3.17542 30.5166 4.73906 30.5166 6.44703C30.5166 7.45738 30.2761 8.39556 29.8671 9.23751C29.0733 10.8252 25.0078 13.6157 24.3102 16.6467C23.1555 13.7119 19.5471 10.8252 18.7533 9.23751C18.3203 8.39556 18.0797 7.45738 18.0797 6.44703C18.0797 3.00703 20.8702 0.240601 24.3102 0.240601Z" fill="currentColor"/>
                                    <path d="M24.3102 3.29565C26.0181 3.29565 27.3893 4.6909 27.3893 6.37481C27.3893 8.08278 26.0181 9.45397 24.3102 9.45397C22.6022 9.45397 21.231 8.08278 21.231 6.37481C21.231 4.6909 22.6022 3.29565 24.3102 3.29565Z" fill="#FEFEFE"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_321_31">
                                        <rect width="33" height="30" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <span class="text-main">Checkout Beautiful Places Around the World.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Widget Featured Destinations -->
<section class="tour-package pd-main">
    <div class="tf-container w-1456">
        <div class="row">
            <div class="col-lg-12">
                <div class="center m0-auto w-text-heading">
                    <span class="sub-title-heading text-main mb-15 wow fadeInUp animated">Explore the world</span>
                    <h2 class="title-heading mb-40 wow fadeInUp animated">Amazing Featured <span class="text-gray font-yes">Destination</span> the world</h2>
                </div>
                <div class="tab-tour-list">
                    <ul class="nav justify-content-center tab-list mb-37" id="myTab" role="tablist">
                        @foreach($cities as $index => $city)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}" id="{{ Str::slug($city) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ Str::slug($city) }}-tab-pane" type="button" role="tab">
                                    {{ $city }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($cities as $index => $city)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="{{ Str::slug($city) }}-tab-pane" role="tabpanel">
                                <div class="row">
                                    @php
                                        $cityDestinations = $featuredDestinationsAll->where('city', $city)->take(4);
                                    @endphp
                                    @forelse($cityDestinations as $dest)
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="tour-listing wow fadeInUp animated" data-wow-delay="0.{{ $loop->index + 1 }}s">
                                                <a href="{{ route('destinations.show', $dest->slug) }}" class="tour-listing-image">
                                                    <div class="badge-top flex-two">
                                                        <span class="feature">Featured</span>
                                                    </div>
                                                    @if(str_starts_with($dest->image, 'destinations/'))
                                                        <img src="{{ asset('storage/'.$dest->image) }}" alt="{{ $dest->name }}">
                                                    @else
                                                        <img src="{{ asset($dest->image) }}" alt="{{ $dest->name }}">
                                                    @endif
                                                </a>
                                                <div class="tour-listing-content">
                                                    <span class="map"><i class="icon-Vector4"></i>{{ $dest->location }}</span>
                                                    <h3 class="title-tour-list">
                                                        <a href="{{ route('destinations.show', $dest->slug) }}">{{ $dest->name }}</a>
                                                    </h3>
                                                    <div class="review">
                                                        @for($i = 0; $i < 5; $i++)
                                                            <i class="icon-Star"></i>
                                                        @endfor
                                                        <span>({{ number_format($dest->rating * 20) }}%)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center">
                                            <p>No destinations available in this city.</p>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="row wow fadeInUp">
                                    <div class="col-lg-12 center mt-44">
                                        <a href="{{ route('destinations.index') }}" class="btn-main">
                                            <p class="btn-main-text">View All Destination</p>
                                            <p class="iconer"><i class="icon-13"></i></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Widget Rent Car -->
<section class="relative tf-widget-activities pd-main overflow-hidden">
    <img src="{{ asset('template/assets/images/page/mask-activiti.png') }}" alt="image" class="mask-top" loading="lazy">
    <img src="{{ asset('template/assets/images/page/mask-print-2.png') }}" alt="image" class="mask-bottom" loading="lazy">
    <div class="tf-container">
        <div class="row z-index3 relative">
            <div class="col-lg-12">
                <div class="center m0-auto w-text-heading" style="margin-bottom:40px;">
                    <span class="sub-title-heading text-main mb-15 wow fadeInUp animated">Comfortable Travel</span>
                    <h2 class="title-heading mb-0 wow fadeInUp animated">Choose Your Perfect <span class="text-gray font-yes">Ride</span> For The Trip</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <ul class="nav nav-tabs-activities justify-content-center" id="fleetTab" role="tablist">
                    @php
                        $fleet = App\Models\Car::where('is_active', true)->orderBy('sort_order')->get();
                    @endphp
                    @foreach($fleet as $index => $car)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $index === 0 ? 'active' : '' }}" id="fleet-{{ Str::slug($car->name) }}-tab" data-bs-toggle="tab" data-bs-target="#fleet-{{ Str::slug($car->name) }}-pane" type="button" role="tab">
                                <span class="icon flex-five">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" fill="currentColor"/>
                                    </svg>
                                </span>
                                <span>{{ $car->name }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content mt-44" id="fleetTabContent">
                    @foreach($fleet as $index => $car)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="fleet-{{ Str::slug($car->name) }}-pane" role="tabpanel">
                            <div class="tabs-activities-content flex">
                                <div class="activities-image" style="border-radius:16px;overflow:hidden;background:#f5f5f5;display:flex;align-items:center;justify-content:center;">
                                    <img src="{{ $car->image_url }}" alt="{{ $car->name }}" loading="lazy" style="width:100%;height:100%;object-fit:contain;">
                                </div>
                                <div class="activities-content relative">
                                    <div class="flex-three mb-20" style="gap:12px;align-items:center;">
                                        <span class="sub-title text-white">Comfortable Travel</span>
                                        <span style="background:rgba(255,255,255,0.2);color:#fff;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:700;letter-spacing:0.5px;">
                                            @if($car->type === 'Premium Car')
                                                &#9733; {{ $car->type }}
                                            @else
                                                {{ $car->type }}
                                            @endif
                                        </span>
                                    </div>
                                    <h3 class="title-activitis text-white mb-40">{{ $car->name }}</h3>
                                    <div class="flex-three mb-20" style="flex-wrap:wrap;gap:20px;">
                                        <div class="flex-three text-white icon-list-wrap">
                                            <div class="icon">
                                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                            </div>
                                            <span class="icon-lists">{{ $car->passengers }} Passengers</span>
                                        </div>
                                        <div class="flex-three text-white icon-list-wrap">
                                            <div class="icon">
                                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a4 4 0 0 0-8 0v2"/></svg>
                                            </div>
                                            <span class="icon-lists">{{ $car->luggage }} Luggage</span>
                                        </div>
                                    </div>
                                    @if($car->description)
                                        <p class="text-white mb-20" style="font-size:15px;line-height:1.8;">{{ $car->description }}</p>
                                    @endif
                                    <div class="flex-three mb-30" style="gap:8px;align-items:center;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="color:#fff;"><path d="M20 6L9 17l-5-5"/></svg>
                                        <span class="text-white" style="font-size:14px;font-weight:600;">Include Driver</span>
                                    </div>
                                    <div class="flex-three btn-wrap-activitis">
                                        <a href="{{ route('contact') }}" class="icon-activitis flex-five">
                                            <i class="icon-Vector-21"></i>
                                        </a>
                                        <a href="{{ route('contact') }}" class="text-white get-start">Book Your Trip Now</a>
                                    </div>
                                    <img src="{{ asset('template/assets/images/page/mask-tap.png') }}" alt="image" class="mask-tab">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Widget Banner Contact -->
<section class="widget-banner-contact relative" style="overflow:hidden;">
    <div class="tf-container">
        <div class="row z-index3 relative">
            <div class="col-lg-7 content-banner-contact">
                <div class="mb-32">
                    <span class="sub-title-heading text-main mb-15 font-yes fs-28-46 wow fadeInUp animated">Explore Yogyakarta</span>
                    <h2 class="title-heading text-white wow fadeInUp animated">Your trusted partner for private car rental and tour guide in Yogyakarta — discover ancient temples, volcanic landscapes, and rich Javanese culture</h2>
                </div>
                <div class="flex-three">
                    <div class="video-wrap wow fadeInUp animated">
                        <a href="https://www.youtube.com/watch?v=bka65YgaD0A" class="widget-icon-video flex-five widget-videos">
                            <i class="icon-Polygon-4"></i>
                        </a>
                    </div>
                    <address class="wow fadeInUp animated">
                        Contact us at <a href="mailto:info@jogadrivertour.com">info@jogadrivertour.com</a><br>
                    </address>
                </div>
                <img src="{{ asset('template/assets/images/page/vector2.png') }}" alt="image" class="mask-icon-banner" loading="lazy">
            </div>
            <div class="col-lg-5" style="margin:-60px -30px -60px 0;padding:0;">
                <div class="image-banner-contact" style="height:100%;">
                    <img src="{{ asset('template/assets/images/destination/1.jpg') }}" alt="Yogyakarta" loading="lazy" style="object-fit:cover;width:100%;height:100%;border-radius:0;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Widget Blog -->
<section class="pd-main">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center m0-auto w-text-heading">
                    <span class="sub-title-heading text-main mb-15 wow fadeInUp animated">Explore the world</span>
                    <h2 class="title-heading mb-40 wow fadeInUp animated">Latest news & articles <span class="text-gray font-yes">from</span> the blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($latestBlogs as $blog)
                <div class="col-md-4 wow fadeInUp animated" data-wow-delay="0.{{ $loop->index + 1 }}s">
                    <div class="tf-widget-blog blog-style">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-image">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
                            <div class="category-blog">
                                <i class="icon-Group-8"></i>
                                <span>{{ $blog->category }}</span>
                            </div>
                        </a>
                        <div class="blog-content">
                            <ul class="meta-list flex-three">
                                <li>
                                    <i class="icon-4"></i>
                                    <a href="{{ route('blog.show', $blog->slug) }}"><span>{{ $blog->created_at->format('d M Y') }}</span></a>
                                </li>
                                <li>
                                    <i class="icon-7"></i>
                                    <a href="{{ route('blog.show', $blog->slug) }}"><span>Comments (03)</span></a>
                                </li>
                            </ul>
                            <h3 class="entry-title"><a href="{{ route('blog.show', $blog->slug) }}">{{ Str::limit($blog->title, 50) }}</a></h3>
                            <p class="des">{{ Str::limit($blog->excerpt, 80) }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn-read-more">Read More <i class="icon-Vector-4"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No blog posts available.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="mb--93">
    <div class="tf-container">
        <div class="callt-to-action flex-two">
            <div class="callt-to-action-content flex-three">
                <div class="image">
                    <img src="{{ asset('template/assets/images/page/ready.png') }}" alt="Image">
                </div>
                <div class="content">
                    <h2 class="title-call">Ready to explore Yogyakarta?</h2>
                     <p class="des">Yogyakarta Driver Tour is ready to make your Yogyakarta adventure unforgettable</p>
                </div>
            </div>
            <img src="{{ asset('template/assets/images/page/vector4.png') }}" alt="" class="shape-ab">
            <div class="callt-to-action-button">
                <a href="{{ route('contact') }}" class="get-call">Book Your Trip Now</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .slider-home1,
    .slider .swiper-slide {
        height: 800px !important;
    }
    .slider-home1 .silider-image .image-slide {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .btn-nex-prev {
        z-index: 10;
    }
    .title-slide .animationtext {
        display: inline-block;
        white-space: nowrap;
        height: auto;
        overflow: visible;
    }
    .title-slide .animationtext .cd-words-wrapper .item-text {
        white-space: nowrap;
    }
    .widget-testimonial .testimonial-image {
        height: 80px !important;
        overflow: visible !important;
    }
    .widget-testimonial .testimonial-image .swiper-wrapper {
        height: 80px !important;
    }
    .widget-testimonial .testimonial-image .swiper-slide {
        width: 65px !important;
        height: 65px !important;
        min-width: 65px !important;
        flex: 0 0 65px !important;
        border-radius: 100%;
        border: 3px solid #FFFFFF;
        box-shadow: 0px 10px 15px 0px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .widget-testimonial .testimonial-image .swiper-slide-thumb-active {
        border: 3px solid #4DA528 !important;
    }
    .widget-testimonial .testimonial-image .avata {
        width: 100% !important;
        height: 100% !important;
    }
    .widget-testimonial .testimonial-image .avata img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
        border-radius: 100%;
    }
    .tour-package .tab-content .row { display: flex; flex-wrap: wrap; }
    .tour-package .tab-content .col-sm-6.col-lg-3 { display: flex; flex: 0 0 25%; max-width: 25%; }
    .tour-package .tab-content .tour-listing { display: flex; flex-direction: column; width: 100%; }
    .tour-package .tab-content .tour-listing-image { height: 220px; overflow: hidden; }
    .tour-package .tab-content .tour-listing-image img { width: 100%; height: 100%; object-fit: cover; }
    .tour-package .tab-content .tour-listing-content { flex: 1; display: flex; flex-direction: column; padding: 12px 15px; }
    .tour-package .tab-content .tour-listing-content .map { font-size: 12px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .tour-package .tab-content .tour-listing-content .title-tour-list { font-size: 15px; line-height: 1.3; margin: 6px 0; }
    .tour-package .tab-content .tour-listing-content .review { font-size: 12px; margin-top: auto; }
    .tour-package .tab-content .tour-listing-content .review i { font-size: 12px; }

    /* Fleet Section Overrides */
    .tf-widget-activities .tabs-activities-content {
        padding: 0;
        margin: 0;
        display: flex;
        border-radius: 16px;
        overflow: hidden;
    }
    .tf-widget-activities .tabs-activities-content .activities-image {
        flex: 0 0 45%;
        max-width: 45%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5f5f5;
        border-radius: 16px 0 0 16px;
        overflow: hidden;
    }
    .tf-widget-activities .tabs-activities-content .activities-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        margin-left: 0;
        border-radius: 0;
    }
    .tf-widget-activities .tabs-activities-content .activities-content {
        flex: 1;
        padding: 40px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .tf-widget-activities .tabs-activities-content .activities-content .title-activitis {
        font-size: 28px;
        font-weight: 800;
    }

    @media (max-width: 991px) {
        .tf-widget-activities .tabs-activities-content {
            flex-direction: column;
        }
        .tf-widget-activities .tabs-activities-content .activities-image {
            flex: none;
            max-width: 100%;
            height: 250px;
            border-radius: 16px 16px 0 0;
        }
        .tf-widget-activities .tabs-activities-content .activities-content {
            padding: 30px;
        }
    }
    @media (max-width: 575px) {
        .tf-widget-activities .tabs-activities-content .activities-image {
            height: 200px;
        }
        .tf-widget-activities .tabs-activities-content .activities-content {
            padding: 20px;
        }
        .tf-widget-activities .tabs-activities-content .activities-content .title-activitis {
            font-size: 22px;
        }
        .nav-tabs-activities .nav-item .nav-link {
            padding: 12px 14px !important;
        }
        .nav-tabs-activities .nav-item .nav-link span:last-child {
            font-size: 11px !important;
        }
    }

    @media (max-width: 991px) {
        .tour-package .tab-content .col-sm-6.col-lg-3 { flex: 0 0 50%; max-width: 50%; }
        .about-us .travel-video { margin-bottom: 40px; }
        .about-us .travel-video .mask-video { width: 120px !important; height: 160px !important; }
        .about-us .travel-video .mask-enjoy { display: none; }
    }
    @media (max-width: 575px) {
        .tour-package .tab-content .col-sm-6.col-lg-3 { flex: 0 0 100%; max-width: 100%; }
        .tour-package .tab-content .tour-listing-image { height: 200px; }
        .about-us .travel-video .image-video { height: 280px !important; }
        .about-us .travel-video .mask-video { width: 100px !important; height: 130px !important; }
        .about-us { padding-bottom: 80px !important; }
        .about-us .inner-content-about { padding-top: 20px; }
        .about-us .travel-video .mask-enjoy { display: none; }
    }
</style>
@endpush
