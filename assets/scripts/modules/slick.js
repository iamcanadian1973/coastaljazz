import $ from 'jquery';
import 'slick-carousel';

export default {
	init() {

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
		 
	},
};
