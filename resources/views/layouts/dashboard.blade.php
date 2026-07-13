<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard - Yogyakarta Driver Tour')</title>
    <meta name="author" content="Yogyakarta Driver Tour">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('template/app/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('template/app/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/app/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/fonts/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app/css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app/css/bootstrap-select.min.css') }}">

    <link rel="shortcut icon" href="{{ asset('template/assets/images/favico.webp') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('template/assets/images/favico.webp') }}">

    <link rel="stylesheet" href="{{ asset('vendor/quill/quill.snow.css') }}">
    @stack('styles')
    <style>
        .sidebar-dashboard.actives .db-logo img {
            width: 40px;
        }
        .sidebar-dashboard.actives .db-logo {
            padding: 38px 10px;
            text-align: center;
            display: flex;
            justify-content: center;
        }
        .ql-toolbar.ql-snow {
            border: 1px solid #ddd !important;
            border-radius: 8px 8px 0 0 !important;
            background: #fafafa;
        }
        .ql-container.ql-snow {
            border: 1px solid #ddd !important;
            border-top: none !important;
            border-radius: 0 0 8px 8px !important;
            min-height: 120px;
            font-size: 14px;
        }
        .ql-editor {
            min-height: 120px;
        }
        /* Heading styles inside Quill editor */
        .ql-editor h2 { font-size: 20px; font-weight: 700; margin-top: 20px; margin-bottom: 8px; }
        .ql-editor h3 { font-size: 18px; font-weight: 700; margin-top: 18px; margin-bottom: 8px; }
        .ql-editor h4 { font-size: 16px; font-weight: 700; margin-top: 16px; margin-bottom: 6px; }
        .ql-editor p  { margin-bottom: 10px; line-height: 1.7; }
        .ql-editor ul, .ql-editor ol { margin-bottom: 12px; padding-left: 20px; }
        .ql-editor li { margin-bottom: 4px; }
        .sidebar-dashboard {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .db-menu {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.15) transparent;
        }
        .db-menu::-webkit-scrollbar {
            width: 5px;
        }
        .db-menu::-webkit-scrollbar-track {
            background: transparent;
        }
        .db-menu::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
        }
        .db-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.3);
        }
        .db-menu ul li a span {
            white-space: nowrap;
            display: inline !important;
        }
        .db-menu ul li a {
            display: inline-flex !important;
            align-items: center !important;
            flex-wrap: nowrap !important;
            gap: 0;
            width: 100%;
            box-sizing: border-box;
        }
        .db-menu ul li a i {
            flex-shrink: 0;
            display: inline !important;
            margin-right: 14px !important;
            width: auto !important;
        }
        .db-menu ul li {
            white-space: nowrap;
        }
    </style>
</head>

