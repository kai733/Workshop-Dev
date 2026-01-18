document.addEventListener('DOMContentLoaded', function () {
    const hamburgerBtn = document.querySelector('.hamburger-btn');
    const mobileNav = document.querySelector('.mobile-nav');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav a');
    const body = document.body;

    // Toggle mobile menu
    function toggleMenu() {
        const isOpen = mobileNav.classList.contains('active');

        if (isOpen) {
            closeMenu();
        } else {
            openMenu();
        }
    }

    function openMenu() {
        mobileNav.classList.add('active');
        hamburgerBtn.classList.add('active');
        hamburgerBtn.setAttribute('aria-expanded', 'true');
        body.style.overflow = 'hidden'; // Prevent body scroll
    }

    function closeMenu() {
        mobileNav.classList.remove('active');
        hamburgerBtn.classList.remove('active');
        hamburgerBtn.setAttribute('aria-expanded', 'false');
        body.style.overflow = ''; // Restore body scroll
    }

    // Hamburger button click
    hamburgerBtn.addEventListener('click', toggleMenu);

    // Close menu when clicking on a link
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Close menu when clicking outside
    mobileNav.addEventListener('click', function (e) {
        if (e.target === mobileNav) {
            closeMenu();
        }
    });

    // Close menu on ESC key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
            closeMenu();
        }
    });
});
