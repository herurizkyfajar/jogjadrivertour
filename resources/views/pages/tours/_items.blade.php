@foreach($myTours as $myTour)
    <div class="tour-listing box-sd">
        <div class="tour-listing-image">
            @if(str_starts_with($myTour->image, 'my-tours/'))
                <img src="{{ asset('storage/'.$myTour->image) }}" alt="My Tour">
            @else
                <img src="{{ asset($myTour->image) }}" alt="My Tour">
            @endif
        </div>
        <div class="tour-listing-content">
            @php $fc = \App\Http\Controllers\Admin\MyTourController::countryCode($myTour->negara_asal); @endphp
            @if($fc)
                <span class="map"><img src="https://flagcdn.com/24x18/{{ strtolower($fc) }}.png" alt="{{ $fc }}" style="width:24px;height:18px;vertical-align:middle;border:1px solid #eee;border-radius:2px;"> {{ $myTour->negara_asal }}</span>
            @else
                <span class="map"><i class="icon-Group-9"></i>{{ $myTour->negara_asal }}</span>
            @endif
        </div>
    </div>
@endforeach
