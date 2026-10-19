@php
    $company = \App\Support\SiteContent::company();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hidden-x">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@hasSection('meta_description')@yield('meta_description')@else{{ 'PearlMind is a digital agency in Doha, Qatar — website development, social media marketing, app & software development.' }}@endif">
    <title>@yield('title', 'Digital Agency in Qatar | PearlMind')</title>

    <link rel="icon" href="{{ asset('images/PearlMind-logo.jpeg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/PearlMind-logo.jpeg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('amonx/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/jarallax/jarallax.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/amonx-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/owl-carousel/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/css/amonx.css') }}">

    <style>
        :root {
            --pearl-blue: #2F68EF;
            --pearl-dark: #1A1C22;
        }
        .main-header__logo img,
        .footer-widget__logo img,
        .sidebar-two__logo img,
        .logo-box img {
            max-height: 52px;
            width: auto;
            border-radius: 6px;
        }
        .whatsapp-float {
            position: fixed;
            right: 22px;
            bottom: 90px;
            z-index: 99999;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #25D366;
            color: #fff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 28px rgba(0,0,0,.22);
            font-size: 28px;
            transition: transform .2s ease;
        }
        .whatsapp-float:hover { color: #fff !important; transform: scale(1.06); }
        .instagram-client-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            min-height: 140px;
            padding: 24px 16px;
            border: 1px solid rgba(17,17,17,.1);
            text-decoration: none;
            color: inherit;
            background: #fff;
            transition: border-color .2s ease, box-shadow .2s ease;
        }
        .instagram-client-card:hover {
            border-color: var(--pearl-blue);
            box-shadow: 0 12px 30px rgba(47,104,239,.12);
            color: inherit;
        }
        .instagram-client-card i { font-size: 28px; color: var(--pearl-blue); }
        .pearl-form-success {
            margin-bottom: 1rem;
            padding: 14px 16px;
            border: 1px solid rgba(47,104,239,.35);
            background: rgba(47,104,239,.08);
        }
        .about-one__image--pearl .about-one__image__box {
            -webkit-mask: none;
            mask: none;
            border-radius: 24px;
        }
        .about-one__image--pearl .about-one__image__box img {
            width: 100%;
            border-radius: 24px;
        }
        @media (min-width: 768px) {
            .about-one__image--pearl .about-one__rate {
                top: auto;
                bottom: 22px;
                left: 22px;
            }
        }
        .project-one__item__image img {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }
        .services-three__card__image__box img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
    </style>
    @stack('styles')

    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => $company['name'],
        'description' => $company['type'],
        'url' => url('/'),
        'telephone' => $company['phone'],
        'email' => $company['email'],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Building No. 71, Floor No. 6, Office 601, Al Doha Al Jadeeda',
            'addressLocality' => 'Doha',
            'addressCountry' => 'QA',
        ],
        'areaServed' => 'Qatar',
        'image' => asset('images/PearlMind-logo.jpeg'),
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
    </script>
</head>
<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>

    <div class="preloader">
        <div class="preloader__image" style="background-image: url({{ asset('amonx/images/loader.png') }});"></div>
    </div>

    <div class="page-wrapper">
        @include('partials.header')

        <div id="smooth-wrapper">
            <div id="smooth-content">
                @yield('content')
                @include('partials.footer')
            </div>
        </div>
    </div>

    @include('partials.sidebar')
    @include('partials.mobile-nav')

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <div class="search-popup__content">
            <form role="search" method="get" class="search-popup__form" action="{{ route('portfolio') }}">
                <input type="text" id="search" name="q" placeholder="Search Here...">
                <button type="submit" aria-label="search submit" class="amonx-btn">
                    <span class="amonx-btn__icon">
                        <i class="icon-search"></i>
                        <i class="icon-search"></i>
                    </span>
                </button>
            </form>
        </div>
    </div>

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__text">back top</span>
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
    </a>

    <a class="whatsapp-float" href="https://wa.me/{{ $company['whatsapp'] }}" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="{{ asset('amonx/vendors/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('amonx/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/aos/js/aos.js') }}"></script>
    <script src="{{ asset('amonx/vendors/imagesloaded/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/isotope/isotope.js') }}"></script>
    <script src="{{ asset('amonx/vendors/slick/slick.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/countdown/countdown.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/chart/chart.js') }}"></script>
    <script src="{{ asset('amonx/vendors/gsap/gsap.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/gsap/scrolltrigger.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/gsap/splittext.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/gsap/ScrollSmoother.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/gsap/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/gsap/CustomEase.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/gsap/amonx-gsap.js') }}"></script>
    <script src="{{ asset('amonx/vendors/three-js/three.min.js') }}"></script>
    <script src="{{ asset('amonx/vendors/hover-effect-js/hover-effect.umd.js') }}"></script>
    <script src="{{ asset('amonx/js/amonx.js') }}"></script>
    @stack('scripts')
</body>
</html>
