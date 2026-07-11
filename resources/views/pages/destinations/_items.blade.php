@foreach($destinations as $destination)
    <div class="col-sm-6 col-lg-4 mb-37">
        <div class="tf-widget-destination">
            <a href="{{ route('destinations.show', $destination->slug) }}" class="destination-imgae">
                @if(str_starts_with($destination->image, 'destinations/'))
                    <img src="{{ asset('storage/'.$destination->image) }}" alt="{{ $destination->name }}">
                @else
                    <img src="{{ asset($destination->image) }}" alt="{{ $destination->name }}">
                @endif
            </a>
            <div class="destination-content">
                <span class="nation">{{ $destination->name }}</span>
                <div class="flex-two btn-destination">
                    <h6 class="title"><a href="{{ route('destinations.show', $destination->slug) }}">View destination</a></h6>
                    <a href="{{ route('destinations.show', $destination->slug) }}" class="flex-five btn-view">
                        <i class="icon-Vector-32"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
