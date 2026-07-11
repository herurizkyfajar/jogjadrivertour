@extends('layouts.app')

@section('title', 'My Tours - Yogyakarta Driver Tour')

@section('content')
<section class="breadcumb-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12 center z-index1">
                <h1 class="title">My Tours</h1>
                <ul class="breadcumb-list flex-five">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>My Tours</span></li>
                </ul>
                <img class="bcrumb-ab" src="{{ asset('template/assets/images/page/mask-bcrumb.png') }}" alt="">
            </div>
        </div>
    </div>
</section>

<section class="archieve-tour">
    <div class="tf-container">
        <div class="row mb-40">
            <div class="col-lg-12">
                <p style="color:#666;">Riwayat perjalanan klien kami</p>
            </div>
        </div>
        <div class="listing-list-car-grid mb-60" id="tours-grid" style="grid-template-columns: repeat(4, 1fr);">
            @include('pages.tours._items')
        </div>
        <div id="tours-loading" style="text-align:center;padding:30px;display:none;">
            <p style="color:#999;">Loading...</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function() {
    var page = 2;
    var loading = false;
    var hasMore = {{ $myTours->hasMorePages() ? 'true' : 'false' }};

    window.addEventListener('scroll', function() {
        if (loading || !hasMore) return;
        if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 300)) {
            loading = true;
            document.getElementById('tours-loading').style.display = 'block';
            fetch('{{ route("tours.index") }}?page=' + page, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                document.getElementById('tours-grid').insertAdjacentHTML('beforeend', data.html);
                hasMore = data.hasMore;
                page++;
                loading = false;
                document.getElementById('tours-loading').style.display = 'none';
            })
            .catch(function() {
                loading = false;
                document.getElementById('tours-loading').style.display = 'none';
            });
        }
    });
})();
</script>
@endpush
