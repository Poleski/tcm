/*

Created by Methanic

 */

jQuery(document).ready(function($) {

    // Slick

    var slickSettings = {
        infinite: true,
        prevArrow: '<div class="left carousel-arrows"><i class="fas fa-angle-left fa-2x"></i></div>',
        nextArrow: '<div class="right carousel-arrows"><i class="fas fa-angle-right fa-2x"></i></div>',
    };

    $('.slider').each(function() {
        if ($(this).hasClass('slider-fade')) {
            slickSettings.fade = true;
        }

        if ($(this).hasClass('slider-dots')) {
            slickSettings.dots = true;
        }

        $('.slides', this).slick(slickSettings)
    })
});
