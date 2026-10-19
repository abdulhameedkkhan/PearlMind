@php
    $company = \App\Support\SiteContent::company();
@endphp
<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="icon-close"></i></span>
        <div class="logo-box">
            <a href="{{ route('home') }}" aria-label="PearlMind logo">
                <img src="{{ asset('images/PearlMind-logo.jpeg') }}" width="140" alt="PearlMind">
            </a>
        </div>
        <div class="mobile-nav__container"></div>
        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <span class="mobile-nav__contact__icon"><i class="fa fa-envelope"></i></span>
                <a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a>
            </li>
            <li>
                <span class="mobile-nav__contact__icon"><i class="fa fa-phone-alt"></i></span>
                <a href="tel:{{ $company['phone_tel'] }}">{{ $company['phone'] }}</a>
            </li>
        </ul>
    </div>
</div>
