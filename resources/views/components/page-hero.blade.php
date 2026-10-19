@props(['title' => null, 'subtitle' => null, 'lead' => null])

<section class="border-b border-line bg-surface">
    <div class="container-site py-14 lg:py-20">
        @if ($subtitle)
            <p class="section-subtitle">{{ $subtitle }}</p>
        @endif
        @if ($title)
            <h1 class="section-title mt-3 max-w-3xl">{{ $title }}</h1>
        @endif
        @if ($lead)
            <p class="section-lead mt-5 max-w-2xl">{{ $lead }}</p>
        @endif
        {{ $slot }}
    </div>
</section>
