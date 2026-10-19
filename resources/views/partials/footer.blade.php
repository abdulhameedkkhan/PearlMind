@php
    $company = $company ?? \App\Support\SiteContent::company();
@endphp
<footer class="main-footer">
    <div class="main-footer__bg" style="background-image: url({{ asset('amonx/images/shapes/footer-bg-1-1.png') }});"></div>
    <div class="main-footer__top">
        <div class="main-footer__marquee reveal-fade-up" data-delay="0.3">
            <div class="marquee marquee-left--gsap">
                <p class="marquee__toleft">
                    <span class="main-footer__marquee__title">Let's <mark>Work</mark> Together</span>
                    <span class="main-footer__marquee__icon"><i class="icon-tagline"></i></span>
                    <span class="main-footer__marquee__title">Let's <mark>Create</mark> Together</span>
                    <span class="main-footer__marquee__icon"><i class="icon-tagline"></i></span>
                    <span class="main-footer__marquee__title">Let's Build Something <mark>Great</mark></span>
                    <span class="main-footer__marquee__icon"><i class="icon-tagline"></i></span>
                    <span class="main-footer__marquee__title">Digital Agency in <mark>Qatar</mark></span>
                    <span class="main-footer__marquee__icon"><i class="icon-tagline"></i></span>
                    <span class="main-footer__marquee__title">Let's Start a <mark>Project</mark></span>
                    <span class="main-footer__marquee__icon"><i class="icon-tagline"></i></span>
                </p>
            </div>
        </div>
    </div>
    <div class="main-footer__widget">
        <div class="container">
            <div class="row gutter-y-40">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-widget footer-widget--logo">
                        <div class="footer-widget__logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('images/PearlMind-logo.jpeg') }}" alt="PearlMind" width="160">
                            </a>
                        </div>
                        <p class="mt-3" style="opacity:.8">{{ $company['address'] }}</p>
                        <p><a href="tel:{{ $company['phone_tel'] }}">{{ $company['phone'] }}</a></p>
                        <p><a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a></p>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-6">
                    <div class="footer-widget footer-widget--links footer-widget--links-one">
                        <h2 class="footer-widget__title">Quick Link</h2>
                        <ul class="footer-widget__links list-unstyled">
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('services') }}">Services</a></li>
                            <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-5 col-sm-6">
                    <div class="footer-widget footer-widget--links footer-widget--links-two">
                        <h2 class="footer-widget__title">Services</h2>
                        <ul class="footer-widget__links list-unstyled">
                            <li><a href="{{ route('services.show', 'website-development') }}">Website Development</a></li>
                            <li><a href="{{ route('services.show', 'social-media-marketing') }}">Social Media Marketing</a></li>
                            <li><a href="{{ route('services.show', 'application-development') }}">Application Development</a></li>
                            <li><a href="{{ route('services.show', 'software-development') }}">Software Development</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6">
                    <div class="footer-widget footer-widget--newsletter">
                        <h2 class="footer-widget__title">Get In Touch</h2>
                        <div class="footer-widget__newsletter">
                            <p class="footer-widget__newsletter__text">Ready to grow your digital presence in Qatar? Let's talk about your next project.</p>
                            <a href="{{ route('contact') }}" class="amonx-btn">
                                <span class="amonx-btn__icon">
                                    <i class="icon-arrow-double-right"></i>
                                    <i class="icon-arrow-double-right"></i>
                                </span>
                                <span class="amonx-btn__text">Contact Us</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-footer__bottom">
        <div class="container">
            <div class="row align-items-center gutter-y-20">
                <div class="col-md-7">
                    <p class="main-footer__copyright">
                        &copy; {{ date('Y') }} <a href="{{ route('home') }}">PearlMind</a>. Digital Agency in Doha, Qatar. All rights reserved.
                    </p>
                </div>
                <div class="col-md-5">
                    <ul class="main-footer__page list-unstyled">
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
