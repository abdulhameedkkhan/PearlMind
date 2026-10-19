@php
    $company = \App\Support\SiteContent::company();
@endphp
<aside class="fix">
    <div class="side-info">
        <div class="side-info-content">
            <div class="offset-widget offset-header">
                <div class="offset-logo">
                    @include('partials.logo')
                </div>
                <button id="side-info-close" class="side-info-close" type="button">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mobile-menu d-xl-none fix"></div>
            <div class="offset-button">
                <a href="{{ route('contact') }}" class="rr-btn">
                    <span class="btn-wrap">
                        <span class="text-one">Let's Talk</span>
                        <span class="text-two">Let's Talk</span>
                    </span>
                </a>
            </div>
            <div class="offset-widget-box">
                <h2 class="title">Contact Us</h2>
                <div class="contact-meta">
                    <div class="contact-item">
                        <span class="icon"><i class="fa-solid fa-location-dot"></i></span>
                        <span class="text">{{ $company['address'] }}</span>
                    </div>
                    <div class="contact-item">
                        <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                        <span class="text"><a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a></span>
                    </div>
                    <div class="contact-item">
                        <span class="icon"><i class="fa-solid fa-phone"></i></span>
                        <span class="text"><a href="tel:{{ $company['phone_tel'] }}">{{ $company['phone'] }}</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
<div class="offcanvas-overlay"></div>
