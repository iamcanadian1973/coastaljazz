(function (document, window, $) {

	'use strict';

	// Load Foundation
	$(document).foundation();
    
    
    
    $(window).on('load changed.zf.mediaquery', function(event, newSize, oldSize) {
        
        $( '.nav-primary' ).doubleTapToGo();
        
        if( ! Foundation.MediaQuery.atLeast('xlarge') ) {
          $( '.nav-primary' ).doubleTapToGo( 'destroy' );
        }
        
    });
    
    /*
    $('.basictable').basictable({
        forceResponsive: false,
    });
    */
    
    /*
    var tribe_wrapper = $('#tribe-events-content-wrapper .load-more-events');

    $('.tribe-events-week-grid:last #tribe-events-footer a').on('click', function(ev) {
        var href = $(this).attr('href') + ' .tribe-events-week-grid';

        ev.preventDefault();
    
      
        tribe_wrapper.append(href);
    });
    */
    
    /*
    $('body').on('click', '.tribe-events-week-grid:last #tribe-events-footer a', function(e) {

      // Don't actually follow the href in the <a>
      e.preventDefault();

      var $el = $(e.target),      // the <a>
         $resp = $('<div>'),      // a <div> to store our new posts
         $parent = $el.parent();  // the <div> wrapper for the current loop

      // Hide the "Load More" button and show the "Loading..." indicator
      $parent.addClass('loading');

      // Get posts (and new Load More button) from archive page and append them to our existing posts 
      $resp.load($el.attr('href') + ' .load-more-wrapper', function() {

         $parent.removeClass('loading');

         var $container = $el.parents('.load-more-wrapper').find('.load-more-container'),
            $new_posts = $resp.find('.load-more-container').children(),
            $load_more = $resp.find('.load-more') || '';

         $container.append($new_posts);

         //$el.parent().replaceWith($load_more);
      });
   });
    */
    
    
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }
    
    
    
    // Remove default behiavior
    $( '#tribe_events_filters_wrapper' ).off( 'click', '#tribe_events_filters_reset' );
    
    
    $( '#tribe_events_filters_wrapper' ).on( 'click', '#tribe_events_filters_reset', function( e ) {

	        e.preventDefault();
            
            var tribe_eventcategory = getUrlParameter('tribe_eventcategory');
                        
            var cat = '';
            
            if( tribe_eventcategory ==  2 ) {
                cat = 'category/festival';
            }
            else if( tribe_eventcategory ==  3 ) {
               cat = 'category/year-round'; 
            }
            else {
                
            }
            
            
            window.location.href = coastal.tribe_get_events_link + cat;
            
            return false;
                
     } );
    

}(document, window, jQuery));

