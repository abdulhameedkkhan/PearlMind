<header class="header-area">
    <div class="header-main">
        <div class="container rr-container-1650">
            <div class="header-area__inner">
                <div class="header__logo">
                    @include('partials.logo')
                </div>
                <div class="header__shape">
                    <svg width="13" height="40" viewBox="0 0 13 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="6" width="1" height="40" fill="white" fill-opacity="0.1" />
                        <rect y="10" width="1" height="20" fill="white" fill-opacity="0.1" />
                        <rect x="12" y="10" width="1" height="20" fill="white" fill-opacity="0.1" />
                    </svg>
                </div>
                <div class="header__nav">
                    @include('partials.nav-menu')
                </div>
                <div class="header__navicon d-xl-none">
                    <button class="side-toggle" type="button">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
