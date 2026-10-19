@php
    $company = \App\Support\SiteContent::company();
    $seoOrigin = \App\Support\SiteContent::origin();
    $seoCanonical = \App\Support\SiteContent::canonical();
    $seoTitle = html_entity_decode(trim((string) $__env->getSection('title')), ENT_QUOTES) ?: 'Digital Agency in Qatar | Website Development Doha | PearlMind';
    $seoDescription = html_entity_decode(trim((string) $__env->getSection('meta_description')), ENT_QUOTES) ?: 'PearlMind is a digital agency in Doha, Qatar for website development, social media marketing, mobile apps, and custom software.';
    $seoImage = $seoOrigin.'/images/PearlMind-logo.jpeg';
@endphp
<!DOCTYPE html>
<html lang="en" class="hidden-x">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="@yield('meta_keywords', 'digital agency Qatar, digital agency Doha, website development Qatar, website design Doha, social media marketing Qatar, app development Qatar, software development Doha, ecommerce website Qatar, PearlMind')">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="author" content="PearlMind">
    <meta name="geo.region" content="QA">
    <meta name="geo.placename" content="Doha, Qatar">
    <meta name="theme-color" content="#1A3E9A">
    <link rel="canonical" href="{{ $seoCanonical }}">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ $seoOrigin }}/sitemap.xml">
    <meta property="og:locale" content="en_QA">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PearlMind">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:alt" content="PearlMind logo">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    <link rel="icon" href="{{ asset('images/PearlMind-logo.jpeg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/PearlMind-logo.jpeg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('amonx/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('amonx/vendors/amonx-icons/style.css') }}">
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
        .page-header__image__box {
            width: min(480px, 46vw);
            height: 520px;
            overflow: hidden;
        }
        .page-header__image__box img,
        .page-header__image__box .grid-reveal-anim-img {
            width: 100%;
            height: 520px;
            object-fit: cover;
            object-position: center 42%;
        }
        .page-header__image__box img.page-header__portrait {
            object-position: center 12%;
        }
        .about-one__experience__year span {
            background-image: none !important;
            -webkit-text-fill-color: #2F68EF;
            color: #2F68EF;
        }
        .about-one__info__image {
            display: block;
            width: 100%;
        }
        .about-one__info__image img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            object-position: center 55%;
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
        .team-one__card__image img {
            width: 100%;
            height: 340px;
            object-fit: cover;
            object-position: center 18%;
        }
        .testimonials-one__card__image img {
            object-fit: cover;
            object-position: center 20%;
        }
        .services-three__card__image__box img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            object-position: center 18%;
        }
        .service-details__image {
            min-height: 460px;
        }
        .service-details__image img {
            min-height: 460px;
            object-position: center 15%;
        }
        .services-one__image img {
            object-position: center center;
        }
        .work-process__card__image {
            height: 220px;
        }
        .work-process__card__image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            object-position: center 18%;
        }
        .why-choose__image__box img {
            width: 100%;
            max-width: 420px;
            height: 520px;
            object-fit: cover;
            object-position: center 18%;
            border-radius: 24px;
        }
        .contact-one--page {
            padding-bottom: 80px;
        }
        .pearl-faq {
            margin-top: 28px;
            padding: 22px 22px 6px;
            background: #fff;
            border-radius: 20px;
            position: relative;
            z-index: 3;
        }
        .pearl-faq h3 {
            margin: 0 0 8px;
            color: #121826;
            font-size: 22px;
            line-height: 1.3;
            letter-spacing: 0;
        }
        .pearl-faq details {
            border-top: 1px solid #e6eaf2;
            padding: 14px 0;
        }
        .pearl-faq summary {
            color: #121826;
            font-weight: 600;
            line-height: 1.45;
            cursor: pointer;
        }
        .pearl-faq details p {
            margin: 10px 0 0;
            color: #3d4450;
            line-height: 1.65;
        }
        h1.hero-one__title {
            margin-top: 0;
        }
    </style>
    @stack('styles')

    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'ProfessionalService',
                '@id' => $seoOrigin.'/#business',
                'name' => $company['name'],
                'description' => $company['type'],
                'url' => $seoOrigin.'/',
                'image' => $seoImage,
                'logo' => $seoImage,
                'telephone' => $company['phone_tel'],
                'email' => $company['email'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Building No. 71, Floor No. 6, Office 601, Al Doha Al Jadeeda',
                    'addressLocality' => 'Doha',
                    'addressRegion' => 'Doha',
                    'addressCountry' => 'QA',
                ],
                'areaServed' => [
                    ['@type' => 'Country', 'name' => 'Qatar'],
                    ['@type' => 'City', 'name' => 'Doha'],
                ],
                'hasMap' => 'https://maps.google.com/?q=Al+Doha+Al+Jadeeda,+Doha,+Qatar',
                'knowsAbout' => [
                    'Website development in Qatar',
                    'Social media marketing in Doha',
                    'Mobile app development in Qatar',
                    'Custom software development in Doha',
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => $seoOrigin.'/#website',
                'url' => $seoOrigin.'/',
                'name' => 'PearlMind',
                'description' => $seoDescription,
                'inLanguage' => 'en',
                'publisher' => ['@id' => $seoOrigin.'/#business'],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
    </script>
    @stack('jsonld')
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

    <script src="{{ asset('amonx/vendors/jquery/jquery-3.7.1.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/bootstrap-select/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/jquery-appear/jquery.appear.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/jquery-validate/jquery.validate.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/owl-carousel/js/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/aos/js/aos.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/gsap/gsap.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/gsap/scrolltrigger.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/gsap/splittext.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/gsap/ScrollSmoother.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/gsap/ScrollToPlugin.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/gsap/CustomEase.min.js') }}" defer></script>
    <script src="{{ asset('amonx/vendors/gsap/amonx-gsap.js') }}" defer></script>
    @if (request()->routeIs('home'))
        <script src="{{ asset('amonx/vendors/three-js/three.min.js') }}" defer></script>
        <script src="{{ asset('amonx/vendors/hover-effect-js/hover-effect.umd.js') }}" defer></script>
    @endif
    <script src="{{ asset('amonx/js/amonx.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