<body class="body header-fixed">
    <div class="preload preload-container" id="preloader">
        <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
            <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20"
                stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20"
                stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20"
                stroke-dasharray="0 440" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20"
                stroke-dasharray="0 440" stroke-linecap="round"></circle>
        </svg>
    </div>

    <script>
        window.addEventListener('load', function() {
            var preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.display = 'none';
            }
        });
    </script>

    <div id="wrapper">
        <div id="pagee" class="clearfix">

            <div class="sidebar-dashboard">
                <div class="db-logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('template/assets/images/logo.webp') }}" alt="Logo" width="120" height="58"></a>
                </div>
                <div class="db-menu">
                    <ul>
                        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="icon-Vector-9"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.my-tours.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.my-tours.index') }}">
                                <i class="icon-Layer-2"></i>
                                <span>My Tours</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.cars.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.cars.index') }}">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="#4DA528" xmlns="http://www.w3.org/2000/svg" style="margin-right:14px;vertical-align:middle;"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                                <span>Cars</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.packages.index') }}">
                                <i class="icon-Group-81"></i>
                                <span>Tour Packages</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.destinations.index') }}">
                                <i class="icon-Group-91"></i>
                                <span>Destinations</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.cities.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.cities.index') }}">
                                <i class="icon-Group-91"></i>
                                <span>Cities</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.media.index') }}">
                                <i class="icon-image-gallery-1"></i>
                                <span>Media</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.analytics.index') }}">
                                <i class="icon-Layer-2"></i>
                                <span>Analytics</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.blog.*') && !request()->routeIs('admin.blog.comments.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.blog.index') }}">
                                <i class="icon-Vector-10"></i>
                                <span>Blog</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.blog.comments.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.blog.comments.index') }}">
                                <i class="icon-25"></i>
                                <span>Blog Comments</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.faqs.index') }}">
                                <i class="icon-noun-mail-5780740-1"></i>
                                <span>FAQ</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.chat-sessions.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.chat-sessions.index') }}">
                                <i class="icon-Group-9"></i>
                                <span>Chat Sessions</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings.index') }}">
                                <i class="icon-Vector-9"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                            <a href="{{ route('about') }}">
                                <i class="icon-profile-user-1"></i>
                                <span>About Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="icon-turn-off-1"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="has-dashboard">
                <!-- Main Header -->
                <header class="main-header flex">
                    <div id="header">
                        <div class="header-dashboard">
                            <div class="tf-container full">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="inner-container flex justify-space align-center">
                                            <div class="header-search flex-three">
                                                <div class="icon-bars">
                                                    <i class="icon-Vector3"></i>
                                                </div>
                                                <form action="/" class="search-dashboard">
                                                    <i class="icon-Vector5"></i>
                                                    <input type="search" placeholder="Search tours">
                                                </form>
                                            </div>
                                            <div class="nav-outer flex align-center">
                                                <nav class="main-menu show navbar-expand-md">
                                                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                                        <ul class="navigation clearfix">
                                                            <li><a href="{{ route('home') }}">Home</a></li>
                                                            <li><a href="{{ route('tours.index') }}">Tours</a></li>
                                                            <li><a href="{{ route('destinations.index') }}">Destinations</a></li>
                                                            <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                                        </ul>
                                                    </div>
                                                </nav>
                                            </div>
                                            <div class="header-account flex align-center">
                                                <div class="dropdown account">
                                                    <a type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{ asset('template/assets/images/page/avata.jpg') }}" alt="Avatar">
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                                        <li><a href="{{ route('admin.settings.index') }}">Settings</a></li>
                                                        <li>
                                                            <form action="{{ route('logout') }}" method="POST">
                                                                @csrf
                                                                <button type="submit" style="background:none;border:none;width:100%;cursor:pointer;padding:0;text-align:left;">
                                                                    <a style="display:block;padding:8px 20px;font-size:14px;color:#333;text-decoration:none;">Logout</a>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- End Main Header -->

                <main id="main">
                    @yield('content')
                </main>

                <footer class="footer footer-dashboard">
                    <div class="tf-container full">
                        <div class="row">
                            <div class="col-xl-6">
                                <p class="text-white">&copy; {{ date('Y') }} Yogyakarta Driver Tour</p>
                            </div>
                            <div class="col-xl-6">
                                <ul class="menu-footer flex-six">
                                    <li><a href="#">Privacy & Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </div>

    <a id="scroll-top" class="button-go"></a>

    <!-- Modal search -->
    <div class="modal search-mobie fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <form action="/" class="search-form-mobie">
                        <div class="search">
                            <i class="icon-circle2017"></i>
                            <input type="search" placeholder="Search Travel" class="search-input" autocomplete="off">
                            <button type="button">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/app/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/app/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('template/app/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/app/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('template/app/js/swiper.js') }}"></script>
    <script src="{{ asset('template/app/js/plugin.js') }}"></script>
    <script src="{{ asset('template/app/js/shortcodes.js') }}"></script>
    <script src="{{ asset('template/app/js/main.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select').niceSelect();
            document.querySelectorAll('.wysiwyg').forEach(function(el) {
                var container = document.createElement('div');
                container.id = 'quill-' + Math.random().toString(36).substr(2, 9);
                el.parentNode.insertBefore(container, el);
                el.style.display = 'none';
                var quill = new Quill('#' + container.id, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ 'header': [2, 3, 4, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['link', 'image'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'indent': '-1'}, { 'indent': '+1' }],
                            ['clean']
                        ]
                    },
                    placeholder: el.getAttribute('placeholder') || ''
                });
                if (el.value) {
                    // dangerouslyPasteHTML is the correct Quill API to load
                    // existing HTML (including h4, ul, li, strong, em, etc.)
                    quill.clipboard.dangerouslyPasteHTML(el.value);
                }
                var form = el.closest('form');
                if (form) {
                    form.addEventListener('submit', function() {
                        el.value = quill.root.innerHTML;
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
