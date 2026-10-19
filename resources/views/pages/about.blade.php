@extends('layouts.app')

@section('title', 'About Us | Digital Agency in Doha, Qatar | PearlMind')
@section('meta_description', 'About PearlMind — a leading digital agency in Doha, Qatar. Website development, social media marketing, apps & software for 100+ businesses.')

@section('content')
    @include('partials.page-header', ['title' => 'About Us'])

    <section class="about-one about-one--page space-y">
        <div class="container">
            <div class="row gutter-y-40">
                <div class="col-xl-10 mx-auto">
                    <div class="sec-title">
                        <p class="sec-title__tagline">
                            <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                            Who We Are
                            <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                        </p>
                        <h2 class="sec-title__title">PearlMind is a leading digital agency based in Doha, Qatar</h2>
                    </div>
                    <p class="about-one__text mb-4">
                        PearlMind is dedicated to helping businesses grow in the digital world. We specialize in website development, digital marketing, social media management, application development, and software development. With a strong track record of delivering results-driven solutions, we have proudly served 100+ businesses across Qatar, helping them build a powerful online presence and connect with their audience.
                    </p>
                </div>
            </div>

            <div class="row gutter-y-40 mt-5">
                <div class="col-md-6">
                    <div class="sec-title">
                        <h3 class="sec-title__title">Our Vision</h3>
                    </div>
                    <p>
                        To be Qatar's most trusted digital partner — empowering businesses of all sizes to grow, innovate, and succeed through smart technology and creative digital solutions.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="sec-title">
                        <h3 class="sec-title__title">Our Mission</h3>
                    </div>
                    <p>
                        Our mission is to deliver high-quality, customized digital solutions — from websites and mobile apps to marketing campaigns — that help our clients strengthen their brand, reach the right audience, and achieve measurable, long-term business growth.
                    </p>
                </div>
            </div>

            <div class="row gutter-y-30 mt-5">
                <div class="col-12">
                    <div class="sec-title">
                        <p class="sec-title__tagline">
                            <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                            Why Choose PearlMind
                            <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                        </p>
                        <h2 class="sec-title__title">What sets us apart</h2>
                    </div>
                </div>
                @foreach ($whyChoose as $i => $point)
                    <div class="col-md-6 col-lg-4">
                        <div class="services-three__card" data-aos="fade-up" data-aos-delay="{{ ($i + 1) * 100 }}">
                            <div class="services-three__card__content" style="padding:28px">
                                <span class="services-three__card__icon"><i class="icon-check"></i></span>
                                <p class="services-three__card__text mb-0">{{ $point }}</p>
                            </div>
                            <div class="services-three__card__bg"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5">
                <a href="{{ route('contact') }}" class="amonx-btn">
                    <span class="amonx-btn__icon">
                        <i class="icon-arrow-double-right"></i>
                        <i class="icon-arrow-double-right"></i>
                    </span>
                    <span class="amonx-btn__text">Contact Us</span>
                </a>
            </div>
        </div>
    </section>
@endsection
