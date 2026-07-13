@extends('layouts.app')

@section('title', 'Destinations - Yogyakarta Driver Tour')

@section('content')
<section class="breadcumb-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12 center z-index1">
                <h1 class="title">Tour Destination</h1>
                <ul class="breadcumb-list flex-five">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>Tour Destination</span></li>
                </ul>
                <img class="bcrumb-ab" src="{{ asset('template/assets/images/page/mask-bcrumb.png') }}" alt="" width="193" height="158">
            </div>
        </div>
    </div>
</section>

<section class="tour-destination pd-main">
    <div class="tf-container">
        <!-- Filter Bar -->
        <div class="destination-filter-bar" style="background:#fff;border:1px solid #f1f1f1;border-radius:16px;padding:16px 24px;box-shadow:0 15px 45px rgba(0,0,0,0.05);margin-bottom:40px;">
            <form method="GET" action="{{ route('destinations.index') }}" style="display:flex;align-items:center;gap:12px;flex-wrap:nowrap;">
                <div style="flex:1 1 0;min-width:0;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search destination..." style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>
                <div style="flex:0 0 180px;">
                    <select name="city" style="width:100%;padding:10px 14px;border:1px solid #ddd;border-radius:8px;font-size:14px;box-sizing:border-box;background:#fff;">
                        <option value="">All Cities</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="checkbox" name="featured" value="1" {{ request('featured') ? 'checked' : '' }} title="Featured only" style="width:18px;height:18px;accent-color:#4DA528;flex:0 0 auto;cursor:pointer;">
                <button type="submit" style="background:#4DA528;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:14px;font-weight:600;cursor:pointer;height:40px;min-width:80px;box-sizing:border-box;">Filter</button>
                <a href="{{ route('destinations.index') }}" style="background:#eee;color:#666;text-decoration:none;border-radius:8px;padding:10px 20px;font-size:14px;font-weight:600;height:40px;min-width:80px;box-sizing:border-box;display:inline-flex;align-items:center;justify-content:center;">Reset</a>
            </form>
        </div>

        <div class="row" id="destinations-grid">
            @include('pages.destinations._items')
        </div>

        <div id="destinations-loading" style="text-align:center;padding:30px;display:none;">
            <p style="color:#999;">Loading...</p>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .tf-widget-destination .destination-imgae {
        height: 350px;
        overflow: hidden;
    }
    .tf-widget-destination .destination-imgae img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endpush

@push('scripts')
<script>
(function() {
    var page = 2;
    var loading = false;
    var hasMore = {{ $destinations->hasMorePages() ? 'true' : 'false' }};
    var baseUrl = '{{ route("destinations.index") }}';
    var params = new URLSearchParams(window.location.search);

    window.addEventListener('scroll', function() {
        if (loading || !hasMore) return;
        if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 300)) {
            loading = true;
            document.getElementById('destinations-loading').style.display = 'block';
            params.set('page', page);
            fetch(baseUrl + '?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                document.getElementById('destinations-grid').insertAdjacentHTML('beforeend', data.html);
                hasMore = data.hasMore;
                page++;
                loading = false;
                document.getElementById('destinations-loading').style.display = 'none';
            })
            .catch(function() {
                loading = false;
                document.getElementById('destinations-loading').style.display = 'none';
            });
        }
    });
})();
</script>
@endpush
