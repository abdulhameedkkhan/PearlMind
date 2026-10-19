@php
    $company = \App\Support\SiteContent::company();
@endphp
<aside class="sidebar-two">
    <div class="sidebar-two__overlay sidebar-btn__toggler"></div>
    <div class="sidebar-two__content">
        <span class="sidebar-two__close sidebar-btn__toggler"><i class="icon-close"></i></span>
        <div class="sidebar-two__logo sidebar-two__item">
            <a href="{{ route('home') }}" aria-label="PearlMind logo">
                <img src="{{ asset('images/PearlMind-logo.jpeg') }}" alt="PearlMind" width="160">
            </a>
        </div>
        <div class="sidebar-two__about sidebar-two__item">
            <p class="sidebar-two__about__text">
                PearlMind is a digital agency in Doha helping businesses grow through websites, social media, apps, and software.
            </p>
        </div>
        <div class="sidebar-two__info sidebar-two__item">
            <h2 class="sidebar-two__title">Contact Us</h2>
            <ul class="sidebar-two__info__list">
                <li>
                    <span class="sidebar-two__info__icon"><i class="icon-location"></i></span>
                    <address>{{ $company['address'] }}</address>
                </li>
                <li>
                    <span class="sidebar-two__info__icon"><i class="icon-email"></i></span>
                    <a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a>
                </li>
                <li>
                    <span class="sidebar-two__info__icon"><i class="icon-phone-call"></i></span>
                    <a href="tel:{{ $company['phone_tel'] }}">{{ $company['phone'] }}</a>
                </li>
            </ul>
        </div>
        <div class="sidebar-two__social sidebar-two__item">
            <h2 class="sidebar-two__title">Follow Us</h2>
            <div class="social-links">
                <a href="https://wa.me/{{ $company['whatsapp'] }}" target="_blank" rel="noopener noreferrer">
                    <span class="social-links__icon">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        <span class="sr-only">WhatsApp</span>
                    </span>
                </a>
                <a href="mailto:{{ $company['email'] }}">
                    <span class="social-links__icon">
                        <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                        <span class="sr-only">Email</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</aside>
