/* Studio Vendrig V5 — interactie: menu, hero-diavoorstelling, reveal, lightbox */
(function () {
    'use strict';

    /* Mobiel menu */
    var toggle = document.getElementById('navToggle');
    var nav = document.getElementById('mainNav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('open');
            toggle.classList.toggle('open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    }

    /* Hero-diavoorstelling */
    var slides = document.querySelectorAll('#heroSlides img');
    var counter = document.getElementById('heroIndex');
    if (slides.length > 1) {
        var current = 0;
        setInterval(function () {
            slides[current].classList.remove('is-active');
            current = (current + 1) % slides.length;
            slides[current].classList.add('is-active');
            if (counter) {
                counter.textContent = String(current + 1).padStart(2, '0');
            }
        }, 4500);
    }

    /* Reveal bij scrollen */
    var reveals = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && reveals.length) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        reveals.forEach(function (el) { io.observe(el); });
    } else {
        reveals.forEach(function (el) { el.classList.add('is-visible'); });
    }

    /* Lightbox voor projectgalerij */
    var lightbox = document.getElementById('lightbox');
    var galleryImgs = Array.prototype.slice.call(document.querySelectorAll('.gallery-item img'));
    if (lightbox && galleryImgs.length) {
        var lbImg = lightbox.querySelector('img');
        var lbCaption = lightbox.querySelector('.lightbox-caption');
        var index = 0;

        function show(i) {
            index = (i + galleryImgs.length) % galleryImgs.length;
            lbImg.src = galleryImgs[index].src;
            lbImg.alt = galleryImgs[index].alt;
            lbCaption.textContent = galleryImgs[index].dataset.caption || '';
        }
        function open(i) {
            show(i);
            lightbox.hidden = false;
            document.body.style.overflow = 'hidden';
        }
        function close() {
            lightbox.hidden = true;
            document.body.style.overflow = '';
        }

        galleryImgs.forEach(function (img, i) {
            img.addEventListener('click', function () { open(i); });
        });
        lightbox.querySelector('.lightbox-close').addEventListener('click', close);
        lightbox.querySelector('.lightbox-prev').addEventListener('click', function () { show(index - 1); });
        lightbox.querySelector('.lightbox-next').addEventListener('click', function () { show(index + 1); });
        lightbox.addEventListener('click', function (e) { if (e.target === lightbox) close(); });
        document.addEventListener('keydown', function (e) {
            if (lightbox.hidden) return;
            if (e.key === 'Escape') close();
            if (e.key === 'ArrowLeft') show(index - 1);
            if (e.key === 'ArrowRight') show(index + 1);
        });
    }
})();
