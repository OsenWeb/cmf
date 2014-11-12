(function() {
    var app = angular.module("cmf", ['ngAnimate']);

    app.controller("TabController", function() {
        this.currentTab = 0;

        this.setCurrentTab = function(tab) {
            this.currentTab = tab;
        };

        this.isCurrentTab = function(tab) {
            return this.currentTab === tab;
        };
    });

    app.controller("SliderController", function($scope) {

        this.slides = [];

        $scope.$watch(function() {
            return $scope.images;
        }, function(newVal, oldVal, scope) {
            scope.sliderCtrl.slides = scope.images;
        });

        this.currentSlide = 0;

        this.checkCurrentSlide = function(slideIndex) {
            return slideIndex === this.currentSlide;
        };

        this.setCurrentSlide = function(slideIndex) {
            this.currentSlide = slideIndex;
        };

        this.back = function() {
            if(this.currentSlide > 0) {
                this.currentSlide -= 1;
            } else {
                this.currentSlide = this.slides.length - 1;
            };
        };

        this.forward = function() {
            if(this.currentSlide < this.slides.length - 1) {
                this.currentSlide += 1;
            } else {
                this.currentSlide = 0;
            };
        };
    });

    app.factory('dd', function() {
        var dd = {
            currentDropdown: undefined,
            setCurrentDropdown: function(dropdown) {
                this.currentDropdown = dropdown;
            }
        };
        return dd;
    });

    app.controller("DropdownController", ['dd', function(dd) {
        this.showElement = function() {
            return this === dd.currentDropdown;
        };

        this.toggleElVisibility = function() {
            if(this === dd.currentDropdown) {
                dd.setCurrentDropdown(undefined);
            } else {
                dd.setCurrentDropdown(this);
            };
        };
    }]);

})();


