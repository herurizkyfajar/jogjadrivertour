<footer class="footer footer-style1">
    <div class="tf-container">
        <div class="footer-main">
            <div class="footer-logo">
                <div class="logo-footer">
                    <a href="{{ route('home') }}" aria-label="Yogyakarta Driver Tour - Home">
                        <img src="{{ asset('template/assets/images/logo.webp') }}" alt="Yogyakarta Driver Tour Logo">
                    </a>
                </div>
                <p class="des-footer">Your trusted partner for private car rental and professional tour guide services in Yogyakarta and its surroundings.</p>
                <ul class="footer-info">
                    <li class="flex-three">
                        <i class="icon-noun-mail-5780740-1"></i>
                        <p>info@jogadrivertour.com</p>
                    </li>
                    <li class="flex-three">
                        <i class="icon-Group-9"></i>
                        <p>+62 812 3456 7890</p>
                    </li>
                    <li class="flex-three">
                        <i class="icon-Layer-19"></i>
                        <p>Jl. Malioboro No. 123, Yogyakarta</p>
                    </li>
                </ul>
            </div>
            <div class="footer-service">
                <h5 class="title">Quick Links</h5>
                <ul class="footer-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('tours.index') }}">Tour Packages</a></li>
                    <li><a href="{{ route('destinations.index') }}">Destinations</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="footer-gallery">
                <h5 class="title">Gallery</h5>
                @php $galleryTours = \App\Models\MyTour::latest()->take(9)->get(); @endphp
                @if($galleryTours->count())
                    <div class="gallery-img" style="display:grid;grid-template-columns:repeat(3,1fr);gap:4px;">
                        @foreach($galleryTours as $tour)
                            <a href="{{ asset('storage/' . $tour->image) }}" data-fancybox="gallery" style="display:block;aspect-ratio:1;overflow:hidden;border-radius:4px;">
                                <img src="{{ asset('storage/' . $tour->image) }}" alt="Gallery: {{ $tour->negara_asal }} - {{ $loop->iteration }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="gallery-img">
                        <a href="{{ asset('template/assets/images/gallery/gl1.jpg') }}" data-fancybox="gallery"><img src="{{ asset('template/assets/images/gallery/gl1.jpg') }}" alt="image gallery"></a>
                        <a href="{{ asset('template/assets/images/gallery/gl2.jpg') }}" data-fancybox="gallery"><img src="{{ asset('template/assets/images/gallery/gl2.jpg') }}" alt="image gallery"></a>
                        <a href="{{ asset('template/assets/images/gallery/gl3.jpg') }}" data-fancybox="gallery"><img src="{{ asset('template/assets/images/gallery/gl3.jpg') }}" alt="image gallery"></a>
                        <a href="{{ asset('template/assets/images/gallery/gl4.jpg') }}" data-fancybox="gallery"><img src="{{ asset('template/assets/images/gallery/gl4.jpg') }}" alt="image gallery"></a>
                        <a href="{{ asset('template/assets/images/gallery/gl5.jpg') }}" data-fancybox="gallery"><img src="{{ asset('template/assets/images/gallery/gl5.jpg') }}" alt="image gallery"></a>
                        <a href="{{ asset('template/assets/images/gallery/gl6.jpg') }}" data-fancybox="gallery"><img src="{{ asset('template/assets/images/gallery/gl6.jpg') }}" alt="image gallery"></a>
                    </div>
                @endif
            </div>
            <div class="footer-partof">
                <h5 class="title">Part of</h5>
                <a href="https://bandungdrivertour.com" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('template/assets/images/bandung-driver-tour.webp') }}" alt="Bandung Driver Tour" style="max-height: 80px;">
                </a>
            </div>
        </div>
        <div class="row footer-bottom">
            <div class="col-md-6">
                <p class="copy-right" style="white-space: nowrap; font-size: 13px;">Copyright &copy; {{ date('Y') }} by <a href="{{ route('home') }}" class="text-main">Yogyakarta Driver Tour.</a> All Rights Reserved | Powered by <a href="https://bandungdrivertour.com" target="_blank" rel="noopener noreferrer" class="text-main">Bandung Driver Tour</a></p>
            </div>
            <div class="col-md-6">
                <ul class="social flex-six">
                    <li><a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="icon-icon-2"></i></a></li>
                    <li><a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"><i class="icon-x"></i></a></li>
                    <li><a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="icon-icon_03"></i></a></li>
                    <li><a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="icon-2"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<a id="scroll-top" class="button-go"></a>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="logo-canvas">
            <img src="{{ asset('template/assets/images/logo.webp') }}" alt="image">
        </div>
        <p class="des">Your trusted partner for private car rental and professional tour guide in Yogyakarta.</p>
        <ul class="canvas-info">
            <li class="flex-three">
                <i class="icon-noun-mail-5780740-1"></i>
                <p>info@jogadrivertour.com</p>
            </li>
            <li class="flex-three">
                <i class="icon-Group-9"></i>
                <p>+62 812 3456 7890</p>
            </li>
            <li class="flex-three">
                <i class="icon-Layer-19"></i>
                <p>Jl. Malioboro No. 123, Yogyakarta</p>
            </li>
        </ul>
        <ul class="social flex-three">
            <li><a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="icon-icon-2"></i></a></li>
            <li><a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="icon-icon-1"></i></a></li>
            <li><a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"><i class="icon-8"></i></a></li>
            <li><a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="icon-6"></i></a></li>
        </ul>
    </div>
</div>
