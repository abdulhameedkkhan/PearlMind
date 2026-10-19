@extends('layouts.app')

@section('title', $service['meta_title'])
@section('meta_description', $service['meta_description'])
@section('meta_keywords', $service['meta_keywords'])

@section('content')
    @include('partials.page-header', [
        'title' => $service['headline'],
        'image' => $service['img'],
        'imageAlt' => $service['title'].' in Qatar',
        'breadcrumb' => [
            ['label' => 'Services', 'url' => route('services')],
        ],
    ])

    <section class="service-details space-y">
        <div class="container">
            <div class="row gutter-y-30">
                <div class="col-xl-8 col-lg-7 order-1 order-lg-0" data-aos="fade" data-aos-duration="1300">
                    <div class="service-details__image scale-anim">
                        <img src="{{ $service['img'] }}" alt="{{ $service['title'] }} in Qatar">
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 order-0 order-lg-1" data-aos="fade-left" data-aos-duration="1300">
                    <div class="service-details__pages">
                        <h3 class="service-details__pages__title">All Services:</h3>
                        <ul class="list-unstyled service-details__nav">
                            @foreach ($services as $item)
                                <li class="{{ $item['slug'] === $service['slug'] ? 'current' : '' }}">
                                    <a href="{{ route('services.show', $item['slug']) }}">
                                        <span class="service-details__nav__icon"><i class="icon-arrow-right-2"></i></span>
                                        {{ $item['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="service-details__content">
                <div class="service-details__box service-details__box--1">
                    <p class="service-details__text" data-aos="fade-up">{{ $service['text'] }}</p>
                </div>

                <div class="service-details__inner mt-5">
                    <h2 class="service-details__inner__title mb-4">What We Offer</h2>
                    <ul class="service-details__inner__list list-unstyled row">
                        @foreach ($service['offers'] as $offer)
                            <li class="col-md-6 mb-3">
                                <i class="icon-check"></i> {{ $offer }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if (!empty($service['industries']))
                    <div class="mt-5">
                        <h3 class="service-details__inner__title mb-4">Industries We Serve</h3>
                        <ul class="list-unstyled row">
                            @foreach ($service['industries'] as $industry)
                                <li class="col-md-6 mb-2"><i class="icon-check"></i> {{ $industry }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (count($works))
                    <div class="mt-5">
                        <h3 class="service-details__inner__title mb-4">Client Websites</h3>
                        <div class="row gutter-y-30">
                            @foreach ($works as $work)
                                <div class="col-md-6 col-lg-4">
                                    <div class="project-one__item">
                                        <a href="{{ $work['url'] }}" target="_blank" rel="noopener noreferrer" class="project-one__item__image">
                                            <img src="{{ $work['img'] }}" alt="{{ $work['title'] }} website by PearlMind">
                                        </a>
                                        <div class="project-one__item__content">
                                            <h4 class="project-one__item__title">
                                                <a href="{{ $work['url'] }}" target="_blank" rel="noopener noreferrer">{{ $work['title'] }}</a>
                                            </h4>
                                            <p class="mb-0">{{ $work['domain'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (count($socialClients))
                    <div class="mt-5">
                        <h3 class="service-details__inner__title mb-4">Social Media Handles</h3>
                        <div class="row g-3">
                            @foreach ($socialClients as $client)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <a class="instagram-client-card" href="{{ $client['url'] }}" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-instagram"></i>
                                        <strong>{{ $client['handle'] }}</strong>
                                        <span>{{ $client['name'] }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-5">
                    <a href="{{ route('contact', ['service' => $service['title']]) }}" class="amonx-btn">
                        <span class="amonx-btn__icon">
                            <i class="icon-arrow-double-right"></i>
                            <i class="icon-arrow-double-right"></i>
                        </span>
                        <span class="amonx-btn__text">Inquire Now</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('jsonld')
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $service['headline'],
        'serviceType' => $service['title'],
        'description' => $service['meta_description'],
        'url' => \App\Support\SiteContent::canonical('services/'.$service['slug']),
        'areaServed' => ['@type' => 'Country', 'name' => 'Qatar'],
        'provider' => ['@id' => \App\Support\SiteContent::origin().'/#business'],
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
