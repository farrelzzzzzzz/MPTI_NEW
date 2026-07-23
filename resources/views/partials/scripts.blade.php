<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile Menu Toggle
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');

        if (hamburger) {
            hamburger.addEventListener('click', function () {
                navMenu.classList.toggle('active');
                this.classList.toggle('active');
            });
        }

        // Close menu when clicking outside
        document.addEventListener('click', function (event) {

            if (!hamburger || !navMenu) {
                return;
            }

            const isClickInside =
                navMenu.contains(event.target) ||
                hamburger.contains(event.target);

            if (!isClickInside && navMenu.classList.contains('active')) {

                navMenu.classList.remove('active');
                hamburger.classList.remove('active');

            }

        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        // Close mobile menu
                        if (navMenu.classList.contains('active')) {
                            navMenu.classList.remove('active');
                            hamburger.classList.remove('active');
                        }
                    }
                }
            });
        });

        // Active link highlight
        const currentLocation = window.location.pathname;
        document.querySelectorAll('.nav-menu a').forEach(link => {
            const linkPath = link.getAttribute('href');
            if (linkPath === currentLocation || (currentLocation === '/' && linkPath === '{{ route('home') }}')) {
                link.classList.add('active');
            }
        });
    });
</script>