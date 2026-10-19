@php
    use App\Support\SiteContent;
    $navServices = array_values(SiteContent::services());
@endphp
<nav class="main-menu">
    <ul>
        <li class="{{ request()->routeIs('home') ? 'current-menu-item' : '' }}">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="{{ request()->routeIs('about') ? 'current-menu-item' : '' }}">
            <a href="{{ route('about') }}">About Us</a>
        </li>
        <li class="menu-item-has-children {{ request()->routeIs('services*') ? 'current-menu-item' : '' }}">
            <a href="{{ route('services') }}">Services</a>
            <ul class="dp-menu">
                @foreach ($navServices as $item)
                    <li>
                        <a href="{{ route('services.show', $item['slug']) }}">{{ $item['title'] }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="{{ request()->routeIs('portfolio') ? 'current-menu-item' : '' }}">
            <a href="{{ route('portfolio') }}">Portfolio</a>
        </li>
        <li class="{{ request()->routeIs('contact') ? 'current-menu-item' : '' }}">
            <a href="{{ route('contact') }}">Contact</a>
        </li>
    </ul>
</nav>
