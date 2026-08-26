/*-----------------------------------------------------------------------------------
    Template Name: patte
    Note: Custom JS with safety null-checks
-----------------------------------------------------------------------------------*/

jQuery(document).ready(function($) {
    if ($.isFunction($.fn.owlCarousel)) {
        /* 01. slider-categorie */
        if ($('.slider-categorie').length) {
            $('.slider-categorie').owlCarousel({
                loop: true,
                dot: true,
                nav: true,
                autoplay: true,
                navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    993: { items: 3 },
                    1360: { items: 4 }
                }
            });
        }

        /* 02. hero-one-slider */
        if ($('.hero-one-slider.owl-carousel').length) {
            $('.hero-one-slider.owl-carousel').owlCarousel({
                loop: true,
                dots: true,
                nav: false,
                items: 1,
                autoplay: true,
                autoplayTimeout: 5000,
                smartSpeed: 800
            });
        }

        /* 03. client-slider */
        if ($('.client-slider.owl-carousel').length) {
            $('.client-slider.owl-carousel').owlCarousel({
                loop: true,
                dots: true,
                nav: true,
                autoplay: true,
                navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
                responsive: {
                    0: { items: 1 },
                    768: { items: 1 },
                    1200: { items: 2 }
                }
            });
        }

        /* 06. logodata */
        if ($('.logodata').length) {
            $('.logodata').owlCarousel({
                loop: true,
                dots: false,
                nav: false,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: { items: 2 },
                    800: { items: 3 },
                    1000: { items: 4 },
                    1200: { items: 5 }
                }
            });
        }
    }

    /* Loader */
    $('body').addClass('loaded');

    /* Mobile Nav Toggle */
    $('.bar-menu').on('click', function() {
        $('#mobile-nav').toggleClass('open hmburger-menu').show();
    });

    $('#res-cross, #closeMobileNavBtn').on('click', function() {
        $('#mobile-nav').removeClass('open');
    });

    /* Header Search */
    if ($('.search-box-outer').length) {
        $('.search-box-outer').on('click', function() {
            $('body').addClass('search-active');
            $('#searchModal').css('display', 'flex');
        });
        $('.close-search, #closeSearchModalBtn').on('click', function() {
            $('body').removeClass('search-active');
            $('#searchModal').hide();
        });
    }

    /* Accordion */
    $('.accordion-item .heading').on('click', function(e) {
        e.preventDefault();
        var item = $(this).closest('.accordion-item');
        if (item.hasClass('active')) {
            item.removeClass('active');
        } else {
            $('.accordion-item').removeClass('active');
            item.addClass('active');
        }
        var $content = $(this).next();
        $content.slideToggle(100);
        $('.accordion-item .content').not($content).slideUp('fast');
    });
});

/* Countdown Timer */
if (document.getElementById("days")) {
    (function() {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        let today = new Date(),
            dd = String(today.getDate()).padStart(2, "0"),
            mm = String(today.getMonth() + 1).padStart(2, "0"),
            yyyy = today.getFullYear(),
            nextYear = yyyy + 1,
            dayMonth = "12/30/",
            birthday = dayMonth + yyyy;

        today = mm + "/" + dd + "/" + yyyy;
        if (today > birthday) {
            birthday = dayMonth + nextYear;
        }

        const countDown = new Date(birthday).getTime(),
            x = setInterval(function() {
                const now = new Date().getTime(),
                    distance = countDown - now;

                const daysEl = document.getElementById("days");
                const hoursEl = document.getElementById("hours");
                const minutesEl = document.getElementById("minutes");
                const secondsEl = document.getElementById("seconds");

                if (daysEl) daysEl.innerText = String(Math.floor(distance / day)).padStart(2, '0');
                if (hoursEl) hoursEl.innerText = String(Math.floor((distance % day) / hour)).padStart(2, '0');
                if (minutesEl) minutesEl.innerText = String(Math.floor((distance % hour) / minute)).padStart(2, '0');
                if (secondsEl) secondsEl.innerText = String(Math.floor((distance % minute) / second)).padStart(2, '0');

                if (distance < 0) {
                    clearInterval(x);
                }
            }, 1000);
    }());
}

/* Scroll Progress with null check */
let calcScrollValue = () => {
    let scrollProgress = document.getElementById("progress");
    if (!scrollProgress) return;
    let pos = document.documentElement.scrollTop;
    let calcHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    let scrollValue = calcHeight > 0 ? Math.round((pos * 100) / calcHeight) : 0;
    if (pos > 100) {
        scrollProgress.style.display = "grid";
    } else {
        scrollProgress.style.display = "none";
    }
    scrollProgress.onclick = () => {
        document.documentElement.scrollTop = 0;
    };
    scrollProgress.style.background = `conic-gradient(#fa441d ${scrollValue}%, #fff ${scrollValue}%)`;
};

window.addEventListener('scroll', calcScrollValue);
window.addEventListener('load', calcScrollValue);