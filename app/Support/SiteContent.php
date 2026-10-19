<?php

namespace App\Support;

use App\Models\Project;
use Illuminate\Support\Facades\Schema;

class SiteContent
{
    public static function company(): array
    {
        return [
            'name' => 'PearlMind',
            'type' => 'Digital Agency — Website Development, Digital Marketing, App & Software Development',
            'city' => 'Doha, Qatar',
            'address' => 'Building No. 71, Floor No. 6, Office 601, Al Doha Al Jadeeda, Doha, Qatar',
            'phone' => '+974 7176 0983',
            'phone_tel' => '+97471760983',
            'email' => 'contact@pearlmind.qa',
            'whatsapp' => '97471760983',
        ];
    }

    public static function origin(): string
    {
        $base = rtrim((string) config('app.url'), '/');
        $host = parse_url($base, PHP_URL_HOST) ?: '';

        if ($host === '' || in_array($host, ['localhost', '127.0.0.1'], true)) {
            return 'https://pearlmind.qa';
        }

        return $base;
    }

    public static function canonical(?string $path = null): string
    {
        $path = trim($path ?? request()->path(), '/');

        return self::origin().($path === '' ? '/' : '/'.$path);
    }

    public static function services(): array
    {
        return [
            'website-development' => [
                'slug' => 'website-development',
                'title' => 'Website Development',
                'short' => 'Modern, fast, and reliable websites tailored to your business in Qatar.',
                'headline' => 'Website Development Services in Qatar',
                'text' => 'At PearlMind, we design and develop modern, fast, and reliable websites tailored to your business needs. Whether you need a WordPress website, a fully custom-coded solution, or a complete E-commerce store, our team builds websites that are visually appealing, mobile-friendly, and optimized to convert visitors into customers. We offer end-to-end E-commerce development — from product catalogs and secure payment integration to inventory management — giving your business a complete online store built to grow with you.',
                'meta_title' => 'Website Development Doha | PearlMind Digital Agency Qatar',
                'meta_description' => 'Website development in Doha, Qatar — WordPress, custom-coded sites, and complete E-commerce solutions by PearlMind.',
                'meta_keywords' => 'website development Qatar, website design Doha, WordPress website Qatar, ecommerce website Doha, web design company Qatar',
                'img' => '/amonx/images/resources/testimonials-1-6-large.jpg',
                'offers' => [
                    'WordPress Website Development',
                    'Custom-Coded Website Development',
                    'Complete E-commerce Website Solutions',
                    'Website Redesign & Revamp',
                    'Landing Pages & Business Websites',
                    'Website Maintenance & Support',
                ],
                'show_portfolio' => true,
                'show_social' => false,
                'industries' => [],
            ],
            'social-media-marketing' => [
                'slug' => 'social-media-marketing',
                'title' => 'Social Media Marketing & Management',
                'short' => 'Strategic content, creative design, and consistent engagement that grows your brand.',
                'headline' => 'Social Media Marketing & Management',
                'text' => 'PearlMind helps brands grow their presence on social media through strategic content, creative design, and consistent engagement. We manage complete social media accounts for businesses across various industries including beauty salons, E-commerce brands, car garages, trading & contracting companies, and restaurants — building strong online communities that turn followers into loyal customers.',
                'meta_title' => 'Social Media Marketing Qatar | PearlMind Doha',
                'meta_description' => 'Social media marketing & management in Qatar — Instagram, Facebook, TikTok content, ads, and growth strategy by PearlMind.',
                'meta_keywords' => 'social media marketing Qatar, social media management Doha, Instagram marketing Qatar, Facebook ads Doha, TikTok content Qatar',
                'img' => '/amonx/images/resources/testimonials-1-5-large.jpg',
                'offers' => [
                    'Social Media Account Management (Instagram, Facebook, TikTok)',
                    'Content Creation & Graphic Design',
                    'Social Media Ad Campaigns',
                    'Reels & Video Content Production',
                    'Brand Growth & Engagement Strategy',
                    'Monthly Content Calendars & Reporting',
                ],
                'show_portfolio' => false,
                'show_social' => true,
                'industries' => [
                    'Beauty Salons & Spas',
                    'E-commerce Brands',
                    'Car Garages & Automotive',
                    'Trading & Contracting Companies',
                    'Restaurants & Hospitality',
                    'And many more businesses across Qatar',
                ],
            ],
            'application-development' => [
                'slug' => 'application-development',
                'title' => 'Application Development',
                'short' => 'High-performing Android & iOS apps from concept to app store launch.',
                'headline' => 'Mobile Application Development',
                'text' => 'PearlMind builds high-performing mobile applications for Android and iOS, designed to give your business a seamless digital presence beyond the website. From concept to launch, we handle UI/UX design, development, testing, and deployment to app stores.',
                'meta_title' => 'App Development Qatar | Mobile Apps Doha | PearlMind',
                'meta_description' => 'Mobile application development in Qatar — Android, iOS, and cross-platform apps by PearlMind in Doha.',
                'meta_keywords' => 'app development Qatar, mobile app development Doha, Android app Qatar, iOS app Doha, application development Qatar',
                'img' => '/amonx/images/resources/testimonials-1-2-large.jpg',
                'offers' => [
                    'Android & iOS App Development',
                    'Cross-Platform App Development',
                    'UI/UX App Design',
                    'E-commerce & Business Mobile Apps',
                    'App Maintenance & Updates',
                ],
                'show_portfolio' => false,
                'show_social' => false,
                'industries' => [],
            ],
            'software-development' => [
                'slug' => 'software-development',
                'title' => 'Software Development',
                'short' => 'Custom software that streamlines operations and supports business growth.',
                'headline' => 'Custom Software Development',
                'text' => 'We design and develop custom software solutions that streamline business operations, improve efficiency, and support growth. From internal management systems to industry-specific tools, PearlMind builds software tailored exactly to how your business works.',
                'meta_title' => 'Software Development Doha | Custom Software Qatar | PearlMind',
                'meta_description' => 'Custom software development in Doha — CRM, ERP, booking systems, and API integration by PearlMind.',
                'meta_keywords' => 'software development Qatar, custom software Doha, CRM Qatar, ERP software Doha, business software Qatar',
                'img' => '/amonx/images/team/team-1-4.jpg',
                'offers' => [
                    'Custom Business Software & Management Systems',
                    'CRM & ERP Solutions',
                    'Booking & Inventory Management Systems',
                    'System Integration & API Development',
                    'Ongoing Software Support & Maintenance',
                ],
                'show_portfolio' => false,
                'show_social' => false,
                'industries' => [],
            ],
        ];
    }

