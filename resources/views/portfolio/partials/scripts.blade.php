<script>
    // Theme Management
    const themeToggle = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    const html = document.documentElement;

    function initTheme() {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const isDark = savedTheme ? savedTheme === 'dark' : prefersDark;
        
        if (isDark) {
            html.classList.add('dark');
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        } else {
            html.classList.remove('dark');
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        }
    }

    function toggleTheme() {
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        
        if (isDark) {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        } else {
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        }
    }

    themeToggle.addEventListener('click', toggleTheme);
    initTheme();

    // Mobile Menu
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOpen = document.getElementById('menu-open');
    const menuClose = document.getElementById('menu-close');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

    mobileMenuBtn.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.toggle('hidden');
        mobileMenuBtn.setAttribute('aria-expanded', !isOpen);
        menuOpen.classList.toggle('hidden');
        menuClose.classList.toggle('hidden');
    });

    mobileNavLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            menuOpen.classList.remove('hidden');
            menuClose.classList.add('hidden');
        });
    });

    // Navbar Scroll Effect
    const navbar = document.getElementById('navbar');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            navbar.classList.add('bg-white/90', 'dark:bg-slate-950/90', 'shadow-md');
        } else {
            navbar.classList.remove('bg-white/90', 'dark:bg-slate-950/90', 'shadow-md');
        }
        
        lastScroll = currentScroll;
    });

    // Active Navigation Link
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');

    function updateActiveLink() {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            const sectionHeight = section.offsetHeight;
            if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('text-primary-600', 'dark:text-primary-400');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('text-primary-600', 'dark:text-primary-400');
            }
        });
    }

    window.addEventListener('scroll', updateActiveLink);

    // Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                const offset = 80;
                const targetPosition = target.offsetTop - offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Intersection Observer for Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
                
                // Trigger counter animations
                if (entry.target.querySelector('.counter')) {
                    animateCounters(entry.target);
                }
                
                // Trigger skill progress bars
                if (entry.target.querySelector('.skill-progress')) {
                    animateSkillBars(entry.target);
                }
            }
        });
    }, observerOptions);

    document.querySelectorAll('[data-aos]').forEach(el => {
        observer.observe(el);
    });

    // Counter Animation
    function animateCounters(container) {
        const counters = container.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = parseInt(counter.dataset.target) || 0;
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current) + (target > 100 ? '+' : '');
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target + (target > 100 ? '+' : '');
                }
            };
            
            updateCounter();
        });
    }

    // Skill Progress Bars Animation
    function animateSkillBars(container) {
        const bars = container.querySelectorAll('.skill-progress');
        const percentages = container.querySelectorAll('.skill-percentage');
        
        bars.forEach((bar, index) => {
            const target = parseInt(bar.dataset.percentage) || 0;
            bar.style.width = target + '%';
        });
        
        percentages.forEach((el, index) => {
            const target = parseInt(el.dataset.target) || 0;
            let current = 0;
            const duration = 1500;
            const step = target / (duration / 16);
            
            const updatePercentage = () => {
                current += step;
                if (current < target) {
                    el.textContent = Math.floor(current) + '%';
                    requestAnimationFrame(updatePercentage);
                } else {
                    el.textContent = target + '%';
                }
            };
            
            setTimeout(updatePercentage, 300);
        });
    }

    // Hero Canvas Animation
    function initHeroCanvas() {
        const canvas = document.getElementById('hero-canvas');
        if (!canvas) return;
        
        const ctx = canvas.getContext('2d');
        let particles = [];
        let animationId = null;
        
        function resize() {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }
        
        function createParticles() {
            particles = [];
            const count = Math.min(80, Math.floor(canvas.width * canvas.height / 15000));
            
            for (let i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    vx: (Math.random() - 0.5) * 0.5,
                    vy: (Math.random() - 0.5) * 0.5,
                    radius: Math.random() * 2 + 0.5,
                    opacity: Math.random() * 0.5 + 0.1
                });
            }
        }
        
        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            const isDark = document.documentElement.classList.contains('dark');
            const primaryColor = isDark ? '99, 102, 241' : '99, 102, 241'; // primary-500
            const accentColor = isDark ? '249, 115, 22' : '249, 115, 22'; // accent-500
            
            particles.forEach(p => {
                // Draw particle
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(${primaryColor}, ${p.opacity})`;
                ctx.fill();
                
                // Update position
                p.x += p.vx;
                p.y += p.vy;
                
                // Wrap around
                if (p.x < 0) p.x = canvas.width;
                if (p.x > canvas.width) p.x = 0;
                if (p.y < 0) p.y = canvas.height;
                if (p.y > canvas.height) p.y = 0;
            });
            
            // Draw connections
            particles.forEach((p1, i) => {
                particles.slice(i + 1).forEach(p2 => {
                    const dx = p1.x - p2.x;
                    const dy = p1.y - p2.y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    
                    if (dist < 120) {
                        ctx.beginPath();
                        ctx.moveTo(p1.x, p1.y);
                        ctx.lineTo(p2.x, p2.y);
                        ctx.strokeStyle = `rgba(${primaryColor}, ${0.1 * (1 - dist / 120)})`;
                        ctx.lineWidth = 0.5;
                        ctx.stroke();
                    }
                });
            });
            
            animationId = requestAnimationFrame(draw);
        }
        
        function start() {
            resize();
            createParticles();
            draw();
        }
        
        function stop() {
            cancelAnimationFrame(animationId);
        }
        
        window.addEventListener('resize', () => {
            resize();
            createParticles();
        });
        
        // Recreate particles on theme change
        const themeObserver = new MutationObserver(() => {
            createParticles();
        });
        themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
        
        start();
    }
    
    initHeroCanvas();

    // Typed Text Animation
    function initTypedText() {
        const typedText = document.getElementById('typed-text');
        if (!typedText) return;
        
        const texts = [
            'Full Stack Developer',
            'Laravel Expert',
            'Vue.js Enthusiast',
            'Cloud Architect',
            'Problem Solver'
        ];
        
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typeSpeed = 100;
        
        function type() {
            const currentText = texts[textIndex];
            
            if (isDeleting) {
                typedText.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;
                typeSpeed = 50;
            } else {
                typedText.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;
                typeSpeed = 100;
            }
            
            if (!isDeleting && charIndex === currentText.length) {
                isDeleting = true;
                typeSpeed = 2000;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
                typeSpeed = 500;
            }
            
            setTimeout(type, typeSpeed);
        }
        
        type();
    }
    
    initTypedText();

    // Project Filtering
    const filterBtns = document.querySelectorAll('.project-filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    const projectsGrid = document.getElementById('projects-grid');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;
            
            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-primary-600', 'text-white');
                b.classList.add('bg-slate-100', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-300');
            });
            btn.classList.add('active', 'bg-primary-600', 'text-white');
            btn.classList.remove('bg-slate-100', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-300');
            
            // Filter cards
            projectCards.forEach((card, index) => {
                const category = card.dataset.category;
                const show = filter === 'all' || category === filter;
                
                if (show) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // Testimonials Carousel
    const testimonialTrack = document.getElementById('testimonials-track');
    const testimonialPrev = document.getElementById('testimonial-prev');
    const testimonialNext = document.getElementById('testimonial-next');
    const testimonialDots = document.querySelectorAll('.testimonial-dot');
    
    if (testimonialTrack && testimonialPrev && testimonialNext) {
        let currentSlide = 0;
        const totalSlides = testimonialDots.length;
        let autoSlideInterval;
        
        function updateCarousel() {
            const slideWidth = testimonialTrack.querySelector('.testimonial-slide').offsetWidth;
            testimonialTrack.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
            
            testimonialDots.forEach((dot, index) => {
                dot.classList.toggle('bg-primary-600', index === currentSlide);
                dot.classList.toggle('bg-slate-300', index !== currentSlide);
                dot.classList.toggle('dark:bg-slate-600', index !== currentSlide);
                dot.setAttribute('aria-selected', index === currentSlide);
            });
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }
        
        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }
        
        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
        }
        
        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }
        
        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }
        
        testimonialNext.addEventListener('click', () => {
            nextSlide();
            stopAutoSlide();
            startAutoSlide();
        });
        
        testimonialPrev.addEventListener('click', () => {
            prevSlide();
            stopAutoSlide();
            startAutoSlide();
        });
        
        testimonialDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                goToSlide(index);
                stopAutoSlide();
                startAutoSlide();
            });
        });
        
        // Pause on hover
        testimonialTrack.parentElement.addEventListener('mouseenter', stopAutoSlide);
        testimonialTrack.parentElement.addEventListener('mouseleave', startAutoSlide);
        
        // Handle resize
        window.addEventListener('resize', updateCarousel);
        
        startAutoSlide();
    }

    // Contact Form Handling
    const contactForm = document.getElementById('contact-form');
    const formStatus = document.getElementById('form-status');
    
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(contactForm);
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="ph-fill ph-spinner animate-spin"></i> Sending...';
            
            try {
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    formStatus.className = 'block p-4 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300';
                    formStatus.textContent = data.message || 'Message sent successfully!';
                    contactForm.reset();
                } else {
                    throw new Error(data.message || 'Failed to send message');
                }
            } catch (error) {
                formStatus.className = 'block p-4 rounded-xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300';
                formStatus.textContent = error.message || 'Something went wrong. Please try again.';
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
                
                setTimeout(() => {
                    formStatus.classList.add('hidden');
                }, 5000);
            }
        });
    }

    // Parallax Effect for Hero
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const hero = document.getElementById('home');
        if (hero) {
            const shapes = hero.querySelectorAll('.absolute > div[class*="blur"]');
            shapes.forEach((shape, index) => {
                const speed = 0.1 + (index * 0.05);
                shape.style.transform = `translateY(${scrolled * speed}px)`;
            });
        }
    });

    // Scroll Reveal for Elements without data-aos
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.skill-category, .tool-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        revealObserver.observe(el);
    });

    // Scroll to Top Button
    const scrollTopBtn = document.getElementById('scroll-top');
    if (scrollTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'invisible');
                scrollTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'invisible');
                scrollTopBtn.classList.remove('opacity-100', 'visible');
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Smooth reveal for stats
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelectorAll('.counter').forEach(counter => {
                    if (!counter.classList.contains('animated')) {
                        counter.classList.add('animated');
                        animateCounters(entry.target);
                    }
                });
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-aos="zoom-in"]').forEach(el => {
        statsObserver.observe(el);
    });
</script>

<style>
    /* AOS Animation Classes */
    [data-aos] {
        opacity: 0;
        transition-property: opacity, transform;
        transition-duration: 0.8s;
        transition-timing-function: ease-out;
    }
    
    [data-aos="fade-up"] {
        transform: translateY(30px);
    }
    
    [data-aos="fade-down"] {
        transform: translateY(-30px);
    }
    
    [data-aos="fade-right"] {
        transform: translateX(-30px);
    }
    
    [data-aos="fade-left"] {
        transform: translateX(30px);
    }
    
    [data-aos="zoom-in"] {
        transform: scale(0.9);
    }
    
    [data-aos].aos-animate {
        opacity: 1;
        transform: translate(0) scale(1);
    }
    
    /* Animation Delays */
    .animation-delay-100 { transition-delay: 100ms; }
    .animation-delay-200 { transition-delay: 200ms; }
    .animation-delay-300 { transition-delay: 300ms; }
    .animation-delay-400 { transition-delay: 400ms; }
    .animation-delay-500 { transition-delay: 500ms; }
    .animation-delay-600 { transition-delay: 600ms; }
    .animation-delay-700 { transition-delay: 700ms; }
    .animation-delay-800 { transition-delay: 800ms; }
    .animation-delay-900 { transition-delay: 900ms; }
    .animation-delay-1000 { transition-delay: 1000ms; }
    
    /* Custom Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    
    @keyframes float-slow {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(5deg); }
    }
    
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 0.8; }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-float-slow {
        animation: float-slow 8s ease-in-out infinite;
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 4s ease-in-out infinite;
    }
    
    .animate-slide-up {
        animation: slideUp 0.8s ease-out forwards;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .typing-cursor {
        display: inline-block;
        width: 2px;
        height: 1.2em;
        background: currentColor;
        margin-left: 4px;
        animation: blink 1s infinite;
        vertical-align: text-bottom;
    }
    
    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Focus Visible */
    :focus-visible {
        outline: 2px solid #6366f1;
        outline-offset: 2px;
    }
    
    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    
    .dark ::-webkit-scrollbar-track {
        background: #0f172a;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    .dark ::-webkit-scrollbar-thumb {
        background: #475569;
    }
    
    .dark ::-webkit-scrollbar-thumb:hover {
        background: #64748b;
    }
    
    /* Project Card Transitions */
    .project-card {
        transition: opacity 0.3s ease, transform 0.3s ease, display 0.3s ease;
    }
    
    /* Skill Progress Bar */
    .skill-progress {
        transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Reduced Motion */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>