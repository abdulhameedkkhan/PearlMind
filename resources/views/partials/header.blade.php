@php
    use App\Support\SiteContent;
    $company = SiteContent::company();
    $navServices = array_values(SiteContent::services());
@endphp
<header class="main-header main-header--one sticky-header sticky-header--normal">
    <div class="container-fluid main-header__container">
        <div class="main-header__inner">
            <div class="main-header__logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/PearlMind-logo.jpeg') }}" alt="PearlMind" width="160">
                </a>
            </div>
            <div class="main-header__right">
                <div class="main-header__top">
                    <ul class="main-header__info list-unstyled">
                        <li>
                            <span class="main-header__info__icon main-header__info__icon--phone"><i class="icon-phone-call"></i></span>
                            <span><a href="tel:{{ $company['phone_tel'] }}">{{ $company['phone'] }}</a></span>
                        </li>
                        <li>
                            <span class="main-header__info__icon main-header__info__icon--location"><i class="icon-location"></i></span>
                            <span><a href="{{ route('contact') }}">Doha, Qatar</a></span>
                        </li>
                    </ul>
                    <ul class="main-header__info list-unstyled">
                        <li>
                            <span><a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a></span>
                        </li>
                    </ul>
                </div>
                <div class="main-header__navigation">
                    <nav class="main-header__nav main-menu">
                        <ul class="main-menu__list">
                            <li class="{{ request()->routeIs('home') ? 'current' : '' }}">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="{{ request()->routeIs('about') ? 'current' : '' }}">
                                <a href="{{ route('about') }}">About</a>
                            </li>
                            <li class="dropdown {{ request()->routeIs('services*') ? 'current' : '' }}">
                                <a href="{{ route('services') }}">Services <i class="icon-arrow-down"></i></a>
                                <ul>
                                    <li><a href="{{ route('services') }}">All Services</a></li>
                                    @foreach ($navServices as $item)
                                        <li><a href="{{ route('services.show', $item['slug']) }}">{{ $item['title'] }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="{{ request()->routeIs('portfolio') ? 'current' : '' }}">
                                <a href="{{ route('portfolio') }}">Portfolio</a>
                            </li>
                            <li class="{{ request()->routeIs('contact') ? 'current' : '' }}">
                                <a href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="main-header__navigation__right">
                        <div class="mobile-nav__btn mobile-nav__toggler">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <a href="{{ route('contact') }}" class="amonx-btn main-header__btn">
                            <span class="amonx-btn__icon">
                                <i class="icon-arrow-double-right"></i>
                                <i class="icon-arrow-double-right"></i>
                            </span>
                            <span class="amonx-btn__text">Get In Touch</span>
                        </a>
                        <div class="sidebar-btn__toggler"><i class="icon-menu"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
