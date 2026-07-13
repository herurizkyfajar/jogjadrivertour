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
                <img class="bcrumb-ab" src="{{ asset('template/assets/images/page/mask-bcrumb.png') }}" alt="" width="193" height="158">
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
                    <a href="{{ route('tours.show', $tour->slug) }}" class="tour-listing box-sd d-flex flex-column" style="height:100%;text-decoration:none;color:inherit;">
                        <div style="overflow:hidden;border-radius:16px 16px 0 0;">
                            @if(str_starts_with($tour->image, 'tours/'))
                                <img src="{{ asset('storage/'.$tour->image) }}" alt="{{ $tour->name }}" style="width:100%;height:220px;object-fit:cover;display:block;">
                            @else
                                <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}" style="width:100%;height:220px;object-fit:cover;display:block;">
                            @endif
                        </div>
                        <div class="tour-listing-content flex-grow-1 d-flex flex-column">
                            <h3 class="title-tour-list" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                {{ $tour->name }}
                            </h3>
                            <div class="icon-box flex-three mt-auto">
                                <div class="icons flex-three">
                                    <i class="icon-time-left"></i>
                                    <span>{{ $tour->duration_info }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
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

<section style="padding:60px 0;">
    <div class="tf-container">
        <div style="background:linear-gradient(135deg,rgba(0,0,0,0.55),rgba(0,0,0,0.45)),url('{{ asset('template/assets/images/destination/1.webp') }}') center/cover no-repeat;border-radius:20px;padding:50px 40px 40px;position:relative;overflow:hidden;">
            <div style="position:relative;z-index:1;">
                <span style="display:inline-block;border:1px solid rgba(255,255,255,0.5);color:#fff;padding:6px 18px;border-radius:30px;font-size:13px;font-weight:500;margin-bottom:16px;">Why Choose Us</span>
                <h2 style="color:#fff;font-size:38px;font-weight:800;line-height:1.2;margin:0 0 40px;max-width:500px;">Built around your comfort and trust</h2>
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">
                    <div style="background:#fff;border-radius:16px;padding:28px 22px;">
                        <h4 style="font-size:16px;font-weight:700;color:#081E2A;margin:0 0 10px;">Top Destinations</h4>
                        <p style="font-size:13px;color:#666;margin:0;line-height:1.6;">Curated stops across Yogyakarta — from Borobudur sunrise to Parangtritis beach.</p>
                    </div>
                    <div style="background:#fff;border-radius:16px;padding:28px 22px;">
                        <h4 style="font-size:16px;font-weight:700;color:#081E2A;margin:0 0 10px;">Flexible Packages</h4>
                        <p style="font-size:13px;color:#666;margin:0;line-height:1.6;">Build your own itinerary or pick a ready-made plan that suits your schedule.</p>
                    </div>
                    <div style="background:#fff;border-radius:16px;padding:28px 22px;">
                        <h4 style="font-size:16px;font-weight:700;color:#081E2A;margin:0 0 10px;">Expert Local Drivers</h4>
                        <p style="font-size:13px;color:#666;margin:0;line-height:1.6;">Friendly local drivers who know Yogyakarta inside out — no tourist traps.</p>
                    </div>
                    <div style="background:#fff;border-radius:16px;padding:28px 22px;">
                        <h4 style="font-size:16px;font-weight:700;color:#081E2A;margin:0 0 10px;">Transparent Pricing</h4>
                        <p style="font-size:13px;color:#666;margin:0;line-height:1.6;">No hidden fees. Includes driver, fuel and parking — what you see is what you pay.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.tour-listing { display: flex; flex-direction: column; height: 100%; }
.tour-listing .tour-listing-content { flex: 1; display: flex; flex-direction: column; }
.tour-listing .tour-listing-content .icon-box { margin-top: auto; }
</style>
@endpush
