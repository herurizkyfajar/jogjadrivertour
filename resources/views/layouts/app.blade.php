<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Yogyakarta Driver Tour - Private Car Rental & Tour Guide in Yogyakarta')</title>
    <meta name="author" content="Yogyakarta Driver Tour">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Yogyakarta Driver Tour — your trusted partner for private car rental and professional tour guide in Yogyakarta and its surroundings. Book comfortable vehicles with experienced English-speaking drivers for temple tours, city tours, and custom itineraries.')">
    <meta name="keywords" content="Yogyakarta car rental, private car Yogyakarta, tour guide Yogyakarta, Borobudur tour, Prambanan tour, Yogyakarta driver, rent car Jogja, private transport Yogyakarta">
    <meta property="og:title" content="@yield('title', 'Yogyakarta Driver Tour - Private Car Rental & Tour Guide in Yogyakarta')">
    <meta property="og:description" content="@yield('meta_description', 'Your trusted partner for private car rental and professional tour guide in Yogyakarta and its surroundings.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="stylesheet" href="{{ asset('template/app/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('template/app/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/fonts/style.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('template/app/css/swiper-bundle.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('template/app/css/animate.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('template/app/css/nice-select.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('template/app/css/magnific-popup.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('template/app/css/jquery.fancybox.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('template/app/css/textanimation.css') }}" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('template/assets/fonts/style.css') }}">
        <link rel="stylesheet" href="{{ asset('template/app/css/swiper-bundle.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/app/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('template/app/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('template/app/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('template/app/css/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/app/css/textanimation.css') }}">
    </noscript>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" media="print" onload="this.media='all'">

    <link rel="shortcut icon" href="{{ asset('template/assets/images/favico.webp') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('template/assets/images/favico.webp') }}">

    @stack('styles')
    <style>
        .header-account .language {
            margin-right: 15px;
        }
        .header-account .language select {
            display: none;
        }
        .header-account .language .nice-select {
            border: unset !important;
            border-radius: unset;
            padding: 8px 26px 8px 0px;
            line-height: 20px;
            height: auto;
        }
        .header-account .language .nice-select::after {
            border-bottom: 1.7px solid #000000;
            border-right: 1.7px solid #000000;
            margin-top: -6px;
            right: 5px;
        }
        .header-account .language .nice-select .current {
            font-size: 16px;
            font-weight: 500;
            line-height: 20px;
            color: #000000;
        }
        .header-account .language .nice-select .list {
            width: 200px;
            top: 100%;
            right: 0;
            left: auto;
        }
        .header-account .language .nice-select .list .option {
            padding: 8px 16px;
        }
        .header-account .language .nice-select .list .option:hover,
        .header-account .language .nice-select .list .option.selected {
            background: #4DA528;
            color: #fff;
        }
        #google_translate_element {
            display: none;
        }
        .goog-te-gadget-simple {
            display: none !important;
        }
        .skiptranslate {
            display: none !important;
        }
        body > .skiptranslate {
            display: none !important;
        }
        body .widget-testimonial .testimonial-image {
            height: 80px !important;
            overflow: visible !important;
        }
        body .widget-testimonial .testimonial-image .swiper-wrapper {
            height: 80px !important;
            transform: none !important;
        }
        body .widget-testimonial .testimonial-image .swiper-slide {
            width: 65px !important;
            height: 65px !important;
            min-width: 65px !important;
            flex: 0 0 65px !important;
            border-radius: 100% !important;
            border: 3px solid #FFFFFF !important;
            box-shadow: 0px 10px 15px 0px rgba(0, 0, 0, 0.06) !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
            margin: 0 8px !important;
            opacity: 1 !important;
        }
        body .widget-testimonial .testimonial-image .swiper-slide-thumb-active {
            border: 3px solid #4DA528 !important;
        }
        body .widget-testimonial .testimonial-image .avata {
            width: 65px !important;
            height: 65px !important;
            border-radius: 100% !important;
            overflow: hidden !important;
            flex-shrink: 0 !important;
        }
        body .widget-testimonial .testimonial-image .avata img {
            width: 65px !important;
            height: 65px !important;
            min-width: 65px !important;
            min-height: 65px !important;
            object-fit: cover !important;
            border-radius: 100% !important;
            display: block !important;
        }
    </style>
</head>

<body class="body header-fixed counter-scroll @yield('body-class')">
    <div id="google_translate_element" style="display:none;"></div>

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

            @include('includes.header')

            <main id="main">
                @yield('content')
            </main>

            @include('includes.footer')

            @include('includes.chatbot')

        </div>
    </div>

    <script src="{{ asset('template/app/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/app/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('template/app/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/app/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('template/app/js/swiper.js') }}"></script>
    <script src="{{ asset('template/app/js/plugin.js') }}"></script>
    <script src="{{ asset('template/app/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('template/app/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template/app/js/textanimation.js') }}"></script>
    <script src="{{ asset('template/app/js/wow.min.js') }}"></script>
    <script src="{{ asset('template/app/js/shortcodes.js') }}"></script>
    <script src="{{ asset('template/app/js/main.js') }}"></script>
    <script>
        function doGoogleTranslate(lang) {
            var ct = document.getElementById('google_translate_element');
            if (!ct) return;
            var iframe = ct.querySelector('iframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage('translate-' + lang, '*');
            }
        }
        function setLanguage(lang) {
            if (!lang) {
                deleteCookie('googtrans');
                localStorage.removeItem('joga_lang');
            } else {
                setCookie('googtrans', '/en/' + lang);
                localStorage.setItem('joga_lang', lang);
            }
            location.reload();
        }
        function setCookie(name, value) {
            var host = window.location.hostname;
            var domains = [host, '.' + host];
            var parentDomain = host.split('.').slice(-2).join('.');
            if (parentDomain !== host) domains.push(parentDomain);
            domains.forEach(function(d) {
                document.cookie = name + '=' + value + '; path=/; domain=' + d + '; max-age=31536000';
            });
            document.cookie = name + '=' + value + '; path=/; max-age=31536000';
        }
        function deleteCookie(name) {
            var host = window.location.hostname;
            var domains = [host, '.' + host];
            var parentDomain = host.split('.').slice(-2).join('.');
            if (parentDomain !== host) domains.push(parentDomain);
            domains.forEach(function(d) {
                document.cookie = name + '=; path=/; domain=' + d + '; expires=Thu, 01 Jan 1970 00:00:00 UTC';
            });
            document.cookie = name + '=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC';
        }
        function getCookie(name) {
            var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? decodeURIComponent(match[2]) : null;
        }
        function getCurrentLang() {
            var c = getCookie('googtrans');
            if (c && c.indexOf('/id') > -1) return 'id';
            var ls = localStorage.getItem('joga_lang');
            if (ls === 'id') return 'id';
            return 'en';
        }
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,id',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }
        new WOW().init();
        $(document).ready(function() {
            $('select').niceSelect();
            var currentLang = getCurrentLang();
            if (currentLang === 'id') {
                $('#lang-current').text('Indonesia');
                $('.language .nice-select .list .option').removeClass('selected');
                $('.language .nice-select .list .option[data-value="id"]').addClass('selected');
            } else {
                $('#lang-current').text('English');
                $('.language .nice-select .list .option').removeClass('selected');
                $('.language .nice-select .list .option[data-value=""]').addClass('selected');
            }
            $(document).on('click', '.language .nice-select .option', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var lang = $(this).data('value');
                setLanguage(lang);
            });
            $(document).on('click', '.language .nice-select', function(e) {
                if ($(e.target).hasClass('current') || $(e.target).closest('.list').length === 0) {
                    return;
                }
            });
        });
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" async defer></script>

    @stack('scripts')
</body>

</html>
