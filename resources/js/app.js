document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('[data-site-header]');
    const menuBtn = document.querySelector('[data-menu-toggle]');
    const mobileNav = document.querySelector('[data-mobile-nav]');
    const servicesMega = document.querySelector('[data-services-mega]');
    const servicesToggle = document.querySelector('[data-services-toggle]');

    const onScroll = () => {
        header?.classList.toggle('is-scrolled', window.scrollY > 10);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    menuBtn?.addEventListener('click', () => {
        const open = mobileNav?.classList.toggle('hidden') === false;
        menuBtn.setAttribute('aria-expanded', String(open));
        document.body.classList.toggle('overflow-hidden', open);
    });

    mobileNav?.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            mobileNav.classList.add('hidden');
            menuBtn?.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
        });
    });

    const closeServices = () => {
        servicesMega?.classList.remove('is-open');
        servicesToggle?.setAttribute('aria-expanded', 'false');
    };

    const openServices = () => {
        servicesMega?.classList.add('is-open');
        servicesToggle?.setAttribute('aria-expanded', 'true');
    };

    servicesToggle?.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = servicesMega?.classList.contains('is-open');
        if (isOpen) {
            closeServices();
        } else {
            openServices();
        }
    });

    document.addEventListener('click', (e) => {
        if (!servicesMega?.contains(e.target)) {
            closeServices();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeServices();
        }
    });

    document.querySelectorAll('[data-region-toggle]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            btn.closest('.region-mega')?.classList.toggle('open');
        });
    });
});