    public static function service(string $slug): ?array
    {
        return self::services()[$slug] ?? null;
    }

    public static function servicesByGroup(): array
    {
        return ['Our Services' => array_values(self::services())];
    }

    public static function featuredServices(): array
    {
        return collect(array_values(self::services()))
            ->map(fn (array $service, int $i) => array_merge($service, [
                'num' => str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT),
            ]))
            ->all();
    }

    public static function contactSubjects(): array
    {
        return [
            'Website Development',
            'Social Media Marketing',
            'App Development',
            'Software Development',
            'Other',
        ];
    }

    /** @return list<array{title: string, url: string, domain: string, img: string, cat: string}> */
    public static function works(): array
    {
        if (Schema::hasTable('projects') && Project::query()->where('is_active', true)->exists()) {
            return Project::query()->visible()->get()->map(fn (Project $project) => [
                'title' => $project->title,
                'url' => $project->url,
                'domain' => $project->domain(),
                'cat' => $project->category,
                'img' => $project->image,
            ])->all();
        }

        $sites = [
            ['The Mok International', 'https://themokinternational.com', 'Website'],
            ['Electronyat', 'https://electronyat.qa', 'E-commerce'],
            ['Neelam', 'https://neelam.qa', 'Website'],
            ['Shopprve', 'https://shopprve.com', 'E-commerce'],
            ['Sada Beauty Salons', 'https://sadabeautysalons.com', 'Beauty'],
            ['Masterland Qatar', 'https://masterlandqatar.com', 'Website'],
            ['Accentia Consulting', 'https://accentiaconsulting.com', 'Consulting'],
            ['RH Contracting', 'https://rhcontracting.qa', 'Contracting'],
            ['Velvet Glow Salon & Spa Qatar', 'https://velvetglowsalonspaqatar.com', 'Beauty'],
            ['Next Vision Institute', 'https://nextvisioninstitute.com', 'Education'],
            ['Zymal Official', 'https://zymalofficial.com', 'E-commerce'],
            ['Mekarib RK', 'https://mekaribyrk.co', 'Website'],
            ['The Premium Butchers', 'https://thepremiumbutchers.com', 'E-commerce'],
        ];

        return array_map(function (array $item) {
            [$title, $url, $cat] = $item;
            $domain = preg_replace('#^https?://#', '', $url);

            return [
                'title' => $title,
                'url' => $url,
                'domain' => $domain,
                'cat' => $cat,
                'img' => '/images/work/'.$domain.'.jpg',
            ];
        }, $sites);
    }

    /** @return list<array{handle: string, url: string, name: string}> */
    public static function socialClients(): array
    {
        return [
            ['handle' => '@shopprve', 'url' => 'https://instagram.com/shopprve', 'name' => 'Shopprve'],
            ['handle' => '@pawzville', 'url' => 'https://instagram.com/pawzville', 'name' => 'Pawzville'],
            ['handle' => '@fat_pawz', 'url' => 'https://instagram.com/fat_pawz', 'name' => 'Fat Pawz'],
            ['handle' => '@nextvisioninstitute', 'url' => 'https://instagram.com/nextvisioninstitute', 'name' => 'Next Vision Institute'],
            ['handle' => '@the.premiumbutcher', 'url' => 'https://instagram.com/the.premiumbutcher', 'name' => 'The Premium Butcher'],
            ['handle' => '@sadabeautysalon.qa', 'url' => 'https://instagram.com/sadabeautysalon.qa', 'name' => 'Sada Beauty Salon'],
            ['handle' => '@velvetglowladiessalonandspa', 'url' => 'https://instagram.com/velvetglowladiessalonandspa', 'name' => 'Velvet Glow Salon & Spa'],
            ['handle' => '@shellabeautycenter', 'url' => 'https://instagram.com/shellabeautycenter', 'name' => 'Shella Beauty Center'],
        ];
    }

    public static function whyChoose(): array
    {
        return [
            '100+ businesses successfully served across Qatar',
            'End-to-end digital solutions under one roof — web, marketing, apps & software',
            'Dedicated team of designers, developers & digital marketers',
            'Custom solutions tailored to each client\'s industry and goals',
            'Proven experience across E-commerce, beauty & salon, automotive, hospitality, contracting, and trading businesses',
        ];
    }

    public static function faqs(): array
    {
        return [
            ['q' => 'What services does PearlMind provide?', 'a' => 'PearlMind is a digital agency in Doha offering website development, social media marketing & management, application development, and custom software development.'],
            ['q' => 'How long does it take to design and launch a website?', 'a' => 'Every project is different. We collect requirements, clarify scope, then agree on a realistic timeline and stick to it.'],
            ['q' => 'Do I need a big budget to work with PearlMind?', 'a' => 'Not at all. Packages fit different budgets without compromising quality.'],
            ['q' => 'Do you offer support after launch?', 'a' => 'Yes. We provide website maintenance, app updates, and ongoing software support after launch.'],
        ];
    }
}
