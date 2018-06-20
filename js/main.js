/*

Created by Methanic

 */

jQuery(document).ready(function($) {

    $('.slider').each(function() {
        if ($(this).hasClass('slider-fade')) {
            $('.slides', this).slick({
                fade: true,
                infinite: true
            })
        } else {
            $('.slides', this).slick({
                infinite: true
            })
        }
    })
});
