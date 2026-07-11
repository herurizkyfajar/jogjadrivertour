@extends('layouts.app')

@push('styles')
<style>
    /* â”€â”€ Description content typography spacing â”€â”€ */
    .des-content p {
        margin-bottom: 12px;
        line-height: 1.75;
    }
    .des-content h4 {
        margin-top: 28px;
        margin-bottom: 10px;
        font-size: 17px;
        font-weight: 700;
    }
    .des-content h4:first-child {
        margin-top: 0;
    }
    /* Override global template reset: ul,li { list-style: none } */
    .des-content ul {
        list-style: disc !important;
        padding-left: 22px !important;
        margin-top: 8px !important;
        margin-bottom: 16px !important;
    }
    .des-content ol {
        list-style: decimal !important;
        padding-left: 22px !important;
        margin-top: 8px !important;
        margin-bottom: 16px !important;
    }
    .des-content ul li,
    .des-content ol li {
        list-style: inherit !important;
        display: list-item !important;
        margin-bottom: 6px !important;
        line-height: 1.65 !important;
        padding-left: 0 !important;
    }
</style>
@endpush

@section('title', $destination->name . ' - Yogyakarta Driver Tour')

@section('content')
<section>
    <div class="tf-container full">
        <div class="row">
            <div class="col-md-12">
                @if(str_starts_with($destination->image, 'destinations/'))
                    <img src="{{ asset('storage/'.$destination->image) }}" alt="{{ $destination->name }}" style="width:100%;height:400px;object-fit:cover;">
                @else
                    <img src="{{ asset($destination->image) }}" alt="{{ $destination->name }}" style="width:100%;height:400px;object-fit:cover;">
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
                        <button class="nav-link" id="pills-location-share-tab" data-bs-toggle="pill" data-bs-target="#pills-location-share" type="button" role="tab" aria-controls="pills-location-share" aria-selected="false"><i class="icon-map-1"></i> Location share</button>
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
                                        <span class="feature">{{ $destination->city }}</span>
                                        <h2 class="title">{{ $destination->name }}</h2>
                                        <ul class="flex-three list-wrap-heading">
                                            <li class="flex-three">
                                                <i class="icon-map-1"></i>
                                                <span>{{ $destination->location }}, {{ $destination->city }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40 image-gallery-single">
                            <div class="col-12">
                                @if(str_starts_with($destination->image, 'destinations/'))
                                    <img src="{{ asset('storage/'.$destination->image) }}"
                                         alt="{{ $destination->name }}"
                                         style="width:100%;height:450px;object-fit:cover;border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,0.12);">
                                @else
                                    <img src="{{ asset($destination->image) }}"
                                         alt="{{ $destination->name }}"
                                         style="width:100%;height:450px;object-fit:cover;border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,0.12);">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="information-content-tour">
                                    <div class="description-wrap mb-40">
                                        <span class="description">Description:</span>
                                        <div class="des-content">{!! $destination->description !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="side-bar-right">
                                    <div class="sidebar-widget">
                                        <h6 class="block-heading">Book This Destination</h6>
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
                                                <span class="label">Visitors:</span>
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
                                                <span class="total text-main">Rp 100.000</span>
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
                                        <h4 class="block-heading">Related Tours</h4>
                                        <div class="recent-post-list">
                                            @php
                                                $relatedTours = \App\Models\Tour::where('is_active', true)->latest()->take(3)->get();
                                            @endphp
                                            @foreach($relatedTours as $tour)
                                                <div class="list-recent flex-three">
                                                    <a href="{{ route('tours.show', $tour->slug) }}" class="recent-image" style="display:block;width:80px;min-width:80px;height:60px;overflow:hidden;border-radius:8px;">
                                                        @if(str_starts_with($tour->image, 'tours/'))
                                                            <img src="{{ asset('storage/'.$tour->image) }}" alt="{{ $tour->name }}" style="width:100%;height:100%;object-fit:cover;">
                                                        @else
                                                            <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}" style="width:100%;height:100%;object-fit:cover;">
                                                        @endif
                                                    </a>
                                                    <div class="recent-info">
                                                        <div class="start">
                                                            @for($i = 0; $i < 5; $i++)
                                                                <i class="icon-Star"></i>
                                                            @endfor
                                                        </div>
                                                        <h4 class="title">
                                                            <a href="{{ route('tours.show', $tour->slug) }}">{{ Str::limit($tour->name, 40) }}</a>
                                                        </h4>
                                                        <p>From <span class="text-main">Rp {{ number_format($tour->discount_price ?: $tour->price, 0, ',', '.') }}</span></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Share Tab -->
                    <div class="tab-pane fade" id="pills-location-share" role="tabpanel" aria-labelledby="pills-location-share-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="location-content-tour">
                                    <h3 class="title mb-30">Location</h3>
                                    @if($destination->maps_embed)
                                        <div style="border-radius:12px;overflow:hidden;border:1px solid #ddd;height:450px;">
                                            {!! str_replace('style="border:0;"', 'style="width:100%;height:100%;border:0;"', $destination->maps_embed) !!}
                                        </div>
                                    @else
                                        <div style="background:#f5f5f5;border-radius:12px;height:450px;display:flex;align-items:center;justify-content:center;">
                                            <div style="text-align:center;">
                                                <i class="icon-map-1" style="font-size:48px;color:#4DA528;"></i>
                                                <p style="margin-top:15px;font-size:16px;color:#666;">{{ $destination->location }}, {{ $destination->city }}</p>
                                                <p style="margin-top:5px;font-size:13px;color:#999;">Map not available</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="side-bar-right">
                                    <div class="sidebar-widget">
                                        <h6 class="block-heading">Destination Location</h6>
                                        <ul class="category-confidence mb-30">
                                            <li class="flex-three"><i class="icon-map-1"></i><span>{{ $destination->location }}</span></li>
                                            <li class="flex-three"><i class="icon-18"></i><span>{{ $destination->city }}</span></li>
                                        </ul>
                                        <a href="{{ $destination->maps_link ?: 'https://www.google.com/maps/search/?api=1&query=' . urlencode($destination->location . ', ' . $destination->city) }}" target="_blank" style="display:block;width:100%;padding:14px;background:#4DA528;color:#fff;border:none;border-radius:8px;font-size:16px;font-weight:600;cursor:pointer;text-align:center;text-decoration:none;margin-bottom:20px;">
                                            <i class="icon-map-1" style="margin-right:8px;"></i> Get Directions
                                        </a>
                                    </div>
                                    <div class="sidebar-widget">
                                        <h6 class="block-heading">Share Destination</h6>
                                        <div class="flex-two mb-15">
                                            <input type="text" id="location-link" value="{{ url('/destinations/' . $destination->slug) }}" readonly style="width:100%;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:14px;background:#f9f9f9;">
                                        </div>
                                        <button type="button" onclick="copyLocationLink()" style="width:100%;padding:12px;background:#333;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">
                                            <i class="icon-18" style="margin-right:8px;"></i> Copy Link
                                        </button>
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
                                @if($destination->gallery_images && count($destination->gallery_images) > 0)
                                    <div class="row">
                                        @foreach($destination->gallery_images as $galleryPath)
                                            <div class="col-6 col-md-3 mb-20">
                                                <a href="{{ str_starts_with($galleryPath, 'destinations/') ? asset('storage/'.$galleryPath) : asset($galleryPath) }}" target="_blank" style="display:block;">
                                                    <img src="{{ str_starts_with($galleryPath, 'destinations/') ? asset('storage/'.$galleryPath) : asset($galleryPath) }}" alt="gallery" style="width:100%;height:200px;object-fit:cover;border-radius:12px;transition:transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-6 col-md-3 mb-20">
                                            @if(str_starts_with($destination->image, 'destinations/'))
                                                <img src="{{ asset('storage/'.$destination->image) }}" alt="gallery" style="width:100%;height:200px;object-fit:cover;border-radius:12px;">
                                            @else
                                                <img src="{{ asset($destination->image) }}" alt="gallery" style="width:100%;height:200px;object-fit:cover;border-radius:12px;">
                                            @endif
                                        </div>
                                    </div>
                                @endif
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
                    <p class="des">Book your tour to {{ $destination->name }} now</p>
                </div>
            </div>
            <img src="{{ asset('template/assets/images/page/vector4.png') }}" alt="" class="shape-ab">
            <div class="callt-to-action-button">
                <a href="{{ route('tours.packages') }}" class="get-call">Let's get started</a>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script>
function copyLocationLink() {
    var linkInput = document.getElementById('location-link');
    linkInput.select();
    linkInput.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(linkInput.value).then(function() {
        var btn = event.target.closest('button');
        var originalText = btn.innerHTML;
        btn.innerHTML = '<i class="icon-Vector-7" style="margin-right:8px;"></i> Copied!';
        btn.style.background = '#4DA528';
        setTimeout(function() {
            btn.innerHTML = originalText;
            btn.style.background = '#333';
        }, 2000);
    });
}
</script>
@endpush

@endsection
