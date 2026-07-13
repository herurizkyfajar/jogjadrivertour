@extends('layouts.app')

@section('title', 'Contact Us - Private Car Rental & Tour Guide in Yogyakarta')

@section('content')
<section class="breadcumb-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12 center z-index1">
                <h1 class="title">Contact Us</h1>
                <ul class="breadcumb-list flex-five">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>Contact Us</span></li>
                </ul>
                <img class="bcrumb-ab" src="{{ asset('template/assets/images/page/mask-bcrumb.png') }}" alt="" width="193" height="158">
            </div>
        </div>
    </div>
</section>

<section class="contact-us pd-main">
    <div class="tf-container">
        <div class="row mb-60">
            <div class="col-md-4">
                <div class="box-contact center">
                    <div class="icon">
                        <svg width="56" height="73" viewBox="0 0 56 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M47.5867 58.4287C45.4135 57.4777 42.6076 56.7089 39.3696 56.1675C40.3145 55.2701 41.2807 54.3105 42.2493 53.2917C46.1178 49.2227 49.2046 45.0655 51.4241 40.9353C54.2298 35.7141 55.6524 30.5188 55.6524 25.4937C55.6524 11.5468 43.2782 0.199997 28.0684 0.199997C12.8586 0.199997 0.484375 11.5468 0.484375 25.4937C0.484375 30.5188 1.90694 35.7141 4.7127 40.9354C6.93214 45.0656 10.0189 49.2228 13.8874 53.2919C14.856 54.3106 15.8223 55.2703 16.7672 56.1676C13.5292 56.709 10.7233 57.4778 8.55009 58.4289C4.41693 60.2375 3.54927 62.3021 3.54927 63.7154C3.54927 65.5051 4.8992 68.051 11.3296 70.0167C15.8235 71.3902 21.768 72.1467 28.0684 72.1467C34.3687 72.1467 40.3132 71.3902 44.8071 70.0167C51.2376 68.051 52.5875 65.5051 52.5875 63.7154C52.5875 62.3021 51.7198 60.2375 47.5867 58.4287ZM3.54927 25.4937C3.54927 13.0964 14.5485 3.01041 28.0684 3.01041C41.5882 3.01041 52.5875 13.0964 52.5875 25.4937C52.5875 35.9269 45.734 45.3387 39.9845 51.3971C35.0456 56.6014 30.0468 60.2974 28.0684 61.6832C26.0895 60.297 21.0907 56.601 16.1522 51.3972C10.4028 45.3387 3.54927 35.9269 3.54927 25.4937ZM43.8379 67.3505C39.6483 68.631 34.048 69.3363 28.0684 69.3363C22.0888 69.3363 16.4885 68.631 12.2989 67.3505C8.10292 66.068 6.61416 64.5907 6.61416 63.7154C6.61416 62.2555 10.6079 59.7415 19.4614 58.6182C20.7726 59.7609 21.9935 60.7556 23.0604 61.5884C21.4347 62.1034 20.4062 62.865 20.4062 63.7154C20.4062 65.2682 23.8373 66.5258 28.0684 66.5258C32.2995 66.5258 35.7306 65.2682 35.7306 63.7154C35.7306 62.865 34.702 62.1034 33.0764 61.5884C34.1433 60.7556 35.3642 59.7609 36.6754 58.6182C45.5289 59.7415 49.5226 62.2555 49.5226 63.7154C49.5226 64.5907 48.0338 66.068 43.8379 67.3505Z" fill="currentColor" />
                            <path d="M49.5257 25.4937C49.5257 14.6461 39.9013 5.82082 28.0714 5.82082C16.2416 5.82082 6.61719 14.6461 6.61719 25.4937C6.61719 36.3414 16.2416 45.1666 28.0714 45.1666C39.9013 45.1666 49.5257 36.3414 49.5257 25.4937ZM9.68208 25.4937C9.68208 16.1958 17.9315 8.63123 28.0714 8.63123C38.2113 8.63123 46.4608 16.1958 46.4608 25.4937C46.4608 34.7917 38.2113 42.3562 28.0714 42.3562C17.9315 42.3562 9.68208 34.7917 9.68208 25.4937Z" fill="currentColor" />
                            <path d="M29.5992 35.3301C29.5992 36.1062 30.2853 36.7353 31.1317 36.7353H37.2614C38.1078 36.7353 38.7939 36.1062 38.7939 35.3301V28.304H41.8588C42.4951 28.304 43.0651 27.9436 43.2912 27.3982C43.5172 26.8529 43.3523 26.2361 42.8768 25.8486L29.0848 14.6069C28.5041 14.1336 27.6293 14.1336 27.0486 14.6069L13.2566 25.8486C12.7811 26.2361 12.6162 26.8529 12.8422 27.3982C13.0683 27.9436 13.6385 28.304 14.2748 28.304H17.3397V35.3301C17.3397 36.1062 18.0257 36.7353 18.8721 36.7353H25.0019C25.8483 36.7353 26.5343 36.1062 26.5343 35.3301V31.1145H29.5992V35.3301ZM25.0019 28.304C24.1555 28.304 23.4694 28.9331 23.4694 29.7092V33.9249H20.4046V26.8988C20.4046 26.1227 19.7185 25.4936 18.8721 25.4936H18.3054L28.0668 17.5372L37.8281 25.4936H37.2614C36.4151 25.4936 35.729 26.1227 35.729 26.8988V33.9249H32.6641V29.7092C32.6641 28.9331 31.978 28.304 31.1317 28.304H25.0019Z" fill="currentColor" />
                        </svg>
                    </div>
                    <span>address line</span>
                    <p class="des">Jl. Malioboro No. 123<br>Yogyakarta, Indonesia</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-contact center">
                    <div class="icon">
                        <svg width="71" height="71" viewBox="0 0 71 71" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M63.7861 47.2436L54.7265 43.5093C53.5603 43.0354 52.2697 43.0966 51.1467 43.6769L43.0545 47.8761C41.9315 48.4564 41.1043 49.4849 40.7769 50.6915C40.4495 51.8981 40.6512 53.1731 41.3327 54.2247L45.3942 60.5164C45.9593 61.3885 46.826 61.9903 47.7984 62.1768C48.7709 62.3634 49.7638 62.1197 50.5567 61.5089C62.0718 52.6274 64.5615 39.0856 56.7912 28.2801C56.0225 27.2201 54.8144 26.5739 53.5223 26.5362C52.2302 26.4985 50.9887 27.0729 50.1525 28.0839L46.2266 32.8396C45.3904 33.8506 44.5542 34.8617 43.5855 35.4813L35.1777 40.8898C34.0485 41.6125 32.6292 41.7814 31.3535 41.3541C30.0778 40.9267 29.0883 39.9534 28.6547 38.6893L24.8483 27.7725C24.4147 26.5084 24.4755 25.0882 25.0163 23.8831L25.1669 23.5495C25.7077 22.3444 26.6724 21.477 27.8464 21.1738L36.7133 18.9056C37.8363 18.6155 39.0141 18.7227 40.0578 19.2079L49.4012 23.5542C50.5242 24.0745 51.8008 24.1101 52.9458 23.6524L61.6837 20.1528C62.8067 19.6998 63.6789 18.7822 64.0702 17.6318C64.4616 16.4814 64.3319 15.2172 63.7133 14.1775L60.0962 8.16803C59.5311 7.29592 58.6644 6.69411 57.692 6.50756C56.7195 6.321 55.7267 6.56473 54.9337 7.17553C44.6073 15.1234 38.7892 27.1069 39.5618 39.4721C39.6486 40.8593 40.3428 42.1421 41.4491 42.9766C42.5554 43.811 43.9514 44.1043 45.2836 43.7774L53.8356 41.5853C54.6641 41.3806 55.5368 41.4552 56.3184 41.7976C57.1 42.1401 57.747 42.7293 58.1586 43.4757L63.7861 47.2436Z" fill="currentColor" />
                        </svg>
                    </div>
                    <span>Phone Number</span>
                    <p class="des">+62 812 3456 7890<br>+62 856 1234 5678</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-contact center">
                    <div class="icon">
                        <svg width="78" height="68" viewBox="0 0 78 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M75.4087 16.2808L51.9787 1.28076C50.4899 0.334475 48.6731 -0.115889 46.8281 -0.000912428C44.9832 0.114064 43.2314 0.929622 41.9287 2.28076L39.5287 4.68076L30.5287 1.28076C29.542 0.892527 28.472 0.760273 27.4197 0.896527C26.3673 1.03278 25.3664 1.43327 24.5087 2.06276L1.10872 17.0628C-0.32229 17.9845 -1.14387 19.6322 -0.928719 21.3045C-0.713571 22.9768 0.404798 24.3885 2.02872 24.9428L23.0287 32.0428L16.9287 57.6428C16.6342 59.047 16.8208 60.5073 17.4572 61.7716C18.0936 63.036 19.138 64.0227 20.4001 64.5406C21.6622 65.0584 23.0584 65.0719 24.3291 64.5786L42.1287 57.6428L45.5287 66.4428C46.081 67.8738 47.2442 68.9549 48.693 69.3567C50.1418 69.7585 51.6988 69.437 52.8787 68.4828L76.2787 53.4828C77.7545 52.539 78.6683 50.8878 78.6683 49.1128V18.6828C78.6744 17.3422 78.1896 16.0477 77.3163 15.0218C76.443 13.996 75.2481 13.3244 75.4087 16.2808ZM50.5287 38.6828L27.1287 23.6828L49.5287 11.6828L72.5287 26.6828L50.5287 38.6828Z" fill="currentColor" />
                        </svg>
                    </div>
                    <span>Mail Address</span>
                    <p class="des">info@jogadrivertour.com<br>booking@jogadrivertour.com</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-us-map">
                    <div class="inner-header mb-45">
                        <h2 class="title">Get in touch</h2>
                        <p class="des">Ready to explore Yogyakarta? Contact us for private car rental and tour guide inquiries.</p>
                    </div>
                    <div class="map relative">
                        <div id="map" style="width:100%;height:400px;background:#ddd;border-radius:12px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-us-wrap bg-4">
                    <div class="inner-header mb-60">
                        <h2 class="title">Fill Up The Form</h2>
                        <p class="des">Your email address will not be published. Required fields<br>are marked *</p>
                    </div>
                    <form action="/" id="form-contact-us">
                        <div class="input-wrap relative">
                            <i class="icon-user-1-1"></i>
                            <input type="text" placeholder="Your Name*">
                        </div>
                        <div class="input-wrap relative">
                            <i class="icon-Group-51"></i>
                            <input type="email" placeholder="Email Address*">
                        </div>
                        <div class="input-wrap relative">
                            <i class="icon-content"></i>
                            <textarea name="text-write" rows="7" cols="30" placeholder="Enter Your Message here"></textarea>
                        </div>
                        <button type="submit" class="btn-submit-contact"><i class="icon-Group-121"></i> Get In Touch</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="brand-logo-widget bg-4">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="swiper brand-logo overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="{{ asset('template/assets/images/logo.webp') }}" alt="" width="200" height="97"></div>
                        <div class="swiper-slide"><img src="{{ asset('template/assets/images/logo.webp') }}" alt="" width="200" height="97"></div>
                        <div class="swiper-slide"><img src="{{ asset('template/assets/images/logo.webp') }}" alt="" width="200" height="97"></div>
                        <div class="swiper-slide"><img src="{{ asset('template/assets/images/logo.webp') }}" alt="" width="200" height="97"></div>
                        <div class="swiper-slide"><img src="{{ asset('template/assets/images/logo.webp') }}" alt="" width="200" height="97"></div>
                        <div class="swiper-slide"><img src="{{ asset('template/assets/images/logo.webp') }}" alt="" width="200" height="97"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb--93 bg-1">
    <div class="tf-container">
        <div class="callt-to-action flex-two z-index3 relative">
            <div class="callt-to-action-content flex-three">
                <div class="image">
                    <img src="{{ asset('template/assets/images/page/ready.png') }}" alt="Image" width="83" height="83">
                </div>
                <div class="content">
                    <h2 class="title-call">Ready to explore Yogyakarta?</h2>
                    <p class="des">Book your private car rental and tour guide today</p>
                </div>
            </div>
            <img src="{{ asset('template/assets/images/page/vector4.png') }}" alt="" class="shape-ab" width="169" height="138">
            <div class="callt-to-action-button">
                <a href="{{ route('tours.packages') }}" class="get-call">Let's get started</a>
            </div>
        </div>
    </div>
</section>
@endsection
