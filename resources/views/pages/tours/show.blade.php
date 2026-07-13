@extends('layouts.app')

@section('title', $tour->name . ' - Yogyakarta Driver Tour')

@section('content')
<section>
    <div class="tf-container full">
        <div class="row">
            <div class="col-md-12">
                @if(str_starts_with($tour->image, 'tours/'))
                    <img src="{{ asset('storage/'.$tour->image) }}" alt="{{ $tour->name }}" style="width:100%;height:400px;object-fit:cover;">
                @else
                    <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}" style="width:100%;height:400px;object-fit:cover;">
                @endif
            </div>
        </div>
    </div>
</section>

<section class="tour-single">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav justify-content-between tab-tour-single" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-information-tab" data-bs-toggle="pill" data-bs-target="#pills-information" type="button" role="tab" aria-controls="pills-information" aria-selected="true"><i class="icon-Vector-51"></i> Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-tour-planing-tab" data-bs-toggle="pill" data-bs-target="#pills-tour-planing" type="button" role="tab" aria-controls="pills-tour-planing" aria-selected="false"><i class="icon-destination-2-1"></i> Tour Planing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false"><i class="icon-favourite-1"></i> Reviews</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-shot-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-shot-gallery" type="button" role="tab" aria-controls="pills-shot-gallery" aria-selected="false"><i class="icon-image-gallery-1"></i> Shot Gallery</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row pd-main">
            <div class="col-lg-12">
                <div class="tab-content" id="pills-tabContent">
                    <!-- Information Tab -->
                    <div class="tab-pane fade show active" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab" tabindex="0">
                        <div class="row mb-50">
                            <div class="col-lg-12">
                                <div class="inner-heading-wrap flex-two">
                                    <div class="inner-heading">
                                        @if($tour->tag)
                                            <span class="feature">{{ $tour->tag }}</span>
                                        @endif
                                        <h2 class="title">{{ $tour->name }}</h2>
                                        <ul class="flex-three list-wrap-heading">
                                            <li class="flex-three">
                                                <i class="icon-time-left"></i>
                                                <span>{{ $tour->duration_info }}</span>
                                            </li>
                                            <li class="flex-three">
                                                <i class="icon-18"></i>
                                                <span>{{ $tour->category }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="inner-price">
                                        <div class="flex-three">
                                            <div class="start">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="icon-Star"></i>
                                                @endfor
                                            </div>
                                            <span class="review">({{ $tour->review_count }} Reviews)</span>
                                        </div>
                                        <p class="price-sale text-main">
                                            @if($tour->discount_price && $tour->discount_price < $tour->price)
                                                Rp {{ number_format($tour->discount_price, 0, ',', '.') }}
                                                <span class="price">Rp {{ number_format($tour->price, 0, ',', '.') }}</span>
                                            @else
                                                Rp {{ number_format($tour->price, 0, ',', '.') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40 image-gallery-single">
                            <div class="col-12 col-sm-6">
                                @if(str_starts_with($tour->image, 'tours/'))
                                    <img src="{{ asset('storage/'.$tour->image) }}" alt="image" style="width:100%;height:300px;object-fit:cover;border-radius:12px;">
                                @else
                                    <img src="{{ asset($tour->image) }}" alt="image" style="width:100%;height:300px;object-fit:cover;border-radius:12px;">
                                @endif
                            </div>
                            <div class="col-6 col-sm-3">
                                <img src="{{ asset('template/assets/images/destination/1.jpg') }}" alt="image" style="width:100%;height:300px;object-fit:cover;border-radius:12px;">
                            </div>
                            <div class="col-6 col-sm-3">
                                <img src="{{ asset('template/assets/images/destination/2.jpg') }}" alt="image" style="width:100%;height:300px;object-fit:cover;border-radius:12px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="information-content-tour">
                                    <div class="description-wrap mb-40">
                                        <span class="description">Description:</span>
                                        <p class="des">{!! nl2br(e($tour->description)) !!}</p>
                                    </div>
                                    <div class="description-wrap mb-40">
                                        <span class="description">Advance Facilities</span>
                                        <p class="des">Leave your guidebooks at home and dive into the local cultures that make each destination so special. We'll connect you with our exclusive experiences. Each trip is carefully crafted to let enjoy your vacation.</p>
                                    </div>
                                    <div class="description-wrap mb-40">
                                        <span class="description">What to Expect</span>
                                        <p class="des mb-18">Leave your guidebooks at home and dive into the local cultures that make each destination so special. We'll connect you with our exclusive experiences.</p>
                                        <ul class="listing-des">
                                            <li><p>View the City Walls</p></li>
                                            <li><p>Hiking in the forest</p></li>
                                            <li><p>Discover the famous view point "The Lark"</p></li>
                                            <li><p>Sunset on the cruise</p></li>
                                        </ul>
                                    </div>
                                    <div class="expect-wrap mb-70">
                                        <h4 class="title mb-18">What to Expect</h4>
                                        <div class="expect flex-three">
                                            <span>Departure/Return Location</span>
                                            <p>Yogyakarta City Center</p>
                                        </div>
                                        <div class="expect flex-three">
                                            <span>Departure Time</span>
                                            <p>Please arrive by 7:00 AM for a departure at 7:30 AM</p>
                                        </div>
                                        <div class="expect flex-three">
                                            <span>Return Time</span>
                                            <p>Approximately 5:00 PM</p>
                                        </div>
                                    </div>
                                    <div class="expect-wrap mb-70">
                                        <h4 class="title mb-40">Included/Exclude</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="listing-clude">
                                                    <li class="flex-three"><i class="icon-Vector-7"></i><p>Air Conditioned Transport</p></li>
                                                    <li class="flex-three"><i class="icon-Vector-7"></i><p>Professional English Speaking Guide</p></li>
                                                    <li class="flex-three"><i class="icon-Vector-7"></i><p>Lunch at Local Restaurant</p></li>
                                                    <li class="flex-three"><i class="icon-Vector-7"></i><p>All Entrance Fees</p></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="listing-clude">
                                                    <li class="flex-three"><i class="icon-Vector-7"></i><p>Personal Expenses</p></li>
                                                    <li class="flex-three"><i class="icon-Vector-7"></i><p>Tips and Gratuities</p></li>
                                                    <li class="flex-three"><i class="icon-Vector-7"></i><p>Travel Insurance</p></li>
                                                    <li class="flex-three"><i class="icon-Vector-7"></i><p>Hotel Pick Up (Available on Request)</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="expect-wrap">
                                        <h4 class="title mb-40">Tour Amenities</h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul class="listing-icon">
                                                    <li class="flex-three"><i class="icon-10"></i><p>Air Conditioning</p></li>
                                                    <li class="flex-three"><i class="icon-10"></i><p>Professional Guide</p></li>
                                                    <li class="flex-three"><i class="icon-10"></i><p>Transport Included</p></li>
                                                    <li class="flex-three"><i class="icon-10"></i><p>Meal Included</p></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="listing-icon">
                                                    <li class="flex-three"><i class="icon-10"></i><p>Entrance Fees</p></li>
                                                    <li class="flex-three"><i class="icon-10"></i><p>Photography</p></li>
                                                    <li class="flex-three"><i class="icon-10"></i><p>Insurance</p></li>
                                                    <li class="flex-three"><i class="icon-10"></i><p>Wifi</p></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="listing-icon">
                                                    <li class="flex-three"><i class="icon-10"></i><p>Mineral Water</p></li>
                                                    <li class="flex-three"><i class="icon-10"></i><p>Parking</p></li>
                                                    <li class="flex-three"><i class="icon-10"></i><p>First Aid Kit</p></li>
                                                    <li class="flex-three"><i class="icon-10"></i><p>Wheelchair Accessible</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="side-bar-right">
                                    <div class="sidebar-widget">
                                        <h6 class="block-heading">Book This Tour</h6>
                                        <form action="{{ route('contact') }}" id="form-book-tour">
                                            <div class="input-wrap mb-30">
                                                <input type="date" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;">
                                            </div>
                                            <div class="flex-two mb-30">
                                                <span class="label">Time:</span>
                                                <div class="radio">
                                                    <input id="first" type="radio" name="time" value="07:00" checked>
                                                    <label for="first">07.00</label>
                                                    <input id="second" type="radio" name="time" value="09:00">
                                                    <label for="second">09.00</label>
                                                </div>
                                            </div>
                                            <div class="input-wrap-sellect mb-30">
                                                <span class="label">Tickets:</span>
                                                <div class="flex-two mb-15">
                                                    <p>Children (0-12 years)</p>
                                                    <div class="nice-select" tabindex="0">
                                                        <span class="current">1</span>
                                                        <ul class="list">
                                                            <li data-value="" class="option selected focus">1</li>
                                                            <li data-value="2" class="option">2</li>
                                                            <li data-value="3" class="option">3</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="flex-two mb-15">
                                                    <p>Adult (13+ years)</p>
                                                    <div class="nice-select" tabindex="0">
                                                        <span class="current">1</span>
                                                        <ul class="list">
                                                            <li data-value="" class="option selected focus">1</li>
                                                            <li data-value="2" class="option">2</li>
                                                            <li data-value="3" class="option">3</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-two mb-40">
                                                <span class="label">Total:</span>
                                                <span class="total text-main">
                                                    @if($tour->discount_price && $tour->discount_price < $tour->price)
                                                        Rp {{ number_format($tour->discount_price, 0, ',', '.') }}
                                                    @else
                                                        Rp {{ number_format($tour->price, 0, ',', '.') }}
                                                    @endif
                                                </span>
                                            </div>
                                            <button type="submit" style="width:100%;padding:14px;background:#4DA528;color:#fff;border:none;border-radius:8px;font-size:16px;font-weight:600;cursor:pointer;">Proceed Booking</button>
                                        </form>
                                    </div>
                                    <div class="sidebar-widget">
                                        <h6 class="block-heading">Book With Confidence</h6>
                                        <ul class="category-confidence">
                                            <li class="flex-three"><i class="icon-customer-service-1"></i><span>Customer care available 24/7</span></li>
                                            <li class="flex-three"><i class="icon-Vector-6"></i><span>Hand-picked Tours & Activities</span></li>
                                            <li class="flex-three"><i class="icon-insurance-1"></i><span>Free Travel Insureance</span></li>
                                            <li class="flex-three"><i class="icon-price-tag-1-1"></i><span>No-hassle best price guarantee</span></li>
                                        </ul>
                                    </div>
                                    <div class="sidebar-widget">
                                        <h4 class="block-heading">Recent Tours</h4>
                                        <div class="recent-post-list">
                                            @php
                                                $recentTours = \App\Models\Tour::where('is_active', true)->where('id', '!=', $tour->id)->latest()->take(3)->get();
                                            @endphp
                                            @foreach($recentTours as $recent)
                                                <div class="list-recent flex-three">
                                                    <a href="{{ route('tours.show', $recent->slug) }}" class="recent-image" style="display:block;width:80px;min-width:80px;height:60px;overflow:hidden;border-radius:8px;">
                                                        @if(str_starts_with($recent->image, 'tours/'))
                                                            <img src="{{ asset('storage/'.$recent->image) }}" alt="{{ $recent->name }}" style="width:100%;height:100%;object-fit:cover;">
                                                        @else
                                                            <img src="{{ asset($recent->image) }}" alt="{{ $recent->name }}" style="width:100%;height:100%;object-fit:cover;">
                                                        @endif
                                                    </a>
                                                    <div class="recent-info">
                                                        <div class="start">
                                                            @for($i = 0; $i < 5; $i++)
                                                                <i class="icon-Star"></i>
                                                            @endfor
                                                        </div>
                                                        <h4 class="title">
                                                            <a href="{{ route('tours.show', $recent->slug) }}">{{ Str::limit($recent->name, 40) }}</a>
                                                        </h4>
                                                        <p>From <span class="text-main">Rp {{ number_format($recent->discount_price ?: $recent->price, 0, ',', '.') }}</span></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tour Planing Tab -->
                    <div class="tab-pane fade" id="pills-tour-planing" role="tabpanel" aria-labelledby="pills-tour-planing-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="planing-content-tour">
                                    <h3 class="title-plan">Tour Plan :</h3>
                                    <div class="tour-planing-section flex">
                                        <div class="number-box flex-five">01</div>
                                        <div class="content-box">
                                            <h5 class="title">Day 1: Pickup & Arrival</h5>
                                            <p class="des">We'll meet at the designated pickup point in Yogyakarta. After a brief introduction, we'll head to our first destination. Enjoy the scenic drive through the beautiful Javanese countryside.</p>
                                        </div>
                                    </div>
                                    <div class="tour-planing-section flex">
                                        <div class="number-box flex-five">02</div>
                                        <div class="content-box">
                                            <h5 class="title">Day 2: Explore Main Attractions</h5>
                                            <p class="des mb-10">Full day exploration of the main attractions. Visit historical sites and enjoy local cuisine at recommended restaurants.</p>
                                            <ul class="listing-des">
                                                <li><p>Visit the main destination</p></li>
                                                <li><p>Explore local culture and traditions</p></li>
                                                <li><p>Enjoy authentic Javanese cuisine</p></li>
                                                <li><p>Photo sessions at scenic spots</p></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tour-planing-section flex">
                                        <div class="number-box flex-five">03</div>
                                        <div class="content-box">
                                            <h5 class="title">Day 3: Adventure Activities</h5>
                                            <p class="des mb-22">Today is filled with adventure activities. Experience the thrill of outdoor activities in beautiful natural settings.</p>
                                            <ul class="listing-icon">
                                                <li class="flex-three"><i class="icon-10"></i><p>Professional guide for all activities</p></li>
                                                <li class="flex-three"><i class="icon-10"></i><p>Safety equipment provided</p></li>
                                                <li class="flex-three"><i class="icon-10"></i><p>Lunch included at scenic viewpoint</p></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tour-planing-section flex">
                                        <div class="number-box flex-five">04</div>
                                        <div class="content-box">
                                            <h5 class="title">Day 4: Departure</h5>
                                            <p class="des mb-25">Final day of the tour. Enjoy breakfast before heading back to Yogyakarta with unforgettable memories.</p>
                                            <ul class="listing-clude">
                                                <li class="flex-three"><i class="icon-Vector-7"></i><p>Pick and Drop Services</p></li>
                                                <li class="flex-three"><i class="icon-Vector-7"></i><p>Breakfast at Hotel</p></li>
                                                <li class="flex-three"><i class="icon-Vector-7"></i><p>Souvenir Shopping Time</p></li>
                                                <li class="flex-three"><i class="icon-Vector-7"></i><p>Transfer to Airport/Station</p></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="side-bar-right">
                                    <div class="sidebar-widget">
                                        <h6 class="block-heading">Book This Tour</h6>
                                        <form action="{{ route('contact') }}">
                                            <div class="input-wrap mb-30">
                                                <input type="date" style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;">
                                            </div>
                                            <div class="flex-two mb-40">
                                                <span class="label">Total:</span>
                                                <span class="total text-main">
                                                    @if($tour->discount_price && $tour->discount_price < $tour->price)
                                                        Rp {{ number_format($tour->discount_price, 0, ',', '.') }}
                                                    @else
                                                        Rp {{ number_format($tour->price, 0, ',', '.') }}
                                                    @endif
                                                </span>
                                            </div>
                                            <button type="submit" style="width:100%;padding:14px;background:#4DA528;color:#fff;border:none;border-radius:8px;font-size:16px;font-weight:600;cursor:pointer;">Proceed Booking</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Tab -->
                    <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="reviews-content-tour">
                                    <h3 class="title mb-30">Reviews ({{ $tour->review_count }})</h3>
                                    <div class="comment-blog flex mb-40">
                                        <div class="avata">
                                            <img src="{{ asset('template/assets/images/avata/avt-coment.jpg') }}" alt="">
                                        </div>
                                        <div class="content">
                                            <div class="flex-one">
                                                <div class="info">
                                                    <h6 class="name">Rohan De Spond</h6>
                                                    <div class="start">
                                                        @for($i = 0; $i < 5; $i++)
                                                            <i class="icon-Star"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <span class="date">25 January 2024</span>
                                            </div>
                                            <div class="des">Amazing experience! The tour was well organized and the guide was very knowledgeable. Highly recommended for anyone visiting Yogyakarta.</div>
                                        </div>
                                    </div>
                                    <div class="comment-blog flex mb-40">
                                        <div class="avata">
                                            <img src="{{ asset('template/assets/images/avata/avt-comment-2.jpg') }}" alt="">
                                        </div>
                                        <div class="content">
                                            <div class="flex-one">
                                                <div class="info">
                                                    <h6 class="name">Johan Ritaxon</h6>
                                                    <div class="start">
                                                        @for($i = 0; $i < 4; $i++)
                                                            <i class="icon-Star"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <span class="date">15 January 2024</span>
                                            </div>
                                            <div class="des">Great value for money. The itinerary was perfect and we got to see all the major attractions. Will definitely book again!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="side-bar-right">
                                    <div class="sidebar-widget">
                                        <h6 class="block-heading">Rating Summary</h6>
                                        <div style="text-align:center;padding:20px;">
                                            <div style="font-size:48px;font-weight:700;color:#4DA528;">{{ $tour->rating }}</div>
                                            <div class="start" style="justify-content:center;">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="icon-Star"></i>
                                                @endfor
                                            </div>
                                            <p style="margin-top:10px;color:#666;">{{ $tour->review_count }} Reviews</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shot Gallery Tab -->
                    <div class="tab-pane fade" id="pills-shot-gallery" role="tabpanel" aria-labelledby="pills-shot-gallery-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="title mb-30">Shot Gallery</h3>
                                <div class="row">
                                    <div class="col-6 col-md-3 mb-20">
                                        @if(str_starts_with($tour->image, 'tours/'))
                                            <img src="{{ asset('storage/'.$tour->image) }}" alt="gallery" style="width:100%;height:200px;object-fit:cover;border-radius:12px;">
                                        @else
                                            <img src="{{ asset($tour->image) }}" alt="gallery" style="width:100%;height:200px;object-fit:cover;border-radius:12px;">
                                        @endif
                                    </div>
                                    <div class="col-6 col-md-3 mb-20">
                                        <img src="{{ asset('template/assets/images/destination/1.jpg') }}" alt="gallery" style="width:100%;height:200px;object-fit:cover;border-radius:12px;">
                                    </div>
                                    <div class="col-6 col-md-3 mb-20">
                                        <img src="{{ asset('template/assets/images/destination/2.jpg') }}" alt="gallery" style="width:100%;height:200px;object-fit:cover;border-radius:12px;">
                                    </div>
                                    <div class="col-6 col-md-3 mb-20">
                                        <img src="{{ asset('template/assets/images/destination/3.jpg') }}" alt="gallery" style="width:100%;height:200px;object-fit:cover;border-radius:12px;">
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <p class="des">Book your tour now and explore Yogyakarta</p>
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
