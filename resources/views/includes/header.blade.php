<!-- Main Header -->
<header class="main-header flex">
    <!-- Header Lower -->
    <div id="header">
        <div class="header-top">
            <div class="header-top-wrap flex-two">
                <div class="header-top-right">
                    <ul class="flex-three">
                        <li class="flex-three">
                            <i class="icon-day"></i>
                            <span>{{ now()->format('l, M d, Y') }}</span>
                        </li>
                        <li class="flex-three">
                            <i class="icon-mail"></i>
                            <span>info@jogadrivertour.com</span>
                        </li>
                        <li class="flex-three">
                            <i class="icon-phone"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                    </ul>
                </div>
                <div class="header-top-left flex-two">
                    <a href="{{ route('contact') }}" class="booking">
                        <i class="icon-19"></i>
                        <span>Booking Now</span>
                    </a>
                    <div class="follow-social flex-two">
                        <span>Follow Us :</span>
                        <ul class="flex-two">
                            <li><a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="icon-icon-2"></i></a></li>
                            <li><a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="icon-icon_03"></i></a></li>
                            <li><a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"><i class="icon-x"></i></a></li>
                            <li><a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="icon-icon"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-lower">
            <div class="tf-container full">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-container flex justify-space align-center">
                            <!-- Logo Box -->
                            <div class="mobile-nav-toggler mobie-mt mobile-button">
                                <i class="icon-Vector3"></i>
                            </div>
                            <div class="logo-box">
                                <div class="logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('template/assets/images/logo.webp') }}" alt="Logo" width="200" height="97">
                                    </a>
                                </div>
                            </div>
                            <div class="nav-outer flex align-center">
                                <!-- Main Menu -->
                                <nav class="main-menu show navbar-expand-md">
                                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li class="{{ request()->routeIs('home') ? 'current' : '' }}">
                                                <a href="{{ route('home') }}">Home</a>
                                            </li>
                                            <li class="dropdown2 {{ request()->routeIs('tours.*') ? 'current' : '' }}">
                                                <a href="{{ route('tours.index') }}">Tour</a>
                                                <ul>
                                                    <li><a href="{{ route('tours.index') }}">Archive Tour</a></li>
                                                    <li><a href="{{ route('tours.packages') }}">Tour Package</a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ request()->routeIs('destinations.*') ? 'current' : '' }}">
                                                <a href="{{ route('destinations.index') }}">Destination</a>
                                            </li>
                                            <li class="{{ request()->routeIs('about') ? 'current' : '' }}">
                                                <a href="{{ route('about') }}">About Us</a>
                                            </li>
                                            <li class="{{ request()->routeIs('blog.*') ? 'current' : '' }}">
                                                <a href="{{ route('blog.index') }}">Blog</a>
                                            </li>
                                            <li class="{{ request()->routeIs('contact') ? 'current' : '' }}">
                                                <a href="{{ route('contact') }}">Contact</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                                <!-- Main Menu End-->
                            </div>
                            <div class="header-account flex align-center">
                                <div class="search-mobie relative">
                                    <div class="dropdown">
                                        <button type="button" class="show-search" data-bs-toggle="dropdown" aria-label="Search" style="background:none;border:none;cursor:pointer;padding:0;">
                                            <i class="icon-Vector5"></i>
                                        </button>
                                        <ul class="dropdown-menu top-search">
                                            <form action="/" id="search-bar-widget">
                                                <input type="text" placeholder="Search here...">
                                                <button type="button"><i class="icon-search-2"></i></button>
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                                <div class="language">
                                    <div class="nice-select" tabindex="0">
                                        <img src="{{ asset('template/assets/images/page/language.svg') }}" alt="" width="20" height="20">
                                        <span class="current" id="lang-current">English</span>
                                        <ul class="list">
                                            <li data-value="" class="option selected">English</li>
                                            <li data-value="id" class="option">Indonesia</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="register">
                                    <ul class="flex align-center">
                                        @auth
                                            <li>
                                                <a href="{{ route('dashboard') }}" class="flex-three" aria-label="Dashboard">
                                                    <i class="icon-profile-user-1"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('login') }}" class="flex-three" aria-label="Login">
                                                    <i class="icon-user-1-1"></i>
                                                </a>
                                            </li>
                                        @endauth
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('template/assets/images/page/fl1.png') }}" alt="" class="fly-ab" width="174" height="92">
        </div>
    </div>

    <!-- End Header Lower -->
    <button type="button" class="header-sidebar flex-three" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-label="Open menu" style="background:none;border:none;cursor:pointer;padding:0;">
        <i class="icon-Bars"></i>
    </button>

    <!-- Mobile Menu -->
    <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('template/assets/images/logo.webp') }}" alt="" width="200" height="97">
                </a>
            </div>
            <div class="bottom-canvas">
                <div class="menu-outer"></div>
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->
</header>
<!-- End Main Header -->
