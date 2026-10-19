@extends('layouts.app')

@section('title', 'Digital Services in Qatar | Web, Social, Apps & Software | PearlMind')
@section('meta_description', 'PearlMind services in Qatar: website development, social media marketing and management, Android and iOS apps, and custom software for Doha businesses.')
@section('meta_keywords', 'digital services Qatar, website development Doha, social media management Qatar, mobile app development Doha, custom software Qatar, PearlMind services')

@php
    $serviceIcons = ['icon-settings', 'icon-growth', 'icon-chip', 'icon-bar-chart'];
    $serviceImages = [
        'website-development' => asset('amonx/images/team/team-1-1.jpg'),
        'social-media-marketing' => asset('amonx/images/team/team-1-2.jpg'),
        'application-development' => asset('amonx/images/resources/testimonials-1-2-large.jpg'),
        'software-development' => asset('amonx/images/team/team-1-4.jpg'),
    ];
@endphp

@section('content')
    @include('partials.page-header', [
        'title' => 'Digital Services in Qatar',
        'image' => asset('amonx/images/team/team-1-3.jpg'),
        'imageAlt' => 'Client in traditional Qatari dress',
    ])

    <section class="services-three services-three--page space-y">
        <div class="container">
            <div class="sec-title text-center">
                <p class="sec-title__tagline">
                    <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                    Services
                    <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                </p>
                <h2 class="sec-title__title">End-to-end digital solutions under one roof</h2>
            </div>
            <div class="services-three__grid">
                @foreach ($services as $i => $service)
                    <div class="services-three__card" data-aos="fade-up" data-aos-duration="1300" data-aos-delay="{{ ($i + 1) * 100 }}">
                        <div class="services-three__card__content">
                            <span class="services-three__card__icon"><i class="{{ $serviceIcons[$i] ?? 'icon-settings' }}"></i></span>
                            <div class="services-three__card__inner">
                                <h2 class="services-three__card__title">
                                    <a href="{{ route('services.show', $service['slug']) }}">{{ $service['title'] }}</a>
                                </h2>
                                <p class="services-three__card__text">{{ $service['short'] }}</p>
                            </div>
                            <div class="services-three__card__image services-three__card__image--hover">
                                <span class="services-three__card__number"></span>
                                <div class="services-three__card__image__box">
                                    <img src="{{ $serviceImages[$service['slug']] ?? $service['img'] }}" alt="{{ $service['title'] }}">
                                </div>
                            </div>
                            <div class="services-three__card__inner">
                                <ul class="services-three__card__list list-unstyled">
                                    @foreach (array_slice($service['offers'], 0, 3) as $offer)
                                        <li>
                                            <div class="services-three__card__list__icon">
                                                <span><i class="icon-check"></i></span>
                                            </div>
                                            {{ $offer }}
                                        </li>
                                    @endforeach
                                </ul>
                                <span class="services-three__card__number"></span>
                            </div>
                            <div class="services-three__card__image services-three__card__image--show">
                                <div class="services-three__card__image__box">
                                    <img src="{{ $serviceImages[$service['slug']] ?? $service['img'] }}" alt="{{ $service['title'] }}">
                                </div>
                            </div>
                            <div class="services-three__card__inner services-three__card__inner--btn">
                                <a href="{{ route('services.show', $service['slug']) }}" class="amonx-btn">
                                    <span class="amonx-btn__icon">
                                        <i class="icon-arrow-double-right"></i>
                                        <i class="icon-arrow-double-right"></i>
                                    </span>
                                    <span class="amonx-btn__text">Explore the Service</span>
                                </a>
                            </div>
                        </div>
                        <div class="services-three__card__bg"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
