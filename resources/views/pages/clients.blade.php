@extends('layouts.app')

@section('title', 'Clients | PearlMind Qatar')
@section('footer_class', 'footer-area-2 overflow-hidden')

@section('content')
    <main>
        <section class="page-title-area">
            <div class="container large">
                <div class="page-title-area-inner section-spacing-top">
                    <div class="page-title-wrapper">
                        <h2 class="page-title fade-anim">Brands that <br>
                            <span>trust</span> PearlMind</h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-spacing-bottom-150">
            <div class="container large">
                <div class="row g-3 fade-anim">
                    @foreach ($clients as $client)
                        <div class="col-6 col-md-3">
                            <div class="client-name-chip">{{ $client }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="who-we-are section-spacing-bottom-150">
            <div class="container">
                <div class="who-we-are__wrapper">
                    <div class="who-we-are-sub">
                        <h6 class="section-subtitle">Testimonials</h6>
                    </div>
                    <div class="who-we-are__content">
                        @foreach ([
                            ['Impressive team — prompt, practical, and full of ideas we wouldn’t have thought of.', 'Khalid Al Mansoori', 'Social Media'],
                            ['Patient, competitive on price, and every requirement was met. Highly recommended.', 'Afra Al Harbi', 'Digital Marketing'],
                            ['Excellent delivery, organized end-to-end. Always available for urgent support.', 'Omar Al Farsi', 'Website Development'],
                        ] as [$quote, $name, $role])
                            <p class="designation text-gray mb-40 fade-anim">
                                “{{ $quote }}” — <strong>{{ $name }}</strong>, {{ $role }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
