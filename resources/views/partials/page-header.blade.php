@php
    /** @var string $title */
    $subtitle = $subtitle ?? null;
    $breadcrumb = $breadcrumb ?? [];
@endphp
<section class="page-header image-parallax">
    <div class="page-header__bg image-parallax-lr" style="background-image: url({{ asset('amonx/images/backgrounds/page-header-bg.jpg') }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="page-header__content hidden">
                    <h1 class="page-header__title reveal-fade-up" data-delay="0.3">{{ $title }}</h1>
                    <ul class="amonx-breadcrumb list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        @foreach ($breadcrumb as $crumb)
                            @if (!empty($crumb['url']))
                                <li><a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a></li>
                            @else
                                <li><span>{{ $crumb['label'] }}</span></li>
                            @endif
                        @endforeach
                        <li><span>{{ $title }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 d-none d-xl-block">
                <div class="page-header__image">
                    <div class="page-header__image__box grid-reveal-anim">
                        <img src="{{ asset('amonx/images/resources/page-header-1.jpg') }}" alt="{{ $title }}" data-animate="true" class="grid-reveal-anim-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-header__shape roll-in-left">
        <img src="{{ asset('amonx/images/shapes/page-header-shape-1.png') }}" alt="" class="page-header__shape__image">
    </div>
</section>
