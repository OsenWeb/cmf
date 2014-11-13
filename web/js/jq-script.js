myjQ(function($) {

    $('.carousel .carousel-wrap').on('jcarousel:reload jcarousel:create', function () {
        var carouselEl = $(this);
        var width = carouselEl.innerWidth();

        if (width >= 1660) {            
            width = width/5;
        } else if (width >= 1260) {          
            width = width/4;
        } else {            
            width = width/3;
        }

        carouselEl.jcarousel('items').css('width', width + 'px');
    }).jcarousel({
        wrap: 'circular'
    });

    $('.carousel-back').on("click", function() {
        var carouselEl = $(this).closest('.carousel').find('.carousel-wrap');
        carouselEl.jcarousel('scroll', '-=1');
    });

    $('.carousel-forward').on("click", function() {
        var carouselEl = $(this).closest('.carousel').find('.carousel-wrap');
        carouselEl.jcarousel('scroll', '+=1');
    });
    
});