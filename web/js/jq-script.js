myjQ(function($) {

    if($('.carousel').length) {

        function scrollСarouselBack(carouselEl) {
            carouselEl.jcarousel('scroll', '-=1');
        };

        function scrollСarouselForward(carouselEl) {
            carouselEl.jcarousel('scroll', '+=1');
        };

        var xDown = null;
        var yDown = null;

        function handleTouchStart(e) {
            xDown = e.originalEvent.touches[0].clientX;
            yDown = e.originalEvent.touches[0].clientY;
        };

        function handleTouchMove(e) {
            if ( ! xDown || ! yDown ) {
                return;
            };

            var xUp = e.originalEvent.touches[0].clientX;
            var yUp = e.originalEvent.touches[0].clientY;

            var xDiff = xDown - xUp;
            var yDiff = yDown - yUp;

            if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
                if ( xDiff > 0 ) {
                    /* left swipe */
                    var carouselEl = $(this);
                    scrollСarouselForward(carouselEl);
                } else {
                    /* right swipe */
                    var carouselEl = $(this);
                    scrollСarouselBack(carouselEl);
                };
            } else {
                if ( yDiff > 0 ) {
                    /* up swipe */ 
                } else { 
                    /* down swipe */
                };
            };
            xDown = null;
            yDown = null;
        };

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
            scrollСarouselBack(carouselEl);
        });

        $('.carousel-forward').on("click", function() {
            var carouselEl = $(this).closest('.carousel').find('.carousel-wrap');
            scrollСarouselForward(carouselEl);
        });

        $('.carousel .carousel-wrap').on("touchstart", handleTouchStart);
        $('.carousel .carousel-wrap').on("touchmove", handleTouchMove);
    
    };
});