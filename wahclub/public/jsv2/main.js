(function ($) {
	"use strict";

	/*------------------------------------------------------
  /  Data js
  /------------------------------------------------------*/
 
	$(document).ready(function ($) {
		   
		   /*------------------------------------------------------
  	/  Hamburger Menu
  	/------------------------------------------------------*/
		$(".menu-bar").on("click", function () {
			$(".menu-bar").toggleClass("menu-bar-toggeled");
			$(".header-menu").toggleClass("opened");
			$("body").toggleClass("overflow-hidden");
		});

		$(".header-menu ul li a").on("click", function () {
			$(".menu-bar").removeClass("menu-bar-toggeled");
			$(".header-menu").removeClass("opened");
			$("body").removeClass("overflow-hidden");
		});

    /*------------------------------------------------------
        // category Carousel
  	/------------------------------------------------------*/
  	
  	    $(".toptags-carousel.owl-carousel").owlCarousel({
			loop: true,
			margin: 30,
			nav: false,
			dots: false,
			autoplay: true,
			active: true,
			autoplayHoverPause: true,
			smartSpeed: 1000,
			autoplayTimeout: 2000,
			responsive: {
				0: {
					items: 1,
				},
				600: {
					items: 2,
				},
				1000: {
					items: 3,
				},
				1400: {
					items: 4,
				},
			},
		});
  	 
		
 
	});

    $(".category-carousel.owl-carousel").owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        dots: false,
        autoplay: true,
        active: true,
        autoplayHoverPause: true,
        smartSpeed: 1000,
        autoplayTimeout: 2000,
        responsive: {
            0: {
                items: 1.3,
            },
            767: {
                items: 1.5,
            },
            800: {
                items: 2.2,
            },
            1000: {
                items: 3,
            },
            1400: {
                items: 4.1,
            },
        },
    });

	 
})(jQuery);