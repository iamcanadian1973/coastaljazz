(function($) {
	
	'use strict';	
	
     
    var royalSlider, nav;
 	  
	  // Homepage Slider
	  
	var custom_opts = {
		transitionType: 'move',
		controlNavigation:'bullets',
		imageScaleMode: 'fill',
		imageAlignCenter:false,
		arrowsNav: false,
		arrowsNavAutoHide: true,
		sliderTouch: false,
		addActiveClass: true,
		sliderDrag:false,
		fullscreen: false,
		loop: true,
		autoHeight: false,
		slidesSpacing: 0,
		transitionSpeed: 500,
        autoScaleSlider: true, 
		autoScaleSliderWidth: 1600,     
		autoScaleSliderHeight: 460,
        
		autoPlay: {
				// autoplay options go gere
				enabled: true,
				pauseOnHover: false,
				delay: 5000
			}
	  };
      
    $(window).load(function() {
        $('.slider .royalSlider').royalSlider(custom_opts);
        
        royalSlider = $(".royalSlider");
	
        $('.rsNav').appendTo('.slideshow');
      
       // hide single slider nav
        nav = royalSlider.find('.rsNav'); 
        if (nav.length && royalSlider.data('royalSlider').numSlides <= 1) { 
            nav.hide();
        }
        
    });
      
    
    var $slick_shows = $('.slick-shows');
    $slick_shows.on('init', function() {
        $slick_shows.each(function(index) {
            
        });
    });

    $slick_shows.slick({
        dots: false,
        //centerMode: true,
        slidesToShow: 3,
        arrows: true,
        //mobileFirst: true,
        nextArrow: '<div class="arrow-right"><i class="fa fa-chevron-right" aria-hidden="true"><span>Next</span></i></div>',
        prevArrow: '<div class="arrow-left"><i class="fa fa-chevron-left" aria-hidden="true"><span>Previous</span></i></div>',
        responsive: [
            {
              breakpoint: 980,
              settings: {
                //centerMode: true,
                slidesToShow: 2
              }
            },
            {
              breakpoint: 640,
              settings: {
                        //centerMode: true,
                slidesToShow: 1
              }
            }
        ]
    });
      
	
    
	
})(jQuery);