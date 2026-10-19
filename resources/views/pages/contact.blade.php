@extends('layouts.app')

@section('title', 'Contact PearlMind | Digital Agency in Doha, Qatar')
@section('meta_description', 'Contact PearlMind in Doha, Qatar — Building No. 71, Floor 6, Office 601, Al Doha Al Jadeeda. Call +974 7176 0983 or email contact@pearlmind.qa.')
@section('meta_keywords', 'contact PearlMind, digital agency Doha contact, website quote Qatar, +974 7176 0983, Al Doha Al Jadeeda, contact@pearlmind.qa')

@section('content')
    @include('partials.page-header', [
        'title' => 'Contact PearlMind',
        'image' => asset('amonx/images/team/team-1-2.jpg'),
        'imageAlt' => 'PearlMind client in a hijab',
    ])

    <section class="contact-one contact-one--page space-top">
        <div class="container">
            <div class="row gutter-y-40">
                <div class="col-xl-5 col-lg-6">
                    <div class="contact-one__left" data-aos="fade-right" data-aos-duration="1300">
                        <div class="sec-title">
                            <p class="sec-title__tagline">
                                <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                                Get In Touch
                                <span class="sec-title__tagline__icon"><i class="icon-tagline"></i></span>
                            </p>
                            <h2 class="sec-title__title title-fade-in">We'd love to hear from you</h2>
                        </div>
                        <p class="mb-4">Whether you have a project in mind or just want to say hello, our team is here to help.</p>
                        <div class="contact-one__info">
                            <div class="contact-one__info__item" style="--accent-color: #2F68EF">
                                <span class="contact-one__info__icon contact-one__info__icon--phone"><i class="icon-phone-call"></i></span>
                                <div class="contact-one__info__content">
                                    <h3 class="contact-one__info__title">Phone:</h3>
                                    <a href="tel:{{ $company['phone_tel'] }}" class="contact-one__info__link">{{ $company['phone'] }}</a>
                                </div>
                            </div>
                            <div class="contact-one__info__item" style="--accent-color: #2F68EF">
                                <span class="contact-one__info__icon contact-one__info__icon--location"><i class="icon-location-3"></i></span>
                                <div class="contact-one__info__content">
                                    <h3 class="contact-one__info__title">Address:</h3>
                                    <a href="https://maps.google.com/?q={{ urlencode($company['address']) }}" target="_blank" rel="noopener noreferrer" class="contact-one__info__link">{{ $company['address'] }}</a>
                                </div>
                            </div>
                            <div class="contact-one__info__item" style="--accent-color: #2F68EF">
                                <span class="contact-one__info__icon"><i class="icon-email"></i></span>
                                <div class="contact-one__info__content">
                                    <h3 class="contact-one__info__title">Email:</h3>
                                    <a href="mailto:{{ $company['email'] }}" class="contact-one__info__link">{{ $company['email'] }}</a>
                                </div>
                            </div>
                        </div>

                        @if (count($faqs))
                            <div class="pearl-faq">
                                <h3>Quick Answers</h3>
                                @foreach ($faqs as $faq)
                                    <details>
                                        <summary>{{ $faq['q'] }}</summary>
                                        <p>{{ $faq['a'] }}</p>
                                    </details>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="contact-one__form" data-aos="fade-left" data-aos-duration="1300">
                        <div class="contact-one__form__top">
                            <h2 class="contact-one__form__title">GET IN TOUCH</h2>
                            <p class="contact-one__form__text">Send us your project details</p>
                        </div>

                        @if (session('success'))
                            <div class="pearl-form-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}" class="contact-one__form__form form-one">
                            @csrf
                            <div class="form-one__group">
                                <div class="form-one__control form-one__control--full">
                                    <input type="text" id="contact-name" name="name" value="{{ old('name') }}" required placeholder="Full Name *">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-one__control form-one__control--full">
                                    <input type="email" id="contact-email" name="email" value="{{ old('email') }}" required placeholder="Email Address *">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-one__control">
                                    <input type="tel" id="contact-number" name="phone" value="{{ old('phone') }}" required placeholder="Phone Number *">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-one__control">
                                    <select name="service" required class="form-select" style="height:60px;border:0;border-radius:0;background:#f5f5f5;padding:0 20px">
                                        <option value="">Select Service *</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject }}" @selected(old('service', request('service')) === $subject)>{{ $subject }}</option>
                                        @endforeach
                                    </select>
                                    @error('service') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-one__control form-one__control--full">
                                    <textarea id="contact-message" name="message" required placeholder="Your Message *">{{ old('message') }}</textarea>
                                    @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-one__control form-one__control--full">
                                    <button type="submit" class="amonx-btn">
                                        <span class="amonx-btn__icon">
                                            <i class="icon-arrow-double-right"></i>
                                            <i class="icon-arrow-double-right"></i>
                                        </span>
                                        <span class="amonx-btn__text">Submit Now</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="google-map google-map__contact">
        <iframe
            title="PearlMind office location"
            src="https://maps.google.com/maps?q={{ urlencode('Al Doha Al Jadeeda, Doha, Qatar') }}&z=15&output=embed"
            class="map__contact"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
@endsection

@push('jsonld')
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => collect($faqs)->map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ])->values()->all(),
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
