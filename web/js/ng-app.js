(function() {
    var app = angular.module("shop", []);

    app.controller("TabController", function() {
        this.currentTab = 0;

        this.setCurrentTab = function(tab) {
            this.currentTab = tab;
        };

        this.isCurrentTab = function(tab) {
            return this.currentTab === tab;
        }
    });

    app.controller("SliderController", function() {
        this.slides = testSlides;

        this.currentSlide = 0;

        this.checkCurrentSlide = function(slideIndex) {
            return slideIndex === this.currentSlide;
        }

        this.setCurrentSlide = function(slideIndex) {
            this.currentSlide = slideIndex;
        }

        this.back = function() {
            if(this.currentSlide > 0) {
                this.currentSlide -= 1;
            } else {
                this.currentSlide = this.slides.length - 1;
            }
        }

        this.forward = function() {
            if(this.currentSlide < this.slides.length - 1) {
                this.currentSlide += 1;
            } else {
                this.currentSlide = 0;
            }
        }
    });

})();


var testSlides = [{
    smallImage: 'images/demo-prod-1.jpg',
    mediumImage: 'images/demo-prod-1.jpg',
    laggeImage: 'images/demo-prod-1.jpg'
}, {
    smallImage: 'images/demo-prod-2.jpg',
    mediumImage: 'images/demo-prod-2.jpg',
    laggeImage: 'images/demo-prod-2.jpg'
}, {
    smallImage: 'images/demo-prod-3.jpg',
    mediumImage: 'images/demo-prod-3.jpg',
    laggeImage: 'images/demo-prod-3.jpg'
}, {
    smallImage: 'images/demo-prod-2.jpg',
    mediumImage: 'images/demo-prod-2.jpg',
    laggeImage: 'images/demo-prod-2.jpg'
}];