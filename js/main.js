/*

Created by Methanic

 */

jQuery(document).ready(function($) {

    // Navigation

    $('.home #site-navigation').onePageNav({
        currentClass: 'active',
        changeHash: false,
        scrollSpeed: 750,
        scrollOffset: 100,
        filter: ':not(.external)',
        easing: 'swing'
    });

    // Header background

    function headerOffset() {
        var header = $('#masthead');
        var windowOffset = $(window).scrollTop();

        if (windowOffset > header.height() && header.hasClass("dynamic")) {
            header.addClass("scrolled");
        } else {
            header.removeClass("scrolled");
        }
    };

    headerOffset();

    // Sliders

    var slickSettings = {
        autoplay: true,
        infinite: true,
        prevArrow: '<div class="left carousel-arrows"><i class="fas fa-angle-left fa-2x"></i></div>',
        nextArrow: '<div class="right carousel-arrows"><i class="fas fa-angle-right fa-2x"></i></div>',
        speed: 200
    };

    $('.slider').each(function() {
        var slider = $(this);

        if (slider.hasClass('slider-fade')) {
            slickSettings.fade = true;
        }

        if (slider.hasClass('slider-dots')) {
            slickSettings.dots = true;
        }

        if (slider.hasClass('slider-testimonial')) {
            slickSettings.adaptiveHeight = true;
            slickSettings.arrows = false;
            slickSettings.autoplaySpeed = 7000;
        }

        slider.on('init', function(e, slick) {
            slider.find('.slide-overlay.dynamic, .slide-content.dynamic').addClass('ready');
        });

        $('.slides', this).slick(slickSettings)
    });

    // FAQs

    $('.faqs').each(function() {
        $(this).accordion({
            active: false,
            collapsible: true,
            heightStyle: 'content',
            icons: false
        });
    })


    // Scroll cache

    var scrollCache;

    $(window).scroll(function() {
        clearTimeout(scrollCache);

        scrollCache = setTimeout(function() {
            headerOffset();
        }, 1)
    })
});
