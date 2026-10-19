@extends('layouts.app')

@section('title', 'Portfolio / Our Work | Client Websites | PearlMind Qatar')
@section('meta_description', 'PearlMind portfolio — live client websites across Qatar including E-commerce, beauty, consulting, contracting, and more.')

@section('content')
    @include('partials.page-header', ['title' => 'Our Work'])

    <section class="project-one space-y">
        <div class="container">
            <div class="project-one__top mb-4">
                <div class="sec-title">
                    <p class="sec-title__tagline">
                        <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                        Portfolio
                        <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                    </p>
                    <h2 class="sec-title__title">Client Websites</h2>
                </div>
            </div>
            <div class="row gutter-y-30">
                @foreach ($works as $work)
                    <div class="col-lg-6">
                        <div class="project-one__item">
                            <a href="{{ $work['url'] }}" target="_blank" rel="noopener noreferrer" class="project-one__item__image">
                                <img src="{{ $work['img'] }}" alt="{{ $work['title'] }} website by PearlMind">
                            </a>
                            <div class="project-one__item__content">
                                <div class="project-one__item__left">
                                    <div class="project-one__item__inner">
                                        <ul class="project-one__item__list list-unstyled">
                                            <li>{{ $work['cat'] }}</li>
                                            <li>{{ $work['domain'] }}</li>
                                        </ul>
                                        <h2 class="project-one__item__title">
                                            <a href="{{ $work['url'] }}" target="_blank" rel="noopener noreferrer">{{ $work['title'] }}</a>
                                        </h2>
                                    </div>
                                    <a href="{{ $work['url'] }}" target="_blank" rel="noopener noreferrer" class="project-one__item__btn"><i class="icon-arrow-double-right-up"></i></a>
                                    <div class="project-one__item__shape"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
